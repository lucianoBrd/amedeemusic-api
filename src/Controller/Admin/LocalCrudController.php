<?php

namespace App\Controller\Admin;

use App\Entity\Local;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LocalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Local::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::DELETE)
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name')->setColumns(6);
        yield TextField::new('local')->setColumns(6);
    }
}
