<?php

namespace App\Service;

use App\Entity\Banner;
use App\Entity\Message;
use App\Service\MailService;
use App\Service\LocalGenerator;
use App\Entity\MailContent\Shared\Text;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\UserWelcoming;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class ContactService
{
    public function __construct(
        private LocalGenerator $localGenerator, 
        private MailService $mailService,
        private ContainerBagInterface $params,
    )
    {
    }

    public function getMessageContext(string $local, Message $message): array {
        $language = $this->localGenerator->getLanguageByLocal($local);

        $user = $message->getUser();

        $title = $language->getMessageFrom() . ' ' . $user->getName();

        $mailContent = new UserWelcoming();
        $mailContent
            ->setTitle($language->getHello())
            ->setTitleBold($this->params->get('artist_name'))
            ->setLLabel('Name - Mail:')
            ->setRLabel('Message:')
            ->setLInfo($user->getName() . ' - ' . $user->getMail())
            ->setRInfo($message->getMessage())
        ;
        $text = new Text();
        $text
            ->setTitle($title)
            ->setParagraph($message->getDate()->format('d/m/Y H:i:s'))
        ;
        $mailContent->addText($text);
        $button = new Button();
        $button
            ->setColor($mailContent->getColor())
            ->setLink('mailto:' . $user->getMail())
            ->setName($language->getRespond())
        ;
        $mailContent->setButton($button);

        return $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_USER_WELCOMING,
            content: $mailContent,
            user: null
        );
    }

    public function getMessageContextConfirm(string $local, Message $message): array {
        $language = $this->localGenerator->getLanguageByLocal($local);

        $user = $message->getUser();

        $title = $language->getConfirmationOfRecusal();

        $mailContent = new UserWelcoming();
        $mailContent
            ->setTitle($language->getHello())
            ->setTitleBold($user->getName())
            ->setLLabel('Date:')
            ->setRLabel('Message:')
            ->setLInfo($message->getDate()->format('d/m/Y H:i:s'))
            ->setRInfo($message->getMessage())
        ;
        $text = new Text();
        $text
            ->setTitle($title)
        ;
        $mailContent->addText($text);

        return $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_USER_WELCOMING,
            content: $mailContent,
            user: $user
        );
    }
}
