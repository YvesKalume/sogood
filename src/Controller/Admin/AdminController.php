<?php
/**
 * Copyright (c) 2020.
 * Yves Kalume
 * yveskalumenoble@gmail.com
 */

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin/",name="admin.dashboard")
     * @return Response
     */
    public function dashboard(){
        return $this->render('admin/dashboard.html.twig');
    }
}

