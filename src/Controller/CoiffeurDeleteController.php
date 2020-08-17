<?php

namespace App\Controller;

use App\Entity\Coiffeur;
use App\Service\CoiffeurManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoiffeurDeleteController extends AbstractController
{
    /**
     * @Route("/coiffeur/{id}/delete", name="coiffeur_delete")
     */
    public function index(Coiffeur $coiffeur, CoiffeurManager $coiffeurManager)
    {
        $path = $this->getParameter('coiffeursImg_directory');
        $fileName = $coiffeur->getFile();
        if($fileName){
            $completPath = $path.'/'.$fileName;
            unlink($completPath);
        }
        $fileNameSnap = $coiffeur->getSnap();
        if($fileNameSnap){
            $completPath = $path.'/'.$fileNameSnap;
            unlink($completPath);
        }
        $coiffeurManager->delete($coiffeur);
        
        return $this->redirectToRoute('home');
    }
}
