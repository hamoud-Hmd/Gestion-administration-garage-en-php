<?php
/**
 * Created by PhpStorm.
 */

namespace controllers;


use classes\Bdd;
use models\CarService;

class CarController
{

    public function add()
    {
        $errors = [];
        //si je ne suis pas identifié, on affiche la home
        if (!isset($_SESSION['connect']) && !$_SESSION['connect']) {
            //retourne la vue de la nouvelle home logguer
            include_once('views\home.php');
            return;
        }

        $carService = new CarService(new Bdd());
        //recherche des différents modèle de voitures
        $carModeles = $carService->getConstructeurs();

        //si la méthode est POST
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            //si tout les champs sont remplis
            if (!empty($_POST['constructor']) && !empty($_POST['modele']) && !empty($_POST['typeCarb']) && !empty($_POST['quantity']) && !empty($_POST['prix'])) {
                //on vérifie que le modèle rentrée existe bien dans nos modèles
                /** @var $models \PDO $query */
                //on vérifie que le constructeur existe aussi
                if(empty($carService->getConstructeurs($_POST['constructor']))){
                    $errors[] = 'Ce constructeur n\'existe pas!';
                    include_once('views/addCar.php');
                    return;
                }

                $carService->insert($_POST['constructor'],
                    $_POST['modele'],
                    $_POST['typeCarb'],
                    $_POST['quantity'] ,$_POST['prix']);

            } else {
                $errors[] = 'T\'essaie de faire le mito, allez, remplis le champ!';
            }
        }

        include_once('views/addCar.php');
        return;
    }

}