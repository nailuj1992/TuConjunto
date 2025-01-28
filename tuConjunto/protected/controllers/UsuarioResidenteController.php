<?php

/**
 * Description of UsuarioResidenteController
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class UsuarioResidenteController extends UsuariosController {

    public $param = Funcion::usuarioResidente;

    public function doAccess() {
        return array(
            array(
                'allow', // allow admin user to perform all possible actions
                'actions' => array('index', 'view', 'create', 'update', 'add', 'excel', 'confirm'),
                'roles' => array(CrugeAuthitem2::$rolConcejo, CrugeAuthitem2::$rolAdministrador),
            ),
            array(
                'allow',
                'actions' => array('chooseInmueble'),
                'roles' => array(CrugeAuthitem2::$rolResidente),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function getRole() {
        return CrugeAuthitem2::$rolResidente;
    }

    public function actionCreate() {
        $model = new Residente;
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $model->idConjunto = $conjunto->idConjunto;
        }

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Residente'])) {
            $model->attributes = $_POST['Residente'];
            $rol = $this->getRole();

            $rolesPersistence = new RolesPersistence;
            if ($rolesPersistence->crearUsuarioResidente($model, $rol, $model->idInmueble)) {
                $this->redirect(array('view', 'id' => $model->iduser));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
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
                $excelPersistence = new RolesPersistence;
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

    public function actionChooseInmueble() {
        $model = new Inmueblesporcontacto;
        $id = Yii::app()->user->id;
        $contacto = Contactos::model()->find(Contactos::model()->buscar($id));
        $model->Contactos_idContacto = $contacto->idContacto;
        $model->Inmuebles_idInmueble = $contacto->Inmuebles_idInmueble;

        if (isset($_POST['Inmueblesporcontacto'])) {
            $model->attributes = $_POST['Inmueblesporcontacto'];

            $rolesPersistence = new RolesPersistence;
            if ($rolesPersistence->seleccionarInmueble($contacto, $model->Inmuebles_idInmueble)) {
                $this->redirect(array('/'));
            }
        }

        $this->render('chooseInmueble', array(
            'model' => $model,
        ));
    }

    public function actionAdd() {
        $model = new Residente;

        if (isset($_POST['Residente'])) {
            $model->attributes = $_POST['Residente'];
            $user = CrugeUser2::model()->find(array('condition' => "email = '$model->email'"));

            $rolesPersistence = new RolesPersistence;
            if ($rolesPersistence->adicionarInmuebleResidente($model, $user)) {
                $this->redirect(array('view', 'id' => $user->iduser));
            }
        }

        $this->render('add', array(
            'model' => $model,
        ));
    }

    public function loadModel($id) {
        $model = CrugeUser2::model()->findByPk($id, CrugeUser2::model()->getCriteriaResidente($this->getRole()));
        if ($model === null) {
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

}
