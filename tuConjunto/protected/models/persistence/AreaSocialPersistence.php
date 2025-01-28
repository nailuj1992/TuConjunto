<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AreaSocialPersistence {

    /**
     * Permite crear un área social.
     * @param type $model Informacion del área social.
     * @return boolean
     */
    public function crearAreaSocial($model) {
        if ($model->save()) {
            return true;
        }
        return false;
    }

    /**
     * Permite modificar un conjunto.
     * @param type $model Informacion del conjunto.
     * @param type $file Archivo de imagen, para el logo, ingresado.
     * @param type $logoActual Logo actual del conjunto.
     * @return boolean
     */
    public function modificarAreaSocial($model) {
        if ($model->save()) {
            return true;
        }
        return false;
    }

}
