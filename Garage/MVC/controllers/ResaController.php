<?php
/**
 * Created by PhpStorm.
 */

namespace controllers;


use models\CarService;
use models\ResaService;
use classes\Bdd;

class ResaController
{

    public function create()
    {
        $errors = [];

        if (!isset($_SESSION['connect']) || !$_SESSION['connect']) {
            //retourne la vue de la nouvelle home logguer
            include_once('views\home.php');
            return;
        }

        $carService = new CarService(new Bdd());
        $resaService = new ResaService(new Bdd());
        $typePaiement = $resaService->getTypePaiement();

        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            if (!isset($_POST['dateResa']) || empty($_POST['dateResa'])) {
                $errors[] = 'la date de réservation ne peut pas être vide.';
            }
            if (!isset($_POST['cars']) || empty($_POST['cars'])) {
                $errors[] = 'Une date de réservation ne peut pas être créée sans véhicule';
            }

            $car = $carService->getCar($_POST['cars']);

            if (empty($car)) {
                $errors[] = 'L\identifiant du véhicule n\'existe pas.';
            }

            if (!isset($_POST['sommeVersee']) || empty($_POST['sommeVersee'])) {
                $errors[] = 'Une somme de réservation doit être versée';
            } elseif (isset($_POST['sommeVersee']) &&
                $resaService->getIsMinVersement($car[0]['gar_prix'], (int)$_POST['sommeVersee']) == false) {
                $errors[] = 'Vous n\'avez pas assez versée d\'accompte';
            }

            if (empty($errors)) {
                $resaService->insertResa($_POST['dateResa'], $_POST['sommeVersee'], $_POST['typePaiement']);
                $lastId = $resaService->getLastId();

                if ($lastId) {
                    $resaService->updateGarage($car[0]['gar_id'], $lastId);
                }
            }
        }

        $cars = $carService->getCar();
        include_once('views/resa_create.php');
        return;
    }

    public function valid()
    {
        $resaService = new ResaService(new Bdd());
        $carService = new CarService(new Bdd());

        //je récupère l'identifiant GET de la résa
        $id = (isset($_GET['idResa']) && !empty($_GET['idResa'])) ? $_GET['idResa'] : null;
        //je vérifie que la résa existe bien
        if ($id) {
            //je récupère les informations de la résa
            $resa = $resaService->getResaById($id);

            //je vérifie que la résa existe bien
            if ($resa) {
                //je récupère les informations du véhicule qui est réservé
                $car = $carService->getCarByIdResa($id);
                //je mets à jour la somme versée
                $resaService->updateValidCancelResa($id, $car[0]['gar_prix']);
            }
        }
        //je récupère les informations relatives aux véhicules pour mon tableau
        $values = $carService->getAllCars();

        //retourne la vue de la nouvelle home logguer
        include_once('views\home_logged.php');
        return;
    }

    public function cancel(){
        $resaService = new ResaService(new Bdd());
        $carService = new CarService(new Bdd());

        //je récupère l'identifiant GET de la résa
        $id = (isset($_GET['idResa']) && !empty($_GET['idResa'])) ? $_GET['idResa'] : null;
        //je vérifie que la résa existe bien
        if ($id) {
            //je récupère les informations de la résa
            $resa = $resaService->getResaById($id);
            //je vérifie que la résa existe bien
            if ($resa) {
                //je récupère les informations du véhicule qui est réservé
                $car = $carService->getCarByIdResa($id);
                //je mets à jour la somme versée
                $resaService->updateValidCancelResa($id, ($car[0]['gar_prix']/10), false);
            }
        }
        //je récupère les informations relatives aux véhicules pour mon tableau
        $values = $carService->getAllCars();

        //retourne la vue de la nouvelle home logguer
        include_once('views\home_logged.php');
        return;
    }

    public function updateResa(){
        $errors = [];

        if (!isset($_SESSION['connect']) || !$_SESSION['connect']) {
            //retourne la vue de la nouvelle home logguer
            include_once('views\home.php');
            return;
        }

        $carService = new CarService(new Bdd());
        $resaService = new ResaService(new Bdd());
        $typePaiement = $resaService->getTypePaiement();

        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            if (!isset($_POST['dateResa']) || empty($_POST['dateResa'])) {
                $errors[] = 'la date de réservation ne peut pas être vide.';
            }
            if (!isset($_POST['cars']) || empty($_POST['cars'])) {
                $errors[] = 'Une date de réservation ne peut pas être créée sans véhicule';
            }

            $car = $carService->getCar($_POST['cars']);

            if (empty($car)) {
                $errors[] = 'L\identifiant du véhicule n\'existe pas.';
            }

            if (!isset($_POST['sommeVersee']) || empty($_POST['sommeVersee'])) {
                $errors[] = 'Une somme de réservation doit être versée';
            } elseif (isset($_POST['sommeVersee']) &&
                $resaService->getIsMinVersement($car[0]['gar_prix'], (int)$_POST['sommeVersee']) == false) {
                $errors[] = 'Vous n\'avez pas assez versée d\'accompte';
            }

            if (empty($errors)) {
                $resaService->majResa($_POST['dateResa'], $_POST['sommeVersee'], $_POST['typePaiement']);
            }
        }

        $cars = $carService->getCar();
        include_once('views/resa_create.php');
        return;
    }
}