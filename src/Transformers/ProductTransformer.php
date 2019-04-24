<?php

namespace App\Transformers;

use App\Entity\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'productCategory',
    ];

    public function transform(Product $product)
    {
        return [
            'id' => (int) $product->getId(),
            'name' => $product->getName(),
            'sku' => $product->getSku(),
            'color' => $product->getColor(),
            'agencyPacksPerBag' => $product->getAgencyPacksPerBag(),
            'agencyPackSize' => $product->getAgencyPackSize(),
            'hospitalPacksPerBag' => $product->getHospitalPacksPerBag(),
            'hospitalPackSize' => $product->getHospitalPackSize(),
            'defaultCost' => $product->getDefaultCost(),
            'retailPrice' => $product->getRetailPrice(),
            'status' => $product->getStatus(),
            'createdAt' => $product->getCreatedAt()->format('c'),
            'updatedAt' => $product->getUpdatedAt()->format('c'),
        ];
    }

    public function includeProductCategory(Product $product)
    {
        $category = $product->getProductCategory();

        if (!$category) {
            return;
        }

        return $this->item($category, new ProductCategoryTransformer());
    }
}
