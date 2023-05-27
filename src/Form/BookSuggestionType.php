<?php

namespace App\Form;

use App\Entity\MailContent\BookSuggestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookSuggestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('titleBold')
            ->add('color')
            ->add('featuredTitle')
            ->add('featuredAuthor')
            ->add('featuredCategory')
            ->add('sectionFeaturedTitle')
            ->add('sectionBestTitle')
            ->add('featuredButton')
            ->add('featuredImage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookSuggestion::class,
        ]);
    }
}
