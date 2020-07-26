<?php

namespace App\Controller;

use App\Entity\Presentation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PresentationDeleteController extends AbstractController
{
    /**
     * @Route("/presentation/{id}/delete", name="presentation_delete")
     */
    public function presentationDelete(Presentation $presentation, PresentationManager $presentationManager)
    {
        $presentationManager->delete();
        
        return $this->render('presentation_delete/index.html.twig', [
            'controller_name' => 'PresentationDeleteController',
        ]);
    }
}
