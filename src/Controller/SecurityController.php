<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/security/formEmail", name="formEmailForgot")
     */
    public function formEmail(UserRepository $repo, MailerInterface $mailer, Request $request)
    {

        $form = $this->createFormBuilder()
            ->add('email', EmailType::class, [
                'label' => false
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $repo->findOneByEmail($form["email"]->getData());
            $message = (new Email())
                ->from('safouendakhli@workshop-barbershop.fr')
                ->to($user->getEmail())
                ->subject('Mot de passe oublié')
                ->text(
                    'Voici le lien pour modifier votre mot de passe : </br>
            http://localhost:8000/security/forgotPassword/' . $user->getToken() . '',
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('success', 'Vous allez recevoir un mail contenant un lien pour modifier votre mot de passe');

            return $this->redirectToRoute('home');
        }

        return $this->render('security/formMailForgot.html.twig', [
            'formEmail' => $form->createView()
        ]);
    }

    /**
     * @Route("/security/forgotPassword/{token}", name="forgotPassword")
     */
    public function forgotPassword(User $user=null, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $error = null;
        $error1 = null;

        if ($user == null) {
            $error = true;
        }

        $form = $this->createFormBuilder()
            ->add('password', PasswordType::class)
            ->add('passwordConfirm', PasswordType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form["password"]->getData() == $form["passwordConfirm"]->getData()) {
                $hash = $encoder->encodePassword($user, $form["password"]->getData());
                $user->setPassword($hash);
                $token = random_bytes(15);
                $user->setToken(bin2hex($token));

                $manager->persist($user);
                $manager->flush();
            } else {
                $error1 = true;

                return $this->render('security/forgotPassword.html.twig', [
                    'formPassword' => $form->createView(),
                    'error' => $error,
                    'error1' => $error1,
                ]);
            }

            return $this->redirectToRoute('home');
        }


        return $this->render('security/forgotPassword.html.twig', [
            'formPassword' => $form->createView(),
            'error' => $error,
            'error1' => $error1,

        ]);
    }
    
    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
