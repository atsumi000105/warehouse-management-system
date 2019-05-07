<?php

namespace App\Controller;

use App\Entity\Group;
use App\Transformers\GroupTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GroupController
 * @package App\Controller
 *
 * @Route(path="/api/groups")
 */
class GroupController extends BaseController
{
    protected $defaultEntityName = Group::class;

    /**
     * Get a list of Groups
     *
     * @Route(path="", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $groups = $this->getRepository()->findAll();

        return $this->serialize($request, $groups);
    }

    /**
     * Get a single Group
     *
     * @Route(path="/{id<\d+>}", methods={"GET"})
     *
     * @param $id
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        $group = $this->getGroup($id);

        return $this->serialize($request, $group);
    }

    /**
     * Save a new group
     *
     * @Route(path="", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // TODO: Get validation working (#2)
//        $this->validate($request, [
//            'name' => 'required',
//            'permissions' => 'array',
//        ]);

        $group = new Group();

        $params = $this->getParams($request);
        $group->applyChangesFromArray($params);

        $this->getEm()->persist($group);
        $this->getEm()->flush();

        return $this->serialize($request, $group);
    }

    /**
     * Whole or partial update of a group
     *
     * @Route(path="/{id<\d+>}", methods={"PATCH"})
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $params = $this->getParams($request);
        /** @var Group $group */
        $group = $this->getGroup($id);

        $group->applyChangesFromArray($params);

        $this->getEm()->persist($group);
        $this->getEm()->flush();

        return $this->serialize($request, $group);
    }

    /**
     * Delete a group
     *
     * @Route(path="/{id<\d+>}", methods={"DELETE"})
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $group = $this->getGroup($id);
        $this->getEm()->remove($group);

        $this->getEm()->flush();

        return $this->success(sprintf('Group "%s" deleted.', $group->getName()));
    }

    /**
     * List all permissions in the system
     *
     * @Route(path="/list-roles", methods={"GET"})
     *
     * @param $id
     * @return JsonResponse
     */
    public function listRoles()
    {

        $roles = Group::AVAILABLE_ROLES;

        return new JsonResponse($roles);
    }

    /**
     * @param $id
     * @return null|Group
     * @throws NotFoundHttpException
     */
    protected function getGroup($id)
    {
        /** @var Group $group */
        $group = $this->getRepository()->find($id);

        if (!$group) {
            throw new NotFoundHttpException(sprintf('Unknown Group ID: %d', $id));
        }

        return $group;
    }

    protected function getDefaultTransformer()
    {
        return new GroupTransformer;
    }
}
