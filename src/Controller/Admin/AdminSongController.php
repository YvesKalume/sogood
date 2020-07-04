<?php
/**
 * Copyright (c) 2020.
 * Yves Kalume
 * yveskalumenoble@gmail.com
 */

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
     * @Route("/admin/songs",name="admin.songs.list")
     * @return Response
     */
    public function list() : Response{
        $songs = $this->songRepository->findAll();
        return $this->render("song/list.html.twig",compact("songs"));
    }

    /**
     * @Route("/admin/song/add",name="admin.song.add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request) : Response{

        $song = new Song();

        $form = $this->createForm(SongType::class,$song);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($song);
            $em->flush();

            return $this->redirectToRoute('admin.song.add');
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
    public function edit(Song $song,Request $request) : Response{
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

    /**
     * @Route("admin/song/{id}/delete", name="song.delete",methods="DELETE")
     * @param Song $song
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Song $song, Request $request) : Response{

        if ($this->isCsrfTokenValid('delete'. $song.getId(),$request->get('token'))){
            $em = $this->getDoctrine()->getManager();
            $em->remove($song);
            $em->flush();
        }

        return $this->redirectToRoute("admin.songs.list");
    }
}