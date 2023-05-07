<?php

namespace App\Controller\Admin;

use App\Entity\Politic;
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

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title');
        yield TextEditorField::new('document')->setTrixEditorConfig([
            'blockAttributes' => [
                'default' => ['tagName' => 'p'],
            ],
        ]);
        yield AssociationField::new('local');
    }
}
