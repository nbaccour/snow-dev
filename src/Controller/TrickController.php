<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    /**
     * @Route("/{slug}", name="trick_category")
     */
    public function category($slug, CategoryRepository $categoryRepository): Response
    {

        $category = $categoryRepository->findOneBy(['slug' => $slug]);

        if (!$category) {
//            throw new NotFoundHttpException("La catégorie demandée n'existe pas");
            throw $this->createNotFoundException("La catégorie demandée n'existe pas");
        }
        return $this->render('trick/category.html.twig', [
            'slug'     => $slug,
            'category' => $category,
        ]);
    }
}
