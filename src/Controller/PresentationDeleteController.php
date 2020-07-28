<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Service\PresentationManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PresentationDeleteController extends AbstractController
{
    /**
     * @Route("/presentation/{id}/delete/{page}", name="presentation_delete")
     */
    public function presentationDelete(Presentation $presentation, $page, PresentationManager $presentationManager)
    {
        $presentationManager->delete($presentation);
        
        if($page == 'salon') return $this->redirectToRoute('salon');
        else return $this->redirectToRoute('coiffures');
    }
}
