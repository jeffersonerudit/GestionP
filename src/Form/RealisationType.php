<?php

namespace App\Form;

use App\Entity\Realisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RealisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder            
            ->add('New_Client')
            ->add('New_Partenaire')
            ->add('New_Contact')
            ->add('Nbr_Rdv_Pris')
            ->add('nbr_Rdv_Conf')
            ->add('save', SubmitType::class, [
            'label' => 'Enregistrer'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Realisation::class,
        ]);
    }
}
