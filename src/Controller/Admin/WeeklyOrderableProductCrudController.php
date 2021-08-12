<?php

namespace App\Controller\Admin;

use App\Entity\WeeklyOrderableProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use App\Enum\HubsEnum;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class WeeklyOrderableProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return WeeklyOrderableProduct::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Weekly Orderable Product')
            ->setEntityLabelInPlural('Weekly Orderable Products')
            ->setPageTitle('index', '%entity_label_plural% listing')
            ->setSearchFields(['product.uniqueName', 'description', 'title'])
            
            // ...
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $units=[];
        $unittypes=HubsEnum::UNIT_TYPES;
                
        foreach ($unittypes as $x => $x_value) 
        {
            //$units[$x] = $x_value['abridgment'];
            $units[$x_value['abridgment']] =$x ;
            
        }
        //dd($units);
        return [
            AssociationField::new('product'),
            TextField::new('title'),
            TextareaField::new('description'),
            NumberField::new('totalStock'),
            ChoiceField::new('salesUnit')->setChoices($units),
            MoneyField::new('price')->setCurrency('USD')
        ];
    }
    
    
}
