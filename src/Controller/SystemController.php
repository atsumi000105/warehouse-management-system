<?php

namespace App\Controller;

use App\Entity\EAV\Definition;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SystemController
 *
 * @Route(path="/api/system")
 */
class SystemController extends BaseController
{
    /**
     * Get a list of Products
     *
     * @Route(path="/attribute-types", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function attributeTypes(Request $request)
    {
        $types = Definition::getAttributeTypes();
        $attributes = array_map(function ($type) {
            $attribute = Definition::createNewAttributeFromType($type);
            return [
                'id' => $type,
                'label' => $attribute->getTypeLabel(),
            ];
        }, $types);

        return new JsonResponse(['data' => $attributes]);
    }
}
