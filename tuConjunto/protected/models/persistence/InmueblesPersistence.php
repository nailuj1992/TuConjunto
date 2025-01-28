<?php

/**
 * Description of InmueblesPersistence
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class InmueblesPersistence {

    /**
     * Permite crear un inmueble.
     * @param type $model Informacion del inmueble.
     * @return boolean
     */
    public function crearInmueble($model) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $model->Conjuntos_idConjunto = $conjunto->idConjunto;

        if ($model->save()) {
            return true;
        }
        return false;
    }

    /**
     * Permite modificar un inmueble.
     * @param type $model Informacion del inmueble.
     * @return boolean
     */
    public function modificarInmueble($model) {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $model->Conjuntos_idConjunto = $conjunto->idConjunto;

        if ($model->save()) {
            return true;
        }
        return false;
    }

    /**
     * Le permite al residente escoger el inmueble en el que reside.
     * @param type $contacto Información del contacto residente.
     * @param type $idInmueble ID del inmueble seleccionado.
     * @return boolean
     */
    public function escogerInmueble($contacto, $idInmueble) {
        $contacto->Inmuebles_idInmueble = $idInmueble;

        if ($contacto->update()) {
            return true;
        }
        return false;
    }

    /**
     * Permite asignarle al residente dado la titularidad del inmueble dado.
     * @param type $contacto Informacion del residente.
     * @param type $inmueble Informacion del inmueble.
     * @return boolean
     */
    public function asignarTitularInmueble($contacto, $inmueble) {
        $inmueble->idTitular = $contacto->idContacto;

        if ($inmueble->update()) {
            return true;
        }
        return false;
    }

    /**
     * Permite agregar un excel con la informacion de los inmuebles.
     * @param type $excel Objeto de tipo Archivosexcel.
     * @param type $file Archivo en Excel con los inmuebles a adicionar.
     * @param type $idConjunto ID del conjunto.
     * @return boolean
     */
    public function agregarExcel($excel, $file, $idConjunto) {
        $excel->nombre = $file;
        $excel->Conjuntos_idConjunto = $idConjunto;

        if ($excel->save()) {
            $excel->nombre->saveAs(Yii::app()->basePath . "/../files/" . $file);
            return true;
        }
        return false;
    }

    /**
     * Confirma la adicion de los inmuebles incluidos en el Excel ingresado.
     * @param type $excel Archivo Excel con la informacion de los inmuebles a adicionar.
     * @throws CHttpException
     */
    public function confirmarExcel($excel) {
        $transaction = $excel->dbConnection->beginTransaction();
        $success = true;

        $filePath = Yii::app()->basePath . "/../files/" . $excel->nombre;
        if (is_readable($filePath)) {
            try {// Source code: http://code.runnable.com/Uot2A2l8VxsUAAAR/read-a-simple-2007-xlsx-excel-file-for-php
                $inputFileType = XPHPExcel::IO_Factory_identify($filePath);
                $objReader = XPHPExcel::IO_Factory_createReader($inputFileType);
                $objPHPExcel = $objReader->load($filePath);
            } catch (Exception $ex) {
                throw new CHttpException(400, 'Error loading file "' . pathinfo($filePath, PATHINFO_BASENAME) . '": ' . $ex->getMessage());
            }

            //  Get worksheet dimensions
            $sheet = $objPHPExcel->getSheet(Archivosexcel::$hojaFormato);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            //  Loop through each row of the worksheet in turn
            for ($row = 2; $row <= $highestRow; $row++) {
                //  Read a row of data into an array
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

                $fila = $rowData[0];
                $inmueble = new Inmuebles;
                $inmueble->zona = substr($fila[0], 0, 1);
                $inmueble->numZona = $fila[1];
                $inmueble->tipo = substr($fila[2], 0, 1);
                $inmueble->nombre = $fila[3];
                $inmueble->coeficienteCopropiedad = $fila[4];
                $inmueble->matriculaInmobiliaria = $fila[5];
                $inmueble->areaConstruida = $fila[6];
                $inmueble->Conjuntos_idConjunto = $excel->Conjuntos_idConjunto;

                $existente = Inmuebles::model()->find(array(
                    'condition' => "zona = '$inmueble->zona' AND numZona = '$inmueble->numZona' AND tipo = '$inmueble->tipo' AND nombre = '$inmueble->nombre' AND Conjuntos_idConjunto = '$inmueble->Conjuntos_idConjunto'"
                ));
                if (!$existente) {
                    try {
                        if ($inmueble->zona != null && $inmueble->tipo != null && $inmueble->nombre != null && $inmueble->coeficienteCopropiedad != null && $inmueble->areaConstruida != null) {
                            Yii::app()->db->createCommand("INSERT INTO inmuebles (zona, numZona, nombre, tipo, coeficienteCopropiedad, matriculaInmobiliaria, areaConstruida, Conjuntos_idConjunto) "
                                    . "VALUES ('$inmueble->zona', '$inmueble->numZona', '$inmueble->nombre', '$inmueble->tipo', '$inmueble->coeficienteCopropiedad', '$inmueble->matriculaInmobiliaria', '$inmueble->areaConstruida', '$inmueble->Conjuntos_idConjunto') ")->execute();
                            $success = $success && true;
                        } else {
                            throw new Exception;
                        }
                    } catch (Exception $ex) {
                        $success = $success && false;
                    }
                }
            }
            $success = $success && $excel->delete();
            if ($success) {
                $transaction->commit();
            } else {
                $transaction->rollback();
            }
            return $success;
        } else {
            throw new CHttpException(404, "El archivo $excel->nombre no se puede leer.");
        }
    }

}
