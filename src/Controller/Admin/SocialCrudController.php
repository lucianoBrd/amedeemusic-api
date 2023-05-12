<?php

namespace App\Controller\Admin;

use App\Entity\Social;
use App\Admin\Field\FaField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SocialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Social::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('link')
            ->add('fa')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield UrlField::new('link')
            ->setColumns(6)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield FaField::new('fa', 'Logo')
            ->setColumns(6)
            ->setHelp('See https://fontawesome.com/search?o=r&m=free')
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
    }
}
