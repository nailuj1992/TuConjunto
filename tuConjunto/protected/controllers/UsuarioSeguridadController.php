<?php

/**
 * Description of UsuarioSeguridadController
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class UsuarioSeguridadController extends UsuariosController {

    public $param = Funcion::usuarioSeguridad;

    public function doAccess() {
        return array(
            array(
                'allow', // allow admin user to perform all possible actions
                'actions' => array('index', 'view', 'create', 'update'),
                'roles' => array(CrugeAuthitem2::$rolConcejo, CrugeAuthitem2::$rolAdministrador),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function getRole() {
        return CrugeAuthitem2::$rolVigilante;
    }

}
