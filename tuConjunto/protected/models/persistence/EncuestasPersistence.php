<?php

/**
 * Permite controlar la persistencia de asambleas y encuestas.
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class EncuestasPersistence {

    /**
     * Permite crear una asamblea o encuesta.
     * @param type $encuesta Informacion de la asamblea o encuesta.
     * @param type $conjunto Informacion del conjunto.
     * @return boolean
     */
    public function crearEncuesta($encuesta, $conjunto) {
        $encuesta->Conjuntos_idConjunto = $conjunto->idConjunto;

        if ($encuesta->save()) {
            return true;
        }
        return false;
    }

    /**
     * Permite modificar una asamblea o encuesta.
     * @param type $encuesta Nueva informacion de la asamblea o encuesta.
     * @return boolean
     */
    public function modificarEncuesta($encuesta) {
        if ($encuesta->save()) {
            return true;
        }
        return false;
    }

    /**
     * Permite agregar una pregunta a una asamblea.
     * @param type $pregunta Informacion de la pregunta.
     * @param type $idAsamblea ID de la asamblea.
     * @return boolean
     */
    public function agregarPreguntaAsamblea($pregunta, $idAsamblea) {
        $pregunta->tipo = "C"; // Pregunta cerrada (S/N)
        $pregunta->Asambleas_idAsamblea = $idAsamblea;

        if ($pregunta->save()) {
            return true;
        }
        return false;
    }

    /**
     * Permite modificar una pregunta.
     * @param type $pregunta Nueva informacion de la pregunta.
     * @return boolean
     */
    public function modificarPregunta($pregunta) {
        if ($pregunta->save()) {
            return true;
        }
        return false;
    }

    /**
     * Permite responder a una asamblea.
     * @param type $idUser ID del usuario.
     * @param type $idPregunta ID de la pregunta.
     * @param type $opcion La opcion seleccionada (Si o No).
     * @param type $idAsamblea ID de la asamblea
     * @return boolean
     */
    public function responderAsamblea($idUser, $idPregunta, $opcion, $idAsamblea) {
        $contacto = Contactos::getContacto($idUser);
        if ($contacto != null) {
            $inmueble = Inmuebles::model()->find(array(
                'condition' => "idTitular = $contacto->idContacto",
            ));
            if ($inmueble != null) {
                $asmbl = Asambleas::model()->findByPk($idAsamblea);
                $today = date('Y-m-d');
                $inicio = date($asmbl->fechaInicio);
                $fin = date($asmbl->fechaFin);
                if ($inicio <= $today && $today <= $fin) {
                    Yii::app()->db->createCommand("INSERT INTO respuestas (Preguntas_idPregunta, respuesta, Inmuebles_idInmueble) "
                            . "VALUES ('$idPregunta', '$opcion', '$inmueble->idInmueble') ")->execute();
                    return true;
                } else {
                    throw new CHttpException(403, Asambleas::$asambleasTimeout);
                }
            } else {
                throw new CHttpException(403, Asambleas::$asambleasTitular);
            }
        }
        return false;
    }

    /**
     * Permite crear una pregunta a una encuesta.
     * @param type $idEncuesta ID de la encuesta.
     * @param type $question Informacion de la pregunta.
     * @return type
     */
    public function crearPreguntaEncuesta($idEncuesta, $question) {
        $question->Encuestas_idEncuesta = $idEncuesta;

        $transaction = $question->dbConnection->beginTransaction();
        $fail = false;
        if ($question->save()) {
            if ($question->tipo == Question::$SiNo) {
                $answerYes = new Answer;
                $answerYes->Question_idQuestion = $question->idQuestion;
                $answerYes->contenido = "Sí";

                $answerNo = new Answer;
                $answerNo->Question_idQuestion = $question->idQuestion;
                $answerNo->contenido = "No";

                if ($answerYes->save() && $answerNo->save()) {
                    $transaction->commit();
                } else {
                    $fail = true;
                }
            } else {
                $transaction->commit();
            }
        } else {
            $fail = true;
        }
        if ($fail) {
            $transaction->rollback();
        }
        return !$fail;
    }

    /**
     * Permite responder a una encuesta.
     * @param type $respuestas Respuestas seleccionadas.
     * @param type $inmueble Informacion del inmueble que respondio.
     * @return type
     */
    public function responderEncuesta($respuestas, $inmueble) {
        $transaction = Inmuebleanswer::model()->dbConnection->beginTransaction();
        $success = true;

        foreach ($respuestas as $respuesta) {
            $sql = Yii::app()->db->createCommand("INSERT INTO inmuebleanswer (Answer_idAnswer, Inmuebles_idInmueble) "
                    . "VALUES ('$respuesta', '$inmueble->idInmueble') ");
            $success = $success && $sql->execute();
        }

        if ($success) {
            $transaction->commit();
        } else {
            $transaction->rollback();
        }
        return $success;
    }

    /**
     * Permite adicionar una opcion a una pregunta de seleccion multiple de una encuesta.
     * @param type $answer Informacion de la opcion de respuesta (objeto tipo Answer).
     * @return boolean
     */
    public function adicionarOpcionPreguntaEncuesta($answer) {
        if ($answer->save()) {
            return true;
        }
        return false;
    }

    public function modificarOpcionPreguntaEncuesta($answer) {
        if ($answer->save()) {
            return true;
        }
        return false;
    }

}
