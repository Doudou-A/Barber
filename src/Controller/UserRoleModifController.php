<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRoleType;
use App\Service\CommonManager;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserRoleModifController extends AbstractController
{
    /**
     * @Route("/admin/user/role", name="user_role_modif")
     */
    public function index(UserRepository $repo, Request $request, CommonManager $commonManager)
    {
        $user = new User();

        $allUser = $repo->findAll();
        $form = $this->createForm(UserRoleType::class, $user, [
            'allUser' => $allUser,]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commonManager->persist($user);
        }
        return $this->render('security/userRoleModif.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
