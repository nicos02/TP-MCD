<?php 
namespace App\src\Entity;
class Database {
    public $dbh;

    public function __construct()
    {
        try {
            $host = 'localhost'; 
            $dbname = 'blogsjt'; 
            $user = 'root';
            $password = ''; 

            $this->dbh = new \PDO("mysql:host=$host;dbname=$dbname", $user, $password); // Connexion à la base de données
        } catch (\PDOException $e) {
            echo 'Erreur lors de la connexion à la base de données : ' . $e->getMessage();
            exit();
        }
    }
}
?>