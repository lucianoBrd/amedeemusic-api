<?php

namespace App\Service;

use App\Entity\Mail;
use App\Entity\User;
use App\Service\UserService;
use App\Service\LocalGenerator;
use App\Service\MailContentService;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use App\Entity\MailContent\MailContentInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class MailService
{
    public function __construct(
        private LocalGenerator $localGenerator, 
        private MailerInterface $mailer,
        private ContainerBagInterface $params,
        private UrlGeneratorInterface $router,
        private UserService $userService,
        private MailContentService $mailContentService,
    )
    {
    }

    public function addRecipientsToMail(Mail $mail): Mail {
        $users = $this->userService->getAllSubscribeUser();
        
        $recipientsString = '';

        $first = true;
        foreach ($users as $user) {
            $mail->addRecipient($user);

            if ($first) {
                $first = false;
            } else {
                $recipientsString .= ',';
            }
            $recipientsString .= $user->getMail();
        }
        $mail->setRecipientsString($recipientsString);
        return $mail;
    }

    public function sendMessages(array $messages): bool {
        $error = false;
        foreach ($messages as $message) {
            $error = $error || $this->sendMessage(
                $message['to'],
                $message['title'],
                $message['context']
            );
        }
        return $error;
    }

    public function sendMessage(
        string $to,
        string $title,
        array $context,
        string $template = 'emails/base.html.twig'
    ): bool 
    {
        $error = true;

        $message = (new TemplatedEmail())
            ->from(Address::create($this->params->get('artist_name') . ' <' . $this->params->get('mailer_email') . '>'))
            ->to($to)
            ->subject($title)
            ->htmlTemplate($template)
            ->context($context)
        ;
        try {
            $this->mailer->send($message);
            $error = false;
        } catch (TransportExceptionInterface  $e) {
            $error = true;
        }
        return $error;
    }

    public function getMessageContext(
        string $title,
        string $local,
        string $banner,
        MailContentInterface $content,
        ?User $user = null,
        ?bool $htmlView = false
    ): array
    {
        $language = $this->localGenerator->getLanguageByLocal($local);
        $unsubscribePath = null;
        
        if ($user && $user->isSubscribe() && $user->getSecret() !== null) {
            $unsubscribePath = $this->router->generate('unsubscribe', ['local' => $local, 'secret' => $user->getSecret()], UrlGeneratorInterface::ABSOLUTE_URL);
        }

        return [
            'local' => $local,
            'title' => $title,
            'banner' => $banner,
            'content' => $content,
            'language' => $language,
            'unsubscribePath' => $unsubscribePath,
            'htmlView' => $htmlView,
            'mailContentService' => $this->mailContentService,
        ];
    }
}
