<?php

namespace App\Form\Shared;

use App\Entity\Data;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Entity\MailContent\Shared\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $image = $event->getData();
            $form = $event->getForm();
            
            $form
                ->add('image')
                ->add('mailImages', ChoiceType::class, [
                    'mapped' => false,
                    'choices'  => array_merge(['' => null], Data::MAIL_IMAGES),
                    'data' => (($image && $image->getImage() && in_array($image->getImage(), Data::MAIL_IMAGES)) ? $image->getImage() : ''),
                ])
            ;
        });        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
