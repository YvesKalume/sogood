<?php


namespace App\Controller;


use App\Entity\Song;
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{

    /**
     * @Route("/{id}",name="song.show")
     * @param Song $song
     * @param SongRepository $songRepository
     * @return Response
     */
    public function show(Song $song,SongRepository $songRepository) : Response{
        $song = $songRepository->find($song);
        return $this->render('song/show.html.twig',compact('song'));
    }
}