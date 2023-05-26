<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Banner;
use App\Service\MailService;
use App\Service\MailContentDebugService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

#[Route('/admin/mail', condition: '%kernel.debug% === 1', name: 'mail_')]
class MailDebugController extends AbstractController
{

    public function __construct(
        private MailService $mailService,
        private MailContentDebugService $mailContentDebugService,
        private ContainerBagInterface $params,
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
            $this->params->get('mail_debug'),
            $title,
            $context,
            'emails/content/blog-articles.html.twig'
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
            $this->params->get('mail_debug'),
            $title,
            $context,
            'emails/content/user-welcoming.html.twig'
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
            $this->params->get('mail_debug'),
            $title,
            $context,
            'emails/content/job-board.html.twig'
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
            $this->params->get('mail_debug'),
            $title,
            $context,
            'emails/content/month-stats.html.twig'
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
            $this->params->get('mail_debug'),
            $title,
            $context,
            'emails/content/pricing-table.html.twig'
        );

        dump($error);*/

        $context['htmlView'] = true;

        return $this->render('emails/content/pricing-table.html.twig', $context);
    }

    #[Route(path: '/book-suggestion', name: 'book_suggestion')]
    public function mailBookSuggestion()
    {
        $local = 'fr';
        $title = 'Titre';

        $user = new User();
        $user->setSecret('secret');

        $mailContent = $this->mailContentDebugService->getBookSuggestion();

        $context = $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_BOOK_SUGGESTION,
            content: $mailContent,
            user: $user
        );
        
        /*$error = $this->mailService->sendMessage(
            $this->params->get('mail_debug'),
            $title,
            $context,
            'emails/content/book-suggestion.html.twig'
        );

        dump($error);*/

        $context['htmlView'] = true;

        return $this->render('emails/content/book-suggestion.html.twig', $context);
    }

    #[Route(path: '/playlist-suggestion', name: 'playlist_suggestion')]
    public function mailPlaylistSuggestion()
    {
        $local = 'fr';
        $title = 'Titre';

        $user = new User();
        $user->setSecret('secret');

        $mailContent = $this->mailContentDebugService->getPlaylistSuggestion();

        $context = $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_PLAYLIST_SUGGESTION,
            content: $mailContent,
            user: $user
        );
        
        /*$error = $this->mailService->sendMessage(
            $this->params->get('mail_debug'),
            $title,
            $context,
            'emails/content/playlist-suggestion.html.twig'
        );

        dump($error);*/

        $context['htmlView'] = true;

        return $this->render('emails/content/playlist-suggestion.html.twig', $context);
    }

    #[Route(path: '/free-goods', name: 'free_goods')]
    public function mailFreeGoods()
    {
        $local = 'fr';
        $title = 'Titre';

        $user = new User();
        $user->setSecret('secret');

        $mailContent = $this->mailContentDebugService->getFreeGoods();

        $context = $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_FREE_GOODS,
            content: $mailContent,
            user: $user
        );
        
        /*$error = $this->mailService->sendMessage(
            $this->params->get('mail_debug'),
            $title,
            $context,
            'emails/content/free-goods.html.twig'
        );

        dump($error);*/

        $context['htmlView'] = true;

        return $this->render('emails/content/free-goods.html.twig', $context);
    }

    #[Route(path: '/event-suggestion', name: 'event_suggestion')]
    public function mailEventSuggestion()
    {
        $local = 'fr';
        $title = 'Titre';

        $user = new User();
        $user->setSecret('secret');

        $mailContent = $this->mailContentDebugService->getEventSuggestion();

        $context = $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_EVENT_SUGGESTION,
            content: $mailContent,
            user: $user
        );
        
        /*$error = $this->mailService->sendMessage(
            $this->params->get('mail_debug'),
            $title,
            $context,
            'emails/content/event-suggestion.html.twig'
        );

        dump($error);*/

        $context['htmlView'] = true;

        return $this->render('emails/content/event-suggestion.html.twig', $context);
    }

    #[Route(path: '/event-plan', name: 'event_plan')]
    public function mailEventPlan()
    {
        $local = 'fr';
        $title = 'Titre';

        $user = new User();
        $user->setSecret('secret');

        $mailContent = $this->mailContentDebugService->getEventPlan();

        $context = $this->mailService->getMessageContext(
            title: $title,
            local: $local,
            banner: Banner::BANNER_EVENT_PLAN,
            content: $mailContent,
            user: $user
        );
        
        /*$error = $this->mailService->sendMessage(
            $this->params->get('mail_debug'),
            $title,
            $context,
            'emails/content/event-plan.html.twig'
        );

        dump($error);*/

        $context['htmlView'] = true;

        return $this->render('emails/content/event-plan.html.twig', $context);
    }
}
