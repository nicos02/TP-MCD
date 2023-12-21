<?php

namespace App\src\Entity;

class Register extends Database
{

   public $id;
   public $title;
   public $content;
   public $img;
   public $state;
   public $created_at;

   public function __construct()
   {
      parent::__construct();
   }

   // Vérifier si le nom d'utilisateur existe deja
   public function checkIfUserExists($username)
   {
      $sql = "SELECT * FROM user WHERE username = :username";
      $stmt = $this->dbh->prepare($sql);
      $stmt->bindParam(':username', $username);
      $stmt->execute();
      $user = $stmt->fetch();

      return ($user !== false);
   }

   public function generateCsrfToken()
   {
      $token = bin2hex(random_bytes(32));

      $_SESSION['csrf_token'] = $token;

      return $token;
   }

   // Inscrire l'utilisateur
   public function registerUser($username, $email, $password)
   {
      // Hasher le mot de passe pour des raisons de sécurité
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      // Générer le token CSRF
      $csrfToken = $this->generateCsrfToken();

      // definit le role par defaut de l'utilisateur
      $role = 'user';

      // Insertion des données dans la base de données
      $sql = "INSERT INTO user (username, email, password, token, role) VALUES (:username, :email, :password, :csrfToken, :role)";
      $stmt = $this->dbh->prepare($sql); // Prépare la requête SQL
      $stmt->bindParam(':username', $username); // Associe les paramètres de la requête SQL aux valeurs des paramètres de la requête PHP
      $stmt->bindParam(':email', $email); // Associe les paramètres de la requête SQL aux valeurs des paramètres de la requête PHP
      $stmt->bindParam(':password', $hashedPassword); // Associe les paramètres de la requête SQL aux valeurs des paramètres de la requête PHP
      $stmt->bindParam(':csrfToken', $csrfToken); // Associe les paramètres de la requête SQL aux valeurs des paramètres de la requête PHP
      $stmt->bindParam(':role', $role); // Associe les paramètres de la requête SQL aux valeurs des paramètres de la requête PHP
      $stmt->execute();

   }
}
