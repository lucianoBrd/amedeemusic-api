<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Banner;
use App\Service\MailService;
use App\Entity\MailContent\JobBoard;
use App\Entity\MailContent\Shared\Text;
use App\Entity\MailContent\BlogArticles;
use App\Entity\MailContent\JobBoard\Job;
use App\Entity\MailContent\Shared\Image;
use App\Service\MailContentDebugService;
use App\Entity\MailContent\JobBoard\Info;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\UserWelcoming;
use App\Entity\MailContent\BlogArticles\Color;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MailContent\BlogArticles\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/mail', condition: '%kernel.debug% === 1', name: 'mail_')]
class MailDebugController extends AbstractController
{

    public function __construct(
        private MailService $mailService,
        private MailContentDebugService $mailContentDebugService,
    )
    {
    }

    #[Route(path: '/mail', name: 'mail')]
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

    #[Route(path: '/blog-articles', name: 'blog_articles')]
    public function mailBlogArticles()
    {
        $local = 'fr';
        $title = 'Titre';

        $user = new User();
        $user->setSecret('secret');

        $mailContent = $this->mailContentDebugService->getBlogArticles();

        $context = $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_BLOG_ARTICLES,
            content: $mailContent,
            user: $user
        );
        
        /*$error = $this->mailService->sendMessage(
            'lucien.burdet@gmail.com',
            $title,
            $context
        );

        dump($error);*/

        $context['htmlView'] = true;

        return $this->render('emails/content/blog-articles.html.twig', $context);
    }

    #[Route(path: '/user-welcoming', name: 'user_welcoming')]
    public function mailUserWelcoming()
    {
        $local = 'fr';
        $title = 'Titre';

        $user = new User();
        $user->setSecret('secret');

        $mailContent = $this->mailContentDebugService->getUserWelcoming();

        $context = $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_USER_WELCOMING,
            content: $mailContent,
            user: $user
        );
        
        /*$error = $this->mailService->sendMessage(
            'lucien.burdet@gmail.com',
            $title,
            $context
        );

        dump($error);*/

        $context['htmlView'] = true;

        return $this->render('emails/content/user-welcoming.html.twig', $context);
    }

    #[Route(path: '/job-board', name: 'job_board')]
    public function mailJobBoard()
    {
        $local = 'fr';
        $title = 'Titre';

        $user = new User();
        $user->setSecret('secret');

        $mailContent = $this->mailContentDebugService->getJobBoard();

        $context = $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_JOB_BOARD,
            content: $mailContent,
            user: $user
        );
        
        /*$error = $this->mailService->sendMessage(
            'lucien.burdet@gmail.com',
            $title,
            $context
        );

        dump($error);*/

        $context['htmlView'] = true;

        return $this->render('emails/content/job-board.html.twig', $context);
    }

    #[Route(path: '/month-stats', name: 'month_stats')]
    public function mailMonthStats()
    {
        $local = 'fr';
        $title = 'Titre';

        $user = new User();
        $user->setSecret('secret');

        $mailContent = $this->mailContentDebugService->getMonthStats();

        $context = $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_MONTH_STATS,
            content: $mailContent,
            user: $user
        );
        
        /*$error = $this->mailService->sendMessage(
            'lucien.burdet@gmail.com',
            $title,
            $context
        );

        dump($error);*/

        $context['htmlView'] = true;

        return $this->render('emails/content/month-stats.html.twig', $context);
    }

    #[Route(path: '/pricing-table', name: 'pricing_table')]
    public function mailPricingTable()
    {
        $local = 'fr';
        $title = 'Titre';

        $user = new User();
        $user->setSecret('secret');

        $mailContent = $this->mailContentDebugService->getPricingTable();

        $context = $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_PRICING_TABLE,
            content: $mailContent,
            user: $user
        );
        
        /*$error = $this->mailService->sendMessage(
            'lucien.burdet@gmail.com',
            $title,
            $context
        );

        dump($error);*/

        $context['htmlView'] = true;

        return $this->render('emails/content/pricing-table.html.twig', $context);
    }
}
