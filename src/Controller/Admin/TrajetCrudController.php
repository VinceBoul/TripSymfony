<?php

namespace App\Controller\Admin;

use App\Entity\Trajet;
use App\Form\BusDateType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class TrajetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Trajet::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TimeField::new('startHour'),
            TimeField::new('endHour'),
            TextField::new('startLoc'),
            TextField::new('endLoc'),
            IntegerField::new('days'),
            CollectionField::new('busDates')
                ->onlyOnForms()
            ->setEntryIsComplex()
                ->setFormTypeOption('entry_options', ['by_reference' => false])
             //   ->setEntryType(BusDateType::class)
            ->allowDelete()
            ->allowAdd()
        ];
    }

}
