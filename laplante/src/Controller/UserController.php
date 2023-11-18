<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class UserController extends AbstractController
{
    #[Route('/user/{id}', name: 'app_user_show', requirements: ['id' => '\d+'])]
    public function show(int $id, UserRepository $repos): Response
    {
        $user = $repos->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Aucun utilisateur trouvé pour cet ID : ' . $id);
        }

        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }
}
