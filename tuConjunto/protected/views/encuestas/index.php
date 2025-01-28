<?php
/* @var $this EncuestasController */
/* @var $model Encuestas */
?>

<h1 class="font_titulo">
<i class="fa fa-question-circle"></i> Tus encuestas</h1>
<br>

<?php
if(Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)) {
    $botones = '{view}{update}';
} else {
    $botones = '{view}';
}
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'asambleas-grid',
    'dataProvider' => $model->buscarTimein(),
    'columns' => array(
        'titulo',
        'descripcion',
        array(
            'name' => 'fechaInicio',
            'value' => 'FechasField::formatDate($data->fechaInicio)'
        ),
        array(
            'name' => 'fechaFin',
            'value' => 'FechasField::formatDate($data->fechaFin)'
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Acciones',
            'template' => $botones,
        ),
    ),
));

echo '<div class="container">';
if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)) {
    echo CHtml::link('Registrar una encuesta', array('create'), array('class' => 'btn btn-primary'));
    echo SiteController::$espacio_vacio;
}
