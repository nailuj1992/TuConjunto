<?php

/**
 * Description of PerfilPersistence
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class PerfilPersistence {

    /**
     * Permite modificar el perfil de un contacto.
     * @param type $model Informacion del contacto.
     * @param type $file Archivo de imagen, para la foto, ingresado.
     * @param type $fotoActual Foto actual del contacto.
     */
    public function modificarPerfil($model, $file, $fotoActual) {
        if ($file != null) {
            $model->foto = $file;
        } else {
            $model->foto = $fotoActual;
        }
        try {
            if ($model->save()) {
                if ($file != null && $model->foto != null) {
                    $model->foto->saveAs(Yii::app()->basePath . "/../images/" . $file);
                }
                return true;
            }
        } catch (Exception $ex) {
            throw new CHttpException(500, "Ya hay una cédula registrada. Inténtelo de nuevo.");
        }
        return false;
    }

    /**
     * Permite realizar el cambio de credenciales de usuario.
     * @param type $cambiarCredenciales Informacion con las credenciales nuevas.
     * @param type $old Contrasena vieja.
     * @return boolean
     * @throws CHttpException
     */
    public function cambiarCredenciales($cambiarCredenciales, $old) {
        $fail = false;
        if ($cambiarCredenciales->password == null) {
            $cambiarCredenciales->addError('password', "Debe ingresar la contraseña antigua.");
            $fail = true;
        }
        if ($cambiarCredenciales->new == null) {
            $cambiarCredenciales->addError('new', "Debe ingresar la contraseña nueva.");
            $fail = true;
        }
        if ($cambiarCredenciales->renew == null) {
            $cambiarCredenciales->addError('renew', "Debe volver a ingresar la contraseña nueva.");
            $fail = true;
        }
        if (!$fail) {
            $pass = CrugeUtil::hash($cambiarCredenciales->password);
            $new = CrugeUtil::hash($cambiarCredenciales->new);
            $renew = CrugeUtil::hash($cambiarCredenciales->renew);
            if ($pass != $old) {
                $cambiarCredenciales->addError('password', "La contraseña antigua no coincide.");
            } else {
                if ($new != $renew) {
                    $cambiarCredenciales->addError('renew', "Las contraseñas nuevas deben coincidir.");
                } else {
                    $cambiarCredenciales->password = $new;
                    if ($cambiarCredenciales->save()) {
                        return true;
                    } else {
                        throw new CHttpException(500, "Ha ocurrido un error al momento de cambiar la contraseña. Inténtelo de nuevo.");
                    }
                }
            }
        }
        return false;
    }

}
