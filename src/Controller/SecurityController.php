<?php

namespace App\Controller;

use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
//use Symfony\Component\Translation\Translator;
//use Symfony\Component\Translation\TranslatorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $utils): Response
    {
        $form = $this->createForm(LoginType::class, ['email' => $utils->getLastUsername()]);

//        $translated = $translator->trans('Symfony is great');
//
//        dd($translated);

        return $this->render('security/login.html.twig',
            [
                'formView'   => $form->createView(),
                'error'      => $utils->getLastAuthenticationError(),
//                'translator' => $translated,
            ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(){

    }
}
