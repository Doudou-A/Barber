<?php

namespace App\Form;

use App\Entity\Presentation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PresentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '6000k',
                        'mimeTypesMessage' => 'Please upload a valid IMG file',
                    ])
                ]
            ])
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Coiffure' => 0,
                    'Salon' => 1
                ],

            ])
            ->add('format', ChoiceType::class, [
                'choices'  => [
                    'Image' => 0,
                    'Video' => 1
                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Presentation::class,
        ]);
    }
}
