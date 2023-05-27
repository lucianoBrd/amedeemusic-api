<?php

namespace App\Form;

use App\Entity\MailContent\PricingTable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PricingTableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('titleBold')
            ->add('color')
            ->add('starterTitle')
            ->add('advancedTitle')
            ->add('starterSubTitle')
            ->add('advancedSubTitle')
            ->add('starterPrice')
            ->add('advancedPrice')
            ->add('starterDate')
            ->add('advancedDate')
            ->add('starterParagraph')
            ->add('advancedParagraph')
            ->add('starterButton')
            ->add('advancedButton')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PricingTable::class,
        ]);
    }
}
