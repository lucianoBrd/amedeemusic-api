<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class GalleryCrudController extends AbstractCrudController
{
    public function __construct(
        private ContainerBagInterface $params,
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return Gallery::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield ImageField::new('image')
            ->setBasePath($this->params->get('images_base_directory') . 'gallery/')
            ->setUploadDir($this->params->get('images_directory') . 'gallery/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(12)
            ->setHelp('Recommended 384x309')
            ->setRequired($pageName !== Crud::PAGE_EDIT)
            ->setFormTypeOptions($pageName == Crud::PAGE_EDIT ? ['allow_delete' => false] : [])
        ;

    }
    
}
