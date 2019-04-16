<?php

namespace App\DataFixtures;

use App\Entity\Orders\BulkDistribution;
use App\Entity\Orders\BulkDistributionLineItem;
use App\Entity\Orders\PartnerOrder;
use App\Entity\Orders\PartnerOrderLineItem;
use App\Entity\Product;
use App\Entity\Partner;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BulkDistributionFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            ProductFixtures::class,
            PartnerFixtures::class,
        ];
    }

    public function loadData(ObjectManager $manager)
    {
        $partners = $manager->getRepository(Partner::class)->findAll();
        $products = $manager->getRepository(Product::class)->findByPartnerOrderable();

        for ($i = 0; $i < 50; $i++) {
            /** @var Partner $partner */
            $partner = $this->faker->randomElement($partners);

            $order = new BulkDistribution($partner);

            $order->setStatus($this->faker->randomElement([
                BulkDistribution::STATUS_COMPLETED,
                BulkDistribution::STATUS_PENDING,
            ]));

            $order->setCreatedAt($this->faker->dateTimeBetween('-1 year', 'now'));

            $period = new \Moment\Moment($order->getCreatedAt()->format('U'));
            $period->setTimezone($order->getCreatedAt()->getTimezone()->getName());
            $period->startOf('month');
            $order->setDistributionPeriod($period);

            foreach ($products as $product) {
                $lineItem = new BulkDistributionLineItem($product, $this->faker->numberBetween(1, 100) * $product->getSmallestPackSize());
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
