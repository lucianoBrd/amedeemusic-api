<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class BlogCrudController extends AbstractCrudController
{
    public function __construct(
        private ContainerBagInterface $params,
    ) {
    }
    
    public static function getEntityFqcn(): string
    {
        return Blog::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title')
            ->add('date')
            ->add('content')
            ->add('local')
            ->add('slug')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield ImageField::new('image')
            ->setBasePath($this->params->get('images_base_directory') . 'blog/')
            ->setUploadDir($this->params->get('images_directory') . 'blog/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(12)
            ->setHelp('Recommended 430x430')
            ->setRequired($pageName !== Crud::PAGE_EDIT)
            ->setFormTypeOptions($pageName == Crud::PAGE_EDIT ? ['allow_delete' => false] : [])
        ;
        yield TextField::new('title')
            ->setColumns(12)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield DateField::new('date')->setColumns(6);
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
        yield TextField::new('slug')->hideOnForm();
    }
}
