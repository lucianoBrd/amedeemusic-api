<?php

namespace App\Form;

use App\Entity\MailContent\UserWelcoming;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserWelcomingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('titleBold')
            ->add('color')
            ->add('lLabel')
            ->add('rLabel')
            ->add('lInfo')
            ->add('rInfo')
            ->add('button')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserWelcoming::class,
        ]);
    }
}
