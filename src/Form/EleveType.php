<?php

namespace App\Form;

use App\Entity\Eleve;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cin')
            ->add('matricule')
            ->add('nom')
            ->add('prenom')
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Home' => "Home",
                    'FEMME' => "Femme",
                ]
            ])
            ->add('dateNaissance')
            ->add('lieuNaissance')
            ->add('tele')
            ->add('email')
            ->add('classe')
            ->add('parents');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}