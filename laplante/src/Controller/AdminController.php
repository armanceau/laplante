<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\AddProductType;
use App\Form\EditProductType;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(ProductRepository $repos): Response
    {

        $liste = $repos->findAll();
        $user = $this->getUser();

        return $this->render('admin/index.html.twig',[
            'products' => $liste,
            'user' => $user,
        ]);
    }

    #[Route('/admin/product', name: 'app_admin_product')]
    public function indexProduct(ProductRepository $repos): Response
    {

        $liste = $repos->findAll();
        $user = $this->getUser();

        return $this->render('admin/IndexProduct.html.twig',[
            'products' => $liste,
            'user' => $user,
        ]);
    }

    #[Route('/admin/product/{id}', name: 'admin_product_show', requirements: ['id' => '\d+'])]
    public function show(int $id, ProductRepository $repos): Response
    {
        $product = $repos->find($id);
        $user = $this->getUser();

        if (!$product) {
            throw $this->createNotFoundException('Aucun produit trouvé pour cet ID : ' . $id);
        }

        return $this->render('admin/ShowProduct.html.twig', [
            'product' => $product,
            'user' => $user,
        ]);
    }

    #[Route('/admin/product/add', name: 'admin_product_add')]
    public function add(Request $request, entityManagerInterface $entityManager): Response
    {
        $product = new Product();
        $user = $this->getUser();

        $form = $this->createForm(AddProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Utilisez l'EntityManager pour persister l'utilisateur
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success',"le produit a bien été ajouté");

            // Faites tout ce que vous devez faire après l'ajout

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/AddProduct.html.twig', [
            'NewProductForm' => $form->createView(),
            'user' => $user,
        ]);
    }

    #[Route('/admin/product/delete/{id}', name: 'admin_product_delete')]
    public function delete(int $id, ProductRepository $repos, Request $request): Response
    {
        $product = $repos->find($id);

        $repos->remove($product);

        $this->addFlash('success',"le produit a bien été supprimé");

        return $this->redirectToRoute('app_admin_product');   
    }

    #[Route('/admin/product/edit/{id}', name: 'admin_product_edit', requirements: ['id' => '\d+'])]
    public function edit(int $id, ProductRepository $repos, Request $request, entityManagerInterface $entityManager): Response
    {
        $product = $repos->find($id);
        $user = $this->getUser();

        $form = $this->createForm(EditProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success',"le produit a bien été ajouté");

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/Editproduct.html.twig', [
            'NewProductForm' => $form->createView(),
            'user' => $user,
        ]);
    }

    #[Route('/admin/user', name: 'app_admin_user')]
    public function indexUser(USerRepository $repos): Response
    {

        $liste = $repos->findAll();
        $user = $this->getUser();

        return $this->render('admin/IndexUser.html.twig',[
            'users' => $liste,
            'user' => $user,
        ]);
    }

    #[Route('/admin/user/{id}', name: 'admin_user_show', requirements: ['id' => '\d+'])]
    public function showUser(int $id, UserRepository $repos): Response
    {
        $userRepos = $repos->find($id);
        $user = $this->getUser();

        if (!$userRepos) {
            throw $this->createNotFoundException('Aucun produit trouvé pour cet ID : ' . $id);
        }

        return $this->render('admin/ShowUser.html.twig', [
            'userRepos' => $userRepos,
            'user' => $user,
        ]);
    }
    #[Route('/admin/user/add', name: 'admin_user_add')]
    public function addUser(Request $request, entityManagerInterface $entityManager): Response
    {
       
        $user = $this->getUser();


        return $this->render('admin/AddUser.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/admin/user/delete/{id}', name: 'admin_user_delete')]
    public function deleteUser(int $id, UserRepository $repos, Request $request): Response
    {
        $user = $repos->find($id);

        $repos->remove($user);

        $this->addFlash('success',"l'utilisateur a bien été supprimé");

        return $this->redirectToRoute('app_admin_user');   
    }

    #[Route('/admin/user/edit/{id}', name: 'admin_user_edit', requirements: ['id' => '\d+'])]
    public function editUser(int $id, UserRepository $repos, Request $request, entityManagerInterface $entityManager): Response
    {
        
        $user = $this->getUser();

        

        return $this->render('admin/EditUser.html.twig', [
            'user' => $user,
        ]);
    }
}
