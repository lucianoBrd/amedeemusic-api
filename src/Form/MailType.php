<?php

namespace App\Form;

use App\Entity\Data;
use App\Entity\Mail;
use App\Form\MailContentType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Subject',
                'attr' => [
                    'maxlength' => 500
                ]
            ])
            ->add('mailContentChoice', ChoiceType::class, [
                'mapped' => false,
                'choices'  => array_merge(['' => null], Data::MAIL_CONTENT),
                'attr' => [
                    'onchange' => 'this.form.submit()'
                ],
                'data' => $options['mailContentClassName']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save changes',
                'attr' => [
                    'class' => 'action-saveAndReturn btn btn-primary action-save'
                ]
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $mail = $event->getData();
            $form = $event->getForm();

            $mailContent = $mail->getMailContent();

            if ($mailContent) {
                $form
                    ->add('mailContent', MailContentType::class)
                ;
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mail::class,
            'mailContentClassName' => null,
        ]);
    }
}
