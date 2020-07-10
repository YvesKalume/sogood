<?php
/**
 * Copyright (c) 2020.
 * Yves Kalume
 * yveskalumenoble@gmail.com
 */

namespace App\Controller;


use App\Entity\Song;
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Handler\DownloadHandler;

class SongController extends AbstractController
{

    /**
     * @Route("/{id}",name="song.show")
     * @param Song $song
     * @return Response
     */
    public function show(Song $song) : Response{
        return $this->render('song/show.html.twig',compact('song'));
    }

    /**
     * @Route("/{id}/download",name="song.download")
     * @param Song $song
     * @param DownloadHandler $handler
     * @return Response
     */
    public function download(Song $song,DownloadHandler $handler) : Response {

        $filename = $song->getSinger().'_-_'.$song->getTitle().'_www.sogood.com';
        return $handler->downloadObject($song,'songFile',Song::class,$filename);
    }


}