<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $brands = [
            'AUTRE',
            'DELONGHI',
            'ROWENTA',
            'KRUPS',
            'HOTPOINT ARISTON',
            'RIVIERA ET BAR',
            'SMEG',
            'MELITTA',
            'WHIRLPOOL',
            'FAR',
            'CLATRONIC',
            'DOMO',
            'BIFINETT',
            'CARREFOUR HOME',
            'BLACK & DECKER',
            'BOMANN',
            'BLUEBELL',
        ];

        //Create an empty array
        $brandList=[];

        //loop to get each brand
        foreach($brands as $brandName){

        $brand = new Brand();
        $brand->setName($brandName);
        $manager->persist($brand);
        $brandList[] = $brand;
    }

    $categories=[
        'ASPIRATEUR',
        'AUTOCUISEUR',
        'BLENDER',
        'CAFETIÈRE',
        'REPASSAGE',
        'EXPRESSO',
        'HACHOIR',
        'MACHINE A PAIN',
        'NETTOYEUR VAPEUR',
        'ROBOT',
        'APPAREIL-À-FONDUE/RACLETTE',
        'BATTEUR',
        'BATTERIE DE CUISINE',
        'GAUFRIER',
        'MICRO-ONDES',
        'FOUR',
        'MINI-FOUR',
        'YAOURTIÈRE',
        'ACCESSOIRES TÉLÉPHONE',
        'ACCESSOIRES ORDINATEUR',
        'ACCESSOIRES MULTIMEDIA',
    ];

    //Create an empty array
    $categoryList=[];

    //loop to get each brand
    foreach($categories as $categoryName){

    $category = new Category();
    $category->setName($categoryName);
    $manager->persist($category);
    $categoryList[] = $category;
    }

    $products=[
        'Batterie',
        'Filtre',
        'Courroie',
        'Tuyau',
        'Interrupteur',
        'Résistance',
        'Vitre',
        'Joint',
        'Ampoule',
        'Poignée',
        'Moteur',
        'Couvercle',
        'Verseur',
        'Doseur',
        'Condensateur',
        'Chargeur',
        'Porte',
        'Minuteur',
        'Charnière',
        'Câble',
        'Bloc moteur',
        'Batteur',
        'Joint',
        'Cuve',
        'Télécommande',
    ];

    //Create an empty array
    $productList=[];

    //loop to get each brand
    foreach($products as $productName){

    $product = new Product();
    $product->setName($productName);
    $product->setCreatedAt(new \DateTime);
    $manager->persist($product);
    $productList[] = $product;
    }

    $users=[
        'Durand Micheline',
        'Michu Jean-jean',
        'Lavilliers Bernard',
        'Saint Bernard',
        'Pradel Jacques',
        'Curie Marie',
        'Calmetoi Bernadette',
        'Montmirail Godefroy',
        'Lagrande Mathy',
        'Diouf Mouss',
        'Cheminade Jacques',
        'Lang Jack',
        'Engreve Renée',
        'Sieffe Hassan',
        'Deloin Alain',
        'Dutroux Marc',
        'Voiepasbien Gilbert',
        'De-Monac Steph',
        'Dontcry Lucy',
        'Dills Patrick',
        'Lepetit Nicolas',
        'LaBlonde Brigitte',
        'Lahaie Brigitte',
        'Jeannet Cierge',
        'Shulz Papa',
    ];

    //Create an empty array
    $userList=[];

    //loop to get each brand
    foreach($users as $userName){

    $user = new User();
    $user->setUsername($userName);
    $user->setCreatedAt(new \DateTime);
    $manager->persist($user);
    $userList[] = $user;
    }

    //Don't touch!
    $manager->flush();
}
}