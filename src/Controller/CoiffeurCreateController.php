<?php

namespace App\Controller;

use App\Entity\Coiffeur;
use App\Form\CoiffeurType;
use App\Service\CoiffeurManager;
use App\Service\CommonManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CoiffeurCreateController extends AbstractController
{
    /**
     * @Route("/admin/coiffeur", name="coiffeur")
     * @Route("/admin/{id}/coiffeur", name="coiffeur_edit")
     */
    public function coiffeurCreate(Coiffeur $coiffeur=null, Request $request, EntityManagerInterface $manager, CommonManager $commonManager, CoiffeurManager $coiffeurManager)
    {
        if(!$coiffeur){
            $coiffeur = new Coiffeur;
        }

        $form = $this->createForm(CoiffeurType::class, $coiffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($coiffeur->getFile() !== null && $form['file']->getData() !== null){
                $fileName = $coiffeur->getFile();
                unlink($this->getParameter("%kernel.project_dir%/public/public/uploads/coiffeurs/$fileName"));
            }
            if($coiffeur->getSnap() !== null && $form['snap']->getData() !== null){
                $fileName = $coiffeur->getFile();
                unlink($this->getParameter("%kernel.project_dir%/public/public/uploads/coiffeurs/$fileName"));
            }
            $fileCoiffeur = $form['file']->getData();
            $fileSnap = $form['snap']->getData();

            $aFile = [$fileCoiffeur, $fileSnap];

            foreach($aFile as $key => $file){
                if ($file) {
                    $newFileName = $commonManager->generateUniqueFileName() . '.' . $file->guessExtension();
    
                    try {
                        $file->move(
                            $this->getParameter('coiffeursImg_directory'),
                            $newFileName
                        );
                    } catch (FileException $e) {
                        echo($e);
                        die;
                        // ... handle exception if something happens during file upload
                    }
                    if($key == 0) $coiffeur->setFile($newFileName);
                    else $coiffeur->setSnap($newFileName);
                }
            }

            $commonManager->persist($coiffeur);

            $this->addFlash('success', 'Coiffeur AJouté/Modifié avec succès !');

            return $this->redirect('/index.php');
        }
        return $this->render('coiffeur/coiffeurCreate.html.twig', [
            'form' => $form->createView(),
            'editMode' => $coiffeur->getId() !== null,
            'newMode' => $coiffeur->getId() == null,
            'coiffeur' => $coiffeur,
        ]);
    }

}
