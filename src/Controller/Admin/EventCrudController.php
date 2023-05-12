<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('place')
            ->add('local')
            ->add('date')
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
        yield TextField::new('place')
            ->setColumns(6)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield AssociationField::new('local')->setColumns(6);
        yield DateTimeField::new('date')->setColumns(6);
        yield UrlField::new('link')
            ->setColumns(12)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
    }
}
