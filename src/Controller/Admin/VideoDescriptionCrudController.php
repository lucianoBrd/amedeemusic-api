<?php

namespace App\Controller\Admin;

use App\Entity\VideoDescription;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VideoDescriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VideoDescription::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextareaField::new('description')->setColumns(12);
        yield AssociationField::new('video')->setColumns(6);
        yield AssociationField::new('local')->setColumns(6);
    }
}