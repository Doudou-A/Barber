<?php

namespace App\Service;

use DateTime;
use App\Service\CommonManager;
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

    public function delete($coiffeur){

        $this->commonManager->supprFile($coiffeur, 'coiffeurs');
        $this->supprSnap($coiffeur);
        $this->commonManager->remove($coiffeur);
    }

    public function supprSnap($coiffeur): void
    {
        $snapName = $coiffeur->getSnap();
        unlink("uploads/coiffeurs/$snapName");
    }
}
