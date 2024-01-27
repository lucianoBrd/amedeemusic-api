<?php

namespace App\Service;
use App\Entity\Blog;
use App\Entity\Data;
use App\Entity\Local;
use App\Entity\Locals;
use App\Entity\Project;
use App\Entity\Language;
use App\Service\LocalGenerator;
use App\Entity\Event as AppEvent;
use App\Entity\MailContent\JobBoard;
use App\Entity\MailContent\EventPlan;
use App\Entity\MailContent\FreeGoods;
use App\Entity\MailContent\MonthStats;
use App\Entity\MailContent\Shared\Text;
use App\Entity\MailContent\BlogArticles;
use App\Entity\MailContent\JobBoard\Job;
use App\Entity\MailContent\PricingTable;
use App\Entity\MailContent\Shared\Image;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\MailContent\JobBoard\Info;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\UserWelcoming;
use App\Entity\MailContent\BookSuggestion;
use App\Entity\MailContent\FreeGoods\Good;
use App\Entity\MailContent\EventSuggestion;
use App\Entity\MailContent\MonthStats\Stat;
use App\Entity\MailContent\EventPlan\Speaker;
use App\Entity\MailContent\EventPlan\Schedule;
use App\Entity\MailContent\PlaylistSuggestion;
use App\Entity\MailContent\BookSuggestion\Book;
use App\Entity\MailContent\BlogArticles\Article;
use App\Entity\MailContent\EventSuggestion\Event;
use App\Entity\MailContent\EventPlan\Color as EventPlanColor;
use App\Entity\MailContent\BlogArticles\Color as BlogArticlesColor;
use App\Entity\MailContent\PricingTable\Color as PricingTableColor;
use App\Entity\MailContent\EventSuggestion\Color as EventSuggestionColor;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class MailContentTemplateService
{
    private Language $language;

    public function __construct(
        private EntityManagerInterface $manager,
        private LocalGenerator $localGenerator, 
        private ContainerBagInterface $params,
    )
    {
        $this->language = $this->localGenerator->getLanguageByLocal(Locals::FR);
    }

    public function getBlogArticles(): BlogArticles {
        $local = $this->manager->getRepository(Local::class)->findOneBy(['local' => Locals::FR]);

        $blogs = $this->manager->getRepository(Blog::class)->findBy(['local' => $local], ['date' => 'DESC'], Data::PAGINATION_ITEMS_PER_PAGE_LASTS);

        if (count($blogs) > 0) {
            $mailContent = new BlogArticles();
            $mailContent
                ->setTitle($this->language->getComeRead())
                ->setTitleBold($this->language->getLatestPosts())
            ;
            
            foreach ($blogs as $blog) {
                $image = new Image();
                $image
                    ->setAbsolutePath($this->params->get('app.url') . '/' . $this->params->get('images_base_directory') . 'blog/' . $blog->getImage())
                ;
    
                // Article4
                $article = new Article();
                $article
                    ->setCategory($blog->getDate()->format('d/m/Y'))
                    ->setColor(BlogArticlesColor::COLORS[array_rand(BlogArticlesColor::COLORS)])
                    ->setTitle($blog->getTitle())
                    ->setLink($this->params->get('app.client.url') . '/blog/detail/' . $blog->getSlug())
                    ->setParagraph($blog->getPlainText())
                    ->setImage($image)
                ;
                $mailContent->addArticle($article);
            }
        } else {
            $mailContent = new BlogArticles();
            $mailContent
                ->setTitle('Hey, This is your Weekly')
                ->setTitleBold('Blog Articles')
            ;
            $text = new Text();
            $text->setParagraph('Hi Matthew! We have top posts for you from UI/UX Design, Farming for Tomorrow, Sustainable Urban Planning& more…');
            $mailContent->addText($text);

            // Article1
            $article = new Article();
            $article
                ->setCategory('UX/UI Design')
                ->setColor(BlogArticlesColor::COLORS[array_rand(BlogArticlesColor::COLORS)])
                ->setTitle('Tiny Habits: The Small Changes That Change Everything.')
                ->setLink('#')
                ->setParagraph('WIRED, by')
                ->setParagraphBold('Luciano Brd')
            ;
            $mailContent->addArticle($article);

            // Article2
            $article = new Article();
            $article
                ->setCategory('iOS Development')
                ->setColor(BlogArticlesColor::COLORS[array_rand(BlogArticlesColor::COLORS)])
                ->setTitle('Apple TV Login + Android - Behance Tech.')
                ->setLink('#')
                ->setParagraph('WIRED, by')
                ->setParagraphBold('Luciano Brd')
            ;
            $mailContent->addArticle($article);

            $image = new Image();
            $image
                ->setAbsolutePath('https://dummyimage.com/120x112/D6DAE3/000')
            ;

            // Article3
            $article = new Article();
            $article
                ->setCategory('Farming for Tomorrow')
                ->setColor(BlogArticlesColor::COLORS[array_rand(BlogArticlesColor::COLORS)])
                ->setTitle('New law in Italy would force supermarkets to donate unsold food to those in need.')
                ->setLink('#')
                ->setParagraph('WIRED, by')
                ->setParagraphBold('Luciano Brd')
                ->setImage($image)
            ;
            $mailContent->addArticle($article);

            $image = new Image();
            $image
                ->setAbsolutePath('https://dummyimage.com/120x112/D6DAE3/000')
            ;

            // Article4
            $article = new Article();
            $article
                ->setCategory('Personal Developpment')
                ->setColor(BlogArticlesColor::COLORS[array_rand(BlogArticlesColor::COLORS)])
                ->setTitle('Whether Your Goals Are Big or Small, It\'s Important to Measure Your Progress.')
                ->setLink('#')
                ->setParagraph('WIRED, by')
                ->setParagraphBold('Luciano Brd')
                ->setImage($image)
            ;
            $mailContent->addArticle($article);
        }

        return $mailContent;
    }

    public function getUserWelcoming(): UserWelcoming {
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

        return $mailContent;
    }

    public function getJobBoard(): JobBoard {
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

        // Job1
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

        // Job2
        $job = new Job();
        $job
            ->setTitle('Screen Art Director, Marcom')
            ->setCompagny('-Apple Inc.')
            ->setParagraph('Marcom is Apple\'s Global Marketing Communications group that oversees all of Apple\'s advertising and marketing to create world-class communications.')
        ;
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

        // Job3
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
        
        return $mailContent;
    }

    public function getMonthStats(): MonthStats {
        $mailContent = new MonthStats();
        $mailContent
            ->setTitle('Congrats on a')
            ->setTitleBold('Great Month')
        ;
        $text = new Text();
        $text
            ->setTitle('You\'re doing awesome, Luciano')
            ->setParagraph('Here\'s a look back at your accomplishments last month, plus tips on how to make the most of your time while delivering. Now let\'s get moving!')
        ;
        $mailContent->addText($text);

        // Stat1
        $stat = new Stat();
        $stat
            ->setTitle('Views :')
            ->setNumber('1.07 M')
            ->setSubTitle('Pro tip:')
            ->setParagraph('Here\'s a look back at your accomplishments last month, plus tips on how to make the most of your time while delivering. Now let\'s get moving!')
            ->setEvolution('+38K views')
            ->setDate('last month')
        ;
        $image = new Image();
        $image
            ->setImage('eye.png')
        ;
        $stat->setImage($image);
        $mailContent->addStat($stat);

        // Stat2
        $stat = new Stat();
        $stat
            ->setTitle('Likes :')
            ->setNumber('66')
            ->setEvolution('+38K likes')
            ->setDate('last month')
        ;
        $image = new Image();
        $image
            ->setImage('hearth.png')
        ;
        $stat->setImage($image);
        $mailContent->addStat($stat);

        // Stat3
        $stat = new Stat();
        $stat
            ->setTitle('Downloads :')
            ->setNumber('5.83 K')
            ->setEvolution('+38K Downloads')
            ->setDate('last month')
        ;
        $image = new Image();
        $image
            ->setImage('download.png')
        ;
        $stat->setImage($image);
        $mailContent->addStat($stat);
        
        $button = new Button();
        $button
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setName('More Details')
        ;
        $mailContent->setButton($button);
        
        return $mailContent;
    }

    public function getPricingTable(): PricingTable {
        $mailContent = new PricingTable();
        $mailContent
            ->setTitle('Choose your')
            ->setTitleBold('Plan')
            ->setStarterTitle('Starter')
            ->setStarterSubTitle('For Individuals')
            ->setStarterPrice('Free')
            ->setStarterParagraph('No Domain Included. No Google Ads Credits')
            ->setAdvancedTitle('Advanced')
            ->setAdvancedSubTitle('Groups & Organizations')
            ->setAdvancedPrice('$10/')
            ->setAdvancedDate('mo')
            ->setAdvancedParagraph('Domain Included ($20). Google Ads Crédits($120)')
        ;
        $button = new Button();
        $button
            ->setColor(PricingTableColor::STARTER_COLOR)
            ->setLink('#')
            ->setName('Select')
        ;
        $mailContent->setStarterButton($button);
        $button = new Button();
        $button
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setName('Select')
        ;
        $mailContent->setAdvancedButton($button);
        $text = new Text();
        $text
            ->setTitle('Exceptional Service, at the Right Price')
            ->setParagraph('Here\'s a look back at your accomplishments last month, plus tips on how to make the most of your time while delivering. Now let\'s get moving!')
        ;
        $mailContent->addText($text);
        $image = new Image();
        $image
            ->setImage('case.png')
        ;
        $text = new Text();
        $text
            ->setTitle('Entreprise')
            ->setParagraph('Don\'t find what you\'re looking for or need multiple tarifes. Pease Contact Us for custom services')
            ->setImage($image)
        ;
        $mailContent->addText($text);
        
        return $mailContent;
    }

    public function getBookSuggestion(): BookSuggestion {
        $mailContent = new BookSuggestion();
        $mailContent
            ->setTitle('Hey, This is your Weekly')
            ->setTitleBold('Books Suggestion')
            ->setSectionFeaturedTitle('Featured Book :')
            ->setSectionBestTitle('Best Selling Books :')
            ->setFeaturedAuthor('by Luciano')
            ->setFeaturedCategory('Fiction')
            ->setFeaturedTitle('Tiny Habits: The Small Changes That Change Everything')
        ;
        $button = new Button();
        $button
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setName('Read Now')
        ;
        $mailContent->setFeaturedButton($button);
        $image = new Image();
        $image
            ->setAbsolutePath('https://dummyimage.com/150x230/D6DAE3/000')
        ;
        $mailContent->setFeaturedImage($image);

        // Book1
        $image = new Image();
        $image
            ->setAbsolutePath('https://dummyimage.com/117x178/D6DAE3/000')
        ;
        $button = new Button();
        $button
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setName('Read Now')
        ;
        $book = new Book();
        $book
            ->setTitle('Dear Edward: A Novel')
            ->setImage($image)
            ->setButton($button)
        ;
        $mailContent->addBook($book);
        // Book2
        $image = new Image();
        $image
            ->setAbsolutePath('https://dummyimage.com/117x178/D6DAE3/000')
        ;
        $button = new Button();
        $button
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setName('Read Now')
        ;
        $book = new Book();
        $book
            ->setTitle('American Dirt (Oprah\'s Book Club): A Novel')
            ->setImage($image)
            ->setButton($button)
        ;
        $mailContent->addBook($book);
        // Book3
        $image = new Image();
        $image
            ->setAbsolutePath('https://dummyimage.com/117x178/D6DAE3/000')
        ;
        $button = new Button();
        $button
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setName('Read Now')
        ;
        $book = new Book();
        $book
            ->setTitle('Habits of Purpose for an Age of Distraction')
            ->setImage($image)
            ->setButton($button)
        ;
        $mailContent->addBook($book);
        
        return $mailContent;
    }

    public function getPlaylistSuggestion(): PlaylistSuggestion {
        $repository = $this->manager->getRepository(Project::class);

        $projects = $repository->findBy([], ['date' => 'DESC'], 1);

        if (count($projects) > 0) {
            $project = $projects[0];

            $mailContent = new PlaylistSuggestion();
            $mailContent
                ->setTitle($this->language->getComeListenTo())
                ->setTitleBold($this->language->getLatestNovelty())
                ->setPlaylistTitle($project->getName())
                ->setPlaylistParagraph($project->getType()->getName() . ' • ' . $project->getDate()->format('d/m/Y'))
            ;
            $button = new Button();
            $button
                ->setColor($mailContent->getColor())
                ->setLink($this->params->get('app.client.url') . '/page/project/' . $project->getId())
                ->setName($this->language->getListen())
            ;
            $mailContent->setPlaylistButton($button);
            $image = new Image();
            $image
                ->setAbsolutePath($this->params->get('app.url') . '/' . $this->params->get('images_base_directory') . 'project/' . $project->getImage())
            ;
            $mailContent->setPlaylistImage($image);
        } else {
            $mailContent = new PlaylistSuggestion();
            $mailContent
                ->setTitle('Hey, This is your Weekly')
                ->setTitleBold('Playlist Suggestion')
                ->setPlaylistTitle('Happy Friday Commute')
                ->setPlaylistParagraph('Almost through the Week, Enjoy your last commute')
            ;
            $button = new Button();
            $button
                ->setColor($mailContent->getColor())
                ->setLink('#')
                ->setName('Play Now')
            ;
            $mailContent->setPlaylistButton($button);
            $image = new Image();
            $image
                ->setAbsolutePath('https://dummyimage.com/240x240/D6DAE3/000')
            ;
            $mailContent->setPlaylistImage($image);
        }
        
        return $mailContent;
    }

    public function getFreeGoods(): FreeGoods {
        $mailContent = new FreeGoods();
        $mailContent
            ->setTitle('Hey, This is your Weekly')
            ->setTitleBold('Free Goods')
        ;
        
        // Good1
        $image = new Image();
        $image
            ->setAbsolutePath('https://dummyimage.com/188x134/D6DAE3/000')
        ;
        $good = new Good();
        $good
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setTitle('Stranger Forest Collection')
            ->setAuthor('Luciano')
        ;
        $good->setImage($image);
        $mailContent->addTwoColGood($good);
        // Good2
        $image = new Image();
        $image
            ->setAbsolutePath('https://dummyimage.com/188x134/D6DAE3/000')
        ;
        $good = new Good();
        $good
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setTitle('Fruit and vegetables')
            ->setAuthor('LucianoBrd')
        ;
        $good->setImage($image);
        $mailContent->addTwoColGood($good);

        // Good1
        $image = new Image();
        $image
            ->setAbsolutePath('https://dummyimage.com/117x134/D6DAE3/000')
        ;
        $good = new Good();
        $good
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setTitle('Campari Tomatoes')
            ->setAuthor('Luciano')
        ;
        $good->setImage($image);
        $mailContent->addThreeColGood($good);
        // Good2
        $image = new Image();
        $image
            ->setAbsolutePath('https://dummyimage.com/117x134/D6DAE3/000')
        ;
        $good = new Good();
        $good
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setTitle('Cheers!')
            ->setAuthor('LucianoBrd')
        ;
        $good->setImage($image);
        $mailContent->addThreeColGood($good);
        // Good3
        $image = new Image();
        $image
            ->setAbsolutePath('https://dummyimage.com/117x134/D6DAE3/000')
        ;
        $good = new Good();
        $good
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setTitle('Friday!')
            ->setAuthor('Luciano')
        ;
        $good->setImage($image);
        $mailContent->addThreeColGood($good);
        
        return $mailContent;
    }

    public function getEventSuggestion(): EventSuggestion {
        $events = $this->manager->getRepository(AppEvent::class)->findEventsToCome();

        if (count($events) > 0) {
            $mailContent = new EventSuggestion();
            $mailContent
                ->setTitle($this->language->getComeSeeMeAt())
                ->setTitleBold($this->language->getEvents())
            ;
            foreach ($events as $appEvent) {
                // Event1
                $image = new Image();
                $image
                    ->setImage('pin.png')
                ;
                $event = new Event();
                $event
                    ->setCategory($appEvent->getDate()->format('d/m/Y H:i'))
                    ->setColor(EventSuggestionColor::COLORS[array_rand(EventSuggestionColor::COLORS)])
                    ->setTitle($appEvent->getName())
                    ->setPlace($appEvent->getPlace())
                    ->setImage($image)
                ;
                if ($appEvent->getLink()) {
                    $button = new Button();
                    $button
                        ->setColor($event->getColor())
                        ->setLink($appEvent->getLink())
                        ->setName($this->language->getAccess())
                    ;
                    $event->setButton($button);
                }
                $mailContent->addEvent($event);
            }
        } else {
            $mailContent = new EventSuggestion();
            $mailContent
                ->setTitle('Hey, This is your Weekly')
                ->setTitleBold('Event Suggestion')
            ;
            
            $text = new Text();
            $text->setParagraph('Hi Matthew! We have top posts for you from UI/UX Design, Farming for Tomorrow, Sustainable Urban Planning& more…');
            $mailContent->addText($text);

            // Event1
            $image = new Image();
            $image
                ->setImage('pin.png')
            ;
            $event = new Event();
            $event
                ->setCategory('UX/UI Design')
                ->setColor(EventSuggestionColor::COLORS[array_rand(EventSuggestionColor::COLORS)])
                ->setTitle('Tiny Habits: The Small Changes That Change Everything.')
                ->setPlace('Songbird Cafe. Los Angeles, CA')
                ->setParagraph('Places Left')
                ->setParagraphBold('18')
                ->setImage($image)
            ;
            $button = new Button();
            $button
                ->setColor($event->getColor())
                ->setLink('#')
                ->setName('Book Now')
            ;
            $event->setButton($button);
            $mailContent->addEvent($event);
            // Event2
            $image = new Image();
            $image
                ->setImage('pin.png')
            ;
            $event = new Event();
            $event
                ->setCategory('UX/UI Design')
                ->setColor(EventSuggestionColor::COLORS[array_rand(EventSuggestionColor::COLORS)])
                ->setTitle('Tiny Habits: The Small Changes That Change Everything.')
                ->setPlace('Songbird Cafe. Los Angeles, CA')
                ->setParagraph('Places Left')
                ->setParagraphBold('18')
                ->setImage($image)
            ;
            $button = new Button();
            $button
                ->setColor($event->getColor())
                ->setLink('#')
                ->setName('Book Now')
            ;
            $event->setButton($button);
            $mailContent->addEvent($event);
            // Event3
            $image = new Image();
            $image
                ->setImage('pin.png')
            ;
            $event = new Event();
            $event
                ->setCategory('UX/UI Design')
                ->setColor(EventSuggestionColor::COLORS[array_rand(EventSuggestionColor::COLORS)])
                ->setTitle('Tiny Habits: The Small Changes That Change Everything.')
                ->setPlace('Songbird Cafe. Los Angeles, CA')
                ->setParagraph('Places Left')
                ->setParagraphBold('18')
                ->setImage($image)
            ;
            $button = new Button();
            $button
                ->setColor($event->getColor())
                ->setLink('#')
                ->setName('Book Now')
            ;
            $event->setButton($button);
            $mailContent->addEvent($event);
            // Event4
            $image = new Image();
            $image
                ->setImage('pin.png')
            ;
            $event = new Event();
            $event
                ->setCategory('UX/UI Design')
                ->setColor(EventSuggestionColor::COLORS[array_rand(EventSuggestionColor::COLORS)])
                ->setTitle('Tiny Habits: The Small Changes That Change Everything.')
                ->setPlace('Songbird Cafe. Los Angeles, CA')
                ->setParagraph('Places Left')
                ->setParagraphBold('18')
                ->setImage($image)
            ;
            $button = new Button();
            $button
                ->setColor($event->getColor())
                ->setLink('#')
                ->setName('Book Now')
            ;
            $event->setButton($button);
            $mailContent->addEvent($event);
        }
        
        return $mailContent;
    }

    public function getEventPlan(): EventPlan {
        $mailContent = new EventPlan();
        $mailContent
            ->setTitle('Hey, Welcome to')
            ->setTitleBold('National Design Guide - London')
            ->setSectionSpeakerTitle('About this Event :')
            ->setSectionScheduleTitle('The Schedule :')
            ->setScheduleParagraph('If you have any dietary requirements please email luciano@brd.com')
        ;

        $text = new Text();
        $text->setTitle('The following themes will be covered during this event:');
        $mailContent->addText($text);

        $text = new Text();
        $text->setParagraph('• the whole design ‘landscape’ i.e. how the national guide fits with the NPPF, PPG, Build Better Build Beautiful Commission, BFL12 etc.');
        $mailContent->addText($text);

        $text = new Text();
        $text->setParagraph('• the key objectives of the design guide and how it can be applied locally');
        $mailContent->addText($text);

        $button = new Button();
        $button
            ->setColor(EventPlanColor::COLOR)
            ->setLink('#')
            ->setName('Show More Detail')
        ;
        $mailContent->setFirstScheduleButton($button);
        $button = new Button();
        $button
            ->setColor(EventPlanColor::COLOR)
            ->setLink('#')
            ->setName('Print Event Details')
        ;
        $mailContent->setSecondScheduleButton($button);

        // Speaker1
        $image = new Image();
        $image
            ->setAbsolutePath('https://dummyimage.com/117x117/D6DAE3/000')
        ;
        $speaker = new Speaker();
        $speaker
            ->setImage($image)
            ->setLink('#')
            ->setTitle('Holley')
            ->setParagraph('Facebook')
        ;
        $mailContent->addSpeaker($speaker);
        // Speaker2
        $image = new Image();
        $image
            ->setAbsolutePath('https://dummyimage.com/117x117/D6DAE3/000')
        ;
        $speaker = new Speaker();
        $speaker
            ->setImage($image)
            ->setLink('#')
            ->setTitle('Andrew')
            ->setParagraph('Airbnb')
        ;
        $mailContent->addSpeaker($speaker);
        // Speaker3
        $image = new Image();
        $image
            ->setAbsolutePath('https://dummyimage.com/117x117/D6DAE3/000')
        ;
        $speaker = new Speaker();
        $speaker
            ->setImage($image)
            ->setLink('#')
            ->setTitle('Selina')
            ->setParagraph('Angolia')
        ;
        $mailContent->addSpeaker($speaker);

        // Schedule1
        $schedule = new Schedule();
        $schedule
            ->setColor(EventPlanColor::COLORS[array_rand(EventPlanColor::COLORS)])
            ->setHour('• 8.30 am:')
        ;
        $schedule->addParagraph('- Arrival, networking & breakfast');
        $mailContent->addSchedule($schedule);
        // Schedule2
        $schedule = new Schedule();
        $schedule
            ->setColor(EventPlanColor::COLORS[array_rand(EventPlanColor::COLORS)])
            ->setHour('• 9.30 am:')
        ;
        $schedule->addParagraph('- Workshop overview and goals - Positioning and Branding your product');
        $schedule->addParagraph('- How to delight your customers in hard-to-copy,');
        $schedule->addParagraph('- What to get big on, lead and expand');
        $schedule->addParagraph('- Growth, engagement and monetisation');
        $mailContent->addSchedule($schedule);
        // Schedule3
        $schedule = new Schedule();
        $schedule
            ->setColor(EventPlanColor::COLORS[array_rand(EventPlanColor::COLORS)])
            ->setHour('• 1 pm:')
        ;
        $schedule->addParagraph('- Lunch');
        $mailContent->addSchedule($schedule);
        // Schedule4
        $schedule = new Schedule();
        $schedule
            ->setColor(EventPlanColor::COLORS[array_rand(EventPlanColor::COLORS)])
            ->setHour('• 2 pm:')
        ;
        $schedule->addParagraph('- Recap on frameworks - Strategy, metrics and tactics');
        $schedule->addParagraph('- Product roadmap');
        $schedule->addParagraph('- Product strategy presentations');
        $mailContent->addSchedule($schedule);
        // Schedule5
        $schedule = new Schedule();
        $schedule
            ->setColor(EventPlanColor::COLORS[array_rand(EventPlanColor::COLORS)])
            ->setHour('• 5 pm:')
        ;
        $schedule->addParagraph('- Drinks and networking');
        $mailContent->addSchedule($schedule);
        
        return $mailContent;
    }
}
