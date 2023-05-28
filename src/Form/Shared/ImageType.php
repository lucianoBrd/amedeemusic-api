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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
        ;
        $builder->get('image')->addModelTransformer(new CallbackTransformer(
            function(string $imageAsString = null): ?File {
                try {
                    return new File($this->params->get('images_email_base_directory') . $imageAsString);
                } catch (Exception $e) {
                    return null;
                }
            },
            function(UploadedFile $imageAsUuploadedFile = null): ?UploadedFile {
                return $imageAsUuploadedFile;
            }
        ));
        /*
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
        */    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
