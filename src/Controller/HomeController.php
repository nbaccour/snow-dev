<?php
/**
 * Created by PhpStorm.
 * User: msi-n
 * Date: 23/12/2020
 * Time: 20:12
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render('home.html.twig');
    }
}