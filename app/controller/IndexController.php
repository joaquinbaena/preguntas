<?php
namespace App\Controller;

use App\Core\Router;
use App\Models\Usuarios;

class IndexController extends BaseController {

    public function indexAction() 
    {
        if(isset($_SESSION['data'])) {
            if($_SESSION['perfil'] == "admin") {
                $data = $_SESSION['data'];
                $this->renderHTML('../app/view/admin/index_admin.php', $data);
            }elseif($_SESSION['perfil'] == "usuario") {
                $data = $_SESSION['data'];
                $this->renderHTML('../app/view/usuario/index_usuario.php', $data);
            }
        }elseif (isset($_POST['login'])) {
            $procesaFormulario = true;
            $error = false;
            $data = array();

            if (empty($_POST['usuario'])) {
                $procesaFormulario = true;
                $error = true;
                $data['error_usuario'] = 'El usuario es obligatorio';
            }
            
            if (empty($_POST['password'])) {
                $procesaFormulario = true;
                $error = true;
                $data['error_password'] = 'La password es obligatorio';
            }
            
            if ($error) {
                $this->renderHTML('../app/view/index_view.php', $data);
            }

            if ($procesaFormulario) {
                $usuario = new Usuarios();
                $usuario->setUsuario($_POST['usuario']);
                $usuario->setPassword($_POST['password']);

                $data = $usuario->login();
                if ($data) {
                    if ($data['perfil'] === 'admin') {
                        $_SESSION['perfil'] = 'admin';
                        $_SESSION['id_usuario'] = $data['id_usuario'];
                        $_SESSION['data'] = $data;
                        $this->renderHTML('../app/view/admin/index_admin.php', $data);

                    } elseif ($data['perfil'] === 'usuario') {
                        $_SESSION['perfil'] = 'usuario';
                        $_SESSION['id_usuario'] = $data['id_usuario'];
                        $_SESSION['data'] = $data;
                        //modificar vista y por consecuencia la ruta de la linea de abajo
                        $this->renderHTML('../app/view/usuario/index_usuario.php', $data);

                    }
                }
            }

        } else {
            $this->renderHTML('../app/view/index_view.php');
        }
    }

    public function registroAction()
    {
        if(isset($_POST['registrar'])){
            $usuario = new Usuarios();
            $usuario->setNombre($_POST['nombre']);
            $usuario->setUsuario($_POST['usuario']);
            $usuario->setPassword($_POST['password']);
            $usuario->setPerfil($_POST['perfil']);
            $usuario->setEntity();
            $this->renderHTML('../app/view/usuario_registrado.php');
        }else{
            $this->renderHTML('../app/view/registro_view.php');
        }
    }

    public function cerrarSesion() 
    {
        session_unset();
        session_destroy();
        $this->renderHTML('../app/view/cerrar_sesion.php');
    }
}