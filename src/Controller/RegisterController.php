<?php

namespace App\src\controller;

use App\src\Entity\Register;

class RegisterController extends TwigController
{
   public function index()
   {
      $message = '';
      $message_error = '';
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         // Récupérer les données du formulaire
         $username = $_POST['username'];
         $email = $_POST['email'];
         $password = $_POST['password'];

         $inscription = new Register();

         // Vérifier si le nom d'utilisateur existe déjà
         $userExists = $inscription->checkIfUserExists($username);

         if ($userExists) {
            $message_error = 'Ce nom d\'utilisateur est déjà utilisé. Veuillez en choisir un autre.';
         } else {
            // Appeler la méthode registerUser() pour inscrire l'utilisateur
            $inscription->registerUser($username, $email, $password);

            // Afficher un message de confirmation
               $message = 'Inscription réussie';
         }
      }

      echo $this->twig->render('inscription/index.html.twig', [
         'message' => $message,
         'message_error' => $message_error,
      ]);
   }
}