<?php

namespace App\Controller\Admin;

use App\Admin\Field\FaField;
use App\Entity\ProjectPlatform;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectPlatformCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectPlatform::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield UrlField::new('link')->setColumns(12);
        yield FaField::new('fa', 'Logo')
            ->setColumns(6)
            ->setHelp('See https://fontawesome.com/search?o=r&m=free')
        ;
        yield AssociationField::new('project')->setColumns(6);
    }
}
