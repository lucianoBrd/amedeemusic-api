<?php

namespace App\Controller\Admin;

use App\Entity\Data;
use App\Entity\Mail;
use App\Form\MailType;
use App\Service\MailService;
use App\Service\MailContentService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class MailCrudController extends AbstractCrudController
{
    public function __construct(
        private ContainerBagInterface $params,
        private MailService $mailService,
        private EntityManagerInterface $manager,
        private MailContentService $mailContentService,
    ) {
    }
    
    public static function getEntityFqcn(): string
    {
        return Mail::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $sentAction = Action::new('Sent')
            ->linkToCrudAction('sentAction')
            ->displayIf(static function (Mail $mail) {
                return !$mail->isSent();
            })
        ;

        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_INDEX, $sentAction)
            ->add(Crud::PAGE_DETAIL, $sentAction)
            ->update(Crud::PAGE_INDEX, Action::DELETE, static function(Action $action) {
                $action->displayIf(static function (Mail $mail) {
                    return !$mail->isSent();
                });
                return $action;
            })
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title')
            ->add('date')
            ->add('sent')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title');
        yield DateTimeField::new('date');
        yield TextField::new('recipientsString');
        yield AssociationField::new('recipients');
        yield BooleanField::new('sent')->renderAsSwitch(false);
        yield AssociationField::new('mailContent')
            ->setTemplatePath('admin/field/mail-content.html.twig')
        ;
    }

    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance->isSent()) {
            throw new \Exception('Deleting sent mail is forbidden!');
        }
        parent::deleteEntity($entityManager, $entityInstance);
    }

    public function sentAction(AdminContext $context)
    {
        $mail = $context->getEntity()->getInstance();
        
        //Sent mail
        $error = $this->mailContentService->sendMessagesByMail($mail);

        if (!$error) {
            $mail->setSent(true);
            $this->manager->persist($mail);
            $this->manager->flush();
            $this->addFlash('success', 'Mail sent');
        } else {
            $this->addFlash('danger', 'An error occurred while sending mail');
        }

        $url = $this->container->get(AdminUrlGenerator::class)
            ->setAction(Action::INDEX)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function new(AdminContext $context) {
        $mail = new Mail();
        $mail = $this->mailService->addRecipientsToMail($mail);
        
        $this->manager->persist($mail);
        $this->manager->flush();

        $url = $this->container->get(AdminUrlGenerator::class)
            ->setAction(Action::EDIT)
            ->setEntityId($mail->getId())
            ->generateUrl();

        return $this->redirect($url);
    }

    public function edit(AdminContext $context) {
        $mail = $context->getEntity()->getInstance();

        $mailContent = $mail->getMailContent();

        $mailContentClassName = $mailContent ? get_class($mailContent) : null;

        if ($mailContent) {
            $originalTexts = new ArrayCollection();
            foreach ($mailContent->getTexts() as $text) {
                $originalTexts->add($text);
            }

            switch ($mailContentClassName) {
                case Data::BLOG_ARTICLES:
                    $originalArticles = new ArrayCollection();
                    foreach ($mailContent->getArticles() as $article) {
                        $originalArticles->add($article);
                    }
                    break;
                case Data::BOOK_SUGGESTION:
                    $originalBooks = new ArrayCollection();
                    foreach ($mailContent->getBooks() as $book) {
                        $originalBooks->add($book);
                    }
                    break;
                case Data::EVENT_PLAN:
                    $originalSpeakers = new ArrayCollection();
                    foreach ($mailContent->getSpeakers() as $speaker) {
                        $originalSpeakers->add($speaker);
                    }
                    $originalSchedules = new ArrayCollection();
                    foreach ($mailContent->getSchedules() as $schedule) {
                        $originalSchedules->add($schedule);
                    }
                    break;
                case Data::EVENT_SUGGESTION:
                    $originalEvents = new ArrayCollection();
                    foreach ($mailContent->getEvents() as $event) {
                        $originalEvents->add($event);
                    }
                    break;
                case Data::FREE_GOODS:
                    $originalTwoColGoods = new ArrayCollection();
                    foreach ($mailContent->getTwoColGoods() as $good) {
                        $originalTwoColGoods->add($good);
                    }
                    $originalThreeColGoods = new ArrayCollection();
                    foreach ($mailContent->getThreeColGoods() as $good) {
                        $originalThreeColGoods->add($good);
                    }
                    break;
                case Data::JOB_BOARD:
                    $originalJobs = new ArrayCollection();
                    foreach ($mailContent->getJobs() as $job) {
                        $originalJobs->add($job);
                    }
                    break;
                case Data::MONTH_STATS:
                    $originalStats = new ArrayCollection();
                    foreach ($mailContent->getStats() as $stat) {
                        $originalStats->add($stat);
                    }
                    break;
            }
        }

        $form = $this->createForm(MailType::class, $mail, [
            'mailContentClassName' => $mailContentClassName
        ]);

        $form->handleRequest($context->getRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            if ($mailContent) {
                foreach ($originalTexts as $text) {
                    if (false === $mailContent->getTexts()->contains($text)) {
                        $this->manager->remove($text);
                    }
                }
    
                switch ($mailContentClassName) {
                    case Data::BLOG_ARTICLES:
                        foreach ($originalArticles as $article) {
                            if (false === $mailContent->getArticles()->contains($article)) {
                                $this->manager->remove($article);
                            }
                        }
                        break;
                    case Data::BOOK_SUGGESTION:
                        foreach ($originalBooks as $book) {
                            if (false === $mailContent->getBooks()->contains($book)) {
                                $this->manager->remove($book);
                            }
                        }
                        break;
                    case Data::EVENT_PLAN:
                        foreach ($originalSpeakers as $speaker) {
                            if (false === $mailContent->getSpeakers()->contains($speaker)) {
                                $this->manager->remove($speaker);
                            }
                        }
                        foreach ($originalSchedules as $schedule) {
                            if (false === $mailContent->getSchedules()->contains($schedule)) {
                                $this->manager->remove($schedule);
                            }
                        }
                        break;
                    case Data::EVENT_SUGGESTION:
                        foreach ($originalEvents as $event) {
                            if (false === $mailContent->getEvents()->contains($event)) {
                                $this->manager->remove($event);
                            }
                        }
                        break;
                    case Data::FREE_GOODS:
                        foreach ($originalTwoColGoods as $good) {
                            if (false === $mailContent->getTwoColGoods()->contains($good)) {
                                $this->manager->remove($good);
                            }
                        }
                        foreach ($originalThreeColGoods as $good) {
                            if (false === $mailContent->getThreeColGoods()->contains($good)) {
                                $this->manager->remove($good);
                            }
                        }
                        break;
                    case Data::JOB_BOARD:
                        foreach ($originalJobs as $job) {
                            if (false === $mailContent->getJobs()->contains($job)) {
                                $this->manager->remove($job);
                            }
                        }
                        break;
                    case Data::MONTH_STATS:
                        foreach ($originalStats as $stat) {
                            if (false === $mailContent->getStats()->contains($stat)) {
                                $this->manager->remove($stat);
                            }
                        }
                        break;
                }
            }
            
            $newMailContent = $form->get('mailContentChoice')->getData();

            if ($newMailContent != $mailContentClassName) {
                $mail->setMailContent($this->mailContentService->getMailContentByClassName($newMailContent));

                if ($mailContent) {
                    $this->manager->remove($mailContent);
                }
            }

            $this->manager->persist($mail);
            $this->manager->flush();

            $url = $this->container->get(AdminUrlGenerator::class)
                ->setAction(Action::EDIT)
                ->setEntityId($context->getEntity()->getPrimaryKeyValue())
                ->generateUrl();

            return $this->redirect($url);
        }

        return $this->render('admin/mail-edit.html.twig', [
            'form' => $form,
            'displayMail' => $mailContent ? true : false,
            'mail' => $mail,
        ]);
    }
}
