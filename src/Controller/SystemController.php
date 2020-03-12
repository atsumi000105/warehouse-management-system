<?php

namespace App\Controller;

use App\Entity\EAV\Definition;
use App\Entity\Setting;
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
                'hasOptions' => $attribute->hasOptions(),
                'displayInterfaces' => $attribute->getDisplayInterfaces(),
            ];
        }, $types);

        return new JsonResponse(['data' => $attributes]);
    }

    /**
     * @param Request $request
     *
     * @Route(path="/settings", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function listSettings(Request $request)
    {
        $return_arr = $this->getSettings();

        return new JsonResponse(['data' => $return_arr]);
    }

    /**
     * @param Request $request
     *
     * @Route(path="/settings", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function updateSettings(Request $request)
    {
        $params = $this->getParams($request);
        $repo = $this->getRepository(Setting::class);

        foreach ($params as $key => $param) {
            $setting = $repo->find($key);
            if (!$setting) {
                $setting = new Setting();
                $setting->setConfig($key);
                $this->getEm()->persist($setting);
            }
            $setting->setValue($param);
        }

        $this->getEm()->flush();

        return new JsonResponse(['data' => $this->getSettings()]);
    }

    private function getSettings()
    {
        $settings = $this->getRepository(Setting::class)->findAll();

        $return_arr = [];
        foreach ($settings as $setting) {
            $return_arr[$setting->getConfig()] = $setting->getValue();
        }

        return $return_arr;
    }
}
