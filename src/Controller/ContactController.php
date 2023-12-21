<?php 
namespace App\src\controller;


class ContactController extends TwigController
{
    public function index()
    {
        echo $this->twig->render('contact/index.html.twig',[
            'session' => $_SESSION]
        );
    }

    public function test() 
    {
        echo $this->twig->render('contact/test.html.twig', [
            'session' => $_SESSION
        ]);
    }
}
?>