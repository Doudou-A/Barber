<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setDateCreated(new \DateTime());
            $user->setToken(random_bytes(10));

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            $manager->persist($user);
            $manager->flush();

            $message = (new \Swift_Message('Mail de Confirmation'))
                ->setFrom('send@example.com')
                ->setTo($user->getEmail())
                ->setBody(
                    'Voici le lien pour confirmer votre compte : </br>
            http://localhost:8000/security/confirm/' . $user->getToken() . ' </br>
            Vous pouvez utiliser votre compte durant 24h sans confirmer l\'adresse email.',
                    'text/html'
                );

            $mailer->send($message);

            return $this->redirectToRoute('home');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
