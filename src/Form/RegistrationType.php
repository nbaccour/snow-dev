<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', TextType::class,
                [
                    'label'       => 'Pseudo',
                    'attr'        => ['placeholder' => 'Votre pseudo'],
                    'constraints' => new Length(['min' => '3', 'max' => '255', 'minMessage' => 'Pseudo Invalide']),
                ])
            ->add('email', EmailType::class,
                ['label' => 'Adresse email', 'attr' => ['placeholder' => 'Votre Adresse email']])
            ->add('password', PasswordType::class,
                [
                    'label' => 'mot de passe',
                    'attr'  => ['placeholder' => 'votre mote de passe'],
                ])
            ->add('verifPassword', PasswordType::class,
                [
                    'label' => 'Confirmation du mot de passe',
                    'attr'  => ['placeholder' => 'Répétez votre mot de passe'],
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
