<?php

namespace App\Form;

use App\Entity\Personne;
use App\Entity\Projet;
use App\Entity\StatutProjet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom_Projet')
            ->add('Description_Projet')
            ->add('Personne', EntityType::class, [
                'class' => Personne::class,
'choice_label' => 'nom',
'multiple' => true,
            ])
            ->add('StatutProjet', EntityType::class, [
                'class' => StatutProjet::class,
'choice_label' => 'statut_p',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
