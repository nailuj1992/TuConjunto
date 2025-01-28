<?php

class InmueblesController extends Controller {

    public $param = Funcion::inmueble;

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
                'actions' => array('index', 'view', 'create', 'update', 'delete', 'excel', 'confirm'),
                'roles' => array(CrugeAuthitem2::$rolConcejo, CrugeAuthitem2::$rolAdministrador),
            ),
            array(
                'allow',
                'actions' => array(/* 'choose', */'titular', 'view', 'update'),
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
            $model = new Inmuebles;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (isset($_POST['Inmuebles'])) {
                $model->attributes = $_POST['Inmuebles'];

                $inmueblesPersistence = new InmueblesPersistence;
                if ($inmueblesPersistence->crearInmueble($model)) {
                    $this->redirect(array('view', 'id' => $model->idInmueble));
                }
            }

            $this->render('create', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException(404, Conjuntos::$noConjuntoEnlazado);
        }
    }

    public function actionExcel() {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $model = new Archivosexcel;

            if (isset($_POST['Archivosexcel'])) {
                $model->attributes = $_POST['Archivosexcel'];
                $file = CUploadedFile::getInstance($model, 'nombre');

                $excelPersistence = new InmueblesPersistence;
                if ($excelPersistence->agregarExcel($model, $file, $conjunto->idConjunto)) {
                    $this->redirect(array('confirm', 'id' => $model->idArchivosExcel));
                }
            }

            $this->render('excel', array(
                'model' => $model,
            ));
        } else {
            throw new CHttpException(404, Conjuntos::$noConjuntoEnlazado);
        }
    }

    public function actionConfirm($id) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $model = $this->loadModelExcel($id);

            if (isset($_POST['yt0'])) {// Boton Confirmar
                $excelPersistence = new InmueblesPersistence;
                if ($excelPersistence->confirmarExcel($model)) {
                    $this->redirect(array('index'));
                }
            } else if (isset($_POST['yt1'])) {// Boton Volver
                $model->delete();
                $this->redirect(array('excel'));
            }

            $this->render('confirm', array(
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

            if (isset($_POST['Inmuebles'])) {
                $model->attributes = $_POST['Inmuebles'];

                $inmueblesPersistence = new InmueblesPersistence;
                if ($inmueblesPersistence->modificarInmueble($model)) {
                    $this->redirect(array('view', 'id' => $model->idInmueble));
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
//        $this->loadModel($id)->delete();
//
//        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//        if (!isset($_GET['ajax']))
//            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        throw new CHttpException(404, "No se puede realizar esta opción.");
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $model = new Inmuebles('search');
            $model->unsetAttributes();  // clear any default values
            if (isset($_GET['Inmuebles'])) {
                $model->attributes = $_GET['Inmuebles'];
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
     * @return Inmuebles the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $conjunto = Conjuntos::model()->getConjunto(Yii::app()->user->id);
        $model = Inmuebles::model()->findByPk($id);
        if ($model === null || ($model !== null && $conjunto != null && $model->Conjuntos_idConjunto != $conjunto->idConjunto)) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function loadModelExcel($id) {
        $conjunto = Conjuntos::model()->getConjunto(Yii::app()->user->id);
        $model = Archivosexcel::model()->findByPk($id);
        if ($model === null || ($model !== null && $conjunto != null && $model->Conjuntos_idConjunto != $conjunto->idConjunto)) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Inmuebles $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'inmuebles-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionChoose() {
        $iduser = Yii::app()->user->id;
        $conjunto = Conjuntos::getConjunto($iduser);
        if ($conjunto != null) {
            $model = new Inmuebles;
            $contacto = Contactos::model()->find(Contactos::buscar($iduser));
            if ($contacto->Inmuebles_idInmueble == null) {
                if (isset($_POST['Inmuebles'])) {
                    $idInmueble = $_POST['Inmuebles']['idInmueble'];

                    $inmueblesPersistence = new InmueblesPersistence;
                    if ($inmueblesPersistence->escogerInmueble($contacto, $idInmueble)) {
                        $this->redirect(array('/'));
                    }
                }

                $this->render('choose', array(
                    'model' => $model,
                    'contacto' => $contacto,
                ));
            } else {
                throw new CHttpException(403, 'Usted ya es residente de un inmueble.');
            }
        } else {
            throw new CHttpException(404, Conjuntos::$noConjuntoEnlazado);
        }
    }

    public function actionTitular() {
        $iduser = Yii::app()->user->id;
        $conjunto = Conjuntos::getConjunto($iduser);
        if ($conjunto != null) {
            $contacto = Contactos::model()->find(Contactos::buscar($iduser));
            if ($contacto->Inmuebles_idInmueble != null) {
                $model = Inmuebles::model()->findByPk($contacto->Inmuebles_idInmueble);

                if ($model->idTitular == null) {
                    if (isset($_POST['yt0'])) {
                        $inmueblesPersistence = new InmueblesPersistence;
                        if ($inmueblesPersistence->asignarTitularInmueble($contacto, $model)) {
                            $this->redirect(array('/'));
                        }
                    }
                } else {
                    if ($model->idTitular == $contacto->idContacto) {
                        throw new CHttpException(403, 'Usted ya es titular de este inmueble.');
                    } else {
                        throw new CHttpException(403, 'Este inmueble ya tiene un titular.');
                    }
                }

                $this->render('titular', array(
                    'model' => $model,
                    'contacto' => $contacto,
                ));
            } else {
                throw new CHttpException(403, 'Usted no es residente de este inmueble.');
            }
        } else {
            throw new CHttpException(404, Conjuntos::$noConjuntoEnlazado);
        }
    }

}
