<?php
/**
 * Created by PhpStorm.
 */

namespace classes;

//use controllers\HomeController;


class Router
{

    /**
     * @param string $query /index.php/controller/methode
     * @return mixed
     */
    public function controllerReturn($query = '')
    {
        //initialisation des variables par deffaut
        $controller = 'Home';
        $method = 'index';

        //découpage du path_info avec comme délimiteur / et en supprimant les / en début et fin du path_info
        $explodeQuery = explode('/', trim($query,'/'));

        //on vérifie qu'il y a bien un controller
        if(isset($explodeQuery[0]) && !empty($explodeQuery[0])){
            $controller = ucfirst($explodeQuery[0]);
        }
        //on vérifie qu'il y a bien une méthode
        if(isset($explodeQuery[1]) && !empty($explodeQuery[1])){
            $method = $explodeQuery[1];
        }

        //on catch les exceptions
        try{
            //on refabrique le bon nom du controller
            $controller .= 'Controller';

            //on inclut le fichier du controller
            require_once ('controllers/'.$controller.'.php');

            //on prépare une variable avec le path de la classe du controller
            $controller = '\\controllers\\'.$controller;

            //instantiation du controller
            $object = new $controller();

            //on appelle la méthode du controller et on retourne son résultat
            return $object->$method();

        }catch (\Exception $exception){
            var_dump($exception->getMessage());
            require_once ('controllers/ErrorsController.php');

            $controller = '\\controllers\\ErrorsController';
            $object = new $controller();
            return $object->$method();
        }
    }

}