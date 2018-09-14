<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('from', EmailType::class, array('label' => 'Email from'))
            //->add('dateOfBirth', DateTimeType::class)
            ->add('choice', ChoiceType::class, [
                'choices' => [
                    'Une entreprise' => true,
                    "Collectivité" => true,
                    "Demandeur d'emploi" => true,
                    'Autre' => true,
                ]
            ])
            ->add('message', TextareaType::class)



            ->add('file', FileType::class, [
                'label' => 'Télécharger',
                'required'=> true,
                'csrf_field_name'=> '_token',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here

        ]);
    }
}
