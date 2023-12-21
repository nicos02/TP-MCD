<?php

namespace App\src\Entity;

class User extends Database
{
    public $id;
    public $username;
    public $email;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = 'SELECT * FROM user';// Selectionne toutes les colonnes de la table "user"
        $sth = $this->dbh->prepare($sql);// Prépare la requête SQL
        $sth->execute();// Execute la requête SQL
        return $sth->fetchAll();
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email = :email"; // Sélectionne toutes les colonnes de la table "user" où la colonne "email" correspond à la valeur du paramètre ":email"
        $stmt = $this->dbh->prepare($sql); // Prépare la requête SQL
        $stmt->bindParam(':email', $email); // Associe les paramètres de la requête SQL aux valeurs des paramètres de la requête PHP
        $stmt->execute(); // Execute la requête SQL
        return $stmt->fetch();
    }
}
