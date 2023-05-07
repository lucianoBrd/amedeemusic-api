<?php

namespace App\Controller\Admin;

use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class VideoCrudController extends AbstractCrudController
{
    public function __construct(
        private ContainerBagInterface $params,
    ) {
    }
    
    public static function getEntityFqcn(): string
    {
        return Video::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield ImageField::new('image')
            ->setBasePath($this->params->get('images_base_directory') . 'video/')
            ->setUploadDir($this->params->get('images_directory') . 'video/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(12)
            ->setHelp('Recommended 648x541')
        ;
        yield UrlField::new('link')->setColumns(6);
        yield TextField::new('name')->setColumns(6);
        yield AssociationField::new('local')->setColumns(6);
        yield DateField::new('date')->setColumns(6);
        yield TextareaField::new('description')->setColumns(12);
    }
}
