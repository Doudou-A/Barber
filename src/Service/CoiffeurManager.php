<?php

namespace App\Service;

use DateTime;
use App\Entity\Coiffeur;
use App\DOI\ServerAddCoiffeurRequest;
use App\Repository\CoiffeurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\Types\Integer;

class CoiffeurManager
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var CoiffeurRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $manager, CoiffeurRepository $repository, CommonManager $commonManager)
    {
        $this->manager = $manager;
        $this->commonManager = $commonManager;
        $this->repository = $repository;
    }

    public function delete(Coiffeur $coiffeur): void
    {
        // $this->commonManager->supprFile($coiffeur, 'coiffeur');
        // $this->supprSnap($coiffeur);
        
        $this->commonManager->remove($coiffeur);
    }
    
    public function supprSnap(Coiffeur $coiffeur): void
    {
        $fileName = $coiffeur->getSnap();
        unlink("uploads/coiffeurs/$fileName");
    }
}
