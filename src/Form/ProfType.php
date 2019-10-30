<?php

namespace App\Form;

use App\Entity\Prof;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cin')
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Home' => "Home",
                    'FEMME' => "Femme",
                ]
            ])
            ->add('email')
            ->add('tele')
            ->add('dateNaissance')
            ->add('password');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prof::class,
        ]);
    }
}