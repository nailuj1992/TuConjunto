<?php

/**
 * Description of EncuestasController
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class EncuestasController extends Controller {

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
                'actions' => array('index', 'create', 'delete', 'view', 'update'),
                'roles' => array(CrugeAuthitem2::$rolConcejo, CrugeAuthitem2::$rolAdministrador),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'view'),
                'roles' => array(CrugeAuthitem2::$rolResidente),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $this->render('view', array(
                'model' => $this->loadModel($id),
            ));
        } else {
            throw new CHttpException(404, Conjuntos::$noConjuntoEnlazado);
        }
    }

    public function actionCreate() {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $model = new Encuestas;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Encuestas'])) {
                $model->attributes = $_POST['Encuestas'];

                $encuestasPersistence = new EncuestasPersistence;
                if ($encuestasPersistence->crearEncuesta($model, $conjunto)) {
                    $this->redirect(array('view', 'id' => $model->idEncuesta));
                }
            }

            $this->render('create', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException(404, Conjuntos::$noConjuntoEnlazado);
        }
    }

    public function actionUpdate($id) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $model = $this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Encuestas'])) {
                $model->attributes = $_POST['Encuestas'];

                $encuestasPersistence = new EncuestasPersistence;
                if ($encuestasPersistence->modificarEncuesta($model)) {
                    $this->redirect(array('view', 'id' => $model->idEncuesta));
                }
            }

            $this->render('update', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException(404, Conjuntos::$noConjuntoEnlazado);
        }
    }

    public function actionDelete($id) {
        throw new CHttpException(404, "No se puede realizar esta opción.");
    }

    public function actionIndex() {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $model = new Encuestas('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Encuestas'])) {
                $model->attributes = $_GET['Encuestas'];
            }

            $this->render('index', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException(404, Conjuntos::$noConjuntoEnlazado);
        }
    }

    public function loadModel($id) {
        $conjunto = Conjuntos::model()->getConjunto(Yii::app()->user->id);
        $model = Encuestas::model()->findByPk($id);
        if ($model === null || ($model !== null && $conjunto != null && $model->Conjuntos_idConjunto != $conjunto->idConjunto)) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'encuestas-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
