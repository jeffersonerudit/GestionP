<?php

namespace App\Form;

use App\Entity\Personne;
use App\Entity\RendezVous;
use App\Entity\StatutRendezVous;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezVousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom_Rdv')
            ->add('Type_Rdv')
            ->add('Date_Rdv', null, [
                'widget' => 'single_text'
            ])
            ->add('Lieu')
            ->add('Description')
            ->add('Statut_Rdv', EntityType::class, [
                'class' => StatutRendezVous::class,
'choice_label' => 'statut_rdv',
            ])
            ->add('Personne', EntityType::class, [
                'class' => Personne::class,
'choice_label' => 'nom',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
        ]);
    }
}
