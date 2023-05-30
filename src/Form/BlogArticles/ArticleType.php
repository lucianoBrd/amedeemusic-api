<?php

namespace App\Form\BlogArticles;

use App\Form\Shared\ImageType;
use Symfony\Component\Form\AbstractType;
use App\Entity\MailContent\BlogArticles\Article;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', TextType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ]
            ])
            ->add('color', ColorType::class)
            ->add('title', TextType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ]
            ])
            ->add('link', UrlType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ]
            ])
            ->add('paragraph', TextType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 600
                ]
            ])
            ->add('paragraphBold', TextType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ]
            ])
            ->add('image', ImageType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
