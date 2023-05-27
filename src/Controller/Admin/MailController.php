<?php

namespace App\Controller\Admin;

use App\Entity\Mail;
use App\Form\MailType;
use App\Service\MailService;
use App\Service\MailContentDebugService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
        private MailContentDebugService $mailContentDebugService,
    ) {
    }
    
    #[Route('/new', name: 'new')]
    public function new(Request $request): Response
    {
        $mail = new Mail();
        $mail = $this->mailService->addRecipientsToMail($mail);

        $mail->setMailContent($this->mailContentDebugService->getBlogArticles());
        
        $this->manager->persist($mail);
        $this->manager->flush();

        return $this->redirectToRoute('mail_edit', ['mail' => $mail->getId()]);
    }

    #[Route('/edit/{mail}', name: 'edit')]
    public function edit(Request $request, ?Mail $mail): Response
    {
        $form = $this->createForm(MailType::class, $mail);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            

        }

        return $this->render('admin/mail-edit.html.twig', [
            'form' => $form,
        ]);
    }
}
