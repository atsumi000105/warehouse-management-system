<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Moment\Moment;

class SettingFixtures extends BaseFixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [
            ProductCategoryFixtures::class
        ];
    }

    public function loadData(ObjectManager $em)
    {
        $pullupCategory = $this->getReference('product_category_training_pants');

        $this->config->create('zipCountyStates', ['MO', 'KS']);
        $this->config->create('pullupCategory', $pullupCategory->getId());

        $now = new Moment();

        $this->config->create('partnerReviewStart', $now->cloning()->addMonths(1));
        $this->config->create('partnerReviewEnd', $now->cloning()->addMonths(2));
        $this->config->create('partnerReviewLastStartRun', $now->cloning()->subtractMonths(2));
        $this->config->create('partnerReviewLastEndRun', $now->cloning()->subtractMonths(1));

    }
}
