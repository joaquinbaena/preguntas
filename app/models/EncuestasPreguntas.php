<?php 

namespace App\Models;
require_once("DBAbstractModel.php");

class EncuestasPreguntas extends DBAbstractModel {
    public $id;
    public $id_pregunta;
    public $id_encuesta;
    //encuesta_pregunta
    private static $instancia;
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
        }
        return self::$instancia;
    }

    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setId_pregunta($id_pregunta){
        $this->id_pregunta = $id_pregunta;
    }

    public function setId_encuesta($id_encuesta){
        $this->id_encuesta = $id_encuesta;
    }

    public function getId(){
        return $this->id;
    }

    public function getId_pregunta(){
        return $this->id_pregunta;
    }

    public function getId_encuesta(){
        return $this->id_encuesta;
    }

    public function getAll(){
        $this->query = "SELECT * FROM encuesta_pregunta";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getAllByEncuesta(){
        $this->query = "SELECT id_pregunta FROM encuesta_pregunta WHERE id_encuesta = :id_encuesta";
        $this->parametros['id_encuesta'] = $this->id_encuesta;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getEntity ($id){
        $this->query = "SELECT * FROM encuesta_pregunta WHERE id = :$id";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function editEntity() {
        $this->query = "UPDATE encuesta_pregunta SET id_pregunta = :id_pregunta, id_encuesta = :id_encuesta WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->parametros['id_pregunta'] = $this->id_pregunta;
        $this->parametros['id_encuesta'] = $this->id_encuesta;
        $this->get_results_from_query();
    }

    public function deleteEntity($id) {
        $this->query = "DELETE FROM encuesta_pregunta WHERE id = :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
    }

    public function setEntity() {
        $this->query = "INSERT INTO encuesta_pregunta (id_pregunta, id_encuesta) VALUES (:id_pregunta, :id_encuesta)";
        $this->parametros['id_pregunta'] = $this->id_pregunta;
        $this->parametros['id_encuesta'] = $this->id_encuesta;
        $this->get_results_from_query();
    }

    public function getPregunta($id_pregunta){
        $this->query = "SELECT * FROM preguntas WHERE id = :$id_pregunta";
        $this->get_results_from_query();
        return $this->rows;
    }

    





}


?>