<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\ProductCategory;

class ProductCategoryFixtures extends BaseFixture
{
    public function loadData(ObjectManager $manager)
    {
        $categories = [
            "diapers" => [
                "name" => "Diapers",
                "isPartnerOrderable" => true,
            ],
            "training_pants" => [
                "name" => "Training Pants",
                "isPartnerOrderable" => true,
            ],
            "merchandise" => [
                "name" => "Merchandise",
                "isPartnerOrderable" => false,
            ]
        ];

        foreach ($categories as $key => $catData) {
            $category = new ProductCategory($catData['name']);
            $category->setIsPartnerOrderable($catData['isPartnerOrderable']);

            $manager->persist($category);
            $this->addReference('product_category_' . $key, $category);
        }

        $manager->flush();
    }
}