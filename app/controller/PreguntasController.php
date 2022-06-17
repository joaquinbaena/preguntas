<?php
namespace App\Controller;

use App\Models\Preguntas;
use App\Models\Opciones;
use App\Models\Usuarios;

class PreguntasController extends BaseController {

    public function crearPreguntas() {
        $data = array();
        $data['presentacion'] = $_SESSION['data'];

        if (isset($_POST['actualizar'])) {
            
            $procesaFormulario = true;
            $error = false;

            if (empty($_POST['pregunta'])) {
                $procesaFormulario = true;
                $error = true;
            }

            if (empty($_POST['varios'])) {
                $procesaFormulario = true;
                $error = true;
            }

            if ($error) {
                $data['error_pregunta'] = 'La pregunta es obligatoria';
                $this->renderHTML('../app/view/admin/crear_pregunta.php', $data);
            }

            if ($procesaFormulario) {
                $data['numOpciones'] = $_POST;
                $this->renderHTML('../app/view/admin/crear_pregunta.php', $data);                
            }
            
        } else {
            $this->renderHTML('../app/view/admin/crear_pregunta.php', $data);
        }
        
        if (isset($_POST['guardar'])) {

            $pregunta = new Preguntas();
            $pregunta->setDescripcion_pregunta($_POST['pregunta']);
            $pregunta->setEntity();
            $lastIdArr = $pregunta->getLastId();
            $lastId = $lastIdArr[0]['id_pregunta'];

            $opciones = $_POST['varios'];
            $obj = new Opciones();

            foreach ($_POST as $opcion => $valor) {
                if (strpos($opcion, 'opcion') !== false) {
                    $obj->setopcion($valor);
                    $obj->setId_pregunta($lastId);
                    $obj->setEntity();
                }
            }

        }
    }

}