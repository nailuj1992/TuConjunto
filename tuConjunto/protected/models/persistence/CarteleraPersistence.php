<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class CarteleraPersistence {

    /**
     * Permite crear un anuncio.
     * @param type $model Informacion del anuncio.
     * @return boolean
     */
    public function crearCartelera($model, $file) {
        
      if ($file != null) {
            $model->fotoPrincipal = $file;
        } else {
            $model->fotoPrincipal = 'noimage.png';
            
        }
        try {
            if ($model->save()) {
                if ($file != null && $model->fotoPrincipal != null) {
                    $model->fotoPrincipal->saveAs(Yii::app()->basePath . "/../images/" . $file);
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
    public function modificarCartelera($model, $file, $fotoActual) {
        if ($file != null) {
            $model->fotoPrincipal = $file;
        } else {
            $model->fotoPrincipal = $fotoActual;
        }
        try {
            if ($model->save()) {
                if ($file != null && $model->fotoPrincipal != null) {
                    $model->fotoPrincipal->saveAs(Yii::app()->basePath . "/../images/" . $file);
                }
                return true;
            }
        } catch (Exception $ex) {
            throw new CHttpException(500, $ex->getMessage());
        }
        return false;
    }

}

