<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRoleType;
use App\Service\UserManager;
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
    public function index(UserManager $userManager, Request $request, CommonManager $commonManager, UserRepository $repo)
    {
        $user = new User();

        $allUser = $userManager->findAllUser();

        $form = $this->createForm(UserRoleType::class, $user, [
            'allUser' => $allUser,]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $role = $user->getRoles();
            $user = $repo->find($user->getName());
            $user->setRoles($role);

            $commonManager->persist($user);

            $name = $user->getName();
            $firstName = $user->getFirstName();
            $this->addFlash('success', "Le compte de $name $firstName a bien été modifié");
            return $this->redirectToRoute('home');
        }
        return $this->render('security/userRoleModif.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
