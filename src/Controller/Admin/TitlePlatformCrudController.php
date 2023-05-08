<?php

namespace App\Controller\Admin;

use App\Admin\Field\FaField;
use App\Entity\TitlePlatform;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TitlePlatformCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TitlePlatform::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('link')
            ->add('fa')
            ->add('title')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield UrlField::new('link')->setColumns(12);
        yield FaField::new('fa', 'Logo')
            ->setColumns(6)
            ->setHelp('See https://fontawesome.com/search?o=r&m=free')
        ;
        yield AssociationField::new('title')->setColumns(6);
    }
}
