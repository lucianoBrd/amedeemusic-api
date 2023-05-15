<?php

namespace App\Service;

use App\Entity\User;
use App\Service\LocalGenerator;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
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
    )
    {
    }

    public function sendMessage(
        string $to,
        string $title,
        array $context
    ) {
        $error = true;

        $message = (new TemplatedEmail())
            ->from(Address::create($this->params->get('artist_name') . ' <' . $this->params->get('mailer_email') . '>'))
            ->to($to)
            ->subject($title)
            ->htmlTemplate('emails/base.html.twig')
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
        string $name,
        array $paragraphs,
        ?string $buttonPath = null,
        ?string $buttonAbsolutePath = null,
        ?string $buttonName = null,
        ?User $user = null,
        ?bool $debug = false
    )
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
            'h1' => $name,
            'h3' => $title,
            'paragraphs' => $paragraphs,
            'buttonPath' => $buttonPath,
            'buttonAbsolutePath' => $buttonAbsolutePath,
            'buttonName' => $buttonName,
            'language' => $language,
            'unsubscribePath' => $unsubscribePath,
            'debug' => $debug,
            //'unsubscribePath' => $secret ? $this->params->get('app.url') . '/unsubscribe/' . $local . '/' . $secret : null,
        ];
    }
}
