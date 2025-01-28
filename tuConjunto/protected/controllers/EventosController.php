<?php

/**
 * Description of EventosController
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class EventosController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to perform all possible actions
                'actions' => array('calendarEvents'),
                'roles' => array('admin', CrugeAuthitem2::$rolAdministrador, CrugeAuthitem2::$rolConcejo, CrugeAuthitem2::$rolVigilante, CrugeAuthitem2::$rolResidente),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionCalendarEvents() {
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        if ($conjunto != null) {
            $items = array();
            $condition = array('condition' => "Conjuntos_idConjunto = $conjunto->idConjunto");

            $asambleas = Asambleas::model()->findAll($condition);
            foreach ($asambleas as $value) {
                $items[] = array(
                    'title' => "Asamblea: $value->titulo",
                    'start' => $value->fechaInicio,
                    'end' => $value->fechaFin,
                    'color' => '#E75C5C',
                );
            }

            $encuestas = Encuestas::model()->findAll($condition);
            foreach ($encuestas as $value) {
                $items[] = array(
                    'title' => "Encuesta: $value->titulo",
                    'start' => $value->fechaInicio,
                    'end' => $value->fechaFin,
                    'color' => '#66A4EA',
                );
            }

            $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
            if ($conjunto != null) {
                $criteria = new CDbCriteria;
                $criteria->join = "LEFT JOIN inmuebles i ON i.idInmueble = Inmuebles_idInmueble ";
                $criteria->condition = "i.Conjuntos_idConjunto = $conjunto->idConjunto ";
                $criteria->condition .= "AND aprobada = 'A' ";
                $reservas = Reserva::model()->findAll($criteria);
                foreach ($reservas as $value) {
                    $titulo = $value->areaSocialIdAreaSocial->nombre . ". Hecha por: " . Inmuebles::getNombreInmueble($value->inmueblesIdInmueble);
                    $items[] = array(
                        'title' => "Reserva: $titulo",
                        'start' => "$value->fecha $value->horaInicio",
                        'end' => "$value->fecha $value->horaFin",
                        'allDay' => false,
                        'color' => '#33C27B',
                    );
                }
            }

            echo CJSON::encode($items);
            Yii::app()->end();
        }
    }

}
