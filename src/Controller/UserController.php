<?php

namespace App\src\controller;

use App\src\Controller\TwigController;
use App\src\Entity\User;

class UserController extends TwigController
{
    public function index()
    {
        if ($_SESSION['role'] === 'admin') {
        $user = new User();
        $users = $user->getAll(); // Récupérer tous les utilisateurs


            echo $this->twig->render('user/index.html.twig', [
                'users' => $users,
                'session' => $_SESSION
            ]);
        } else {
            header('Location: home');
        }
    }


    // Affiche le profil de l'utilisateur
    public function account()
    {
        // Si l'utilisateur est connecté on verifie ses informations
        if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'user') {
            $username = $_SESSION['username'];
            $email = $_SESSION['user_email'];

            echo $this->twig->render('login/account.html.twig', [
                'username' => $username,
                'email' => $email,
                'session' => $_SESSION
            ]);
        }else {
            header('Location: home');
        }
    }
}
