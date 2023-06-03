<?php

namespace App\Form\Shared;

use App\Form\Shared\ImageType;
use App\Entity\MailContent\Shared\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as FormTextType;

class TextType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', FormTextType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ]
            ])
            ->add('paragraph', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 600
                ]
            ])
            ->add('image', ImageType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Text::class,
        ]);
    }
}
