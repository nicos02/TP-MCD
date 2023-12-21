<?php

namespace App\src\controller;

use App\src\Entity\Login;

class LoginController extends TwigController
{
    public function index()
    {
        $messageError = ''; // Ajout de cette variable pour les messages d'erreur
        $login = new Login();

        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userData = $login->loginUser($email); // Ajout de l'e-mail en tant que paramètre

            // Verifie si l'utilisateur existe et si le mot de passe correspond
            if ($userData && password_verify($password, $userData['password'])) {

                // Tableau de session avec les informations de l'utilisateur
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['user_email'] = $userData['email'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['token'] = $userData['token'];
                $_SESSION['created_at'] = $userData['created_at'];
                $_SESSION['role'] = $userData['role'];


                // Génération du jeton CSRF
                $login->generateCsrfToken();

                header('Location: /public/user/account');
            } else {
                $messageError = 'Nom d\'utilisateur ou mot de passe incorrect !';
            }
        }

        echo $this->twig->render('login/index.html.twig', [
            'messageError' => $messageError // Ajout de cette variable dans le rendu Twig
        ]);
    }
}
