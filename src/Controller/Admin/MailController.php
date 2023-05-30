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
        $form = $this->createForm(MailType::class, $mail);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $oldMailContent = $mail->getMailContent();
            
            $mailContent = $form->get('mailContent')->getData();
            $mail->setMailContent($this->mailContentService->getMailContentByClassName($mailContent));

            if ($oldMailContent) {
                $this->manager->remove($oldMailContent);
            }
            $this->manager->persist($mail);
            $this->manager->flush();
        }

        return $this->render('admin/mail-edit.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/edit/mail-content/{mail}', name: 'edit_mail_content')]
    public function editMailContent(Request $request, Mail $mail): Response
    {
        $mailContent = $mail->getMailContent();

        if (!$mailContent) {
            throw $this->createNotFoundException();
        }

        $originalTexts = new ArrayCollection();
        foreach ($mailContent->getTexts() as $text) {
            $originalTexts->add($text);
        }

        $form = $this->createForm(MailContentType::class, $mailContent);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($originalTexts as $text) {
                if (false === $mailContent->getTexts()->contains($text)) {
                    $this->manager->remove($text);
                }
            }

            $this->manager->persist($mailContent);
            $this->manager->flush();
            return $this->redirectToRoute('edit_mail_content', ['mail' => $mail->getId()]);
        }

        return $this->render('admin/mail-content-edit.html.twig', [
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
