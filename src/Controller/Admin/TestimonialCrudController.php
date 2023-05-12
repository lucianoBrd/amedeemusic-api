<?php

namespace App\Controller\Admin;

use App\Entity\Testimonial;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TestimonialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Testimonial::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('designation')
            ->add('local')
            ->add('citation')
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
        yield AssociationField::new('local')->setColumns(12);
        yield TextareaField::new('citation')
            ->setColumns(12)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
    }
}
