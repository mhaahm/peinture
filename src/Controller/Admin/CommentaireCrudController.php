<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('blogpost'),
            AssociationField::new('peinture'),
            TextField::new('auteur')->hideOnForm(),
            EmailField::new('email')->onlyOnForms(),
            DateTimeField::new('createdAt'),
            TextareaField::new('contenu'),
            BooleanField::new('isPublished')
        ];
    }

    /**
     * configureActions
     *
     * @param  mixed $actions
     * @return Actions
     */
    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->remove(Crud::PAGE_INDEX,Action::NEW)
        ->remove(Crud::PAGE_INDEX,Action::DELETE)
        ->remove(Crud::PAGE_DETAIL,Action::DELETE)
        ->add(Crud::PAGE_INDEX,Action::DETAIL);
    }
    
    /**
     * configureCrud
     *
     * @param  mixed $crud
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['createdAt' => 'DESC']);
    }
    
}
