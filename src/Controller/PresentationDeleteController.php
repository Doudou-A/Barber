<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Service\CommonManager;
use App\Service\PresentationManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PresentationDeleteController extends AbstractController
{
    /**
     * @Route("/presentation/{id}/delete/{page}", name="presentation_delete")
     */
    public function presentationDelete(Presentation $presentation, $page, CommonManager $commonManager)
    {
        $path = $this->getParameter('presentationImg_directory');
        $fileName = $presentation->getFile();
        $completPath = $path . '/' . $fileName;
        unlink($completPath);
        $commonManager->remove($presentation);
        
        if($page == 'salon') return $this->redirectToRoute('salon');
        else return $this->redirectToRoute('coiffures');
    }
}
