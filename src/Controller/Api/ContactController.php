<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Entity\Banner;
use App\Entity\Message;
use App\Service\MailService;
use App\Service\UserService;
use App\Service\ContactService;
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
        private ContactService $contactService,
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

        $captcha = $request->request->get('captcha');
        $name = $request->request->get('name');
        $mail = $request->request->get('mail');
        $message = $request->request->get('message');

        /* Remove all illegal characters from mail */
        $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);

        $checkCaptcha = $this->recaptchaService->checkCaptcha($captcha);

        if ($checkCaptcha &&
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

            $repository = $this->manager->getRepository(Message::class);
            $m = $repository->findBy(['user' => $user], ['id' => 'DESC'], 1);
            if (count($m) > 0) {
                $m = $m[0];

                /* Send messages */
                $error = $this->mailService->sendMessages([
                    [
                        'to' => $this->params->get('mailer_email'),
                        'title' => $language->getMessageFrom() . ' ' . $user->getName(),
                        'context' => $this->contactService->getMessageContext($local, $m),
                        'template' => 'emails/content/user-welcoming.html.twig'
                    ],
                    [
                        'to' => $mail,
                        'title' => $language->getConfirmationOfRecusal(),
                        'context' => $this->contactService->getMessageContextConfirm($local, $m),
                        'template' => 'emails/content/user-welcoming.html.twig'
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
