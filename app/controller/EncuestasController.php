<?php
namespace App\Controller;

use App\Models\Preguntas;
use App\Models\Usuarios;
use App\Models\Encuestas;
use App\Models\EncuestasPreguntas;
use App\Models\Respuesta;
use App\Models\Opciones;

class EncuestasController extends BaseController {

    public function crearEncuestas() {
        $data = array();
        $data['presentacion'] = $_SESSION['data'];
        $objPreguntas = new Preguntas();
        $data['allPreguntas'] = $objPreguntas->getAll();

        if (isset($_POST['guardar'])) {
            
            $procesaFormulario = true;
            $error = false;

            if (empty($_POST['encuesta'])) {
                $procesaFormulario = true;
                $error = true;
            }

            if (empty($_POST['preguntas'])) {
                $procesaFormulario = true;
                $error = true;
            }

            if ($error) {
                $data['error_pregunta'] = 'La pregunta es obligatoria';
                $this->renderHTML('../app/view/admin/crear_encuesta.php', $data);
            }

            if ($procesaFormulario) {
                $objEncuesta = new Encuestas();
                $objEncuesta->setNombre_encuesta($_POST['encuesta']);
                $objEncuesta->setEntity();
                $arrEncuesta = $objEncuesta->getLastId();
                $idEncuesta = $arrEncuesta[0]['id_encuesta'];

                $objEncuestaPregunta = new EncuestasPreguntas();
                $preguntas = $_POST['preguntas'];
                for ($i=0; $i < count($preguntas); $i++) { 
                    $objEncuestaPregunta->setId_encuesta($idEncuesta);
                    $objEncuestaPregunta->setId_pregunta($preguntas[$i]);
                    $objEncuestaPregunta->setEntity();
                } 
                $this->renderHTML('../app/view/admin/crear_encuesta.php', $data);
               
            }
            
        } else {
            $this->renderHTML('../app/view/admin/crear_encuesta.php', $data);
        }

    }

    public function responderEncuesta() {
        $data = array();
        $data['presentacion'] = $_SESSION['data'];
        // obtener todas las encuestas
        $objEncuestas = new Encuestas();
        $data['allEncuestas'] = $objEncuestas->getAll();

        if (isset($_POST['actualizar'])) {

            $encuesta = $_POST['encuesta'];
            $objEncuestaPregunta = new EncuestasPreguntas();
            $objEncuestaPregunta->setId_encuesta($encuesta);
            $data['allPreguntas'] = $objEncuestaPregunta->getAllByEncuesta();
            $data['preguntas'] = array();
            foreach($data['allPreguntas'] as $preguntas) {
                $pregunta = new Preguntas();
                // $respuesta = new Opciones();
                // $respuesta = $respuesta->setId_pregunta($pregunta['id_pregunta']);
                $pregunta->setId_pregunta($preguntas['id_pregunta']);
                array_push($data['preguntas'], $pregunta->getEntity2());
            }
            echo '<pre>';
            print_r($data['preguntas']);
            echo '</pre>';
            $this->renderHTML('../app/view/usuario/responder_encuesta.php', $data);
        } else {
            $this->renderHTML('../app/view/usuario/responder_encuesta.php', $data);
        }
        
    }

}