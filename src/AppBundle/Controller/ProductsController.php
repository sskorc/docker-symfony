<?php

namespace AppBundle\Controller;

use AppBundle\Document\Product;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProductsController extends FOSRestController
{
    public function getProductsAction()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $products = $dm->getRepository('AppBundle:Product')->findAll();

        $view = $this->view($products, 200);

        return $this->handleView($view);
    }

    public function getProductAction($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $product = $dm->getRepository('AppBundle:Product')->find($id);

        if (empty($product)) {
            throw new HttpException(404, 'Product not found.');
        }

        $view = $this->view($product, 200);

        return $this->handleView($view);
    }

    public function postProductsAction(Request $request)
    {
        $name = $request->get('name');

        if (empty($name)) {
            throw new HttpException(400, 'Missing required parameters');
        }

        $product = new Product();
        $product->setName($name);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($product);
        $dm->flush();

        $view = $this->view($product, 201);

        return $this->handleView($view);
    }
}
