<?php

namespace App\Form\FreeGoods;

use App\Form\Shared\ImageType;
use Symfony\Component\Form\AbstractType;
use App\Entity\MailContent\FreeGoods\Good;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;

class GoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('color', ColorType::class)
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
            ->add('author', TextType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ],
            ])
            ->add('image', ImageType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Good::class,
        ]);
    }
}
