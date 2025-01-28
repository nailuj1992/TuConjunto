<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class MascotasPersistence {

    /**
     * Permite crear una mascota.
     * @param type $model Informacion de la mascota.
     * @return boolean
     */
    public function crearMascota($model, $file) {
        
      if ($file != null) {
            $model->foto = $file;
        } else {
            $model->foto = 'noimage.png';
            
        }
        try {
            if ($model->save()) {
                if ($file != null && $model->foto != null) {
                    $model->foto->saveAs(Yii::app()->basePath . "/../images/mascota_". $model->idMascota. "_" . $file);
                }
                return true;
            }
        } catch (Exception $ex) {
            throw new CHttpException(500, $ex->getMessage());
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
    public function modificarMascota($model, $file, $fotoActual) {
        if ($file != null) {
            $model->foto = $file;
        } else {
            $model->foto = $fotoActual;
        }
        try {
            if ($model->save()) {
                if ($file != null && $model->foto != null) {
                    $model->foto->saveAs(Yii::app()->basePath . "/../images/mascota_". $model->idMascota. "_" . $file);
                }
                return true;
            }
        } catch (Exception $ex) {
            throw new CHttpException(500, $ex->getMessage());
        }
        return false;
    }

}

