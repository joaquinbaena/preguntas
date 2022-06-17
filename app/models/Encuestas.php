<?php 

namespace App\Models;
require_once("DBAbstractModel.php");

class Encuestas extends DBAbstractModel {
    public $id_encuesta;
    public $nombre_encuesta;

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

    public function setId_encuesta($id_encuesta){
        $this->id_encuesta = $id_encuesta;
    }

    public function setNombre_encuesta($nombre_encuesta){
        $this->nombre_encuesta = $nombre_encuesta;
    }

    public function getId_encuesta(){
        return $this->id_encuesta;
    }

    public function getNombre_encuesta(){
        return $this->nombre_encuesta;
    }

    public function getEncuestas(){
        $this->query = "SELECT * FROM encuestas";
        $this->get_results_from_query();
        if ($this->resultado) {
            $this->rows = array();
            foreach ($this->resultado as $fila) {
                array_push($this->rows, $fila);
            }
            $this->mensaje = "Encuestas encontradas";
        } else {
            $this->mensaje = "No se encontraron encuestas";
        }
        return $this->rows;
    }

    public function getAll(){
        $this->query = "SELECT * FROM encuestas";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getEntity($id_encuesta){
        $this->query = "SELECT * FROM encuestas WHERE id_encuesta = :$id_encuesta";
        $this->get_results_from_query();
        if ($this->resultado) {
            $this->rows = array();
            foreach ($this->resultado as $fila) {
                array_push($this->rows, $fila);
            }
            $this->mensaje = "Encuesta encontrada";
        } else {
            $this->mensaje = "No se encontró la encuesta";
        }
        return $this->rows;
    }

    public function setEntity(){
        $this->query = "INSERT INTO encuestas (nombre_encuesta) VALUES (:nombre_encuesta)";
        $this->parametros['nombre_encuesta'] = $this->nombre_encuesta;
        $this->get_results_from_query();
        $this->mensaje = "Encuesta creada";
    }

    // recoger ultimo id
    public function getLastId(){
        $this->query = "SELECT id_encuesta FROM encuestas ORDER BY id_encuesta DESC LIMIT 1";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function editEntity(){
        $this->query = "UPDATE encuestas SET nombre_encuesta = :nombre_encuesta WHERE id_encuesta = :id_encuesta";
        $this->parametros['id_encuesta'] = $this->id_encuesta;
        $this->parametros['nombre_encuesta'] = $this->nombre_encuesta;
        $this->get_results_from_query();
        $this->mensaje = "Encuesta actualizada";
    }

    public function deleteEntity($id_encuesta){
        $this->query = "DELETE FROM encuestas WHERE id_encuesta = :id_encuesta";
        $this->parametros['id_encuesta'] = $this->id_encuesta;
        $this->get_results_from_query();
        $this->mensaje = "Encuesta eliminada";
    }

}

?>