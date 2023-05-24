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
use App\Entity\MailContent\JobBoard\Info;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\UserWelcoming;
use App\Entity\MailContent\BlogArticles\Color;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MailContent\BlogArticles\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/mail', condition: '%kernel.debug% === 1', name: 'mail_')]
class MailController extends AbstractController
{

    public function __construct(
        private MailService $mailService
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

        $mailContent = new BlogArticles();
        $mailContent
            ->setTitle('Hey, This is your Weekly')
            ->setTitleBold('Blog Articles')
        ;
        $text = new Text();
        $text->setParagraph('Hi Matthew! We have top posts for you from UI/UX Design, Farming for Tomorrow, Sustainable Urban Planning& more…');
        $mailContent->addText($text);
        $article = new Article();
        $article
            ->setCategory('UX/UI Design')
            ->setColor(Color::COLORS[array_rand(Color::COLORS)])
            ->setTitle('Tiny Habits: The Small Changes That Change Everything.')
            ->setLink('#')
            ->setParagraph('WIRED, by')
            ->setParagraphBold('Luciano Brd')
        ;
        $mailContent->addArticle($article);
        $article = new Article();
        $article
            ->setCategory('iOS Development')
            ->setColor(Color::COLORS[array_rand(Color::COLORS)])
            ->setTitle('Apple TV Login + Android - Behance Tech.')
            ->setLink('#')
            ->setParagraph('WIRED, by')
            ->setParagraphBold('Luciano Brd')
        ;
        $mailContent->addArticle($article);

        $image = new Image();
        $image
            ->setImage('https://dummyimage.com/120x112/D6DAE3/000')
            ->setAbsolutePath(true)
        ;
        $article = new Article();
        $article
            ->setCategory('Farming for Tomorrow')
            ->setColor(Color::COLORS[array_rand(Color::COLORS)])
            ->setTitle('New law in Italy would force supermarkets to donate unsold food to those in need.')
            ->setLink('#')
            ->setParagraph('WIRED, by')
            ->setParagraphBold('Luciano Brd')
            ->setImage($image)
        ;
        
        $mailContent->addArticle($article);
        $article = new Article();
        $article
            ->setCategory('Personal Developpment')
            ->setColor(Color::COLORS[array_rand(Color::COLORS)])
            ->setTitle('Whether Your Goals Are Big or Small, It\'s Important to Measure Your Progress.')
            ->setLink('#')
            ->setParagraph('WIRED, by')
            ->setParagraphBold('Luciano Brd')
            ->setImage($image)
        ;
        $mailContent->addArticle($article);

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

        $mailContent = new UserWelcoming();
        $mailContent
            ->setTitle('Hey')
            ->setTitleBold('Luciano!')
            ->setLLabel('Username:')
            ->setRLabel('Email:')
            ->setLInfo('LucianoBrd')
            ->setRInfo('luciano@brd.com')
        ;
        $text = new Text();
        $text
            ->setTitle('Nice to meet You !')
            ->setParagraph('Welcome to Amédée! We\'re here to help speed up your projects by providing you with the best footage in the industry.');
        $mailContent->addText($text);
        $text = new Text();
        $text
            ->setTitle('Ready to go live?')
            ->setParagraph('You can upgrade at any time during your trial. When you do, you\'ll have access to the full power of Squarespace.');
        $mailContent->addText($text);
        $button = new Button();
        $button
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setName('Upgrade Now')
        ;
        $mailContent->setButton($button);

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

        $mailContent = new JobBoard();
        $mailContent
            ->setTitle('Design Jobs For')
            ->setTitleBold('Web Designer')
        ;
        $text = new Text();
        $text
            ->setTitle('Design Jobs for Designer')
            ->setParagraph('LucianoBrd is the heart of the design community and the best resource to discover and connect with designers and jobs worldwide.')
        ;
        $mailContent->addText($text);
        $job = new Job();
        $job
            ->setTitle('Screen Art Director, Marcom')
            ->setCompagny('-Apple Inc.')
            ->setParagraph('Marcom is Apple\'s Global Marketing Communications group that oversees all of Apple\'s advertising and marketing to create world-class communications.')
        ;
        $image = new Image();
        $image
            ->setImage('logo.png')
        ;
        $job->setImage($image);
        $info = new Info();
        $info
            ->setTitle('Cupertino, CA')
        ;
        $image = new Image();
        $image
            ->setImage('jpin.png')
        ;
        $info->setImage($image);
        $job->addInfo($info);
        $info = new Info();
        $info
            ->setTitle('Full-time')
        ;
        $image = new Image();
        $image
            ->setImage('jcalandar.png')
        ;
        $info->setImage($image);
        $job->addInfo($info);
        $mailContent->addJob($job);
        
        $button = new Button();
        $button
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setName('Show All Jobs')
        ;
        $mailContent->setButton($button);

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
}
