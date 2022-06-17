<?php 

namespace App\Models;
require_once("DBAbstractModel.php");

class Respuestas extends DBAbstractModel {
    public $id_respuesta;
    public $id_pregunta_encuesta;
    public $valor;

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

    public function setId_respuesta($id_respuesta){
        $this->id_respuesta = $id_respuesta;
    }

    public function setId_pregunta_encuesta($id_pregunta_encuesta){
        $this->id_pregunta_encuesta = $id_pregunta_encuesta;
    }
    
    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getId_respuesta(){
        return $this->id_respuesta;
    }

    public function getId_pregunta_encuesta(){
        return $this->id_pregunta_encuesta;
    }

    public function getValor($valor){
        return $this->valor = $valor;
    }

    public function getAll(){
        $this->query = "SELECT * FROM preguntas";
        $this->get_results_from_query();
        return $this->rows;
    }

    // conseguir el ultimo id de la tabla respuestas
    public function getLastId(){
        $this->query = "SELECT id_respuesta FROM respuestas ORDER BY id_respuesta DESC LIMIT 1";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function setEntity() {
        $this->query = "INSERT INTO preguntas (id_pregunta_encuesta, valor) VALUES (:id_pregunta_encuesta, :valor)";
        $this->parametros['id_pregunta_encuesta'] = $this->id_pregunta_encuesta;
        $this->parametros['valor'] = $this->valor;
        $this->get_results_from_query();
    }

    public function getEntity($id_respuesta){
        $this->query = "SELECT * FROM preguntas WHERE id_respuesta = :$id_respuesta";
        $this->get_results_from_query();
        return $this->rows;
    }
    
    public function editEntity() {
        $this->query = "UPDATE preguntas SET id_pregunta_encuesta = :id_pregunta_encuesta, valor = :valor WHERE id_respuesta = :id_respuesta";
        $this->parametros['id_respuesta'] = $this->id_respuesta;
        $this->parametros['id_pregunta_encuesta'] = $this->id_pregunta_encuesta;
        $this->parametros['valor'] = $this->valor;
        $this->get_results_from_query();
    }
    
    public function deleteEntity($id_respuesta){
        $this->query = "DELETE FROM respuestas WHERE id_respuesta = :$id_respuesta";
        $this->get_results_from_query();
    }
    
    // leer todos los registros de la tabla respuestas
    public function readAll(){
        $this->query = "SELECT * FROM respuestas";
        $this->get_results_from_query();
        return $this->rows;
    }

}


?>