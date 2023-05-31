<?php

namespace App\Form;

use App\Entity\Data;
use App\Form\BlogArticlesType;
use App\Form\JobBoard\JobType;
use App\Form\Shared\ImageType;
use App\Form\Shared\ButtonType;
use App\Form\FreeGoods\GoodType;
use App\Form\MonthStats\StatType;
use App\Form\EventPlan\SpeakerType;
use App\Form\EventPlan\ScheduleType;
use App\Form\BookSuggestion\BookType;
use Symfony\Component\Form\FormEvent;
use App\Form\BlogArticles\ArticleType;
use Symfony\Component\Form\FormEvents;
use App\Entity\MailContent\MailContent;
use App\Form\EventSuggestion\EventType;
use Symfony\Component\Form\AbstractType;
use App\Form\Shared\TextType as MailTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
                ],
                'row_attr' => [
                    'class' => 'col-12',
                ],
            ])
            ->add('titleBold', TextType::class, [
                'required' => false,
                'attr' => [
                    'maxlength' => 255
                ],
                'row_attr' => [
                    'class' => 'col-12',
                ],
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
                    $form
                        ->add('featuredTitle', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('featuredAuthor', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('featuredCategory', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('sectionFeaturedTitle', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('sectionBestTitle', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('featuredButton', ButtonType::class)
                        ->add('featuredImage', ImageType::class)
                        ->add('books', CollectionType::class, [
                            'entry_type' => BookType::class,
                            'entry_options' => ['label' => false],
                            'allow_add' => true,
                            'by_reference' => false,
                            'allow_delete' => true,
                        ])
                    ;
                    break;
                case Data::EVENT_PLAN:
                    $form
                        ->add('sectionSpeakerTitle', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('sectionScheduleTitle', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('scheduleParagraph', TextareaType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 600
                            ],
                        ])
                        ->add('firstScheduleButton', ButtonType::class)
                        ->add('secondScheduleButton', ButtonType::class)
                        ->add('speakers', CollectionType::class, [
                            'entry_type' => SpeakerType::class,
                            'entry_options' => ['label' => false],
                            'allow_add' => true,
                            'by_reference' => false,
                            'allow_delete' => true,
                        ])
                        ->add('schedules', CollectionType::class, [
                            'entry_type' => ScheduleType::class,
                            'entry_options' => ['label' => false],
                            'allow_add' => true,
                            'by_reference' => false,
                            'allow_delete' => true,
                        ])
                    ;
                    break;
                case Data::EVENT_SUGGESTION:
                    $form 
                        ->add('events', CollectionType::class, [
                            'entry_type' => EventType::class,
                            'entry_options' => ['label' => false],
                            'allow_add' => true,
                            'by_reference' => false,
                            'allow_delete' => true,
                        ])  
                    ;
                    break;
                case Data::FREE_GOODS:
                    $form 
                        ->add('twoColGoods', CollectionType::class, [
                            'entry_type' => GoodType::class,
                            'entry_options' => ['label' => false],
                            'allow_add' => true,
                            'by_reference' => false,
                            'allow_delete' => true,
                        ])
                        ->add('threeColGoods', CollectionType::class, [
                            'entry_type' => GoodType::class,
                            'entry_options' => ['label' => false],
                            'allow_add' => true,
                            'by_reference' => false,
                            'allow_delete' => true,
                        ]) 
                    ;
                    break;
                case Data::JOB_BOARD:
                    $form
                        ->add('button', ButtonType::class)
                        ->add('jobs', CollectionType::class, [
                            'entry_type' => JobType::class,
                            'entry_options' => ['label' => false],
                            'allow_add' => true,
                            'by_reference' => false,
                            'allow_delete' => true,
                        ]) 
                    ;
                    break;
                case Data::MONTH_STATS:
                    $form
                        ->add('button', ButtonType::class)
                        ->add('stats', CollectionType::class, [
                            'entry_type' => StatType::class,
                            'entry_options' => ['label' => false],
                            'allow_add' => true,
                            'by_reference' => false,
                            'allow_delete' => true,
                        ]) 
                    ;
                    break;
                case Data::PLAYLIST_SUGGESTION:
                    $form
                        ->add('playlistTitle', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('playlistParagraph', TextareaType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 600
                            ],
                        ])
                        ->add('playlistButton', ButtonType::class)
                        ->add('playlistImage', ImageType::class)
                    ;
                    break;
                case Data::PRICING_TABLE:
                    $form
                        ->add('starterTitle', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('advancedTitle', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('starterSubTitle', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('advancedSubTitle', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('starterPrice', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('advancedPrice', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('starterDate', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('advancedDate', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('starterParagraph', TextareaType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 600
                            ],
                        ])
                        ->add('advancedParagraph', TextareaType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 600
                            ],
                        ])
                        ->add('starterButton', ButtonType::class)
                        ->add('advancedButton', ButtonType::class)
                    ;
                    break;
                case Data::USER_WELCOMING:
                    $form
                        ->add('lLabel', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('rLabel', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 255
                            ],
                        ])
                        ->add('lInfo', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 600
                            ],
                        ])
                        ->add('rInfo', TextType::class, [
                            'required' => false,
                            'attr' => [
                                'maxlength' => 600
                            ],
                        ])
                        ->add('button', ButtonType::class)
                    ;
                    break;
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
