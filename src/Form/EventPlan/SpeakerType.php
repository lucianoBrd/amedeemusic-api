<?php

namespace App\Form\EventPlan;

use App\Form\Shared\ImageType;
use Symfony\Component\Form\AbstractType;
use App\Entity\MailContent\EventPlan\Speaker;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SpeakerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Speaker::class,
        ]);
    }
}
