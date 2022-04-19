<?php

namespace App\Controller;

use App\Entity\EAV\AttributeDefinitionPermission;
use App\Entity\EAV\AttributeValue;
use App\Entity\EAV\AttributeDefinition;
use App\Repository\AttributeDefinitionPermissionRepository;
use App\Service\AttributePermissionProcessor;
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
     */
    public function show(Request $request, int $id): JsonResponse
    {
        $definition = $this->getDefinition($id);

        return $this->serialize($request, $definition);
    }

    /**
     * Save a new Attribute
     *
     * @Route(path="", methods={"POST"})
     */
    public function store(Request $request, ValidatorInterface $validator): JsonResponse
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
     * @Route(path="/{id<\d+>}", methods={"PATCH"})
     * @throws \Exception
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $params = $this->getParams($request);

        $definition = $this->getDefinition($id);
        $definition->applyChangesFromArray($params);

        if (isset($params['canEdit']) && !empty($params['canEdit'])) {
            foreach ($params['canEdit'] as $groupId) {
                $permission = $this->getEm()
                    ->getRepository(AttributeDefinitionPermission::class)
                    ->findBy([
                        'attribute_definition_id' => $id,
                        'group_id' => $groupId
                    ]);

                if ($permission === null) {
                    $permission = new AttributeDefinitionPermission();
                }

                $permission->setAttributeDefinitionId($id);
                $permission->setCanEdit(true);
                $permission->setGroupId($groupId);

                $this->getEm()->persist($permission);
            }
        }

        if (isset($params['canView']) && !empty($params['canView'])) {
            foreach ($params['canView'] as $groupId) {
                $permission = $this->getEm()
                    ->getRepository(AttributeDefinitionPermission::class)
                    ->findBy([
                        'attribute_definition_id' => $id,
                        'group_id' => $groupId
                    ]);

                if ($permission === null) {
                    $permission = new AttributeDefinitionPermission();
                }

                $permission->setAttributeDefinitionId($id);
                $permission->setCanView(true);
                $permission->setGroupId($groupId);

                $this->getEm()->persist($permission);
            }
        }

        $this->getEm()->flush();

        return $this->serialize($request, $definition);
    }

    /**
     * Saves the order index of the definitions
     *
     * @Route(path="/order", methods={"POST"})
     */
    public function storeOrder(Request $request): JsonResponse
    {
        $params = $this->getParams($request);
        $ids = $params['ids'];

        /** @var AttributeDefinition[] $definitions */
        $definitions = $this->getRepository()->findAllSorted();

        foreach ($definitions as $definition) {
            $definition->setOrderIndex(array_search($definition->getId(), $ids));
        }

        $this->getEm()->flush();

        return $this->serialize($request, $definitions);
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function getDefinition(int $id): AttributeDefinition
    {
        /** @var AttributeDefinition $definition */
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
     * @return AttributeDefinition
     */
    abstract protected function getNewDefinition();
}
