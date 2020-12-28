<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function renderMenuList()
    {
        //chercher les categories dans la base de données (repository)
        $categories = $this->categoryRepository->findAll();
//        dd($categories);
        //renvoyer le rendu html sous la forme d'une response (render)

        return $this->render('category/_menu.html.twig', ['categories' => $categories]);
    }



//    /**
//     * @Route("/{slug}", name="category")
//     */
//    public function category(): Response
//    {
//        return $this->render('category/index.html.twig', [
//            'controller_name' => 'CategoryController',
//        ]);
//    }
}
