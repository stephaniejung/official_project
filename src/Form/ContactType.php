<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('service', ChoiceType::class, [
                'choices' => [
                    'Pôle Médiation' => 'mediation',
                    'Pôle Technique' => 'technique',
                    'Insertion' => 'insertion',
                ]
            ])
            ->add('name')
            ->add('from', EmailType::class, array('label' => 'Email'))
            //->add('dateOfBirth', DateTimeType::class)
            ->add('message', TextareaType::class)

            ->add('file', FileType::class, array('label' => 'Joindre un fichier',
                'required' => false
            ))
            ->add('subject', ChoiceType::class, [
                'choices' => [
                    'Une entreprise' => 'entreprise',
                    "Demandeur d'emploi" => "demandeur d'emploi",
                    'Autre' => 'autre',
                ]
            ])
            ->add('submit', SubmitType::class);



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }


}
