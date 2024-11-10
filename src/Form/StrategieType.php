<?php

namespace App\Form;


use App\Entity\Personne;
use App\Entity\Strategie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StrategieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom_Strategie')
            ->add('Personne', EntityType::class, [
            'class' => Personne::class,
            'choice_label' => 'nom',
            ])
            ->add('Budget')
            ->add('Enveloppe')
           
            ->add('Description', TextareaType::class, [
                'empty_data' => ''
            ])
             ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Strategie::class,
        ]);
    }
}
