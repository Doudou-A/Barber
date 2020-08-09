<?php

namespace App\Service;

use DateTime;
use App\Service\CommonManager;
use App\Entity\Indisponibilite;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\Types\Integer;

class CoiffeurManager
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager, CommonManager $commonManager)
    {
        $this->manager = $manager;
        $this->commonManager = $commonManager;
    }

    

    public function delete($param){
        $param = explode('_', $param);

        $coiffeur = $repo->find($param[0]);

        $date = explode('-', $param[1]);
        $dateTime = new DateTime();
        $dateTime = $dateTime->setDate($date[0], $date[1], $date[2]);

        $indispo = new Indisponibilite();
        $indispo->setDateIndispo($dateTime);
        $indispo->setCoiffeur($coiffeur);
    }

    public function supprSnap($coiffeur): void
    {
        $snapName = $coiffeur->getSnap();
        unlink("uploads/coiffeurs/$snapName");
    }
}
