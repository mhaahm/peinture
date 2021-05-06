<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

        
    /**
     * configureFields
     *
     * @param  mixed $pageName
     * @return iterable
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            TelephoneField::new('telephone'),
            TextareaField::new('aPropos'),
            TextareaField::new('aproposSummar'),
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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle('index','Paramètres')
        ->setPageTitle('edit','Editer les paramètres');
    }
    
}
