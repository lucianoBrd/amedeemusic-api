<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\Local;
use App\Entity\Title;
use App\Entity\Video;
use App\Entity\Artist;
use App\Entity\Social;
use App\Entity\Gallery;
use App\Entity\LogoPng;
use App\Entity\Message;
use App\Entity\Politic;
use App\Entity\Project;
use App\Entity\ArtistAbout;
use App\Entity\LogoFavicon;
use App\Entity\Testimonial;
use App\Entity\LogoPngEmail;
use App\Entity\TitlePlatform;
use App\Entity\ProjectPlatform;
use App\Entity\VideoDescription;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private ContainerBagInterface $params,
    ) {
    }
    
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/my-dashboard.html.twig', [
            
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img style="max-width: 50px;" src="' . $this->params->get('assets_base_directory') . 'logo/logo.png' . '"> <span class="text-small">' . $this->params->get('app.name') . '</span>')
            ->setFaviconPath($this->params->get('assets_base_directory') . 'logo/favicon.ico')
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToUrl('Back to the website', 'fas fa-window-maximize', $this->params->get('app.client.url'));

        yield MenuItem::section('Project');
        yield MenuItem::subMenu('Project', 'fa-solid fa-radio')->setSubItems([
            MenuItem::linkToCrud('Project', 'fa-solid fa-record-vinyl', Project::class),
            MenuItem::linkToCrud('ProjectPlatform', 'fa-solid fa-icons', ProjectPlatform::class),
        ]);
        yield MenuItem::subMenu('Title', 'fa-solid fa-radio')->setSubItems([
            MenuItem::linkToCrud('Title', 'fa-solid fa-music', Title::class),
            MenuItem::linkToCrud('TitlePlatform', 'fa-solid fa-icons', TitlePlatform::class),
        ]);
        yield MenuItem::linkToCrud('Type', 'fa-solid fa-compact-disc', Type::class);

        yield MenuItem::section('Logo');
        yield MenuItem::subMenu('Logo', 'fa-regular fa-eye')->setSubItems([
            MenuItem::linkToCrud('LogoFavicon', 'fa-solid fa-file-image', LogoFavicon::class),
            MenuItem::linkToCrud('LogoPng', 'fa-solid fa-file-image', LogoPng::class),
            MenuItem::linkToCrud('LogoPngEmail', 'fa-solid fa-file-image', LogoPngEmail::class),
        ]);

        yield MenuItem::section('Site');
        yield MenuItem::subMenu('Artist', 'fa-solid fa-microphone-lines')->setSubItems([
            MenuItem::linkToCrud('Artist', 'fa-solid fa-file-audio', Artist::class),
            MenuItem::linkToCrud('About', 'fa-solid fa-file-signature', ArtistAbout::class),
        ]);
        yield MenuItem::linkToCrud('Event', 'fa-regular fa-calendar-days', Event::class);
        yield MenuItem::linkToCrud('Event', 'fa-regular fa-calendar-days', Event::class);
        yield MenuItem::linkToCrud('Gallery', 'fa-solid fa-images', Gallery::class);
        yield MenuItem::linkToCrud('Blog', 'fa-solid fa-table-list', Blog::class);
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
