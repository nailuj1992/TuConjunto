<?php
/* @var $this VehiculosController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Vehiculos */
?>

<h1 class="font_titulo">
<i class="fa fa-car"></i> Tus vehículos</h1>
<br>

<?php
if(Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)){
 


$session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Vehiculos', array(
        'criteria' => array(
            'condition' => "idDueno='".$session->idContacto."'"
        ),
            )),
         
    'columns' => array(
        'placa',
        'marca',
        'modelo',
        'serie',
        'color',
        'observacion',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
        ),
    ),
));

if(Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)){

    echo CHtml::link('Registrar vehículo', array('vehiculos/create/'.$model->idVehiculo),array('class'=>'btn btn-primary'));
}
}
?>




<?php

///REPORTE PARA VIGILANTES

if(!(Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente))){
$session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Vehiculos', array(
        'criteria' => array(
            'condition' => "idDueno0.Conjuntos_idConjunto=".$session->Conjuntos_idConjunto."",
            'with' => array('idDueno0' => array('joinType' => 'LEFT JOIN')),
        ),
            )),
    'columns' => array(
        'placa',
        'marca',
        'modelo',
        'serie',
        'color',
        'observacion',
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}',
        ),
    ),
));
}
    


