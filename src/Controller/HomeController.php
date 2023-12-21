<?php 
namespace App\src\controller;

use App\src\Entity\Article;

class HomeController extends TwigController
{
    public function index()
    {
        $article = new Article();

        $article_validate = $article->getValidated();

        echo $this->twig->render('home/index.html.twig',[
            'articles_validate' => $article_validate,
            'session' => $_SESSION
        ]);
    }
}
?>