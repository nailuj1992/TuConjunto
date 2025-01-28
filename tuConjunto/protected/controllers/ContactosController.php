<?php

class ContactosController extends Controller {

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
                'actions' => array('index', 'create', 'delete','update'), 
                'roles' => array('admin'),
            ),
            array('allow', // allow authenticated user to perform 'update' actions
                'actions' => array('index','view','create'),
                'roles' => array(CrugeAuthitem2::$rolResidente),
            ),
            array('allow', // allow authenticated user to perform 'update' actions
                'actions' => array('index','view','create','update'),
                'roles' => array(CrugeAuthitem2::$rolAdministrador,CrugeAuthitem2::$rolConcejo),
            ),
            array('allow', // allow authenticated user to perform 'update' actions
                'actions' => array('dynamicCities'),
                'users' => array('@'),
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
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Contactos;
        $contacto = Contactos::model()->find("cruge_user_iduser=:cruge_user_iduser",array(":cruge_user_iduser" => Yii::app()->user->id));
        $model->Conjuntos_idConjunto=$contacto->Conjuntos_idConjunto;
        $model->Inmuebles_idInmueble=$contacto->Inmuebles_idInmueble;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

       if (isset($_POST['Contactos'])) {
            $model->attributes = $_POST['Contactos'];
            $file = CUploadedFile::getInstance($model, 'foto');

           $perfilPersistence = new PerfilPersistence;
            if ($perfilPersistence->modificarPerfil($model, $file, $model->foto)) {
                $this->redirect(array('autorizado/create'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Documentos'])) {
            $model->attributes = $_POST['Documentos'];

            $documentosPersistence = new DocumentosPersistence;
            if ($documentosPersistence->modificarDocumento(model)) {
                $this->redirect(array('view', 'id' => $model->idDocumentos));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
//        $this->loadModel($id)->delete();
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//        if (!isset($_GET['ajax']))
//            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        throw new CHttpException(404, "No se puede realizar esta opción.");
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Documentos('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Documentos'])) {
            $model->attributes = $_GET['Documentos'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Documentos the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Contactos::model()->findByPk($id);
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Documentos $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'documentos-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
