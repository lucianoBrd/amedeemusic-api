<?php

namespace App\Controller\Admin;

use App\Entity\Politic;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PoliticCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Politic::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::DELETE)
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title')
            ->add('local')
            ->add('document')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title')
            ->setColumns(6)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield AssociationField::new('local')->setColumns(6);
        yield TextEditorField::new('document')
            ->setTrixEditorConfig([
                'blockAttributes' => [
                    'default' => ['tagName' => 'p'],
                ],
            ])
            ->setColumns(12)
        ;
    }
}
