<?php

namespace App\src\Entity;

class Login extends Database
{
   public $email;
   protected $password;

   public function __construct()
   {
      parent::__construct();
   }

   // Fonction pour se connecter
   public function loginUser($email)
   {
      $sql = "SELECT * FROM user WHERE email = :email"; // Requête SQL
      $stmt = $this->dbh->prepare($sql);// Préparation de la requête
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      return $stmt->fetch();// Récupération du résultat avec la méthode fetch()
   }

   // Fonction pour générer un jeton CSRF
   public function generateCsrfToken()
   {
      $token = bin2hex(random_bytes(32));
      $_SESSION['token'] = $token;
   }
}
