<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\ProductCategory;
use App\Transformers\ProductTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProductController
 * @package App\Http\Controllers
 *
 * @Route(path="/api/products")
 */
class ProductController extends BaseController
{
    protected $defaultEntityName = Product::class;

    /**
     * Get a list of Products
     *
     * @Route(path="/", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $partnerOrderable = $request->get('partnerOrderable');

        if ($partnerOrderable == null) {
            $products = $this->getRepository()->findAll();
        } else {
            $products = $this->getRepository()->findByPartnerOrderable($partnerOrderable);
        }

        return $this->serialize($request, $products);
    }

    /**
     * Get a single Product
     *
     * @Route(path="/{id<\d+>}", methods={"GET"})
     *
     * @param $id
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        $product = $this->getProduct($id);

        return $this->serialize($request, $product);
    }

    /**
     * Save a new product
     *
     * @Route(path="/", methods={"POST"})
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) {
        $params = $request->request->all();

        $this->validate($request, [
            'name' => 'required',
        ]);

        $product = new Product($request->get('name'));

        $product->applyChangesFromArray($params);

        if($params['productCategory']['id']) {
            $newCategory = $this->getEm()->find(ProductCategory::class, $params['productCategory']['id']);
            $product->setProductCategory($newCategory);
        }

        $this->checkEditPermissions($product);

        $this->getEm()->persist($product);
        $this->getEm()->flush();

        return $this->serialize($request, $product);
    }

    /**
     * Whole or partial update of a product
     *
     * @Route(path="/{id<\d+>}", methods={"PATCH"})
     *
     * @param Request $request
     * @param $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        $params = $request->request->all();
        /** @var Product $product */
        $product = $this->getProduct($id);

        $this->checkEditPermissions($product);

        $product->applyChangesFromArray($params);

        if($params['productCategory']['id'] != $product->getProductCategory()->getId()) {
            $newCategory = $this->getEm()->find(ProductCategory::class, $params['productCategory']['id']);
            $product->setProductCategory($newCategory);
        }

        $this->getEm()->persist($product);
        $this->getEm()->flush();

        return $this->serialize($request, $product);
    }

    /**
     * Delete a product
     *
     * @Route(path="/{id<\d+>}", methods={"DELETE"})
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $product = $this->getProduct($id);

        $this->checkEditPermissions($product);

        $this->getEm()->remove($product);

        $this->getEm()->flush();

        return $this->success(sprintf('Product "%s" deleted.', $product->getTitle()));
    }

    /**
     * @Route(path="/list-options", methods={"GET"})
     * @return JsonResponse
     */
    public function listOptions(Request $request)
    {
        $products = $this->getRepository()->findAll();

        return $this->serialize($request, $products, new ProductOptionTransformer());
    }

    /**
     * Get current inventory stats for the give product
     *
     * @Route(path="/{id<\d+>}/inventory")
     *
     * @param $id
     */
    public function inventory($id)
    {
        $product = $this->getProduct($id);

        $inventory = [
            'warehouse' => $this->getRepository()->getWarehouseInventory($product),
            'partner' => $this->getRepository()->getPartnerInventory($product),
            'total' => $this->getRepository()->getNetworkInventory($product),
        ];

        return new JsonResponse($inventory);
    }

    /**
     * @param $id
     * @return null|Product
     * @throws NotFoundApiException
     */
    protected function getProduct($id)
    {
        /** @var Product $product */
        $product = $this->getRepository()->find($id);

        if(!$product) {
            throw new NotFoundHttpException(sprintf('Unknown Product ID: %d', $id));
        }

        return $product;
    }

    protected function getDefaultTransformer()
    {
        return new ProductTransformer;
    }
}