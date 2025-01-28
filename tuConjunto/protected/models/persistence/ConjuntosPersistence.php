<?php

/**
 * Description of ConjuntosPersistence
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class ConjuntosPersistence {

    /**
     * Permite crear un conjunto.
     * @param type $model Informacion del conjunto.
     * @param type $file Archivo de imagen, para el logo, ingresado.
     * @return boolean
     */
    public function crearConjunto($model, $file) {
        $model->logo = $file;

        if ($model->save()) {
            if ($model->logo != null) {
                $model->logo->saveAs(Yii::app()->basePath . "/../images/" . $file);
            }
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
    public function modificarConjunto($model, $file, $logoActual) {
        if ($file != null) {
            $model->logo = $file;
        } else {
            $model->logo = $logoActual;
        }

        if ($model->save()) {
            if ($file != null && $model->logo != null) {
                $model->logo->saveAs(Yii::app()->basePath . "/../images/" . $file);
            }
            return true;
        }
        return false;
    }

    /**
     * Permite adicionarle una imagen de cabecera al conjunto.
     * @param type $model Informacion de la imagen (objeto tipo Imagenes).
     * @param type $file Archivo de imagen ingresado.
     * @return boolean
     */
    public function adicionarImagen($model, $file) {
        $model->nombre = $file;

        if ($model->save()) {
            if ($model->nombre != null) {
                $model->nombre->saveAs(Yii::app()->basePath . "/../images/" . $file);
            }
            return true;
        }
        return false;
    }

}
