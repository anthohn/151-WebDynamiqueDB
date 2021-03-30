<?php
/**
 * Auteur : Anthony Höhn
 * Date : 15.03.2021
 * Description :
 */

 class Database {
    // Variable de classe
    private $connector;

    public function __construct(){
    try{
        $this->connector = new PDO("mysql:host=localhost;dbname=db_nickname_anthohn;charset=utf8", "dbNicknameUser", "grp2B_21");
        }catch(PDOException $e){
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


    private function unsetData($req){
        $req->closeCursor(); //Vider le jeu d’enregistrements
    }


    public function getAllTeachers(){
        $query = "SELECT * FROM t_teacher ORDER BY idTeacher DESC";
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);
        $this->unsetData($reqExecuted);
        return $results;
    }

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


    public function getAllSections(){
        $query = 'SELECT * FROM t_teaches JOIN t_teacher ON t_teaches.idxTeacher = t_teacher.idTeacher JOIN t_section ON t_teaches.idxSection = t_section.idSection';
        $reqExecuted = $this->querySimpleExecute($query);
        $results = $this->formatData($reqExecuted);

        $this->unsetData($reqExecuted);
        return $results;
    }

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
}
?>