<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Trick;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,
                [
                    'label'    => 'Nom de la Figure',
                    'attr'     => ['placeholder' => 'Taper le nom de la figure'],
                    'required' => false,
                ])
            ->add('shortDescription', TextareaType::class, ['required' => false])
            ->add('picture', TextType::class,
                [
                    'label'    => 'Image',
                    'attr'     => ['placeholder' => "Taper le nom de l'image"],
                    'required' => false,
                ])
            ->add('category', EntityType::class,
                [
                    'placeholder'  => '-- choisir une catégorie --',
                    'class'        => Category::class,
                    'choice_label' => 'name',
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
