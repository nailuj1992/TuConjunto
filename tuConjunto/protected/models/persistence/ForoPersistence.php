<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ForoPersistence {

    /**
     * Permite crear una pregunta en el foro.
     * @param type $model Informacion de la pregunta.
     * @return boolean
     */
    public function crearForo($model) {
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
    public function modificarForo($model) {
        
        if ($model->save()) {
            return true;
        }
        return false;
    }

}

