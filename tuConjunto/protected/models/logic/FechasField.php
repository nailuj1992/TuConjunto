<?php

/**
 * Description of FechasField
 *
 * @author Julian Gonzalez Prieto (Anacoreta Avuuna, la Luz del Alba).
 */
class FechasField {

    public static function getFechaSelector($model, $field) {
        return array(
            'name' => $field,
            'attribute' => $field,
            'model' => $model,
            'language' => 'es',
            'flat' => true, //remove to hide the datepicker
            'options' => array(
                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                'dateFormat' => 'yy-mm-dd',
            ),
            'htmlOptions' => array(
                'style' => ''
            ),
        );
    }

    public static function formatDate($date) {
        return Yii::app()->dateFormatter->format("yyyy-MM-dd", strtotime($date));
    }

    public static function formatDateTime($date) {
        return Yii::app()->dateFormatter->format("yyyy-MM-dd H:m:s", strtotime($date));
    }

}
