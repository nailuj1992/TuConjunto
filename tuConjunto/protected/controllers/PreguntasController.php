<?php

class PreguntasController extends Controller {

    public $param = Funcion::asamblea;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform all possible actions
                'actions' => array('index', 'create', 'delete', 'view', 'update'),
                'roles' => array(CrugeAuthitem2::$rolConcejo, CrugeAuthitem2::$rolAdministrador),
            ),
            array('allow', // allow all users to perform all possible actions
                'actions' => array('index', 'answer'),
                'roles' => array(CrugeAuthitem2::$rolResidente),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id, $asamblea) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'id' => $asamblea,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($asamblea) {
        $model = new Preguntas;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Preguntas'])) {
            $model->attributes = $_POST['Preguntas'];

            $preguntasPersistence = new EncuestasPersistence;
            if ($preguntasPersistence->agregarPreguntaAsamblea($model, $asamblea)) {
                $this->redirect(array('view', 'id' => $model->idPregunta, 'asamblea' => $asamblea));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'id' => $asamblea,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id, $asamblea) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Preguntas'])) {
            $model->attributes = $_POST['Preguntas'];

            $preguntasPersistence = new EncuestasPersistence;
            if ($preguntasPersistence->modificarPregunta($model)) {
                $this->redirect(array('view', 'id' => $model->idPregunta, 'asamblea' => $asamblea));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'id' => $asamblea,
        ));
    }

    public function actionAnswer($pregunta, $opcion, $asamblea) {
        $idUser = Yii::app()->user->id;

        $preguntasPersistence = new EncuestasPersistence;
        if ($preguntasPersistence->responderAsamblea($idUser, $pregunta, $opcion, $asamblea)) {
            $this->redirect(array("/preguntas?asamblea=$asamblea"));
        } else {
            throw new CHttpException(403, Contactos::$contactoRegistrado);
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        throw new CHttpException(404, "No se puede realizar esta opción.");
    }

    /**
     * Lists all models.
     */
    public function actionIndex($asamblea) {
        $model = new Preguntas('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Preguntas'])) {
            $model->attributes = $_GET['Preguntas'];
        }

        $asmbl = Asambleas::model()->findByPk($asamblea);
        $today = date('Y-m-d');
        $inicio = date($asmbl->fechaInicio);
        $fin = date($asmbl->fechaFin);
        if ($today <= $fin) {
            $residente = Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente);
            $concejo = Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo);
            $administrador = Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador);
            if ($concejo || $administrador || ($residente && $inicio <= $today)) {
                $this->render('index', array(
                    'model' => $model,
                    'id' => $asamblea,
                ));
            } else if ($residente && $inicio > $today) {
                throw new CHttpException(403, Asambleas::$asambleasBefore);
            }
        } else {
            throw new CHttpException(403, Asambleas::$asambleasTimeout);
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Preguntas the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Preguntas::model()->findByPk($id);
        if ($model === null) {// TODO PENDIENTE VALIDACION SEGURIDAD URL
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Preguntas $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'preguntas-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
