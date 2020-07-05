<?php
/**
 * Copyright (c) 2020.
 * Yves Kalume
 * yveskalumenoble@gmail.com
 */
namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{


    /**
     * @Route("/admin/categories",name="admin.categories.index")
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository) : Response{
        return $this->render("/category/index.html.twig",[
           'categories' => $categoryRepository->findAll()
        ]);
    }

    /**
     * @Route("admin/category/add",name="admin.category.add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request) : Response{
        $category = new Category();
        $form = $this->createForm(CategoryType::class,$category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('admin.category.add');
        }
        return $this->render('category/add.html.twig',[
            'form'=>$form->createView()
        ]);


    }

    public function edit(Category $category){

    }
}

