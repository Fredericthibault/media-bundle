<?php
/**
 * Created by PhpStorm.
 * User: pmdc
 * Date: 24/01/17
 * Time: 11:33 AM
 */

namespace Viweb\MediaBundle\EventListener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Viweb\MediaBundle\Entity\Media;

class MediaUploadListener
{

    private $baseDir;

    public function __construct(string $baseDir)
    {
        $this->baseDir = $baseDir;
    }

    private function upload($entity)
    {
        if(!$entity instanceof Media || !$entity->getPath() instanceof UploadedFile){
            return ;
        }
        /**
         * @var UploadedFile $file;
         */
        $file = $entity->getPath();
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        $entity->setFilename($file->getClientOriginalName() . $file->guessExtension());
        $file->move($this->baseDir, $fileName);

        $entity->setPath($this->baseDir . '/' . $fileName);
        $entity->setName($file->getClientOriginalName());

        return $fileName;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->upload($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->upload($entity);
    }
}