<?php

namespace App\Service;

use DateTime;
use App\Entity\Presentation;
use App\DOI\ServerAddPresentationRequest;
use App\Repository\PresentationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\Types\Integer;

class PresentationManager
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var PresentationRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $manager, PresentationRepository $repository, CommonManager $commonManager)
    {
        $this->manager = $manager;
        $this->commonManager = $commonManager;
        $this->repository = $repository;
    }

    public function delete(Presentation $presentation): void
    {
        $this->commonManager->supprFile($presentation, 'presentation');
        $this->commonManager->remove($presentation);
    }
    
    // public function persist(Presentation $presentation): void
    // {
    //     $this->manager->persist($presentation);
    //     $this->manager->flush();
    // }
    
    // public function supprFile(Presentation $presentation): void
    // {
    //     $fileName = $presentation->getFile();
    //     unlink("uploads/presentation/$fileName");
    // }
}
