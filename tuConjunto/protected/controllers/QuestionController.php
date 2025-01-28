<?php

/**
 * Description of QuestionController
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class QuestionController extends Controller {

    public $param = Funcion::encuesta;

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform all possible actions
                'actions' => array('index', 'create', 'delete', 'view', 'update', 'addChoice', 'viewChoices', 'setChoice'),
                'roles' => array(CrugeAuthitem2::$rolConcejo, CrugeAuthitem2::$rolAdministrador),
            ),
            array('allow', // allow all users to perform all possible actions
                'actions' => array('answer'),
                'roles' => array(CrugeAuthitem2::$rolResidente),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id, $encuesta) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'id' => $encuesta,
        ));
    }

    public function actionCreate($encuesta) {
        $model = new Question;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Question'])) {
            $model->attributes = $_POST['Question'];

            $preguntasPersistence = new EncuestasPersistence;
            if ($preguntasPersistence->crearPreguntaEncuesta($encuesta, $model)) {
                $this->redirect(array('view', 'id' => $model->idQuestion, 'encuesta' => $encuesta));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'id' => $encuesta,
        ));
    }

    public function actionUpdate($id, $encuesta) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Question'])) {
            $model->attributes = $_POST['Question'];

            $preguntasPersistence = new EncuestasPersistence;
            if ($preguntasPersistence->modificarPregunta($model)) {
                $this->redirect(array('view', 'id' => $model->idQuestion, 'encuesta' => $encuesta));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'id' => $encuesta,
        ));
    }

    public function actionAnswer($encuesta) {
        $idUser = Yii::app()->user->id;
        $contacto = Contactos::getContacto($idUser);
        if ($contacto != null) {
            $inmueble = Inmuebles::model()->find(array(
                'condition' => "idTitular = $contacto->idContacto",
            ));
            if ($inmueble != null) {
                $encsts = Encuestas::model()->findByPk($encuesta);
                $today = date('Y-m-d');
                $inicio = date($encsts->fechaInicio);
                $fin = date($encsts->fechaFin);
                if ($today <= $fin) {
                    if ($inicio <= $today) {
                        $preguntas = Question::model()->findAll(array('condition' => "Encuestas_idEncuesta = $encuesta"));

                        if (isset($_POST['Respuestas'])) {
                            $respuestas = $_POST['Respuestas'];

                            $preguntasPersistence = new EncuestasPersistence;
                            if ($preguntasPersistence->responderEncuesta($respuestas, $inmueble)) {
                                $this->redirect(array('/encuestas/view', 'id' => $encuesta));
                            }
                        }

                        $this->render('answer', array(
                            'preguntas' => $preguntas,
                            'encuesta' => $encsts,
                        ));
                    } else {
                        throw new CHttpException(403, Encuestas::$encuestasBefore);
                    }
                } else {
                    throw new CHttpException(403, Encuestas::$encuestasTimeout);
                }
            } else {
                throw new CHttpException(403, Encuestas::$encuestasTitular);
            }
        } else {
            throw new CHttpException(404, "The requested page does not exist.");
        }
    }

    public function actionAddChoice($id, $encuesta) {
        $encsts = Encuestas::model()->findByPk($encuesta);
        $today = date('Y-m-d');
        $fin = date($encsts->fechaFin);
        if ($today <= $fin) {
            $question = $this->loadModel($id);
            $model = new Answer;
            $model->Question_idQuestion = $question->idQuestion;

            if (isset($_POST['Answer'])) {
                $model->attributes = $_POST['Answer'];

                $preguntasPersistence = new EncuestasPersistence;
                if ($preguntasPersistence->adicionarOpcionPreguntaEncuesta($model)) {
                    $this->redirect(array('viewChoices', 'id' => $question->idQuestion, 'encuesta' => $encuesta));
                }
            }

            $this->render('addChoice', array(
                'model' => $model,
                'idEncuesta' => $encuesta,
                'question' => $question,
            ));
        } else {
            throw new CHttpException(403, Encuestas::$encuestasTimeout);
        }
    }

    public function actionSetChoice($id, $encuesta, $answer) {
        $encsts = Encuestas::model()->findByPk($encuesta);
        $today = date('Y-m-d');
        $fin = date($encsts->fechaFin);
        if ($today <= $fin) {
            $question = $this->loadModel($id);
            $model = $this->loadModelAnswer($answer);

            if (isset($_POST['Answer'])) {
                $model->attributes = $_POST['Answer'];

                $preguntasPersistence = new EncuestasPersistence;
                if ($preguntasPersistence->modificarOpcionPreguntaEncuesta($model)) {
                    $this->redirect(array('viewChoices', 'id' => $question->idQuestion, 'encuesta' => $encuesta));
                }
            }

            $this->render('setChoice', array(
                'model' => $model,
                'idEncuesta' => $encuesta,
                'question' => $question,
            ));
        } else {
            throw new CHttpException(403, Encuestas::$encuestasTimeout);
        }
    }

    public function actionViewChoices($id, $encuesta) {
        $question = $this->loadModel($id);
        $model = new Answer('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Answer'])) {
            $model->attributes = $_GET['Answer'];
        }

        $encsts = Encuestas::model()->findByPk($encuesta);
        $today = date('Y-m-d');
        $fin = date($encsts->fechaFin);
        if ($today <= $fin) {
            $this->render('viewChoices', array(
                'model' => $model,
                'idEncuesta' => $encuesta,
                'question' => $question,
            ));
        } else {
            throw new CHttpException(403, Encuestas::$encuestasTimeout);
        }
    }

    public function actionDelete($id) {
        throw new CHttpException(404, "No se puede realizar esta opción.");
    }

    public function actionIndex($encuesta) {
        $model = new Question('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Question'])) {
            $model->attributes = $_GET['Question'];
        }

        $encsts = Encuestas::model()->findByPk($encuesta);
        $today = date('Y-m-d');
        $inicio = date($encsts->fechaInicio);
        $fin = date($encsts->fechaFin);
        if ($today <= $fin) {
            $this->render('index', array(
                'model' => $model,
                'id' => $encuesta,
            ));
        } else {
            throw new CHttpException(403, Encuestas::$encuestasTimeout);
        }
    }

    public function loadModel($id) {
        $model = Question::model()->findByPk($id);
        if ($model === null) {// TODO PENDIENTE VALIDACION SEGURIDAD URL
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function loadModelAnswer($id) {
        $model = Answer::model()->findByPk($id);
        if ($model === null) {// TODO PENDIENTE VALIDACION SEGURIDAD URL
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'question-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
