<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/registration", name="user_registration")
     */
    public function registration(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        EntityManagerInterface $manager
    ): Response {

        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $encoder->encodePassword($user, $user->getPassword());


            $user->setPassword($password);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Compte crée avec succès ! Veuillez valider votre compte via le mail qui vous a été envoyé pour pouvoir vous connecter !"
            );

            return $this->redirectToRoute('security_login');

        }

        return $this->render('user/registration.html.twig', ['formView' => $form->createView()]);
    }
}
