<?php

namespace App\Controller\Admin;

use App\Entity\Title;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TitleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Title::class;
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
            ->add('name')
            ->add('project')
            ->add('lyrics')
            ->add('titlePlatforms')
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name')
            ->setColumns(6)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield AssociationField::new('project')->setColumns(6);
        yield TextEditorField::new('lyrics')
            ->setTrixEditorConfig([
                'blockAttributes' => [
                    'default' => ['tagName' => 'p'],
                    'heading1' => ['tagName' => 'h5'],
                ],
            ])
            ->setColumns(12)
            ->setTemplatePath('admin/field/html.html.twig')
        ;
        yield AssociationField::new('titlePlatforms')->hideOnForm();
    }
}
