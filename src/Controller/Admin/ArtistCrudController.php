<?php

namespace App\Controller\Admin;

use App\Entity\Artist;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class ArtistCrudController extends AbstractCrudController
{
    public function __construct(
        private ContainerBagInterface $params,
    ) {
    }
    
    public static function getEntityFqcn(): string
    {
        return Artist::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->disable(Action::NEW, Action::DELETE)
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addPanel('General');
        yield TextField::new('name')
            ->setColumns(6)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield DateField::new('date')->setColumns(6);
        yield EmailField::new('contact')
            ->setColumns(6)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield UrlField::new('videosLink')
            ->setColumns(6)
            ->setFormTypeOptions([
                'attr' => [
                    'maxlength' => 255
                ]
            ])
        ;
        yield AssociationField::new('artistAbouts')->hideOnForm();

        yield FormField::addPanel('Image');
        yield ImageField::new('man')
            ->setBasePath($this->params->get('images_base_directory') . 'artist/')
            ->setUploadDir($this->params->get('images_directory') . 'artist/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(6)
            ->setHelp('Recommended 850x736')
            ->setRequired($pageName !== Crud::PAGE_EDIT)
            ->setFormTypeOptions($pageName == Crud::PAGE_EDIT ? ['allow_delete' => false] : [])
        ;
        yield ImageField::new('header')
            ->setBasePath($this->params->get('images_base_directory') . 'artist/')
            ->setUploadDir($this->params->get('images_directory') . 'artist/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(6)
            ->setHelp('Recommended 1920x1080')
        ;
        yield ImageField::new('project')
            ->setBasePath($this->params->get('images_base_directory') . 'artist/')
            ->setUploadDir($this->params->get('images_directory') . 'artist/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(6)
            ->setHelp('Recommended 1920x1133')
        ;
        yield ImageField::new('gallery')
            ->setBasePath($this->params->get('images_base_directory') . 'artist/')
            ->setUploadDir($this->params->get('images_directory') . 'artist/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(6)
            ->setHelp('Recommended 1920x752')
        ;
        yield ImageField::new('video')
            ->setBasePath($this->params->get('images_base_directory') . 'artist/')
            ->setUploadDir($this->params->get('images_directory') . 'artist/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(6)
            ->setHelp('Recommended 1920x737')
        ;
        yield ImageField::new('blog')
            ->setBasePath($this->params->get('images_base_directory') . 'artist/')
            ->setUploadDir($this->params->get('images_directory') . 'artist/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(6)
            ->setHelp('Recommended 1920x1100')
        ;
        yield ImageField::new('subscribe')
            ->setBasePath($this->params->get('images_base_directory') . 'artist/')
            ->setUploadDir($this->params->get('images_directory') . 'artist/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(6)
            ->setHelp('Recommended 1920x752')
        ;
        yield ImageField::new('testimonial')
            ->setBasePath($this->params->get('images_base_directory') . 'artist/')
            ->setUploadDir($this->params->get('images_directory') . 'artist/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(6)
            ->setHelp('Recommended 1920x1030')
        ;
        yield ImageField::new('footer')
            ->setBasePath($this->params->get('images_base_directory') . 'artist/')
            ->setUploadDir($this->params->get('images_directory') . 'artist/')
            ->setUploadedFileNamePattern('[year]-[month]-[day]-[slug]-[randomhash].[extension]')
            ->setColumns(6)
            ->setHelp('Recommended 1920x913')
        ;
    }
}
