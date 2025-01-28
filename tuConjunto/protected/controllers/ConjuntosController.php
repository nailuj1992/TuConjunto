<?php

class ConjuntosController extends Controller {

    public $param = Funcion::conjunto;

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
                'actions' => array('index', 'create', 'delete'),
                'roles' => array('admin'),
            ),
            array('allow', // allow authenticated user to perform 'update' actions
                'actions' => array('view', 'update', 'imagenes', 'addImage', 'delImage'),
                'roles' => array(CrugeAuthitem2::$rolConcejo, CrugeAuthitem2::$rolAdministrador),
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
        $model = new Conjuntos;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Conjuntos'])) {
            $model->attributes = $_POST['Conjuntos'];
            $file = CUploadedFile::getInstance($model, 'logo');

            $conjuntosPersistence = new ConjuntosPersistence;
            if ($conjuntosPersistence->crearConjunto($model, $file)) {
                $this->redirect(array('view', 'id' => $model->idConjunto));
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
        $logo = $model->logo;
        $idCiudad = $model->Ciudades_idCiudades;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Conjuntos'])) {
            $model->attributes = $_POST['Conjuntos'];
            $file = CUploadedFile::getInstance($model, 'logo');

            $conjuntosPersistence = new ConjuntosPersistence;
            if ($conjuntosPersistence->modificarConjunto($model, $file, $logo)) {
                $this->redirect(array('view', 'id' => $model->idConjunto));
            }
        }

        $model->Ciudades_idCiudades = $idCiudad;
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
        throw new CHttpException(404, "No se puede realizar esta opción.");
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Conjuntos('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Conjuntos'])) {
            $model->attributes = $_GET['Conjuntos'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Conjuntos the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $conjunto = Conjuntos::model()->getConjunto(Yii::app()->user->id);
        $model = Conjuntos::model()->findByPk($id);
        if ($model === null || ($model !== null && $conjunto != null && $model->idConjunto != $conjunto->idConjunto)) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Conjuntos $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'conjuntos-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDynamicCities() {
        $data = Ciudades::model()->findAll('Departamentos_idDepartamentos = :idDepartamento', array(':idDepartamento' => (int) $_POST['Conjuntos']['departamento']));
        echo CHtml::tag('option', array('value' => ''), CHtml::encode(Ciudades::$seleccioneCiudad), true);
        $cities = CHtml::listData($data, 'idCiudades', 'nombre');
        foreach ($cities as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionImagenes($id) {
        $model = new Imagenes('search');
        $model->unsetAttributes();  // clear any default values
        $conjunto = $this->loadModel($id);

        $this->render('imagenes', array(
            'model' => $model,
            'conjunto' => $conjunto,
        ));
    }

    public function actionAddImage($id) {
        $model = new Imagenes;
        $model->Conjuntos_idConjunto = $id;

        $imagenes = Imagenes::model()->findAll(Imagenes::buscarCriteria($id));
        if (sizeof($imagenes) < Imagenes::$maximoImagenes) {
            if (isset($_POST['Imagenes'])) {
                $model->attributes = $_POST['Imagenes'];
                $file = CUploadedFile::getInstance($model, 'nombre');
                if ($file != null) {
                    if ($file->size <= Imagenes::maxSize()) {
                        $conjuntosPersistence = new ConjuntosPersistence;
                        if ($conjuntosPersistence->adicionarImagen($model, $file)) {
                            $this->redirect(array('imagenes', 'id' => $model->Conjuntos_idConjunto));
                        }
                    } else {
                        $model->addError('nombre', "El tamaño máximo a subir debe ser de " . Imagenes::$size . " MB.");
                    }
                } else {
                    $model->addError('nombre', 'Debe ingresar una imagen.');
                }
            }

            $this->render('addImage', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException(403, "La cantidad de imágenes subida excede el tope máximo de " . Imagenes::$maximoImagenes . ".");
        }
    }

    public function actionDelImage($id) {
        $model = Imagenes::model()->findByPk($id);
        $model->delete();
        $this->redirect(array('imagenes', 'id' => $model->Conjuntos_idConjunto));
    }

}
