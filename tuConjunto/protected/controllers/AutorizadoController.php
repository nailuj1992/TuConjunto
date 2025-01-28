<?php

class AutorizadoController extends Controller {

    public $param = Funcion::autorizado;

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
                'actions' => array('index','create','update','bloquear','desbloquear'),
                'roles' => array(CrugeAuthitem2::$rolResidente),
            ),
            array('allow', // allow authenticated user to perform 'update' actions
                'actions' => array('index','view'),
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
    public function actionCreate(){
        $model = new Autorizado;
        $contacto = Contactos::model()->find("cruge_user_iduser=:cruge_user_iduser",array(":cruge_user_iduser" => Yii::app()->user->id));
        $model->Inmuebles_idInmueble=$contacto->Inmuebles_idInmueble;
        $model->bloqueado=0;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Autorizado'])) {
   
            $model->attributes = $_POST['Autorizado'];
            $file = CUploadedFile::getInstance($model, 'foto');
            
            $autorizadoPersistence = new AutorizadoPersistence;
            if ($autorizadoPersistence->crearAutorizado($model, $file)) {
                $this->redirect(array('index'));
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
        $foto = $model->foto;



        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Autorizado'])) {
            $model->attributes = $_POST['Autorizado'];
            
            $file = CUploadedFile::getInstance($model, 'foto');

            $autorizadoPersistence = new AutorizadoPersistence;
            if ($autorizadoPersistence->modificarAutorizado($model,$file,$foto)) {
               $this->redirect(array('index'));
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
        $model = new Autorizado('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Autorizado'])) {
            $model->attributes = $_GET['Autorizado'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }
    
    
    public function actionBloquear($id) {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
            $model->bloqueado=1;
            $mascotasPersistence = new MascotasPersistence;
            if ($mascotasPersistence->modificarMascota($model)) {
                $this->redirect(array('index'));
            }
        

        $this->render('index', array(
            'model' => $model,
        ));
    }
    
    
    public function actionDesbloquear($id) {
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
            $model->bloqueado=0;
            $mascotasPersistence = new MascotasPersistence;
            if ($mascotasPersistence->modificarMascota($model)) {
                $this->redirect(array('index'));
            }
        

        $this->render('index', array(
            'model' => $model,
        ));
    }
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Autorizado the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Autorizado::model()->findByPk($id);
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Autorizado $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'autorizado-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
