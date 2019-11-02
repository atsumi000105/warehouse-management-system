<?php

namespace App\Controller;

use App\Entity\EAV\Attribute;
use App\Entity\EAV\Definition;
use App\Transformers\AttributeDefinitionTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class BaseAttributeController
 * @package App\Controller
 */
abstract class BaseAttributeDefinitionController extends BaseController
{
    /**
     * Get a list of Attribute Definitions
     *
     * @Route(path="", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $definitions = $this->getRepository()->findAllSorted();

        return $this->serialize($request, $definitions);
    }

    /**
     * Get a single Attribute Definition
     *
     * @Route(path="/{id<\d+>}", methods={"GET"})
     *
     * @param $id
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        $product = $this->getDefinition($id);

        return $this->serialize($request, $product);
    }

    /**
     * Save a new Attribute
     *
     * @Route(path="", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request, ValidatorInterface $validator)
    {
        $params = $this->getParams($request);

        $definition = $this->getNewDefinition();

        $definition->applyChangesFromArray($params);

        $this->validate($definition, $validator);

        $this->getEm()->persist($definition);
        $this->getEm()->flush();

        return $this->serialize($request, $definition);
    }

    /**
     * Saves the order index of the definitions
     *
     * @Route(path="/order", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function storeOrder(Request $request)
    {
        $params = $this->getParams($request);
        $ids = $params['ids'];

        /** @var Definition[] $definitions */
        $definitions = $this->getRepository()->findAllSorted();

        foreach ($definitions as $definition) {
            $definition->setOrderIndex(array_search($definition->getId(), $ids));
        }

        $this->getEm()->flush();

        return $this->serialize($request, $definitions);
    }

    /**
     * @param $id
     * @return null|Attribute
     * @throws NotFoundApiException
     */
    protected function getDefinition($id)
    {
        /** @var Attribute $definition */
        $definition = $this->getRepository()->find($id);

        if (!$definition) {
            throw new NotFoundHttpException(sprintf('Unknown Definition ID: %d', $id));
        }

        return $definition;
    }

    protected function getDefaultTransformer()
    {
        return new AttributeDefinitionTransformer();
    }

    /**
     * @return Definition
     */
    abstract protected function getNewDefinition();
}
