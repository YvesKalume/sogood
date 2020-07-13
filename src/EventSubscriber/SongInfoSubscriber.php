<?php
/**
 * Copyright (c) 2020.
 * Yves Kalume
 * yveskalumenoble@gmail.com
 */
namespace App\EventSubscriber;

use App\Entity\Song;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Exception;
use wapmorgan\Mp3Info\Mp3Info;

class SongInfoSubscriber implements EventSubscriber
{

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'preUpdate'
        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        if ($args->getEntity() instanceof Song){
            try
            {
                $mp3info = new Mp3Info($args->getEntity()->getSongFile()->getRealPath());
                $time = floor($mp3info->duration / 60).':'.floor($mp3info->duration % 60);
                $audioSize = number_format($mp3info->audioSize / 1048576,2);
            } catch (Exception $e) {
                echo 'Error song info subscriber : '.$e->getMessage();
                return;
            };

            $args->getEntity()->setTime($time);
            $args->getEntity()->setSize($audioSize);

        }

    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        dump($args->getEntity());
    }
}