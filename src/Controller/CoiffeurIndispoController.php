<?php

namespace App\Controller;

use DateTime;
use App\Service\CommonManager;
use App\Entity\Indisponibilite;
use App\Repository\CoiffeurRepository;
use App\Service\IndisponibiliteManager;
use App\Repository\IndisponibiliteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CoiffeurIndispoController extends AbstractController
{
    /**
     * @Route("/coiffeur/indispo/{param}", name="coiffeur_indispo")
     */
    public function index($param, IndisponibiliteManager $manager)
    {
        $manager->create($param);
        /* $param = explode('_', $param);

        $coiffeur = $repo->find($param[0]);

        $date = explode('-', $param[1]);
        $dateTime = new DateTime();
        $dateTime = $dateTime->setDate($date[0], $date[1], $date[2]);

        $indispo = new Indisponibilite();
        $indispo->setDateIndispo($dateTime);
        $indispo->setCoiffeur($coiffeur);

        $commonManager->persist($indispo); */

        return $this->redirectToRoute('dashboard');
        // return $this->render('coiffeur_indispo/index.html.twig', [
        //     'controller_name' => 'CoiffeurIndispoController',
        // ]);
    }
}
