<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Banner;
use App\Service\MailService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MailController extends AbstractController
{

    public function __construct(
        private MailService $mailService
    )
    {
    }

    #[Route(path: '/mail', name: 'mail', condition: '%kernel.debug% === 1')]
    public function testMail()
    {
        $local = 'fr';
        $title = 'Titre';
        $user = new User();

        $user->setSecret('secret');

        $context = $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_PLAYLIST_SUGGESTION,
            name: 'Lucien Burdet',
            paragraphs: [
                'Ceci est un paragraphe',
                'Deuxième paragraphe',
            ],
            buttonPath: null,
            buttonAbsolutePath: null,
            buttonName: 'Test',
            user: $user
        );
        
        /*$error = $this->mailService->sendMessage(
            'lucien.burdet@gmail.com',
            $title,
            $context
        );

        dump($error);*/

        $context['debug'] = true;

        return $this->render('emails/base.html.twig', $context);
    }
}
