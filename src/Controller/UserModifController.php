<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserModifController extends AbstractController
{
    /**
     * @Route("/utilisateur/{id}", name="user_modification")
     */
    public function registration(User $user, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer)
    {
        if ($user->getId() !== $this->getUser()->getId()) {
            $this->addFlash('fail', 'Vous n\'êtes pas autorisé à accéder à ce compte');
            return $this->redirectToRoute('home');
        }
        $number = $user->getNumber();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($number !== $user->getNumber()){
                $numberChange = $user->getNumberChange();
                $user->setNumberChange($numberChange + 1);

            } 
            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Votre compte a bien été modifié');
            return $this->redirectToRoute('home');
        }

        return $this->render('security/user.html.twig', [
            'form' => $form->createView(),
            'EditMode' => true
        ]);
    }
}
