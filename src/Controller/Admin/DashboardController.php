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
use App\Entity\Politic;
use App\Entity\Project;
use App\Entity\Platform;
use App\Entity\Testimonial;
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
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(SocialCrudController::class)->generateUrl();

        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
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
        //yield MenuItem::linkToLogout('Logout', 'fa fa-exit');

        yield MenuItem::section('Project');
        yield MenuItem::linkToCrud('Project', 'fas fa-headphones', Project::class);
        yield MenuItem::linkToCrud('Title', 'fas fa-music', Title::class);
        yield MenuItem::linkToCrud('Platform', 'fa fa-play-circle-o', Platform::class);
        yield MenuItem::linkToCrud('Type', 'fa fa-file-o', Type::class);

        yield MenuItem::section('Site');
        yield MenuItem::linkToCrud('Artist', 'fa fa-user-circle-o', Artist::class);
        yield MenuItem::linkToCrud('Event', 'fas fa-calendar', Event::class);
        yield MenuItem::linkToCrud('Gallery', 'fa fa-picture-o', Gallery::class);
        yield MenuItem::linkToCrud('Social', 'fas fa-link', Social::class);
        yield MenuItem::linkToCrud('Testimonial', 'fa fa-comments-o', Testimonial::class);
        yield MenuItem::linkToCrud('Video', 'fas fa-film', Video::class);

        yield MenuItem::section('General');
        yield MenuItem::linkToCrud('Local', 'fas fa-language', Local::class);
        yield MenuItem::linkToCrud('Politic', 'fas fa-laptop', Politic::class);
        yield MenuItem::linkToCrud('User', 'fas fa-users', User::class);
    }
}
