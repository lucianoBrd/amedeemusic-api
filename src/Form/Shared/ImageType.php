<?php

namespace App\Form\Shared;

use Exception;
use App\Entity\Data;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Entity\MailContent\Shared\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class ImageType extends AbstractType
{
    public function __construct(
        private ContainerBagInterface $params,
    )
    {
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, [
                'required' => false,
            ])
            ->add('absolutePath', TextType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        $builder->get('image')->addModelTransformer(new CallbackTransformer(
            function(string $imageAsString = null): ?File {
                try {
                    return new File($this->params->get('images_email_base_directory') . $imageAsString);
                } catch (Exception $e) {
                    return null;
                }
            },
            function($imageAsUuploadedFile) {
                return $imageAsUuploadedFile;
            }
        ));
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $image = $event->getData();
            $form = $event->getForm();

            if ($image instanceof Image && $image) {
                $form
                    ->add('keepImage', CheckboxType::class, [
                        'required' => false,
                        'mapped' => false,
                        'data' => true,
                    ])
                ;
            }
        });
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $image = $event->getData();
            $form = $event->getForm();
            $oldImage = $form->getViewData();
            
            if (((array_key_exists('image', $image) && $image['image'] == null) || !array_key_exists('image', $image)) && $oldImage instanceof Image && $oldImage->getImage() && array_key_exists('keepImage', $image)) {
                $image['image'] = new File($this->params->get('images_email_base_directory') . $oldImage->getImage());
                
                $event->setData($image);
            }
        });
        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            dump($event);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
