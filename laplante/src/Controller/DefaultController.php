<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\ProductRepository;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default')]
    public function index(ProductRepository $repos): Response
    {
        $user = $this->getUser();
        $liste = $repos->findAll();

        return $this->render('default/index.html.twig',[
            'user' => $user,
            'products' => $liste,
        ]);
    }
}
