<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Entity\Banner;
use App\Entity\Message;
use App\Service\MailService;
use App\Service\UserService;
use App\Service\LocalGenerator;
use App\Service\RecaptchaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class ContactController extends AbstractController
{
    public function __construct(
        private LocalGenerator $localGenerator, 
        private MailService $mailService,
        private EntityManagerInterface $manager,
        private UserService $userService,
        private RecaptchaService $recaptchaService,
        private ContainerBagInterface $params,
    )
    {
    }

    #[Route(path: '/contact/{local}', name: 'contact', methods: ['POST'])]
    public function index(string $local, Request $request): Response
    {
        $error = true;

        $local = $this->localGenerator->checkLocal($local);

        $language = $this->localGenerator->getLanguageByLocal($local);

        $postData = json_decode($request->getContent(), true);

        if (isset($postData['captcha']) && isset($postData['name']) && isset($postData['mail']) && isset($postData['message'])) {

            $captcha = htmlspecialchars($postData['captcha']);
            $name = htmlspecialchars($postData['name']);
            $mail = htmlspecialchars($postData['mail']);
            $message = htmlspecialchars($postData['message']);

            /* Remove all illegal characters from mail */
            $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);

            if ($this->recaptchaService->checkCaptcha($captcha) &&
                $name && !empty($name) &&
                $mail && !empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL) &&
                $message && !empty($message)
            ) {
                /* Save User + Message */
                $user = new User();
                $m = new Message();

                $m->setMessage($message);

                $user->setName($name)
                    ->setMail($mail)
                    ->addMessage($m);

                $user = $this->userService->addUser($user);

                /* Create messages */
                $title = 'Message de ' . $name;
                $context = $this->mailService->getMessageContext(
                    title: $title,
                    local: $local,
                    banner: Banner::BANNER_CONTACT,
                    name: $this->params->get('artist_name'),
                    paragraphs: [
                        $name,
                        $mail,
                        $message,
                    ],
                    buttonPath: null,
                    buttonAbsolutePath: null,
                    buttonName: null,
                    user: null,
                );
                $titleConfirm = $language->getConfirmationOfRecusal();
                $contextConfirm = $this->mailService->getMessageContext(
                    title: $titleConfirm,
                    local: $local,
                    banner: Banner::BANNER_CONTACT,
                    name: $name,
                    paragraphs: [
                        $language->getThankMessage(),
                        $language->getMessage(),
                        $message,
                    ],
                    buttonPath: null,
                    buttonAbsolutePath: null,
                    buttonName: null,
                    user: $user,
                );

                /* Send messages */
                $error = $this->mailService->sendMessages([
                    [
                        'to' => $this->params->get('mailer_email'),
                        'title' => $title,
                        'context' => $context
                    ],
                    [
                        'to' => $mail,
                        'title' => $titleConfirm,
                        'context' => $contextConfirm
                    ]
                ]);
            }
        }

        if ($error) {
            $user = null;
        }

        $userReturn = $this->userService->getUserReturn($user);

        return $this->json(
            $userReturn,
        );
    }
}
