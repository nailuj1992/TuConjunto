<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ParqueaderosPersistence {

    /**
     * Permite crear un parqueadero.
     * @param type $model Informacion del parqueadero.
     * @return boolean
     */
    public function crearParqueadero($model) {
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
    public function modificarParqueadero($model) {
        
        if ($model->save()) {
            return true;
        }
        return false;
    }

}

