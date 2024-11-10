<?php

namespace App\Form;

use App\Entity\NatureVisite;
use App\Entity\TypeViste;
use App\Entity\Viste;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom_V')
            ->add('Prenom_V')
            ->add('Societe')
            ->add('Poste')
            ->add('Adresse')
            ->add('Pays')
            ->add('Ville')
            ->add('Numero')
            ->add('Mail')
            ->add('TypeViste', EntityType::class, [
                'class' => TypeViste::class,
'choice_label' => 'type_v',
            ])
            ->add('NatureViste', EntityType::class, [
                'class' => NatureVisite::class,
'choice_label' => 'nature_v',
            ])
            ->add('Description')
        ->add('save', SubmitType::class, [
            'label' => 'Enregistrer'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Viste::class,
        ]);
    }
}
