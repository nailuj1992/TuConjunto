<?php

/**
 * Description of PerfilController
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class PerfilController extends Controller {

    public $param = Funcion::perfil;

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
            array('allow', // allow all users to perform view and update actions
                'actions' => array('view', 'update', 'change'),
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
        $model = $this->loadModel($id);
        $this->render('view', array(
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

        if (isset($_POST['Contactos'])) {
            $model->attributes = $_POST['Contactos'];
            $file = CUploadedFile::getInstance($model, 'foto');

            $perfilPersistence = new PerfilPersistence;
            if ($perfilPersistence->modificarPerfil($model, $file, $foto)) {
                $this->redirect(array('view', 'id' => $model->idContacto));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionChange($id) {
        $contacto = $this->loadModel($id);
        $model = CambiarCredenciales::model()->findByPk($contacto->cruge_user_iduser);
        $old = $model->password;

        if (isset($_POST['CambiarCredenciales'])) {
            $model->attributes = $_POST['CambiarCredenciales'];

            $perfilPersistence = new PerfilPersistence;
            if ($perfilPersistence->cambiarCredenciales($model, $old)) {
                $this->redirect(array('view', 'id' => $contacto->idContacto));
            }
        }

        $model->password = "";
        $model->new = "";
        $model->renew = "";
        $this->render('change', array(
            'contacto' => $contacto,
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
        $model = Contactos::model()->findByPk($id);
        if ($model === null || ($model !== null && $model->cruge_user_iduser != Yii::app()->user->id)) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Conjuntos $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'perfil-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
