<?php
/**
 * Created by PhpStorm.
 * User: Gaap_
 * Date: 02/11/2018
 * Time: 15:38
 */

namespace models;


use classes\Bdd;

class CarService
{

    private $models;

    public function __construct(Bdd $models)
    {
        $this->models = $models;
    }

    public function getConstructeurs($id = null)
    {
        $queryString = 'SELECT * FROM constructeur';
        $params = [];
        if(!is_null($id) && (int)$id ==! false){
            $queryString .= ' WHERE con_id = :id';
            $params = ['id' => $id];
        }

        $query = $this->getModels()->getBdd()->prepare($queryString);
        $query->execute($params);
        return $query->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function insert($constructeur, $modele, $typeCarburant, $quantite, $prix){
//on insert en Bdd
        $requete = "INSERT INTO garage (fk_con_id, gar_modele, gar_carburant, gar_nbrVoiture, gar_prix) VALUES (:unConstructeur, :unModele, :unTypeCarburant, :uneQuantite, :unPrix)";
        $insert = $this->getModels()->getBdd()->prepare($requete);

        $insert->bindParam('unConstructeur', $constructeur);
        $insert->bindParam('unModele', $modele);
        $insert->bindParam('unTypeCarburant', $typeCarburant);
        $insert->bindParam('uneQuantite', $quantite);
        $insert->bindParam('unPrix', $prix);

        $insert->execute();
    }

    /**
     * @return mixed
     */
    public function getAllCars(){
        $query = $this->getModels()->getBdd()->prepare(
            'SELECT * FROM garage AS g 
              INNER JOIN constructeur as c ON g.fk_con_id = c.con_id 
              LEFT JOIN resa AS r ON g.fk_res_id = r.res_id 
              WHERE g.fk_con_id = c.con_id'
        );
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCar($id = null, $verifResa = true){
        $queryString = 'SELECT * FROM garage AS g 
              INNER JOIN constructeur as c ON g.fk_con_id = c.con_id 
              LEFT JOIN resa AS r ON g.fk_res_id = r.res_id 
              WHERE g.fk_con_id = c.con_id';
        $excuteArray = [];

        if($verifResa){
            $queryString .= ' AND(r.res_is_valid = 0 OR r.res_is_valid IS NULL)';
        }
        if(!is_null($id)){
            $queryString .= ' AND g.gar_id = :carId';
            $excuteArray = [
                'carId' => $id
            ];
        }
        $query = $this->getModels()->getBdd()->prepare(
             $queryString
        );
        $query->execute($excuteArray);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCarByIdResa($id){
        $query = $this->getModels()->getBdd()->prepare(
            'SELECT * FROM garage AS g 
              INNER JOIN constructeur as c ON g.fk_con_id = c.con_id 
              LEFT JOIN resa AS r ON g.fk_res_id = r.res_id 
              WHERE g.fk_res_id = :idResa'
        );
        $query->execute(['idResa' => $id]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return Bdd
     */
    public function getModels()
    {
        return $this->models;
    }


}