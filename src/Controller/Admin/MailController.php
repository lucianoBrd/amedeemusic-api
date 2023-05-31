<?php

namespace App\Controller\Admin;

use App\Entity\Mail;
use App\Service\MailContentService;
use App\Entity\MailContent\MailContent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

#[Route('/admin/mail', name: 'mail_')]
class MailController extends AbstractDashboardController
{
    public function __construct(
        private MailContentService $mailContentService,
    ) {
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

    #[Route('/display/mail-content/{mailContent}', name: 'display_mail_content')]
    public function displayMailContent(Request $request, MailContent $mailContent): Response
    {
        $mailContentClassName = get_class($mailContent);

        $context = $this->mailContentService->getContextByMailContent($mailContent);

        $context['htmlView'] = true;

        return $this->render($this->mailContentService->getTemplateByClassName($mailContentClassName), $context);
    }
}
