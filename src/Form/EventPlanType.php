<?php

namespace App\Form;

use App\Entity\MailContent\EventPlan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventPlanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('titleBold')
            ->add('color')
            ->add('sectionSpeakerTitle')
            ->add('sectionScheduleTitle')
            ->add('scheduleParagraph')
            ->add('firstScheduleButton')
            ->add('secondScheduleButton')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EventPlan::class,
        ]);
    }
}
