<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\PasswordResetType;
use App\Form\ProfileType;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{

    /**
     * @Route("/profile", name="user_profile")
     */
    public function profile(
        Request $request,
        EntityManagerInterface $manager
    ) {

        $user = $this->getUser();
        dump($user);
        $formProfil = $this->createForm(ProfileType::class, $user);

        $formProfil->handleRequest($request);

        if ($formProfil->isSubmitted() && $formProfil->isValid()) {
            $manager->flush();

            $this->addFlash('success', "Vos données ont été modifiées");

        }

        $formPassword = $this->createForm(PasswordResetType::class, [],
            ['action' => $this->generateUrl('user_pwdReset')]);

        return $this->render("/user/profile.html.twig",
            ['formProfilView' => $formProfil->createView(), 'formPassword' => $formPassword->createView()]);

    }

    /**
     * @Route("/resetPassword", name="user_pwdReset")
     */
    public function pwdReset(
        Request $request,
        ValidatorInterface $validator,
        UserPasswordEncoderInterface $encoder,
        EntityManagerInterface $manager
    ) {
        $user = $this->getUser();
        dump($user);
        $form = $this->createForm(PasswordResetType::class, $user, ['validation_groups' => 'verif-pwd']);
        $form->handleRequest($request);

        $formProfil = $this->createForm(ProfileType::class, $user);

        $formProfil->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash)
                ->setVerifPassword($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', "Votre mot de passe a été modifié");
//            return $this->redirectToRoute('user_profile');
        }

        return $this->render("/user/profile.html.twig",
            ['formProfilView' => $formProfil->createView(), 'formPassword' => $form->createView()]);


    }

    /**
     * @Route("/registration", name="user_registration")
     */
    public function registration(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        EntityManagerInterface $manager,
        ValidatorInterface $validator
    ): Response {

        $user = new User();


        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
//        dump($form->isSubmitted());
//        dd($form->isValid());
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $encoder->encodePassword($user, $user->getPassword());


            $user->setPassword($password);
            $user->setVerifPassword($password);

            $manager->persist($user);
            $manager->flush();
//message : Compte crée avec succès ! Veuillez valider votre compte via le mail qui vous a été envoyé pour pouvoir vous connecter !
            $this->addFlash(
                'success',
                "Compte crée avec succès ! "
            );

            return $this->redirectToRoute('security_login');

        }

        return $this->render('user/registration.html.twig', ['formView' => $form->createView()]);
    }
}
