<?php

namespace App\Controller\Admin;

use App\Entity\BlogContent;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BlogContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlogContent::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title')
            ->add('content')
            ->add('local')
            ->add('blog')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title')
            ->setColumns(12)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield AssociationField::new('blog')->setColumns(6);
        yield AssociationField::new('local')->setColumns(6);
        yield TextEditorField::new('content')
            ->setTrixEditorConfig([
                'blockAttributes' => [
                    'default' => ['tagName' => 'p'],
                    'heading1' => ['tagName' => 'h5'],
                ],
            ])
            ->setColumns(12)
        ;
    }
}
