<?php
namespace App\Controller\Admin;
use App\Entity\Song;
use App\Form\SongType;
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSongController extends AbstractController
{

    /**
     * @var SongRepository
     */
    private $songRepository;

    public function __construct(SongRepository $songRepository)
    {
        $this->songRepository = $songRepository;
    }

    /**
     * @Route("/admin/songs",name="admin.songs.index")
     * @return Response
     */
    public function index(){
        $songs = $this->songRepository->findAll();
        return $this->render("song/list.html.twig",compact("songs"));
    }

    /**
     * @Route("/admin/song/add",name="song.add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request){

        $song = new Song();

        $form = $this->createForm(SongType::class,$song);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($song);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render("song/add.html.twig",[
            "song"=>$song,
            "form"=>$form->createView()
        ]);
    }


    /**
     * @Route("admin/song/{id}/edit", name="song.edit")
     * @param Song $song
     * @param Request $request
     * @return Response
     */
    public function edit(Song $song,Request $request){
        $form = $this->createForm(SongType::class,$song);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render("song/edit.html.twig",[
            "song"=>$song,
            "form"=>$form->createView()
        ]);
    }
}