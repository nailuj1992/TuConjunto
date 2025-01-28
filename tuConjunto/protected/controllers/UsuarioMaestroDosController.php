<?php

/**
 * Description of UsuarioMaestroDosController
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class UsuarioMaestroDosController extends UsuariosController {

    public $param = Funcion::usuarioAdministrador;

    public function doAccess() {
        return array(
            array(
                'allow', // allow admin user to perform all possible actions
                'actions' => array('index', 'view', 'create', 'update', 'viewConjuntos', 'deleteConjunto', 'createConjunto'),
                'roles' => array('admin'),
            ),
            array(
                'allow',
                'actions' => array('selectConjunto'),
                'roles' => array(CrugeAuthitem2::$rolAdministrador),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function getRole() {
        return CrugeAuthitem2::$rolAdministrador;
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
            if ($rolesPersistence->crearUsuarioAdmin($model, $rol)) {
                $this->redirect(array('view', 'id' => $model->iduser));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionViewConjuntos($id) {
        $model = $this->loadModel($id);
        $this->render('viewConjuntos', array(
            'model' => $model,
        ));
    }

    public function actionDeleteConjunto($idConjunto, $iduser) {
        $rolesPersistence = new RolesPersistence;
        $rolesPersistence->desasignarConjunto($idConjunto, $iduser);

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('viewConjuntos', 'id' => $iduser));
        }
    }

    public function actionCreateConjunto($id) {
        $model = new Conjuntosporcontacto;
        $contacto = Contactos::model()->find(Contactos::model()->buscar($id));
        $model->Contactos_idContacto = $contacto->idContacto;

        if (isset($_POST['Conjuntosporcontacto'])) {
            $model->attributes = $_POST['Conjuntosporcontacto'];

            $rolesPersistence = new RolesPersistence;
            if ($rolesPersistence->asignarConjunto($model, $contacto)) {
                $this->redirect(array('viewConjuntos', 'id' => $id));
            }
        }

        $this->render('createConjunto', array(
            'model' => $model,
            'model1' => CrugeUser2::model()->findByPk($id),
            'iduser' => $id,
        ));
    }

    public function actionSelectConjunto() {
        $model = new Conjuntosporcontacto;
        $id = Yii::app()->user->id;
        $contacto = Contactos::model()->find(Contactos::model()->buscar($id));
        $model->Contactos_idContacto = $contacto->idContacto;
        $model->Conjuntos_idConjunto = $contacto->Conjuntos_idConjunto;

        if (isset($_POST['Conjuntosporcontacto'])) {
            $model->attributes = $_POST['Conjuntosporcontacto'];

            $rolesPersistence = new RolesPersistence;
            if ($rolesPersistence->seleccionarConjunto($contacto, $model->Conjuntos_idConjunto)) {
                $this->redirect(array('/'));
            }
        }

        $this->render('selectConjunto', array(
            'model' => $model,
        ));
    }

}
