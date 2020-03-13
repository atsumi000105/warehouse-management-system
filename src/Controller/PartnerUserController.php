<?php

namespace App\Controller;

use App\Entity\Group;
use App\Entity\Partner;
use App\Entity\User;
use App\Entity\PartnerUser;
use App\Entity\ValueObjects\Name;
use App\Transformers\UserTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 *
 * @Route(path="/api/users")
 */
class PartnerUserController extends BaseController
{
    protected $defaultEntityName = User::class;

    /**
     * Get a list of Users
     *
     * @Route(path="", methods={"GET"})
     */
    public function index(Request $request) : JsonResponse
    {
        $users = $this->getRepository()->findAll();

//        $this->checkViewPermissions($users);

        return $this->serialize($request, $users);
    }

    /**
     * Get a single User
     *
     * @Route(path="/{id<\d+>}", methods={"GET"})
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $user = $this->getUserById($id);

//        $this->checkViewPermissions($user);

        return $this->serialize($request, $user);
    }

    /**
     * Save a new user
     *
     * @Route(path="", methods={"POST"})
     */
    public function store(Request $request) : JsonResponse
    {
        $params = $this->getParams($request);
        $user = new User($params["email"]);

        if ($params['groups']) {
            foreach ($params['groups'] as $group) {
                $groups[] = $this->getEm()->getReference(Group::class, $group['id']);
            }

            $user->setGroups($groups);
        }

        if ($params['partners']) {
            foreach ($params['partners'] as $partner) {
                $partners[] = $this->getEm()->getReference(Partner::class, $partner['id']);
            }

            $user->setPartners($partners);
        }

        $name = new Name(
            $params["name"]["firstName"],
            $params["name"]["lastName"]
        );

        $user->setName($name);
        $user->setPlainTextPassword($params['plainTextPassword']);

//        $this->checkEditPermissions($user);

        $this->getEm()->persist($user);
        $this->getEm()->flush();

        return $this->serialize($request, $user);
    }

    /**
     * Whole or partial update of a user
     *
     * @Route(path="/{id<\d+>}", methods={"PATCH"})
     */
    public function update(Request $request, string $id) : JsonResponse
    {
        $params = $this->getParams($request);
        /** @var User $user */
        $user = $this->getUserById($id);

//        $this->checkEditPermissions($user);

        if ($params['groups']) {
            $groups = array_map(function ($group) {
                return $this->getEm()->getReference(Group::class, $group['id']);
            }, $params['groups']);

            $user->setGroups($groups);
        }

        if ($params['partners']) {
            $partners = array_map(function ($partner) {
                return $this->getEm()->getReference(Partner::class, $partner['id']);
            }, $params['partners']);

            $user->setPartners($partners);
        }

        if ($params['name']) {
            $name = new Name($params['name']['firstName'], $params['name']['lastName']);
            $user->setName($name);
            unset($params['name']);
        }

        $user->applyChangesFromArray($params);

        $this->getEm()->persist($user);
        $this->getEm()->flush();

        return $this->serialize($request, $user);
    }

    /**
     * Delete a user
     *
     * @Route(path="/{id<\d+>}", methods={"DELETE"})
     */
    public function destroy(Request $request, string $id)
    {
        $user = $this->getUserById($id);

//        $this->checkEditPermissions($user);

        $this->getEm()->remove($user);

        $this->getEm()->flush();

        return $this->success(sprintf('User "%s" deleted.', $user->getUsername()));
    }

    protected function getDefaultTransformer()
    {
        return new UserTransformer;
    }

    protected function getUserById($id): User
    {
        /** @var User $user */
        $user = $this->getRepository()->find($id);

        if (!$user) {
            throw new NotFoundHttpException(sprintf('Unknown User ID: %d', $id));
        }

        return $user;
    }
}
