<?php

namespace App\Controller\Admin;

use App\Entity\ArtistAbout;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArtistAboutCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArtistAbout::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextareaField::new('about')->setColumns(12);
        yield AssociationField::new('artist')->setColumns(6);
        yield AssociationField::new('local')->setColumns(6);
    }
}
