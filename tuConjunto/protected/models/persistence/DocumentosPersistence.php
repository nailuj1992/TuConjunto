<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DocumentosPersistence {

    /**
     * Permite crear una documento.
     * @param type $model Informacion del documento.
     * @return boolean
     */
    public function crearDocumento($model, $file, $arc, $fileName) {
        if ($model->save()) {
            if ($file != NULL) {
                if ($arc == true) {
                    if (is_object($file) && get_class($file) === 'CUploadedFile') {
                        $file->saveAs(Yii::app()->basePath . '/../documents/' . $fileName);
                        return true;
                    }
                    $this->redirect(array('view', 'id' => $model->idDocumentos));
                } else {
                    echo '<script>alert("Solo se admiten archivos pdf");</script>';
                    $this->redirect(array('update', 'id' => $model->idDocumentos));
                }
            } else
                $this->redirect(array('view', 'id' => $model->idDatos));
        }
    }

    /**
     * Permite modificar un conjunto.
     * @param type $model Informacion del conjunto.
     * @param type $file Archivo de imagen, para el logo, ingresado.
     * @param type $logoActual Logo actual del conjunto.
     * @return boolean
     */
    public function modificarDocumento($model) {

        if ($model->save()) {
            return true;
        }
        return false;
    }

}
