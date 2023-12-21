<?php

namespace App\src\Entity;

class Article extends Database
{
    public $id;
    public $title;
    public $content;
    public $img;
    public $state;
    public $updatedAt;
    public $category_id;
    public $id_user;

    public function __construct()
    {
        parent::__construct();
    }

    // Récupérer tous les articles
    public function getAll()
    {
        $sql = 'SELECT a.*, c.name AS category_name 
        FROM article a 
        INNER JOIN sjt_category c ON a.category_id = c.id';
        // La partie "SELECT a., c.name AS category_name" spécifie les colonnes que vous souhaitez sélectionner. "a." signifie toutes les colonnes de la table "article", et "c.name AS category_name" renomme la colonne "name" de la table "sjt_category" en "category_name".
        //La partie "FROM article a" indique que vous souhaitez sélectionner les données de la table "article" et l'alias "a" est utilisé pour référencer cette table.
        //La partie "INNER JOIN sjt_category c ON a.category_id = c.id" spécifie une jointure entre la table "article" et la table "sjt_category" en utilisant la colonne "category_id" de la table "article" et la colonne "id" de la table "sjt_category" pour faire correspondre les enregistrements.
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    // Récupérer un article
    public function getById($id)
    {
        $sql = 'SELECT * FROM article WHERE id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch();
    }

    // Détruire un article
    public function deleteById($id)
    {
        $sql = 'DELETE FROM article WHERE id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
    }

    public function deleteArticleByCategory ($id) {
        $sql = 'DELETE FROM article WHERE category_id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
    }
    
    // Modifier un article
    public function updateById($id, $title, $content, $image = null, $state = null)
    {
        // Formatage de la date et de l'heure avec le fuseau horaire de Paris
        $parisTimezone = new \DateTimeZone('Europe/Paris'); // Utilisation du fuseau horaire de Paris avec la classe DateTimeZone
        $now = new \DateTime('now', $parisTimezone); // Utilisation du fuseau horaire de Paris avec la classe DateTime
        $updatedAt = $now->format('Y-m-d H:i:s');

        $query = $this->dbh->prepare('UPDATE article SET title = :title, content = :content, updatedAt = :updatedAt, state = :state, img = :img WHERE id = :id');
        $query->bindValue(':title', $title, \PDO::PARAM_STR);
        $query->bindValue(':content', $content, \PDO::PARAM_STR);
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->bindValue(':updatedAt', $updatedAt, \PDO::PARAM_STR);
        $query->bindValue(':state', $state, \PDO::PARAM_INT);

        if ($image !== null) {
            $query->bindValue(':img', $image, \PDO::PARAM_STR);
        }

        $query->execute();
    }

    // Affiche les articles validés
    public function getValidated()
    {
        $sql = 'SELECT * FROM article WHERE state = 1';
        $sth = $this->dbh->query($sql);
        return $sth->fetchAll();
    }

    //Creer un article

    public function create($title, $content, $image, $state, $category_id, $user_id)
    {
        // Formatage de la date et de l'heure avec le fuseau horaire de Paris
        $parisTimezone = new \DateTimeZone('Europe/Paris'); // Utilisation du fuseau horaire de Paris avec la classe DateTimeZone
        $now = new \DateTime('now', $parisTimezone); // Utilisation du fuseau horaire de Paris avec la classe DateTime
        $createdAt = $now->format('Y-m-d H:i:s');

        $query = $this->dbh->prepare('INSERT INTO article (title, content, img, state, created_At, category_id, id_user) VALUES (:title, :content, :img, :state, :created_At, :category_id, :user_id)');
        $query->bindValue(':title', $title, \PDO::PARAM_STR);
        $query->bindValue(':content', $content, \PDO::PARAM_STR);
        $query->bindValue(':img', $image, \PDO::PARAM_STR);
        $query->bindValue(':state', $state, \PDO::PARAM_INT);
        $query->bindValue(':created_At', $createdAt, \PDO::PARAM_STR);
        $query->bindValue(':category_id', $category_id, \PDO::PARAM_INT);
        $query->bindValue(':user_id', $user_id, \PDO::PARAM_INT);

        $query->execute();
    }
}
