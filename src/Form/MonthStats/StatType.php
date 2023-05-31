<?php

namespace App\Form\MonthStats;

use App\Form\Shared\ImageType;
use Symfony\Component\Form\AbstractType;
use App\Entity\MailContent\MonthStats\Stat;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class StatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number', TextType::class, [
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
            ->add('subTitle', TextType::class, [
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
            ->add('evolution', TextType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ],
            ])
            ->add('date', TextType::class, [
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
            'data_class' => Stat::class,
        ]);
    }
}
