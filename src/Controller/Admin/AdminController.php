<?php
/**
 * Copyright (c) 2020.
 * Yves Kalume
 * yveskalumenoble@gmail.com
 */

namespace App\Controller\Admin;

use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin/",name="admin.dashboard")
     * @param SongRepository $songRepository
     * @return Response
     */
    public function dashboard(SongRepository $songRepository) : Response{
        return $this->render('admin/dashboard.html.twig',[
            'song_count'=> $songRepository->count([])
            ]);
    }
}

