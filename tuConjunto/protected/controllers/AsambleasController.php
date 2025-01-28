<?php

class AsambleasController extends Controller {

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
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('index', 'view'),
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

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $model = new Asambleas;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Asambleas'])) {
                $model->attributes = $_POST['Asambleas'];

                $asambleasPersistence = new EncuestasPersistence;
                if ($asambleasPersistence->crearEncuesta($model, $conjunto)) {
                    $this->redirect(array('view', 'id' => $model->idAsamblea));
                }
            }

            $this->render('create', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException(404, Conjuntos::$noConjuntoEnlazado);
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $model = $this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Asambleas'])) {
                $model->attributes = $_POST['Asambleas'];

                $asambleasPersistence = new EncuestasPersistence;
                if ($asambleasPersistence->modificarEncuesta($model)) {
                    $this->redirect(array('view', 'id' => $model->idAsamblea));
                }
            }

            $this->render('update', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException(404, Conjuntos::$noConjuntoEnlazado);
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
    public function actionIndex() {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $model = new Asambleas('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Asambleas'])) {
                $model->attributes = $_GET['Asambleas'];
            }

            $this->render('index', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException(404, Conjuntos::$noConjuntoEnlazado);
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Asambleas the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $conjunto = Conjuntos::model()->getConjunto(Yii::app()->user->id);
        $model = Asambleas::model()->findByPk($id);
        if ($model === null || ($model !== null && $conjunto != null && $model->Conjuntos_idConjunto != $conjunto->idConjunto)) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Asambleas $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'asambleas-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
