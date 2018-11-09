<?php

namespace controllers;

use classes\Bdd;
use models\CarService;
use models\UserService;

class HomeController
{
    public function index()
    {
        //instantiation des variables et des objets
        $error = [];
        $classTypeModels = new Bdd();

        //si la méthode est POST
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            //on vérifie que l'on a bien un pseudo et un mot de passe
            if (!isset($_POST['pseudo']) || !empty($_POST['pseudo'])) {
                $error['pseudo'] = 'Le pseudo ne peut pas être vide';
            }
            if (!isset($_POST['pass']) || !empty($_POST['pass'])) {
                $error['pass'] = 'Le mot de passe ne peut pas être vide';
            }

            //on recherche l'utilisateur
            $userService = new UserService($classTypeModels);

            //si le user exist on le connecte
            if ($verif = $userService->getUser($_POST['pseudo'], $_POST['pass'])) {
                $_SESSION['connect'] = true;
                $_SESSION['idUser'] = $verif['usr_id'];
            } else {
                $error["general"] = "Pseudo ou mot de passe incorrect.";
            }
        }

        //si l'utilisateur est déjà connecté
        if (isset($_SESSION['connect']) && $_SESSION['connect']) {
            $carService = new CarService($classTypeModels);
            $values = $carService->getAllCars();

            //retourne la vue de la nouvelle home logguer
            include_once('views\home_logged.php');
            return;
        }

        //retourne la vue du formulaire
        include_once('views\home.php');
        return;
    }
}
