<?php

namespace App\Form;

use App\Entity\InteretPotentiel;
use App\Entity\Personne;
use App\Entity\RelationP;
use App\Entity\StatutP;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Required;
use App\Form;


class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
            ->add('Nom', TextType::class, [
                'empty_data' => '',
                'required' => true
            ])
            ->add( 'Prenom', TextType::class, [
            'empty_data' => '',
            'required' => true
            ])
            ->add('Photo', TextType::class, [
                'empty_data' => '',
                'required' => false,
                'label' => 'Adresse'
            ])
            ->add('Societe', TextType::class, [
            'empty_data' => '',
            'required' => false
            ])
            ->add( 'Poste', TextType::class, [
            'empty_data' => '',
            'required' => false
            ])
            ->add( 'Pays', TextType::class, [
            'empty_data' => '',
            'required' => true
            ])
            ->add( 'Ville', TextType::class, [
            'empty_data' => '',
            'required' => false
            ])
            ->add( 'Numero', NumberType::class, [
            'empty_data' => '',
            'required' => false
            ])
            ->add( 'Mail', EmailType::class, [
            'empty_data' => '',
            'required' => false
            ])
            
            ->add('Description', TextareaType::class, [
                'empty_data' => ''
            ])
            
            ->add('Relation_P', EntityType::class, [
                'class' => RelationP::class,
'choice_label' => 'type_p',
            'label' => 'Realation'
            ])
            ->add('Statut_P', EntityType::class, [
                'class' => StatutP::class,
'choice_label' => 'statut',
            'label' => 'Statut'
            ])
            ->add('Interet', EntityType::class, [
                'class' => InteretPotentiel::class,
'choice_label' => 'interet',
            'label' => 'Interêt Potentiel'
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
