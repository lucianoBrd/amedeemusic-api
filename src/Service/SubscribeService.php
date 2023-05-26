<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Banner;
use App\Service\MailService;
use App\Service\UserService;
use App\Service\LocalGenerator;
use App\Entity\MailContent\Shared\Text;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\UserWelcoming;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class SubscribeService
{
    public function __construct(
        private LocalGenerator $localGenerator, 
        private MailService $mailService,
        private ContainerBagInterface $params,
        private UserService $userService,
        private UrlGeneratorInterface $router,
    )
    {
    }

    public function getSubscribeMessageContext(string $local, User $user): array {
        $language = $this->localGenerator->getLanguageByLocal($local);

        $title = $language->getThankSubscribe();

        $mailContent = new UserWelcoming();
        $mailContent
            ->setTitle($language->getHello())
            ->setTitleBold($this->userService->getUserName($user))
        ;
        $text = new Text();
        $text
            ->setTitle($title)
        ;
        $mailContent->addText($text);
        $button = new Button();
        $button
            ->setColor($mailContent->getColor())
            ->setLink($this->params->get('app.client.url'))
            ->setName($language->getWebsite())
        ;
        $mailContent->setButton($button);

        return $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_USER_WELCOMING,
            content: $mailContent,
            user: $user,
        );
    }

    public function getUnsubscribeMessageContext(string $local, User $user): array {
        $language = $this->localGenerator->getLanguageByLocal($local);

        $title = $language->getUnsubscribeSuccess();

        $mailContent = new UserWelcoming();
        $mailContent
            ->setTitle($language->getHello())
            ->setTitleBold($this->userService->getUserName($user))
        ;
        $text = new Text();
        $text
            ->setTitle($title)
        ;
        $mailContent->addText($text);
        $button = new Button();
        $button
            ->setColor($mailContent->getColor())
            ->setLink($this->router->generate('subscribe', ['local' => $local, 'mail' => $user->getMail()], UrlGeneratorInterface::ABSOLUTE_URL))
            ->setName($language->getSubscribe())
        ;
        $mailContent->setButton($button);

        return $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_USER_WELCOMING,
            content: $mailContent,
            user: $user,
            htmlView: true
        );
    }

    public function getMessageContextError(string $local, ?User $user, string $title): array {
        $language = $this->localGenerator->getLanguageByLocal($local);

        $mailContent = new UserWelcoming();
        $mailContent
            ->setTitle($language->getHello())
            ->setTitleBold('#Unknown')
        ;
        $text = new Text();
        $text
            ->setTitle($title)
            ->setParagraph($language->getErrorHelp())
        ;
        $mailContent->addText($text);

        return $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_USER_WELCOMING,
            content: $mailContent,
            user: $user,
            htmlView: true
        );
    }
}
