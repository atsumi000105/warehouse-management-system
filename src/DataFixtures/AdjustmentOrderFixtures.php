<?php

namespace App\DataFixtures;


use App\Entity\Orders\AdjustmentOrder;
use App\Entity\Orders\AdjustmentOrderLineItem;
use App\Entity\Product;
use App\Entity\Partner;
use App\Entity\StorageLocation;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AdjustmentOrderFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            ProductFixtures::class,
            PartnerFixtures::class,
            WarehouseFixtures::class
        ];
    }

    public function loadData(ObjectManager $manager)
    {
        $storageLocations = $manager->getRepository(StorageLocation::class)->findAll();
        $partners = $manager->getRepository(Partner::class)->findAll();
        $products = $manager->getRepository(Product::class)->findByPartnerOrderable();

        for ($i = 0; $i < 10; $i++) {
            $storageLocation = $this->faker->randomElement($storageLocations);

            $order = new AdjustmentOrder(
                $storageLocation
            );

            $order->setStatus(AdjustmentOrder::STATUS_COMPLETED);
            $order->setCreatedAt($this->faker->dateTimeBetween('-1 year', 'now'));
            $order->setReason("Fixture Adjustment.");

            foreach ($products as $product) {
                $lineItem = new AdjustmentOrderLineItem($product, $this->faker->numberBetween(-1000, 1000));
                $order->addLineItem($lineItem);
            }

            $order->generateTransactions();

            if ($order->isComplete()) {
                $order->commitTransactions();
            }

            $manager->persist($order);
        }

        $manager->flush();
    }
}