<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Form\PresentationType;
use App\Service\CommonManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class PresentationCreateController extends AbstractController
{
    /**
     * @Route("/admin/presentation", name="presentation")
     * @Route("/admin/{id}/presentation/{page}", name="presentation_edit")
     */
    public function presentationCreate(Presentation $presentation=null, $page=null, Request $request, EntityManagerInterface $manager, CommonManager $commonManager)
    {
        if(!$presentation){
            $presentation = new Presentation;
        }

        $form = $this->createForm(PresentationType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($presentation->getFile() !== null && $form['file']->getData() !== null){
                $commonManager->supprFile($presentation, 'presentation');
                // $fileName = $presentation->getFile();
                // unlink("uploads/presentation/$fileName");
            }
            $file = $form['file']->getData();

            if ($file) {
                $newFileName = $commonManager->generateUniqueFileName() . '.' . $file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('presentationImg_directory'),
                        $newFileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $presentation->setFile($newFileName);
            }

            $commonManager->persist($presentation);
            // $manager->flush();

            $this->addFlash('success', 'Fichier AJouté/Modifié avec succès !');

            if($page == 'salon') return $this->redirectToRoute('salon');
            elseif($page == 'coiffures') return $this->redirectToRoute('coiffures');
            else return $this->redirectToRoute('presentation');
        }
        return $this->render('presentation/presentationCreate.html.twig', [
            'form' => $form->createView(),
            'editMode' => $presentation->getId() !== null,
            'newMode' => $presentation->getId() == null,
            'presentation' => $presentation,
        ]);
    }

}
