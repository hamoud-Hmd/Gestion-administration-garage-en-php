<?php
/**
 * Created by PhpStorm.
 * User: Gaap_
 * Date: 02/11/2018
 * Time: 12:02
 */

namespace models;

use classes\Bdd;

class ResaService
{
    const MIN_VERSEMENT_PCT = 20;

    private $models;
    private $typePaiement = [
        'cheque' => 'Chèque',
        'liquide' => 'Espèce',
        'cb' => 'Carte bleu',
        'rib' => 'Virement',
    ];

    /**
     * ResaService constructor.
     * @param \Models $models
     */
    public function __construct(Bdd $models)
    {
        $this->models = $models;
    }



    public function insertResa($dateResa, $sommeVersee, $typePaiement)
    {
        $insert = $this->getModels()->getBdd()->prepare(
            'INSERT INTO resa(res_date, res_somme_versee, res_date_created, res_type_paiment, res_is_valid)
                    VALUES(:dateResa, :sommeVersee, NOW(), :typePaiement, 1)'
        );
        $insert->execute(
            [
                "dateResa" => $dateResa,
                "sommeVersee" => $sommeVersee,
                "typePaiement" => $typePaiement
            ]
        );
    }
    public function majResa($dateResa, $sommeVersee, $typePaiement)
    {
        $update = $this->getModels()->getBdd()->prepare(
            'UPDATE FROM resa set res_date = :dateResa, res_somme_versee = :sommeVersee, res_type_paiement = :typePaiement )'
        );
        $update->execute(
            [
                "dateResa" => $dateResa,
                "sommeVersee" => $sommeVersee,
            ]
        );
    }

    public function getLastId()
    {
        //on récupère le dernier id
        $query = $this->getModels()->getBdd()->prepare('
                SELECT res_id FROM resa ORDER BY res_id DESC LIMIT 1
                ');

        $query->execute();
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateGarage($cars, $lastId)
    {
        $insert = $this->getModels()->getBdd()->prepare(
            'UPDATE garage SET fk_res_id = :idResa
                          WHERE gar_id = :idGar'
        );
        $insert->execute(
            [
                "idResa" => $lastId[0]['res_id'],
                "idGar" => $cars
            ]
        );
    }

    public function getIsMinVersement($sommeTotale, $sommeVersee){
        return ((($sommeTotale * self::MIN_VERSEMENT_PCT) /100) < $sommeVersee);
    }

    public function getResaById($id){
        //on récupère la resa
        $query = $this->getModels()->getBdd()->prepare('
                SELECT res_id FROM resa WHERE res_id = :idResa ORDER BY res_id DESC LIMIT 1
                ');

        $query->execute(['idResa' => $id]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateValidCancelResa($id,  $somme, $valid = true){
        $insert = $this->getModels()->getBdd()->prepare(
            'UPDATE resa SET res_somme_versee = ' . (($valid) ? ':sommeTotale' : '0')
            .((!$valid) ? ', res_is_valid = 0, res_penalite = :sommeTotale' : '').
            ' WHERE res_id = :idResa'
        );
        $insert->execute(
            [
                "idResa" => $id,
                "sommeTotale" => $somme,
            ]
        );
    }

    /**
     * @return \Models
     */
    private
    function getModels()
    {
        return $this->models;
    }

    /**
     * @return array
     */
    public function getTypePaiement()
    {
        return $this->typePaiement;
    }


}