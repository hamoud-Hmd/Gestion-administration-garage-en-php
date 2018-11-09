<?php
/**
 * Created by PhpStorm.
 */

namespace controllers;


use classes\Bdd;
use models\UserService;

class UserController
{

    public function create(){
        $errors = [];
        //si je ne suis pas identifié, on affiche la home
        if (!isset($_SESSION['connect']) && !$_SESSION['connect']) {
            //retourne la vue de la nouvelle home logguer
            include_once('views\home.php');
            return;
        }

        //si la méthode est POST
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            $userService = new UserService(new Bdd());
            $userService->testPost($_POST['pseudo'], $_POST['email']);
            if(empty($errors = $userService->getErrors())) {
                $userService->insertUser($_POST['pseudo'], $_POST['email'], $_POST['password'], $_POST['dateNaissance']);
            }

        }

        include_once ('views/user_create.php');
        return;
    }

    public function deconnexion(){
        unset($_SESSION['connect']);
        include_once ('views/home.php');
        return;
    }
}