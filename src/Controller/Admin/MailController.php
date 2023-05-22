<?php

namespace App\Controller\Admin;

use App\Entity\Mail;
use App\Form\MailType;
use App\Service\MailService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class MailController extends AbstractController
{
    public function __construct(
        private ContainerBagInterface $params,
        private MailService $mailService,
    ) {
    }
    
    #[Route('/mail/new', name: 'new')]
    public function new(Request $request): Response
    {
        $mail = new Mail();

        $form = $this->createForm(MailType::class, $mail);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->mailService->addRecipientsToMail($mail);
            

        }

        return $this->render('admin/my-dashboard.html.twig', [
            'form' => $form,
        ]);
    }
}
