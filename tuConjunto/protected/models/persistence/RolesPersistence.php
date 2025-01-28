<?php

/**
 * Description of ContactosPersistence
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class RolesPersistence {

    /**
     * Permite crear un usuario.
     * @param type $usuario Informacion del usuario.
     * @param type $rol Rol del contacto. Constantes en CrugeAuthItem2.
     * @return type
     */
    public function crearUsuario($usuario, $rol) {
        $rolNuevo = new CrugeAuthassignment2;
        $contactoNuevo = new ContactoVacio;

        $transaction = $usuario->dbConnection->beginTransaction();
        $fail = false;

        $pass = $usuario->password;
        if ($pass != "") {
            $usuario->password = CrugeUtil::hash($pass);
        }
        $usuario->authkey = CrugeUser2::generateAuthKey($usuario);
        $usuario->state = 0; // Requiere de activacion enviada al correo.

        try {
            if ($usuario->save()) {
                $rolNuevo->userid = $usuario->iduser;
                $rolNuevo->itemname = $rol;

                $contactoNuevo->Conjuntos_idConjunto = $usuario->idConjunto;
                $contactoNuevo->cruge_user_iduser = $usuario->iduser;
                if ($rolNuevo->save() && $contactoNuevo->save()) {
                    $transaction->commit();
                    CrugeUser2::enviarCorreo($usuario, $pass);
                } else {
                    $fail = true;
                }
            } else {
                $fail = true;
            }
        } catch (Exception $ex) {
            $transaction->rollback();
            throw new CHttpException(500, "Ya hay un usuario registrado con ese username o email.");
        }
        if ($fail) {
            $transaction->rollback();
            $usuario->password = $pass;
        }
        return !$fail;
    }

    /**
     * Permite crear un usuario administrador.
     * @param type $usuario Informacion del usuario.
     * @param type $rol Rol del contacto. Constantes en CrugeAuthItem2 ($rolAdministrador).
     * @return type
     */
    public function crearUsuarioAdmin($usuario, $rol) {
        $rolNuevo = new CrugeAuthassignment2;
        $contactoNuevo = new ContactoVacio;
        $conjCont = new Conjuntosporcontacto;

        $transaction = $usuario->dbConnection->beginTransaction();
        $fail = false;

        $pass = $usuario->password;
        if ($pass != "") {
            $usuario->password = CrugeUtil::hash($pass);
        }
        $usuario->authkey = CrugeUser2::generateAuthKey($usuario);
        $usuario->state = 0; // Requiere de activacion enviada al correo.

        try {
            if ($usuario->save()) {
                $rolNuevo->userid = $usuario->iduser;
                $rolNuevo->itemname = $rol;

                $contactoNuevo->cruge_user_iduser = $usuario->iduser;
                if ($rolNuevo->save() && $contactoNuevo->save()) {
                    $conjCont->Conjuntos_idConjunto = $usuario->idConjunto;
                    $conjCont->Contactos_idContacto = $contactoNuevo->idContacto;
                    if ($conjCont->save()) {
                        $transaction->commit();
                        CrugeUser2::enviarCorreo($usuario, $pass);
                    } else {
                        $fail = true;
                    }
                } else {
                    $fail = true;
                }
            } else {
                $fail = true;
            }
        } catch (Exception $ex) {
            $transaction->rollback();
            throw new CHttpException(500, "Ya hay un usuario registrado con ese username o email.");
        }
        if ($fail) {
            $transaction->rollback();
            $usuario->password = $pass;
        }
        return !$fail;
    }

    /**
     * Permite crear un usuario residente.
     * @param type $usuario Informacion del usuario.
     * @param type $rol Rol del contacto. Constantes en CrugeAuthItem2 ($rolResidente).
     * @param type $inmueble
     * @return type
     * @throws CHttpException
     */
    public function crearUsuarioResidente($usuario, $rol, $idInmueble) {
        $rolNuevo = new CrugeAuthassignment2;
        $contactoNuevo = new ContactoVacio;
        $inmblCont = new Inmueblesporcontacto;

        $transaction = $usuario->dbConnection->beginTransaction();
        $fail = false;

        $pass = $usuario->password;
        if ($pass != "") {
            $usuario->password = CrugeUtil::hash($pass);
        }
        $usuario->authkey = CrugeUser2::generateAuthKey($usuario);
        $usuario->state = 0; // Requiere de activacion enviada al correo.

        try {
            if ($usuario->save()) {
                $rolNuevo->userid = $usuario->iduser;
                $rolNuevo->itemname = $rol;

                $contactoNuevo->Conjuntos_idConjunto = $usuario->idConjunto;
                $contactoNuevo->cruge_user_iduser = $usuario->iduser;
                $contactoNuevo->Inmuebles_idInmueble = $idInmueble;
                if ($rolNuevo->save() && $contactoNuevo->save()) {
                    $inmblCont->Inmuebles_idInmueble = $idInmueble;
                    $inmblCont->Contactos_idContacto = $contactoNuevo->idContacto;
                    if ($inmblCont->save()) {
                        $transaction->commit();
                        CrugeUser2::enviarCorreo($usuario, $pass);
                    } else {
                        $fail = true;
                    }
                } else {
                    $fail = true;
                }
            } else {
                $fail = true;
            }
        } catch (Exception $ex) {
            $transaction->rollback();
            throw new CHttpException(500, "Ya hay un usuario registrado con ese username o email.");
        }
        if ($fail) {
            $transaction->rollback();
            $usuario->password = $pass;
        }
        return !$fail;
    }

    /**
     * Confirma la adicion de los residentes incluidos en el Excel ingresado.
     * @param type $excel Archivo Excel con la informacion de los residentes a adicionar.
     * @throws CHttpException
     */
    public function confirmarExcel($excel) {
        $transaction = $excel->dbConnection->beginTransaction();
        $success = true;
        $emails = array();

        $filePath = Yii::app()->basePath . "/../files/" . $excel->nombre;
        if (is_readable($filePath)) {
            try {
                $inputFileType = XPHPExcel::IO_Factory_identify($filePath);
                $objReader = XPHPExcel::IO_Factory_createReader($inputFileType);
                $objPHPExcel = $objReader->load($filePath);
            } catch (Exception $ex) {
                throw new CHttpException(400, 'Error loading file "' . pathinfo($filePath, PATHINFO_BASENAME) . '": ' . $ex->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(Archivosexcel::$hojaFormato);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++) {
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

                $fila = $rowData[0];
                $rol = CrugeAuthitem2::$rolResidente;

                $usuario = new Residente;
                $usuario->username = $fila[0];
                $usuario->email = $fila[1];
                $usuario->password = CrugeUtil::passwordGenerator();
                $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
                if ($conjunto != null) {
                    $usuario->idConjunto = $conjunto->idConjunto;
                }

                $inmuebles = array();
                $inmuebles[] = $fila[2];
                $inmuebles[] = $fila[3];
                $inmuebles[] = $fila[4];
                $inmuebles[] = $fila[5];
                $inmuebles[] = $fila[6];

                $existente = CrugeUser2::model()->find(array(
                    'condition' => "username = '$usuario->username' OR email = '$usuario->email'"
                ));
                if (!$existente) {
                    if ($usuario->username != null && $usuario->email != null && $inmuebles[0] != null) {
                        $pass = $usuario->password;
                        $usuario->password = CrugeUtil::hash($pass);
                        $usuario->authkey = CrugeUser2::generateAuthKey($usuario);
                        $usuario->state = 0; // Requiere de activacion enviada al correo.

                        $usuario->idInmueble = $inmuebles[0];
                        try {
                            if ($usuario->save()) {
                                $rolNuevo = new CrugeAuthassignment2;
                                $contactoNuevo = new ContactoVacio;
                                $inmblCont = new Inmueblesporcontacto;

                                $rolNuevo->userid = $usuario->iduser;
                                $rolNuevo->itemname = $rol;

                                $contactoNuevo->Conjuntos_idConjunto = $usuario->idConjunto;
                                $contactoNuevo->cruge_user_iduser = $usuario->iduser;
                                $contactoNuevo->Inmuebles_idInmueble = $usuario->idInmueble;
                                if ($rolNuevo->save() && $contactoNuevo->save()) {
                                    $inmblCont->Inmuebles_idInmueble = $usuario->idInmueble;
                                    $inmblCont->Contactos_idContacto = $contactoNuevo->idContacto;
                                    if ($inmblCont->save()) {
                                        $emails[] = array(
                                            'user' => $usuario,
                                            'pass' => $pass,
                                        );
                                        $success = $success && true;
                                    } else {
                                        $success = $success && false;
                                    }
                                } else {
                                    $success = $success && false;
                                }
                            } else {
                                $success = $success && false;
                            }
                        } catch (Exception $ex) {
                            $transaction->rollback();
                            throw new CHttpException(500, "Ya hay un usuario registrado con ese username o email; o el inmueble ingresado no existe. Fila # $row");
                        }
                        for ($i = 1; $i < sizeof($inmuebles); $i++) {
                            if ($inmuebles[$i] != null) {
                                $contacto = Contactos::model()->find(array('condition' => "cruge_user_iduser = $usuario->iduser"));

                                $contactoInmueble = new Inmueblesporcontacto;
                                $contactoInmueble->Contactos_idContacto = $contacto->idContacto;
                                $contactoInmueble->Inmuebles_idInmueble = $inmuebles[$i];

                                try {
                                    if ($contactoInmueble->save()) {
                                        $success = $success && true;
                                    } else {
                                        throw new Exception;
                                    }
                                } catch (Exception $ex) {
                                    $success = $success && false;
                                }
                            }
                        }
                    } else {
                        $success = $success && false;
                    }
                } else {
                    $existente->username = $usuario->username;
                    $existente->email = $usuario->email;
                    if ($existente->update()) {
                        $success = $success && true;
                    } else {
                        $success = $success && false;
                    }
                }
            }
            $success = $success && $excel->delete();
            if ($success) {
                $transaction->commit();
                foreach ($emails as $email) {
                    CrugeUser2::enviarCorreo($email['user'], $email['pass']);
                }
            } else {
                $transaction->rollback();
            }
            return $success;
        } else {
            throw new CHttpException(404, "El archivo $excel->nombre no se puede leer.");
        }
    }

    /**
     * Permite modificar un usuario
     * @param type $usuario Informacion del usuario.
     * @return type
     */
    public function modificarUsuario($usuario) {
        $transaction = $usuario->dbConnection->beginTransaction();

        $contactos = Contactos::model()->findAll(array(
            'condition' => "cruge_user_iduser = $usuario->iduser",
        ));
        if (sizeof($contactos) > 0) {
            $contacto = $contactos[0];
            $contacto->Conjuntos_idConjunto = $usuario->idConjunto;
            $contacto->setIsNewRecord(false);
        } else {
            $contacto = null;
        }

        $pass = $usuario->password;
        if ($pass != "") {
            $usuario->password = CrugeUtil::hash($pass);
        }

        try {
            if ($usuario->save() && $contacto != null && $contacto->update()) {
                $transaction->commit();
                return true;
            } else {
                $transaction->rollback();
                $usuario->password = $pass;
                return false;
            }
        } catch (Exception $ex) {
            $transaction->rollback();
            throw new CHttpException(500, "Ya hay un usuario registrado con ese username o email.");
        }
    }

    /**
     * Permite desasignarle un conjunto a un usuario.
     * @param type $idConjunto ID del conjunto seleccionado.
     * @param type $iduser ID del usuario seleccionado.
     * @throws CHttpException
     */
    public function desasignarConjunto($idConjunto, $iduser) {
        $contacto = Contactos::model()->find(Contactos::model()->buscar($iduser));
        $model = Conjuntosporcontacto::model()->findByPk(array('Conjuntos_idConjunto' => $idConjunto, 'Contactos_idContacto' => $contacto->idContacto)); //CrugeUser2::model()->buscarConjuntoUser(CrugeAuthitem2::$rolAdministrador, $iduser, $idConjunto);

        $transaction = $model->dbConnection->beginTransaction();
        if ($contacto->Conjuntos_idConjunto == $idConjunto) {
            $contacto->Conjuntos_idConjunto = null;
        }
        if ($model->delete() && $contacto->update()) {
            $transaction->commit();
        } else {
            $transaction->rollback();
            throw new CHttpException(500, "No se pudo desasignar el conjunto al administrador. Inténtelo de nuevo.");
        }
    }

    /**
     * Le asigna un conjunto a un usuario.
     * @param type $conjuntosPorContacto Informacion del contacto al que le corresponde un conjunto.
     * @param type $contacto Informacion del contacto.
     * @return boolean
     * @throws CHttpException
     */
    public function asignarConjunto($conjuntosPorContacto, $contacto) {
        $user = CrugeUser2::model()->findByPk($contacto->cruge_user_iduser);
        try {
            if ($conjuntosPorContacto->save()) {
                return true;
            }
        } catch (Exception $ex) {
            throw new CHttpException(500, "El administrador $user->username ya tiene asignado el conjunto seleccionado.");
        }
        return false;
    }

    /**
     * Le permite a un administrador seleccionar su conjunto.
     * @param type $contacto Informacion del contacto (administrador).
     * @param type $idConjunto ID del conjunto seleccionado.
     * @return boolean
     */
    public function seleccionarConjunto($contacto, $idConjunto) {
        $contacto->Conjuntos_idConjunto = $idConjunto;

        if ($contacto->update()) {
            return true;
        }
        return false;
    }

    /**
     * Le permite a un residente seleccionar su inmueble.
     * @param type $contacto Informacion del contacto (residente).
     * @param type $idInmueble ID del inmueble seleccionado.
     * @return boolean
     */
    public function seleccionarInmueble($contacto, $idInmueble) {
        $inmueble = Inmuebles::model()->findByPk($idInmueble);

        $contacto->Inmuebles_idInmueble = $inmueble->idInmueble;
        $contacto->Conjuntos_idConjunto = $inmueble->Conjuntos_idConjunto;

        if ($contacto->update()) {
            return true;
        }
        return false;
    }

    /**
     * Permite asignarle el inmueble seleccionado al residente deseado.
     * @param type $residente Informacion del residente.
     * @param type $usuario Informacion del usuario residente.
     */
    public function adicionarInmuebleResidente($residente, $usuario) {
        if ($usuario != null) {
            $contacto = Contactos::model()->find(array('condition' => "cruge_user_iduser = $usuario->iduser"));
            $authAssign = CrugeAuthassignment2::model()->find(array('condition' => "userid = $usuario->iduser"));

            if ($contacto != null && $authAssign != null && $authAssign->itemname == CrugeAuthitem2::$rolResidente) {
                $contactoInmueble = new Inmueblesporcontacto;
                $contactoInmueble->Contactos_idContacto = $contacto->idContacto;
                $contactoInmueble->Inmuebles_idInmueble = $residente->idInmueble;

                try {
                    if ($contactoInmueble->save()) {
                        return true;
                    }
                } catch (Exception $ex) {
                    $residente->addError('idInmueble', "Ya se ha registrado ese residente en aquel inmueble. Inténtelo de nuevo.");
                }
            } else {
                $residente->addError('email', "El usuario debe ser un contacto residente.");
            }
        } else {
            $residente->addError('email', "No se ha encontrado un usuario con ese correo.");
        }
        return false;
    }

}
