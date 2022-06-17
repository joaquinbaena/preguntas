<?php 

namespace App\Models;
require_once("DBAbstractModel.php");

class Usuarios extends DBAbstractModel {
    public $id_usuario;
    public $nombre;
    public $usuario;
    public $password;
    public $perfil;

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

    public function setId_usuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setPerfil($perfil){
        $this->perfil = $perfil;
    }

    public function getId_usuario(){
        return $this->id_usuario;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function getPassword(){
        return $this->password;
    }
    public function getPerfil(){
        return $this->perfil;
    }

    public function getAll() {
        $this->query = "SELECT * FROM usuarios";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function login() {
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";
        $this->parametros['usuario'] = $this->usuario;
        $this->parametros['password'] = $this->password;

        $this->get_results_from_query();
        if( count($this->rows) == 1 ){
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad=$valor;
            }
            $data['cuenta'] = $this->rows[0];
            $data['perfil'] = $this->rows[0]['perfil'];
            $data['nombre'] = $this->rows[0]['nombre'];
            $data['id_usuario'] = $this->rows[0]['id_usuario'];
            $data['hora'] = date('H:i:s');
            $data['usuario'] = $this->usuario;
            //$data['bookmarks'] = $this->getBookmarks($this->rows[0]['id']);
        } else {
            echo "Usuario no encontrado";
        }
        if (isset($data['cuenta'])) {
            return $data??null;
        }
    }
    
    public function setEntity() {
        $this->query = "INSERT INTO usuarios (nombre, usuario, password, perfil) VALUES (:nombre, :usuario, :password, :perfil)";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['usuario'] = $this->usuario;
        $this->parametros['password'] = $this->password;
        $this->parametros['perfil'] = $this->perfil;
        $this->get_results_from_query();
    }

    public function editEntity() {
        $this->query = "UPDATE usuarios SET nombre=:nombre, usuario=:usuario, password=:password, perfil=:perfil WHERE id_usuario=:id_usuario";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['usuario'] = $this->usuario;
        $this->parametros['password'] = $this->password;
        $this->parametros['perfil'] = $this->perfil;
        $this->parametros['id_usuario'] = $this->id_usuario;
        $this->get_results_from_query();
    }

    public function deleteEntity($id_usuario) {
        $this->query = "DELETE FROM usuarios WHERE id_usuario=:id_usuario";
        $this->parametros['id_usuario'] = $id_usuario;
        $this->get_results_from_query();
    }
    
    public function getEntity($id_usuario) {
        $this->query = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
        $this->parametros['id_usuario'] = $id_usuario;
        $this->get_results_from_query();
        if( count($this->rows) == 1 ) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad=$valor;
            }
            $this->mensaje = 'Usuario encontrado';
            return $this->rows[0];
        }
    }

}



?>