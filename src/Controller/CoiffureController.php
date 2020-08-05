<?php

namespace App\Controller;

use App\Repository\PresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoiffureController extends AbstractController
{
    /**
     * @Route("/coiffures", name="coiffures")
     */
    public function coiffureShow(PresentationRepository $repo)
    {
        $aPresentation = $repo->findByType(false);

        return $this->render('presentation/PresentationShow.html.twig', [
            'aPresentation' => $aPresentation,
            'page' => 'coiffures',
            'titre' => 'Les Coiffures',
        ]);
    }
}
