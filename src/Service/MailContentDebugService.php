<?php

namespace App\Service;
use App\Entity\MailContent\JobBoard;
use App\Entity\MailContent\FreeGoods;
use App\Entity\MailContent\MonthStats;
use App\Entity\MailContent\Shared\Text;
use App\Entity\MailContent\BlogArticles;
use App\Entity\MailContent\JobBoard\Job;
use App\Entity\MailContent\PricingTable;
use App\Entity\MailContent\Shared\Image;
use App\Entity\MailContent\JobBoard\Info;
use App\Entity\MailContent\Shared\Button;
use App\Entity\MailContent\UserWelcoming;
use App\Entity\MailContent\BookSuggestion;
use App\Entity\MailContent\FreeGoods\Good;
use App\Entity\MailContent\EventSuggestion;
use App\Entity\MailContent\MonthStats\Stat;
use App\Entity\MailContent\PlaylistSuggestion;
use App\Entity\MailContent\BookSuggestion\Book;
use App\Entity\MailContent\BlogArticles\Article;
use App\Entity\MailContent\EventSuggestion\Event;
use App\Entity\MailContent\BlogArticles\Color as BlogArticlesColor;
use App\Entity\MailContent\PricingTable\Color as PricingTableColor;
use App\Entity\MailContent\EventSuggestion\Color as EventSuggestionColor;

class MailContentDebugService
{
    public function __construct(
    )
    {
    }

    public function getBlogArticles(): BlogArticles {
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
            ->setImage('https://dummyimage.com/120x112/D6DAE3/000')
            ->setAbsolutePath(true)
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
            ->setImage('https://dummyimage.com/150x230/D6DAE3/000')
            ->setAbsolutePath(true)
        ;
        $mailContent->setFeaturedImage($image);

        $image = new Image();
        $image
            ->setImage('https://dummyimage.com/117x178/D6DAE3/000')
            ->setAbsolutePath(true)
        ;
        // Book1
        $book = new Book();
        $book
            ->setTitle('Dear Edward: A Novel')
            ->setImage($image)
            ->setButton($button)
        ;
        $mailContent->addBook($book);
        // Book2
        $book = new Book();
        $book
            ->setTitle('American Dirt (Oprah\'s Book Club): A Novel')
            ->setImage($image)
            ->setButton($button)
        ;
        $mailContent->addBook($book);
        // Book3
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
            ->setImage('https://dummyimage.com/240x240/D6DAE3/000')
            ->setAbsolutePath(true)
        ;
        $mailContent->setPlaylistImage($image);
        
        return $mailContent;
    }

    public function getFreeGoods(): FreeGoods {
        $mailContent = new FreeGoods();
        $mailContent
            ->setTitle('Hey, This is your Weekly')
            ->setTitleBold('Free Goods')
        ;
        
        $image = new Image();
        $image
            ->setImage('https://dummyimage.com/188x134/D6DAE3/000')
            ->setAbsolutePath(true)
        ;
        // Good1
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
        $good = new Good();
        $good
            ->setColor($mailContent->getColor())
            ->setLink('#')
            ->setTitle('Fruit and vegetables')
            ->setAuthor('LucianoBrd')
        ;
        $good->setImage($image);
        $mailContent->addTwoColGood($good);

        $image = new Image();
        $image
            ->setImage('https://dummyimage.com/117x134/D6DAE3/000')
            ->setAbsolutePath(true)
        ;
        // Good1
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
        $mailContent = new EventSuggestion();
        $mailContent
            ->setTitle('Hey, This is your Weekly')
            ->setTitleBold('Event Suggestion')
        ;
        
        $text = new Text();
        $text->setParagraph('Hi Matthew! We have top posts for you from UI/UX Design, Farming for Tomorrow, Sustainable Urban Planning& more…');
        $mailContent->addText($text);

        $image = new Image();
        $image
            ->setImage('pin.png')
        ;

        // Event1
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
        
        return $mailContent;
    }
}
