<?php 

namespace App\Models;
require_once("DBAbstractModel.php");

class Preguntas extends DBAbstractModel {
    public $id_pregunta;
    public $descripcion_pregunta;

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

    public function setId_pregunta($id_pregunta){
        $this->id_pregunta = $id_pregunta;
    }

    public function setDescripcion_pregunta($descripcion_pregunta){
        $this->descripcion_pregunta = $descripcion_pregunta;
    }

    public function getId_pregunta(){
        return $this->id_pregunta;
    }

    public function getDescripcion_pregunta(){
        return $this->descripcion_pregunta;
    }

    public function getAll(){
        $this->query = "SELECT * FROM preguntas";
        $this->get_results_from_query();
        return $this->rows;
    }

    // conseguir el ultimo id de la tabla preguntas
    public function getLastId(){
        $this->query = "SELECT id_pregunta FROM preguntas ORDER BY id_pregunta DESC LIMIT 1";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function setEntity() {
        $this->query = "INSERT INTO preguntas (descripcion_pregunta) VALUES (:descripcion_pregunta)";
        $this->parametros['descripcion_pregunta'] = $this->descripcion_pregunta;
        $this->get_results_from_query();
    }

    public function getEntity($id_pregunta){
        $this->query = "SELECT * FROM preguntas WHERE id_pregunta = :$id_pregunta";
        $this->parametros['id_pregunta'] = $id_pregunta;
        $this->parametros['descripcion_pregunta'] = $this->descripcion_pregunta;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getEntity2(){
        $this->query = "SELECT * FROM preguntas WHERE id_pregunta = :id_pregunta";
        $this->parametros['id_pregunta'] = $this->id_pregunta;
        $this->parametros['descripcion_pregunta'] = $this->descripcion_pregunta;
        $this->get_results_from_query();
        return $this->rows;
    }
    
    public function editEntity() {
        $this->query = "UPDATE preguntas SET descripcion_pregunta = :descripcion_pregunta WHERE id_pregunta = :id_pregunta";
        $this->parametros['id_pregunta'] = $this->id_pregunta;
        $this->parametros['descripcion_pregunta'] = $this->descripcion_pregunta;
        $this->get_results_from_query();
    }
    
    public function deleteEntity($id_pregunta){
        $this->query = "DELETE FROM preguntas WHERE id_pregunta = :$id_pregunta";
        $this->get_results_from_query();
    }
    
    // leer
    public function getAllByEncuesta2($id_encuesta){
        $this->query = "SELECT * FROM preguntas WHERE id_pregunta NOT IN (SELECT id_pregunta FROM encuesta_pregunta WHERE id_encuesta = :$id_encuesta)";
        $this->get_results_from_query();
        return $this->rows;
    }

}


?>