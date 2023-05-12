<?php

namespace App\Controller\Admin;

use App\Entity\Title;
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
                ],
            ])
            ->setColumns(12)
        ;
        yield AssociationField::new('titlePlatforms')->hideOnForm();
    }
}
