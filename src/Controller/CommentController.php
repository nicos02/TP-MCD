<?php

namespace App\src\controller;

use App\src\Entity\Article;
use App\src\Entity\Comment;

class CommentController extends TwigController
{

   public function index()
   {

      if ($_SESSION ['role'] === 'admin') {
         $commentManager = new Comment();
         $allcomment = $commentManager->getComment(); // Récupérer tous les commentaires
         echo $this->twig->render('comment/index.html.twig', [
            'allcomment' => $allcomment,
            'session' => $_SESSION
         ]);

      } else {
         if ($_SESSION ['role'] === 'user') {
            $commentManager = new Comment();
            $allcomment = $commentManager->getCommentById(); // Récupérer les commentaires via l'id de session
            echo $this->twig->render('comment/index.html.twig', [
               'allcomment' => $allcomment,
               'session' => $_SESSION
            ]);
         }
      }


   }

   // Supprimer un commentaire
   public function delete($id)
   {

      if ($_SESSION['role'] === 'admin') {
         $commentManager = new Comment();
         $commentManager->deleteComment($id);

         echo $this->twig->render('comment/delete.html.twig', [
            'session' => $_SESSION
         ]);
      } else {
         header('Location: home');
      }
   }

   //Creer un commentaire

   public function create()
   {

      if ($_SESSION['role'] === 'admin') {
         // Définir le message par défaut
         $message = '';

         // Vérifier si le formulaire a été soumis en utilisant la méthode POST

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Récupérer le titre et le contenu du formulaire
            $content = htmlspecialchars($_POST['content']);
            $state = htmlspecialchars($_POST['state']);
            $id_article = htmlspecialchars($_POST['id_article']);

            // Ajouter le commentaire

            $commentManager = new Comment();
            $commentManager->addComment($content, $state, $id_article);

            // Définir le message de création

            $message = "Le commentaire a été ajouté avec succès ! Redirection en cours...";
         }

         // Utilise Twig pour afficher la vue de create
         $articleManager = new Article();
         $allarticle = $articleManager->getAll();
         echo $this->twig->render('comment/create.html.twig', [

            'allarticle' => $allarticle,
            'message' => $message,
            'session' => $_SESSION
         ]);
      } else {
         header('Location: home');
      }
   }


   //Modifier un commentaire
   public function modify()
   {

      // Définir le message par défaut
      $message = '';

      if ($_SESSION['role'] === 'admin') {
         // Récupérer l'ID de l'article à partir de l'URL
         $url = $_SERVER['REQUEST_URI'];
         $parts = explode('/', $url);
         $id = end($parts);

         // Vérifier si le formulaire a été soumis en utilisant la méthode POST

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Récupérer le titre et le contenu du formulaire
            $state = htmlspecialchars($_POST['state']);

            // Modifier le commentaire

            $commentManager = new Comment();
            $commentManager->updateById($id, $state);

            // Définir le message de modification

            $message = "Le commentaire a été mis à jour avec succès ! Redirection en cours...";
         }


         // Utilise Twig pour afficher la vue de modify

         echo $this->twig->render('comment/modify.html.twig', [

            'session' => $_SESSION,
            'message' => $message,
         ]);
      } else {
         header('Location: home');
      }
   }
}
