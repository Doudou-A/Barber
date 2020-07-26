<?php

namespace App\Controller;

use App\Repository\PresentationRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SalonController extends AbstractController
{
    /**
     * @Route("/salon", name="salon")
     */
    public function salonShow(PresentationRepository $repo)
    {
        $user = $this->getUser();
        $role = $user->getRoles();
        $aPresentation = $repo->findByType(true);

        return $this->render('presentation/presentationShow.html.twig', [
            'aPresentation' => $aPresentation,
            'user' => $user,
            'role' => $role,
        ]);
    }
}
