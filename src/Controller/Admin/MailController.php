<?php

namespace App\Controller\Admin;

use App\Entity\Data;
use App\Entity\Mail;
use App\Form\MailType;
use App\Service\MailService;
use App\Form\MailContentType;
use App\Service\MailContentService;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\MailContentTemplateService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

#[Route('/admin/mail', name: 'mail_')]
class MailController extends AbstractDashboardController
{
    public function __construct(
        private ContainerBagInterface $params,
        private MailService $mailService,
        private EntityManagerInterface $manager,
        private MailContentService $mailContentService,
    ) {
    }
    
    #[Route('/new', name: 'new')]
    public function new(Request $request): Response
    {
        $mail = new Mail();
        $mail = $this->mailService->addRecipientsToMail($mail);
        
        $this->manager->persist($mail);
        $this->manager->flush();

        return $this->redirectToRoute('mail_edit', ['mail' => $mail->getId()]);
    }

    #[Route('/edit/{mail}', name: 'edit')]
    public function edit(Request $request, Mail $mail): Response
    {
        $mailContent = $mail->getMailContent();

        if ($mailContent) {
            $originalTexts = new ArrayCollection();
            foreach ($mailContent->getTexts() as $text) {
                $originalTexts->add($text);
            }

            switch (get_class($mailContent)) {
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

        $form = $this->createForm(MailType::class, $mail);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($mailContent) {
                foreach ($originalTexts as $text) {
                    if (false === $mailContent->getTexts()->contains($text)) {
                        $this->manager->remove($text);
                    }
                }
    
                switch (get_class($mailContent)) {
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

            if ($newMailContent != get_class($mailContent)) {
                $mail->setMailContent($this->mailContentService->getMailContentByClassName($newMailContent));
                $this->manager->remove($mailContent);
            }

            $this->manager->persist($mail);
            $this->manager->flush();
            return $this->redirectToRoute('mail_edit', ['mail' => $mail->getId()]);
        }

        return $this->render('admin/mail-edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/display/{mail}', name: 'display')]
    public function displayMail(Request $request, Mail $mail): Response
    {
        $mailContent = $mail->getMailContent();

        if (!$mailContent) {
            throw $this->createNotFoundException();
        }

        $mailContentClassName = get_class($mailContent);

        $context = $this->mailContentService->getContextByMail($mail);

        $context['htmlView'] = true;

        return $this->render($this->mailContentService->getTemplateByClassName($mailContentClassName), $context);
    }
}
