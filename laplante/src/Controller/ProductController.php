<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

class ProductController extends AbstractController
{
    #[Route('/product/{id?0}', name: 'app_product_show')]
    public function index(int $id, ProductRepository $repos): Response
    {
        $product = $repos->find($id);
        $liste = $repos->findAll();
        $user = $this->getUser();

        // Vérifier si un produit avec cet ID a été trouvé
        if (!$product) {
            throw $this->createNotFoundException('Aucun produit trouvé pour cet ID : ' . $id);
        }

        return $this->render('product/index.html.twig', [
            'product' => $product,
            'products' => $liste,
            'user' => $user,
        ]);
        
    }
}
