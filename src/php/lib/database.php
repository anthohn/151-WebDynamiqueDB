<?php
/**
 * Auteur : Anthony Höhn
 * Date : 15.03.2021
 * Description :
 */

 class Database {
    // Variable de classe
    private $connector;


    //connexion à la bdd en faisant essayant puis si erreur récupere le message et affiche le message d'erreur 
    public function __construct(){
    try{
        $this->connector = new PDO("mysql:host=localhost;dbname=db_nickname_anthohn;charset=utf8", "dbNicknameUser", "grp2B_21");
        }
        catch(PDOException $e)
        {
            die("<h1>Impossible de se connecter à la base de données</h1> erreur :". $e->getMessage()); 
        }
    }


    private function querySimpleExecute($query){
        $req = $this->connector->query($query);
        return $req;
    }

    private function queryPrepareExecute($query, $binds){
        $req = $this->connector->prepare($query);
        foreach($binds as $bind){
            $req->bindValue($bind['field'], $bind['value'], $bind['type']);
        }
        $req->execute();
        return $req;
    }


    private function formatData($req){
        $results = $req->fetchALL(PDO::FETCH_ASSOC);
        return $results;
    }

    //Vider le jeu d’enregistrements
    private function unsetData($req){
        $req->closeCursor(); 
    }


    //récupere tous les enseignant -> pour la page d'accueil
    public function getAllTeachers(){
        $query = "SELECT * FROM t_teacher";
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    //récupere toutes les sections
    public function getAllSections(){
        $query = "SELECT * FROM t_section";
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    //récupére un enseigant via son ID
    public function getOneTeacher($id){
        $query = "SELECT * FROM t_teacher WHERE idTeacher = :id";
        $binds = array(
            0 => array(
                'field' => ':id',
                'value' => $id,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    //récupére de la section d'un enseigant via son ID
    public function getOneTeacherSection($id){
        $query = "SELECT * FROM t_teaches JOIN t_teacher ON fkteacher = idTeacher JOIN t_section ON fksection = idSection WHERE idTeacher = :id";
        $binds = array(
            0 => array(
                'field' => ':id',
                'value' => $id,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    //ajout d'enseigant dans la bdd
    public function addTeacher($surname, $firstname, $gender , $nickname, $origin){
        $query = "INSERT INTO t_teacher (teaFirstname, teaName, teaGender, teaNickname, teaOrigin) VALUES (:surname, :firstname, :gender, :nickname, :origin)";
        $binds = array(
            0 => array(
                'field' => ':surname',
                'value' => $surname,
                'type' => PDO::PARAM_STR
            ),
            1 => array(
                'field' => ':firstname',
                'value' => $firstname,
                'type' => PDO::PARAM_STR
            ),
            2 => array(
                'field' => ':gender',
                'value' => $gender,
                'type' => PDO::PARAM_STR
            ),
            3 => array(
                'field' => ':nickname',
                'value' => $nickname,
                'type' => PDO::PARAM_STR
            ),
            4 => array(
                'field' => ':origin',
                'value' => $origin,
                'type' => PDO::PARAM_STR
            )
        );
        $results = $this->queryPrepareExecute($query, $binds);
        return $results;
    }

    //modification d'enseignant dans la bdd
    public function updateTeacher($id, $firstname, $surname, $gender , $nickname, $origin){
        $query = "UPDATE t_teacher SET teaFirstname = :surname,  teaName = :firstname,  teaGender = :gender , teaNickname = :nickname, teaOrigin = :origin WHERE idTeacher = :id";
        $binds = array(
            0 => array(
                'field' => ':id',
                'value' => $id,
                'type' => PDO::PARAM_INT
            ),
            1 => array(
                'field' => ':surname',
                'value' => $surname,
                'type' => PDO::PARAM_STR
            ),
            2 => array(
                'field' => ':firstname',
                'value' => $firstname,
                'type' => PDO::PARAM_STR
            ),
            3 => array(
                'field' => ':gender',
                'value' => $gender,
                'type' => PDO::PARAM_STR
            ),
            4 => array(
                'field' => ':nickname',
                'value' => $nickname,
                'type' => PDO::PARAM_STR
            ),
            5 => array(
                'field' => ':origin',
                'value' => $origin,
                'type' => PDO::PARAM_STR
            )
        );
        $results = $this->queryPrepareExecute($query, $binds);
        return $results;
    }

    //modifcation de la section d'un enseignant 
    public function updateSectionTeacher($surname, $firstname, $gender , $nickname, $origin){
        $query = "UPDATE t_teacher SET teaFirstname = :surname,  teaName = :firstname,  teaGender = :gender , teaNickname = :nickname, teaOrigin = :origin";
        $binds = array(
            0 => array(
                'field' => ':surname',
                'value' => $surname,
                'type' => PDO::PARAM_STR
            ),
            1 => array(
                'field' => ':firstname',
                'value' => $firstname,
                'type' => PDO::PARAM_STR
            ),
            2 => array(
                'field' => ':gender',
                'value' => $gender,
                'type' => PDO::PARAM_STR
            ),
            3 => array(
                'field' => ':nickname',
                'value' => $nickname,
                'type' => PDO::PARAM_STR
            ),
            4 => array(
                'field' => ':origin',
                'value' => $origin,
                'type' => PDO::PARAM_STR
            )
        );
        $results = $this->queryPrepareExecute($query, $binds);
        return $results;
    }

    //ajout de section pour un ensegniant 
    public function addTeacherSection($section){
        $query = "INSERT INTO t_teaches (fkteacher, fksection) VALUES (LAST_INSERT_ID(), :fksection)";
        $binds = array(
            0 => array(
                'field' => ':fksection',
                'value' => $section,
                'type' => PDO::PARAM_INT
            )
        );
        $results = $this->queryPrepareExecute($query, $binds);
        return $results;
    }

    //Supprimer un enseigant via son ID
    public function deleteOneTeacher($id){
        $query = "DELETE FROM t_teacher WHERE idTeacher = :id";
        $binds = array(
            0 => array(
                'field' => ':id',
                'value' => $id,
                'type' => PDO::PARAM_INT
            )    
        );
        $reqExecuted = $this->queryPrepareExecute($query, $binds);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

    //Connexion d'un utilisateur à la bdd
    // public function connectUser($login, $psw){
    //     $query = "SELECT * FROM t_user WHERE useLogin = ? AND usePassword = ?) VALUES (:useLogin, :usePassword)";
    //     $binds = array(
    //         0 => array(
    //             'field' => ':useLogin',
    //             'value' => $useLogin,
    //             'type' => PDO::PARAM_INT
    //         ),
    //         1 => array(
    //             'field' => ':usePassword',
    //             'value' => $usePassword,
    //             'type' => PDO::PARAM_STR
    //         )    
    //     );
    //     $reqExecuted = $this->queryPrepareExecute($query, $binds);
    //     $results = $this->formatData($reqExecuted);
    //     $this->unsetData($reqExecuted);
    //     return $results;
    // }

}
?>