<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\Local;
use App\Entity\Title;
use App\Entity\Video;
use App\Entity\Artist;
use App\Entity\Social;
use App\Entity\Gallery;
use App\Entity\Message;
use App\Entity\Politic;
use App\Entity\Project;
use App\Entity\ArtistAbout;
use App\Entity\Testimonial;
use App\Entity\TitlePlatform;
use App\Entity\ProjectPlatform;
use App\Entity\VideoDescription;
use App\Controller\Admin\SocialCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/my-dashboard.html.twig', [
            
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Amedeemusic Api');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToUrl('Back to the website', 'fas fa-window-maximize', 'https://amedeemusic.fr');

        yield MenuItem::section('Project');
        yield MenuItem::subMenu('Project', 'fa-solid fa-radio')->setSubItems([
            MenuItem::linkToCrud('Project', 'fas fa-record-vinyl', Project::class),
            MenuItem::linkToCrud('ProjectPlatform', 'fa-solid fa-icons', ProjectPlatform::class),
        ]);
        yield MenuItem::subMenu('Title', 'fa-solid fa-radio')->setSubItems([
            MenuItem::linkToCrud('Title', 'fa-solid fa-music', Title::class),
            MenuItem::linkToCrud('TitlePlatform', 'fa-solid fa-icons', TitlePlatform::class),
        ]);
        yield MenuItem::linkToCrud('Type', 'fa-solid fa-compact-disc', Type::class);

        yield MenuItem::section('Site');
        yield MenuItem::subMenu('Artist', 'fa-solid fa-microphone-lines')->setSubItems([
            MenuItem::linkToCrud('Artist', 'fa-solid fa-file-audio', Artist::class),
            MenuItem::linkToCrud('About', 'fa-solid fa-file-signature', ArtistAbout::class),
        ]);
        yield MenuItem::linkToCrud('Event', 'fa-regular fa-calendar-days', Event::class);
        yield MenuItem::linkToCrud('Gallery', 'fa-solid fa-images', Gallery::class);
        yield MenuItem::linkToCrud('Social', 'fa-solid fa-icons', Social::class);
        yield MenuItem::linkToCrud('Testimonial', 'fa-solid fa-comments', Testimonial::class);
        yield MenuItem::subMenu('Video', 'fa-solid fa-camera-retro')->setSubItems([
            MenuItem::linkToCrud('Video', 'fa-solid fa-clapperboard', Video::class),
            MenuItem::linkToCrud('Description', 'fa-solid fa-file-signature', VideoDescription::class),
        ]);

        yield MenuItem::section('General');
        yield MenuItem::linkToCrud('Local', 'fa-solid fa-language', Local::class);
        yield MenuItem::linkToCrud('Politic', 'fa-solid fa-cookie-bite', Politic::class);
        yield MenuItem::subMenu('User', 'fa-solid fa-users')->setSubItems([
            MenuItem::linkToCrud('User', 'fa-solid fa-user', User::class),
            MenuItem::linkToCrud('Message', 'fa-solid fa-message', Message::class),
        ]);
    }
}
