<?php

namespace App\src;

use App\src\Controller\TwigController;

/**
 * Class Noyau Routeur 
 */
class Kernel extends TwigController
{
    public function start()
    {
        session_start();
        //var_dump($_SERVER);
        $params = [];
        $params = explode("/", $_SERVER["PATH_INFO"]);
        if (isset($params[1]) && !empty($params[1]) && $params[1] != $params[1] . '/ ') {
            $controller = "\\App\\src\\Controller\\" . ucfirst($params[1]) . "Controller";

            //var_dump($controller);
            //var_dump($params);

            $method = (isset($params[2])) ? $params[2] :  "index";

            //var_dump($method);

            $data = (isset($params[3])) ? intval($params[3]) :  "";

            // var_dump($data);
            $controllers = new $controller();
            if (method_exists($controllers, $method)) {
                $fh = fopen('../tmp/logs.txt', 'a');
                fwrite($fh, $_SERVER['REMOTE_ADDR'] . ' ' . $_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI'] . ' ' . date('c') . "\n");
                fclose($fh);
                (isset($data)) ? $controllers->$method($data) : $controllers->$method();
            } else {
                header("Location:/public/home");
                //http_response_code(404);
                //echo "Aucune methode existe";
            }
        } else {
            header('Location: home');
        }
    }
}
