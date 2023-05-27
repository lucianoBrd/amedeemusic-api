<?php

namespace App\Form;

use App\Entity\MailContent\MailContent;
use Symfony\Component\Form\AbstractType;
use App\Form\Shared\TextType as MailTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class MailContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'maxlength' => 255
                ]
            ])
            ->add('titleBold', TextType::class, [
                'attr' => [
                    'maxlength' => 255
                ]
            ])
            ->add('color', ColorType::class)
            ->add('texts', CollectionType::class, [
                'entry_type' => MailTextType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])
            ->add('save', SubmitType::class)
        ;
/*
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $mailContent = $event->getData();
            $form = $event->getForm();
    
            // checks if the Product object is "new"
            // If no data is passed to the form, the data is "null".
            // This should be considered a new "Product"
            if (get_class($mailContent)) {
                $form->add('name', TextType::class);
            }
        });
        */
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MailContent::class,
        ]);
    }
}
