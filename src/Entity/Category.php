<?php

namespace App\src\Entity;

class Category extends Database
{
   public $id;
   public $name;
   public $description;

   public function __construct()
   {
      parent::__construct();
   }

   // Affiche les categories
   public function getCategory()
   {
      $sql = 'SELECT * FROM sjt_category';
      $sth = $this->dbh->query($sql);
      return $sth->fetchAll();
   }

    
   // recupere une category

   public function getCategoryById($id)
   {
      $sql = 'SELECT * FROM sjt_category WHERE id = :id';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':id', $id, \PDO::PARAM_INT);
      $sth->execute();
      return $sth->fetch();
   }

   // Ajoute une category

   public function addCategory()
   {
      $sql = 'INSERT INTO sjt_category (name, description) VALUES (:name, :description)';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':name', $this->name, \PDO::PARAM_STR);
      $sth->bindValue(':description', $this->description, \PDO::PARAM_STR);
      $sth->execute();
   }

   // Supprime une category

   public function deleteCategory($id)
   {
      $sql = 'DELETE FROM sjt_category WHERE id = :id';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':id', $id, \PDO::PARAM_INT);
      $sth->execute();
   }

   // Modifie une category

   public function updateCategory($id, $name, $description)
   {
      $sql = 'UPDATE sjt_category SET name = :name, description = :description WHERE id = :id';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':name',$name, \PDO::PARAM_STR);
      $sth->bindValue(':description', $description, \PDO::PARAM_STR);
      $sth->bindValue(':id', $id, \PDO::PARAM_INT);
      $sth->execute();
   }


   // Créer une category

   public function create($name, $description)
   {
      $sql = 'INSERT INTO sjt_category (name, description) VALUES (:name, :description)';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':name', $name, \PDO::PARAM_STR);
      $sth->bindValue(':description', $description, \PDO::PARAM_STR);
      $sth->execute();
   }
}
