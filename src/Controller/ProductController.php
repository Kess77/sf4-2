<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     *
     * @Route("/product/", name="product_list")
     */
    public function index(ProductRepository $repository)

    {
        $product_list = $repository->findAll();
        return $this->render('product/index.html.twig', [
            'product_list' => $product_list
        ]);
    }

    /**
     * Grace au param converter (installé par framework extraBundle
     * symfony récuperer l'entité Product qui correspond à l'identifiant dans URI
     * Product est la classe dans l'entité
     * Affiche une page d'1 produit
     * @Route("/product/{id}", name="product_show")
     *
     */
    public function show(Product $product)
    {
        return $this->render('product/show.html.twig',[
            'product' => $product
        ]);
    }
}
