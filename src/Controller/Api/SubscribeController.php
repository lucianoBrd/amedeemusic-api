<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Entity\Banner;
use App\Service\MailService;
use App\Service\UserService;
use App\Service\LocalGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class SubscribeController extends AbstractController
{

    public function __construct(
        private LocalGenerator $localGenerator, 
        private MailService $mailService,
        private UserService $userService,
        private EntityManagerInterface $manager,
        private ContainerBagInterface $params,
        private UrlGeneratorInterface $router,
    )
    {
    }

    #[Route(path: '/subscribe/{local}/{mail}', name: 'subscribe', methods: ['GET', 'POST'])]
    public function subscribe(string $local, string $mail, Request $request): Response
    {
        $error = true;
        $method = $request->getMethod();

        $local = $this->localGenerator->checkLocal($local);

        $language = $this->localGenerator->getLanguageByLocal($local);

        /* Remove all illegal characters from mail */
        $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);

        if ($mail && !empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            /* Save User */
            $user = new User();

            $user->setMail($mail);

            $user = $this->userService->addUser($user, true);

            /* Create context */
            $title = $language->getThankSubscribe();
            $context = $this->mailService->getMessageContext(
                title: $title,
                local: $local,
                banner: Banner::BANNER_USER_WELCOMING,
                name: $this->userService->getUserName($user),
                paragraphs: [],
                buttonPath: null,
                buttonName: $language->getWebsite(),
                user: $user,
                debug: ($method == 'GET')
            );

            /* Send message */
            $error = $this->mailService->sendMessage(
                $mail,
                $title,
                $context
            );
        }

        if ($error) {
            $user = null;

            $title = $language->getSubscribeError();
            $context = $this->mailService->getMessageContext(
                title: $title,
                local: $local,
                banner: Banner::BANNER_USER_WELCOMING,
                name: '#Unknown',
                paragraphs: [
                    $language->getErrorHelp()
                ],
                buttonPath: null,
                buttonAbsolutePath: null,
                buttonName: null,
                user: $user,
                debug: true
            );
        }

        $userReturn = $this->userService->getUserReturn($user);

        if ($method == 'POST') {
            return $this->json(
                $userReturn,
            );
        } else {
            return $this->render(
                'emails/base.html.twig',
                $context
            );
        }
        
    }

    #[Route(path: '/unsubscribe/{local}/{secret}', name: 'unsubscribe', methods: ['GET'])]
    public function unsubscribe(string $local, string $secret, Request $request): Response
    {
        $local = $this->localGenerator->checkLocal($local);

        $language = $this->localGenerator->getLanguageByLocal($local);

        $repository = $this->manager->getRepository(User::class);
        $user = $repository->findOneBy(['secret' => $secret]);

        if ($user) {
            $user->setSubscribe(false);
            $this->manager->persist($user);
            $this->manager->flush();

            $subscribePath = $this->router->generate('subscribe', ['local' => $local, 'mail' => $user->getMail()], UrlGeneratorInterface::ABSOLUTE_URL);

            $title = $language->getUnsubscribeSuccess();
            $context = $this->mailService->getMessageContext(
                title: $title,
                local: $local,
                banner: Banner::BANNER_USER_WELCOMING,
                name: $this->userService->getUserName($user),
                paragraphs: [],
                buttonPath: null,
                buttonAbsolutePath: $subscribePath,
                buttonName: $language->getSubscribe(),
                user: $user,
                debug: true
            );

        } else {
            $title = $language->getUnsubscribeError();
            $context = $this->mailService->getMessageContext(
                title: $title,
                local: $local,
                banner: Banner::BANNER_USER_WELCOMING,
                name: '#Unknown',
                paragraphs: [
                    $language->getErrorHelp()
                ],
                buttonPath: null,
                buttonAbsolutePath: null,
                buttonName: null,
                user: $user,
                debug: true
            );
        }

        return $this->render(
            'emails/base.html.twig',
            $context
        );
    }
}
