<?php

/**
 * Description of UsuarioMaestroUnoController
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class UsuarioMaestroUnoController extends UsuariosController {

    public $param = Funcion::usuarioConcejo;

    public function doAccess() {
        return array(
            array(
                'allow', // allow admin user to perform all possible actions
                'actions' => array('index', 'view', 'create', 'update'),
                'roles' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function getRole() {
        return CrugeAuthitem2::$rolConcejo;
    }

}
