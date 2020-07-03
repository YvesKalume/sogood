<?php


namespace App\Controller;


use App\Entity\Song;
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @Route("/",name="home")
     * @param SongRepository $songRepository
     * @return Response
     */
    public function index(SongRepository $songRepository) : Response {

        $songs = $songRepository->findAll();
        return $this->render('song/index.html.twig',compact('songs'));
    }
}