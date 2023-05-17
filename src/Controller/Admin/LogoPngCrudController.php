<?php

namespace App\Controller\Admin;

use App\Entity\LogoPng;
use App\Validator\EasyadminImage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class LogoPngCrudController extends AbstractCrudController
{
    public function __construct(
        private ContainerBagInterface $params,
    ) {
    }
    
    public static function getEntityFqcn(): string
    {
        return LogoPng::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW, Action::DELETE)
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield ImageField::new('image')
            ->setBasePath($this->params->get('assets_base_directory') . 'logo/')
            ->setUploadDir($this->params->get('assets_directory') . 'logo/')
            ->setUploadedFileNamePattern('logo.png')
            ->setColumns(12)
            ->setHelp('Only .png')
            ->setRequired($pageName !== Crud::PAGE_EDIT)
            ->setFormTypeOptions($pageName == Crud::PAGE_EDIT ? ['allow_delete' => false] : [])
            ->setFormTypeOption('constraints', [
                new EasyadminImage(maxSize: '2M', mimeTypes: ['image/png'])
            ])
        ;
    }
}
