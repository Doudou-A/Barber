<?php

namespace App\Service;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\Types\Integer;

class CommonManager
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return string
     */
    public function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
    
    public function persist($entity): void
    {
        $this->manager->persist($entity);
        $this->manager->flush();
    }
    
    public function remove($entity): void
    {
        $this->manager->remove($entity);
        $this->manager->flush();
    }
    
    public function supprFile($entity, $folder): void
    {
        $fileName = $entity->getFile();
        unlink("../../public/uploads/$folder/$fileName");
    }
}
