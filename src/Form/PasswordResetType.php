<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;

class PasswordResetType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('password', PasswordType::class,
                ['label' => 'Nouveau mot de passe', 'attr' => ['placeholder' => 'votre nouveau mote de passe']])
            ->add('verifPassword', PasswordType::class,
                [
                    'label' => 'Confirmer le mot de passe',
                    'attr'  => ['placeholder' => 'confirmer le mote de passe'],
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
