<?php

namespace App\Controller;

use App\Serializer\ApiSerializer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;
use SamJ\FractalBundle\ContainerAwareManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseController extends AbstractController
{
    /** @var string */
    protected $defaultEntityName;

    protected function getEm()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * @param null $entityName
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getRepository($entityName = null)
    {
        if (!isset($entityName) && !isset($this->defaultEntityName)) {
            throw new \InvalidArgumentException(
                'Controller is missing a default entity name and none specified when fetching the repository'
            );
        }

        $entityName = $entityName ?: $this->defaultEntityName;

        return $this->getEm()->getRepository($entityName);
    }

    /**
     * @param $entities
     * @param TransformerAbstract $transformer
     * @param array $meta
     * @return JsonResponse
     */
    protected function serialize(Request $request, $entities, TransformerAbstract $transformer = null, $meta = [])
    {
        $transformer = $transformer ?: $this->getDefaultTransformer();

        if ($entities instanceof \Iterator || is_array($entities)) {
            $resource = new Collection($entities, $transformer, 'data');
        } else {
            $resource = new Item($entities, $transformer, 'data');
        }

        $resource->setMeta($meta);

        return new JsonResponse($this->fractal($request)->createData($resource)->toArray());
    }

    private function fractal(Request $request)
    {
        /** @var Manager $manager */
        $manager = new ContainerAwareManager();
        $manager->setSerializer(new ApiSerializer());
        if ($request->query->has('include')) {
            $manager->parseIncludes($request->query->get('include'));
        }
        return $manager;
    }

    /**
     * Metadata only success response with message
     *
     * @param $message
     * @return JsonResponse
     */
    protected function success($message = null)
    {
        $meta = ['success' => true];

        if ($message) {
            $meta['message'] = $message;
        }

        return new JsonResponse($meta);
    }

    /**
     * Gets the parameters from the request including any json in the content
     *
     * @param Request $request
     * @return array
     */
    protected function getParams(Request $request) : array
    {
        // TODO: This needs to redone to check the type of request and only give back the right params for that method
        $params = $request->request->all();
        $params += $request->query->all();

        if ($request->getContentType() == 'json') {
            $params += json_decode($request->getContent(), true);
        }

        return $params;
    }

    protected function getDefaultTransformer()
    {
        // Implement if tied to an entity
    }
}
