<?php

namespace App\src\controller;

class LogoutController
{
   public function index()
   {
      session_regenerate_id(true);
      session_destroy();

      sleep(1);
      header('Location: /login');
      exit;
   }
}
