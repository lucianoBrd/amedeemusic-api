<?php

namespace App\Controller\Admin;

use App\Entity\VideoDescription;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VideoDescriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VideoDescription::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('description')
            ->add('video')
            ->add('local')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextareaField::new('description')
            ->setColumns(12)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield AssociationField::new('video')->setColumns(6);
        yield AssociationField::new('local')->setColumns(6);
    }
}
