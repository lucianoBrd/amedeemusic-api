<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Service\MailService;
use App\Service\UserService;
use App\Service\LocalGenerator;
use App\Service\SubscribeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubscribeController extends AbstractController
{

    public function __construct(
        private LocalGenerator $localGenerator, 
        private MailService $mailService,
        private UserService $userService,
        private EntityManagerInterface $manager,
        private SubscribeService $subscribeService,
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

            $context = $this->subscribeService->getSubscribeMessageContext($local, $user);

            /* Send message */
            $error = $this->mailService->sendMessage(
                $mail,
                $language->getThankSubscribe(),
                $context,
                'emails/content/user-welcoming.html.twig'
            );

            $context['htmlView'] = true;
        }

        if ($error) {
            $user = null;

            $title = $language->getSubscribeError();
            $context = $this->subscribeService->getMessageContextError($local, $user, $title);
        }

        $userReturn = $this->userService->getUserReturn($user);

        if ($method == 'POST') {
            return $this->json(
                $userReturn,
            );
        } else {
            return $this->render(
                'emails/content/user-welcoming.html.twig',
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

            $context = $this->subscribeService->getUnsubscribeMessageContext($local, $user);

        } else {
            $title = $language->getUnsubscribeError();
            $context = $this->subscribeService->getMessageContextError($local, $user, $title);
        }

        return $this->render(
            'emails/content/user-welcoming.html.twig',
            $context
        );
    }
}
