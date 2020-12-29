<?php

namespace App\Controller;

use App\Entity\Trick;
use App\Repository\CategoryRepository;
use App\Repository\TrickRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class TrickController extends AbstractController
{
    /**
     * @Route("/{slug}", name="trick_category", priority=-1)
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

    /**
     * @Route("/{category_slug}/{slug}", name="trick_show")
     */
    public function show($slug, TrickRepository $trickRepository)
    {
        $trick = $trickRepository->findOneBy(['slug' => $slug]);

        if (!$trick) {
            throw $this->createNotFoundException("La figure demandée n'existe pas");
        }
//        dd($trick);
        return $this->render('trick/trick.html.twig', ['trick' => $trick]);
    }
}
