<?php

namespace App\Controller\Admin;

use App\Entity\Bus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bus::class;
    }
}
