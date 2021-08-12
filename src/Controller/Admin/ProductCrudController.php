<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use App\Enum\HubsEnum;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Product')
            ->setEntityLabelInPlural('Products')
            ->setPageTitle('index', '%entity_label_plural% listing')
            ->setSearchFields(['uniqueName', 'descr', 'title', 'hubTitle'])
            
            // ...
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $hubTitles = HubsEnum::HUB_TITLES;
        $titles=[];
        foreach ($hubTitles as $hubTitle){
           // $titles[$hubTitle]=str_replace('_', ' ', $hubTitle);
            $titles[str_replace('_', ' ', $hubTitle)]= $hubTitle;
        }
        //dd($titles);
       /* $hubTitles=
        [
           "VEGETABLES_AND_FRUITS_HUB"=> "VEGETABLES_AND_FRUITS_HUB",
           "DAIRY_HUB"=> "DAIRY_HUB",
           "GARDENING_SERVICES_HUB"=> "GARDENING_SERVICES_HUB",
           'GARDENING_TOOLS_HUB'=> "GARDENING_TOOLS_HUB",
           "SEED_HUB"=>"SEED_HUB",
           "SEEDLING_AND_SAPLING_HUB"=> "SEEDLING_AND_SAPLING_HUB",
           "COMPOST_HUB"=> "COMPOST_HUB",
           "WORM_HUB"=> "WORM_HUB",
           "FERTILIZER_HUB"=> "FERTILIZER_HUB",
           "HERBS_AND_FLOWERS_HUB"=>"HERBS_AND_FLOWERS_HUB"
        ];*/
        return [
            TextField::new('title'),
            TextareaField::new('descr'),
            TextField::new('uniqueName'),
            ChoiceField::new('hubTitle')->setChoices($titles)
        ];
    }
    
}
