<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\PasswordHasher\Type\PasswordTypePasswordHasherExtension;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\File\Request;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            #->add('email')
            #->add('roles')
            #->add('password')
            #->add('isVerified')
            ->add('Nom')
            ->add('Prenom')
            ->add('Societe')
            ->add('Poste')
            ->add('Adresse')
            ->add('Phone')
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
            #->add('CreatedAt', null, [
            #    'widget' => 'single_text'
            #])
            #->add('UpdatedAt', null, [
            #    'widget' => 'single_text'
            #])

            
            ->add('Enregistrer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
