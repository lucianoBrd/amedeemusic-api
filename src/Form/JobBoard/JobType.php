<?php

namespace App\Form\JobBoard;

use App\Form\Shared\ImageType;
use App\Form\JobBoard\InfoType;
use App\Entity\MailContent\JobBoard\Job;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('compagny', TextType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ],
            ])
            ->add('title', TextType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ],
            ])
            ->add('link', UrlType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ],
            ])
            ->add('paragraph', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 600
                ],
            ])
            ->add('image', ImageType::class)
            ->add('infos', CollectionType::class, [
                'entry_type' => InfoType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
