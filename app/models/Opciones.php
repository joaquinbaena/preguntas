<?php 

namespace App\Models;
require_once("DBAbstractModel.php");

class Opciones extends DBAbstractModel {
    public $id_opcion;
    public $opcion;
    public $id_pregunta;

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

    public function setId_opcion($id_opcion){
        $this->id_opcion = $id_opcion;
    }

    public function setOpcion($opcion){
        $this->opcion = $opcion;
    }

    public function setId_pregunta($id_pregunta){
        $this->id_pregunta = $id_pregunta;
    }

    public function getId_opcion(){
        return $this->id_opcion;
    }

    public function getOpcion(){
        return $this->opcion;
    }

    public function getId_pregunta(){
        return $this->id_pregunta;
    }

    public function getAll(){
        $this->query = "SELECT * FROM opciones";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getAllByPregunta(){
        $this->query = "SELECT * FROM opciones WHERE id_pregunta = :id_pregunta";
        $this->parametros['id_opcion'] = $this->id_opcion;
        $this->parametros['opcion'] = $this->opcion;
        $this->parametros['id_pregunta'] = $this->id_pregunta;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function setEntity() {
        $this->query = "INSERT INTO opciones (opcion, id_pregunta) VALUES (:opcion, :id_pregunta)";
        $this->parametros['opcion'] = $this->opcion;
        $this->parametros['id_pregunta'] = $this->id_pregunta;
        $this->get_results_from_query();
    }

    public function deleteEntity($id) {
        $this->query = "DELETE FROM opciones WHERE id_opcion = :$id";
        $this->parametros['id_opcion'] = $id;
        $this->get_results_from_query();
    }

    public function getEntity ($id){
        $this->query = "SELECT * FROM opciones WHERE id_opcion = :$id";
        $this->parametros['id_opcion'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function editEntity() {
        $this->query = "UPDATE opciones SET opcion = :opcion, id_pregunta = :id_pregunta WHERE id_opcion = :id_opcion";
        $this->parametros['opcion'] = $this->opcion;
        $this->parametros['id_pregunta'] = $this->id_pregunta;
        $this->parametros['id_opcion'] = $this->id_opcion;
        $this->get_results_from_query();
    }


}


?>