<?php

namespace App\Form;

use App\Entity\Data;
use App\Form\BlogArticlesType;
use Symfony\Component\Form\FormEvent;
use App\Form\BlogArticles\ArticleType;
use Symfony\Component\Form\FormEvents;
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
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ]
            ])
            ->add('titleBold', TextType::class, [
                'required' => false,
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

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $mailContent = $event->getData();
            $form = $event->getForm();

            switch (get_class($mailContent)) {
                case Data::BLOG_ARTICLES:
                    $form
                        ->add('articles', CollectionType::class, [
                            'entry_type' => ArticleType::class,
                            'entry_options' => ['label' => false],
                            'allow_add' => true,
                            'by_reference' => false,
                            'allow_delete' => true,
                        ])
                    ;
                    break;
                case Data::BOOK_SUGGESTION:
                    break;
                case Data::EVENT_PLAN:
                    break;
                case Data::EVENT_SUGGESTION:
                    break;
                case Data::FREE_GOODS:
                    break;
                case Data::JOB_BOARD:
                    break;
                case Data::MONTH_STATS:
                    break;
                case Data::PLAYLIST_SUGGESTION:
                    break;
                case Data::PRICING_TABLE:
                    break;
                case Data::USER_WELCOMING:
                    break;
                default:
                    return null;
            }
    
        });
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MailContent::class,
        ]);
    }
}
