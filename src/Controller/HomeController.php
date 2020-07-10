<?php


namespace App\Controller;


use App\Entity\Song;
use App\Form\SongSearchType;
use App\Repository\SongRepository;
use App\Util\SongSearch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @Route("/",name="home")
     * @param SongRepository $songRepository
     * @param Request $request
     * @return Response
     */
    public function index(SongRepository $songRepository,Request $request) : Response {

        $search = new SongSearch();
        $searchForm = $this->createForm(SongSearchType::class,$search);
        $searchForm->handleRequest($request);

        if ($searchForm->isSubmitted()){
            return $this->render('song/search.html.twig',[
               'songs' => $songRepository->searchSongs($search->getQ()),
                'form' => $searchForm->createView(),
                'search' => $search
            ]);
        }

        return $this->render('song/index.html.twig',[
            'songs' =>  $songRepository->findAll(),
            'form' => $searchForm->createView()
        ]);
    }
}