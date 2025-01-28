<?php

/**
 * Description of UsuariosController
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
abstract class UsuariosController extends Controller {

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
        return $this->doAccess();
    }

    public abstract function doAccess();

    public function actionIndex() {
        $model = new CrugeUser2('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['CrugeUser2'])) {
            $model->attributes = $_GET['CrugeUser2'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
        //Yii::app()->db->createCommand('SELECT iduser, username, email, state, logondate FROM cruge_authassignment RIGHT JOIN cruge_user ON cruge_authassignment.userid=cruge_user.iduser WHERE itemname="Residente"')->queryAll();
    }

    public function actionView($id) {
        $model = $this->loadModel($id);
        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionCreate() {
        $model = new CrugeUser2;
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $model->idConjunto = $conjunto->idConjunto;
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['CrugeUser2'])) {
            $model->attributes = $_POST['CrugeUser2'];
            $rol = $this->getRole();

            $rolesPersistence = new RolesPersistence;
            if ($rolesPersistence->crearUsuario($model, $rol)) {
                $this->redirect(array('view', 'id' => $model->iduser));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public abstract function getRole();

    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $conjunto = Conjuntos::getConjunto($model->iduser);
        $model->idConjunto = $conjunto->idConjunto;

        if (isset($_POST['CrugeUser2'])) {
            $model->attributes = $_POST['CrugeUser2'];

            $rolesPersistence = new RolesPersistence;
            if ($rolesPersistence->modificarUsuario($model)) {
                $this->redirect(array('view', 'id' => $model->iduser));
            }
        }

        $model->password = "";
        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        throw new CHttpException(404, "No se puede realizar esta opción.");
    }

    public function loadModel($id) {
        $model = CrugeUser2::model()->findByPk($id, CrugeUser2::model()->getCriteria($this->getRole()));
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Contactos $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contactos-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
