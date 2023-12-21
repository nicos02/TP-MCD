<?php

namespace App\src\controller;

use App\src\Entity\Article;
use App\src\Entity\Category;

class CategoryController extends TwigController
{
   public function index()
   {
      if ($_SESSION['role'] === 'admin') {
         $categoryManager = new Category();
         $allcategory = $categoryManager->getCategory(); // Récupérer tous les category

         echo $this->twig->render('category/index.html.twig', [
            'allcategory' => $allcategory,
            'session' => $_SESSION
         ]);
      } else {
         header('Location: home');
      }
   }

   //Détruire une category
   public function delete($id)
   {
      if ($_SESSION['role'] === 'admin') {
         $deleteArticle = new Article();
         $deleteArticle->deleteArticleByCategory($id);
         
         $categoryManager = new Category();
         $categoryManager->deleteCategory($id);

         // Utilise Twig pour afficher la vue de delete
         echo $this->twig->render('category/delete.html.twig', [
            'session' => $_SESSION
         ]);
      } else {
         header('Location: home');
      }
   }

   // Modifier une category

   public function modify()
   {
      if ($_SESSION['role'] === 'admin') {
         // Définir le message par défaut
         $message = '';

         // Récupérer l'ID de l'article à partir de l'URL
         $url = $_SERVER['REQUEST_URI'];
         $parts = explode('/', $url);
         $id = end($parts);

         // Vérifier si le formulaire a été soumis en utilisant la méthode POST
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Récupérer le titre et le contenu du formulaire
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);

            // Modifier l'article
            $categoryManager = new Category();
            $categoryManager->updateCategory($id, $name, $description);

            // Définir le message de succès
            $message = "La categorie a été mis à jour avec succès ! Redirection en cours...";
         }

         // Utilise Twig pour afficher la vue de modify



         $categoryManager = new Category();
         $category = $categoryManager->getCategoryById($id);

         echo $this->twig->render('category/modify.html.twig', [
            'id' => $id,
            'category' => $category,
            'message' => $message,
            'session' => $_SESSION
         ]);
      } else {
         header('Location: home');
      }
   }

   // Ajouter une category

   public function create()
   {
      if ($_SESSION['role'] === 'admin') {
         // Définir le message par défaut
         $message = '';

         // Vérifier si le formulaire a été soumis en utilisant la méthode POST

         if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Récupérer le titre et le contenu du formulaire
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);

            // Ajouter l'article
            $categoryManager = new Category();
            $categoryManager->create($name, $description);

            // Définir le message de création

            $message = "La categorie a été ajoutée avec succès ! Redirection en cours...";
         }

         // Utilise Twig pour afficher la vue de create



         echo $this->twig->render('category/create.html.twig', [
            'message' => $message,
            'session' => $_SESSION
         ]);
      } else {
         header('Location: home');
      }
   }
}
