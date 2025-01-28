<?php
/* @var $this ParqueaderosController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Parqueaderos */
?>

<h1 class="font_titulo">
    <i class="fa fa-caret-square-o-down"></i> Tus parqueaderos</h1>
    <br>

<?php
if(Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)||Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo)) {
    $botones = '{update}';
} else {
    $botones = '';
}

$session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Parqueaderos', array(
        'criteria' => array(
         'condition' => "inmueblesIdInmueble.Conjuntos_idConjunto=".$session->Conjuntos_idConjunto."",
         'with' => array('inmueblesIdInmueble' => array('joinType' => 'LEFT JOIN')),

        ),
            )),
    'columns' => array(
        'numero',
        'ubicacion',
        array(
            'name' => 'Inmueble',
            'header' => 'Inmueble',
            'value' => 'Inmuebles::model()->getNombre($data->Inmuebles_idInmueble)'
        ),
        array(
            'name' => 'Vehiculo',
            'header' => 'Vehículo',
            'value' => 'Parqueaderos::model()->getVehiculo($data->idParqueadero)'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => $botones,
        ),
    ),
));
if(Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)||Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo)) {

    echo CHtml::link('Agregar parqueadero', array('parqueaderos/create/'.$model->idParqueadero),array('class'=>'btn btn-primary'));
}
    ?>


