<?php

namespace App\Service;

use DateTime;
use App\Service\CommonManager;
use App\Entity\Indisponibilite;
use App\Repository\CoiffeurRepository;
use App\Repository\IndisponibiliteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\Types\Integer;

class IndisponibiliteManager
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager, CommonManager $commonManager, IndisponibiliteRepository $repo, CoiffeurRepository $repoCoiffeur)
    {
        $this->manager = $manager;
        $this->commonManager = $commonManager;
        $this->repo = $repo;
        $this->repoCoiffeur = $repoCoiffeur;
    }

    public function create($param){
        $coiffeur = null;
        $dateTime = null;
        $this->getIndispo($param, $coiffeur, $dateTime);

        $indispo = new Indisponibilite();
        $indispo->setDateIndispo($dateTime);
        $indispo->setCoiffeur($coiffeur);

        $this->commonManager->persist($indispo);
    }

    public function getIndispo($param, &$coiffeur=null, &$dateTime=null){
        $param = explode('_', $param);

        $coiffeur = $this->repoCoiffeur->find($param[0]);

        $date = explode('-', $param[1]);
        $dateTime = new DateTime();
        $dateTime = $dateTime->setDate($date[0], $date[1], $date[2]);
    }

    public function getAIndispo($coiffeur){
        $aIndispo = $this->repo->findByCoiffeur($coiffeur);
        $indispos = [];
        foreach($aIndispo as $indispo){
            $date = $indispo->getDateIndispo();
            $date = $date->format('Y-m-d');

            $indispos[] = $date;
        }

        return $indispos;
    }

    public function delete($param){
        $coiffeur = null;
        $dateTime = null;
        $this->getIndispo($param, $coiffeur, $dateTime);

        $indispo = $this->repo->findIndispoOne($coiffeur->getId(), $dateTime->format('Y-m-d'));

        $this->commonManager->remove($indispo[0]);

    }

    public function supprSnap($coiffeur): void
    {
        $snapName = $coiffeur->getSnap();
        unlink("uploads/coiffeurs/$snapName");
    }
}
