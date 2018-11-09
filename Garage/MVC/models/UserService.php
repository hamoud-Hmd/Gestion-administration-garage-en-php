<?php
/**
 * Created by PhpStorm.
 */

namespace models;


use classes\Bdd;

class UserService
{
    private $models;
    private $errors = [];

    /**
     * UserService constructor.
     * @param Bdd $models
     */
    public function __construct(Bdd $models)
    {
        $this->models = $models;
    }

    /**
     * @param string $pseudo
     * @param string $mail
     */
    public function testPost($pseudo = '', $mail = '')
    {
        $lenPseudo = strlen($pseudo);
        if ($lenPseudo < 4 || $lenPseudo > 50) {
            $this->setErrors('Votre pseudo doit comprendre plus de 3 caractères et moins de 50.');
        }

        $lengthMail = strlen($mail);
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL) || $lengthMail > 50) {
            $this->setErrors('Veuillez entrer un mail au format valide de moins de 50 caractères.');
        }
    }

    /**
     * @param string $pseudo
     * @param string $mail
     * @param string $pass
     * @param string $dateNaiss
     */
    public function insertUser($pseudo, $mail, $pass, $dateNaiss)
    {
        $insert = $this->getModels()->getBdd()->prepare(
            'INSERT INTO users(usr_pseudo, usr_pass, usr_mail, usr_dateNaissance)
                    VALUES(:pseudo, :pass, :mail, :dateNaiss)'
        );
        $insert->execute(
            [
                "pseudo" => $pseudo,
                "pass" => hash('sha512', $pass),
                "mail" => $mail,
                "dateNaiss" => $dateNaiss
            ]
        );
    }

    /**
     * @param string $username
     * @param string $pass
     * @return mixed
     */
    public function getUser($username = '', $pass = ''){
        $query = $this->getModels()->getBdd()->prepare(
            'SELECT usr_id 
                    FROM users 
                    WHERE usr_pseudo = :pseudo
                    AND usr_pass = :pass'
        );
        $query->execute([
            'pseudo' => $username,
            'pass' => hash('sha512', $pass)
        ]);
        return $query->fetch();
    }

    /**
     * @return Bdd
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors[] = $errors;
    }




}