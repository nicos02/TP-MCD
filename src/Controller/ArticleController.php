<?php

namespace App\src\controller;

use App\src\Entity\Article;
use App\src\Entity\Category;

class ArticleController extends TwigController
{
    public function index()
    {
        $articleManager = new Article();
        $allarticle = $articleManager->getAll(); // Récupérer tous les articles

        echo $this->twig->render('article/index.html.twig', [
            'allarticle' => $allarticle,
            'session' => $_SESSION
        ]);
    }

    public function view($id)
    {
        // Appeler la méthode 'getById'pour obtenir l'article correspondant à l'ID
        $articleManager = new Article();
        $article = $articleManager->getById($id);

        // Utilise Twig pour afficher la vue de l'article
        echo $this->twig->render('article/view.html.twig', [
            'article' => $article,
            'session' => $_SESSION
        ]);
    }

    // Détruire un article
    public function delete($id)
    {
        if ($_SESSION['role'] === 'admin') {
        $articleManager = new Article();
        $articleManager->deleteById($id);

            // Utilise Twig pour afficher la vue de delete
            echo $this->twig->render('article/delete.html.twig', [
                'session' => $_SESSION
            ]);
        } else {
            header('Location: home');
        }
    }


    // Modifier un article

    public function modify()
    {
        // Définir le message par défaut
        $message = '';

        // Récupérer l'ID de l'article à partir de l'URL
        $url = $_SERVER['REQUEST_URI'];
        $parts = explode('/', $url);
        $id = end($parts);

        // Vérifier si le formulaire a été soumis en utilisant la méthode POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Récupérer le titre et le contenu du formulaire
            $title = $_POST['title'];
            $content = $_POST['content'];
            $state = $_POST['state'];

            // Vérifier si un fichier a été téléchargé
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Déplacer le fichier téléchargé vers un emplacement de stockage
                $targetDirectory = 'assets/img/';
                $targetFile = $targetDirectory . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

                // Mettre à jour le titre, le contenu et l'image de l'article
                $articleManager = new Article();
                $articleManager->updateById($id, $title, $content, $targetFile, $state);

                // Définir le message de succès
                $message = "L'article a été mis à jour avec succès ! Redirection en cours...";
            } else {
                // Récupérer l'article existant pour obtenir l'image actuelle
                $articleManager = new Article();
                $existingArticle = $articleManager->getById($id);

                // Vérifier si l'article existe
                if ($existingArticle) {
                    $existingImage = $existingArticle['img'];

                    // Mettre à jour le titre, le contenu et l'image de l'article (en utilisant l'image existante)
                    $articleManager->updateById($id, $title, $content, $existingImage, $state);

                    // Définir le message de succès
                    $message = "L'article a été mis à jour avec succès ! Redirection en cours...";
                } else {
                    // Gérer l'erreur si l'article n'existe pas
                    $message = "Erreur lors de la mise à jour de l'article. L'article n'existe pas.";
                }
            }
        }

        if ($_SESSION['role'] === 'admin') {
            // Récupérer l'article correspondant à l'ID
            $articleManager = new Article();
            $article = $articleManager->getById($id);

            // Passer le message de succès à votre modèle Twig
            echo $this->twig->render('article/modify.html.twig', [
                'message' => $message,
                'id' => $id,
                'article' => $article,
                'session' => $_SESSION
            ]);
        } else {
            header('Location: home');
        }
    }

    //Créer un article

    public function create()
    {
        if ($_SESSION['role'] === 'admin') {
            $message = '';

            // Vérifier si le formulaire a été soumis en utilisant la méthode POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupérer le titre et le contenu du formulaire
                $title = $_POST['title'];
                $content = $_POST['content'];
                $state = $_POST['state'];


                // Vérifier si un fichier a été telechagé
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    //​​Deplacer le fichier telechagé vers un emplacement de stockage
                    // Déplacer le fichier téléchargé vers un emplacement de stockage
                    $targetDirectory = 'assets/img/';
                    $targetFile = $targetDirectory . basename($_FILES['image']['name']);
                    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

                    $imagePath = utf8_encode($targetFile);
                    
                    $category_id = $_POST['category_id'];
                    $user_id = $_SESSION['user_id'];

                    // Mettre à jour le titre, le contenu et l'image de l'article
                    $articleManager = new Article();
                    $articleManager->create($title, $content, $imagePath, $state, $category_id, $user_id);

                    // Définir le message de succès
                    $message = "L'article a été créer avec succès ! Redirection en cours...";
                } else {

                    $category_id = $_POST['category_id'];
                    $user_id = $_SESSION['user_id'];

                    $imagePath = 'https://placehold.co/600x400/png';
                    // Mettre à jour le titre, le contenu et l'image de l'article
                    $articleManager = new Article();
                    $articleManager->create($title, $content, $imagePath, $state, $category_id, $user_id);

                    // Définir le message de sélection

                    $message = "L'article a été créé avec succès ! Redirection en cours...";
                }
            }


            $categoryManager = new Category();
            $allcategory = $categoryManager->getCategory(); 

            echo $this->twig->render('article/create.html.twig', [
                'message' => $message,
                'session' => $_SESSION,
                'allcategory' => $allcategory
            ]);
        } else {
            header('Location: home');
        }
    }
}
