<?php

namespace App\Controller\Admin;

use App\Entity\Testimonial;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class TestimonialCrudController extends AbstractCrudController
{
    public function __construct(
        private ContainerBagInterface $params,
    ) {
    }
    
    public static function getEntityFqcn(): string
    {
        return Testimonial::class;
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
            ->add('designation')
            ->add('local')
            ->add('citation')
            ->add('link')
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
        yield TextField::new('designation')
            ->setColumns(6)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield UrlField::new('link')
            ->setColumns(12)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield AssociationField::new('local')->setColumns(12);
        yield TextareaField::new('citation')
            ->setColumns(12)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield ImageField::new('image')
            ->setBasePath($this->params->get('images_base_directory') . 'testimonial/')
            ->setUploadDir($this->params->get('images_directory') . 'testimonial/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(12)
            ->setRequired(false)
        ;
    }
}
