<?php
namespace App\Controller\Admin;
use App\Entity\Song;
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    public function index(){

    }


    /**
     * @Route("admin/song/{id}/edit", name="song.edit")
     * @param Song $song
     * @return Response
     */
    public function edit(Song $song){
        return $this->render("song/edit.html.twig",compact('song'));
    }
}