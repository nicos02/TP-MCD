<?php

namespace App\src\Entity;

class Comment extends Database
{
   public $id;
   public $content;
   public $state;
   public $id_user;
   public $id_article;

   public function __construct()
   {
      parent::__construct();
   }

   // Affiche les commentaires
   public function getComment()
   {
      $sql = 'SELECT comment.*, user.email , article.title
      FROM comment
      INNER JOIN article ON comment.id_article = article.id
      INNER JOIN user ON comment.id_user = user.id ';
      $sth = $this->dbh->query($sql);
      return $sth->fetchAll();
   }

   // Affiche les commentaire via l'id de session
   public function getCommentById()
   {
      $sql = 'SELECT comment.*, user.email , article.title
      FROM comment
      INNER JOIN article ON comment.id_article = article.id
      INNER JOIN user ON comment.id_user = user.id
      WHERE comment.id_user = :id_user';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':id_user', $_SESSION['user_id'], \PDO::PARAM_INT);
      $sth->execute();
      return $sth->fetchAll();
   }
   
   public function addComment( $content, $state , $id_article)
   {
      $parisTimezone = new \DateTimeZone('Europe/Paris'); // Utilisation du fuseau horaire de Paris avec la classe DateTimeZone
      $now = new \DateTime('now', $parisTimezone); // Utilisation du fuseau horaire de Paris avec la classe DateTime
      $createdAt = $now->format('Y-m-d H:i:s');

      $id_user = $_SESSION['user_id'];

      $sql = 'INSERT INTO comment (content, state, created_at, id_user, id_article) VALUES (:content, :state, :created_at, :id_user, :id_article)';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':content', $content, \PDO::PARAM_STR);
      $sth->bindValue(':state', $state, \PDO::PARAM_INT);
      $sth->bindValue(':created_at', $createdAt, \PDO::PARAM_STR);
      $sth->bindValue(':id_user', $id_user, \PDO::PARAM_INT);
      $sth->bindValue(':id_article', $id_article, \PDO::PARAM_INT);
      $sth->execute();
   }

   public function deleteComment($id)
   {
      $sql = 'DELETE FROM comment WHERE id = :id';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':id', $id, \PDO::PARAM_INT);
      $sth->execute();
   }


   public function updateById($id, $state)
   {

      $sql = 'UPDATE comment SET state = :state WHERE id = :id';
      $sth = $this->dbh->prepare($sql);
      $sth->bindValue(':state', $state, \PDO::PARAM_INT);
      $sth->bindValue(':id', $id, \PDO::PARAM_INT);
      $sth->execute();
   }
}
