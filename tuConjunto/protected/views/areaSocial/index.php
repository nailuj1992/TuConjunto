<?php
/* @var $this AreaSocialController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Areasocial */
?>

<h1 class="font_titulo">
<i class="fa fa-map-marker"></i> Tus áreas sociales</h1>

<?php
$session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->getId()));
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Areasocial', array(
        'criteria' => array(
            'condition' => "Conjuntos_idConjunto='" . $session->Conjuntos_idConjunto . "'"
        ),
            )),
    'columns' => array(
        'nombre',
        array(
            'name' => 'Tarifa',
            'header' => 'Tarifa',
            'value' => 'Areasocial::model()->getTarifa($data->idAreaSocial)'
        ),
        'descripcion',
        array(
            'class' => 'CButtonColumn',
            'header' => 'Acciones',
            'template' => '{view}{update}',
        ),
    ),
));


echo CHtml::link('Registrar área social', array('areaSocial/create/' . $model->idAreaSocial), array('class' => 'btn btn-primary'));
