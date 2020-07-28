<?php

namespace App\Form;

use App\Entity\Coiffeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CoiffeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
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
            ->add('snap', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '6000k',
                        'mimeTypesMessage' => 'Please upload a valid IMG file',
                    ])
                ]
            ])
            ->add('facebook')
            ->add('insta')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Coiffeur::class,
        ]);
    }
}
