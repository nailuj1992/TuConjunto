<?php
/* @var $this AsambleasController */
/* @var $model Asambleas */
?>

<h1 class="font_titulo">
    <i class="fa fa-exclamation-circle"></i> Ver asamblea: <?php echo $model->titulo; ?></h1>
    <br>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'itemCssClass' => array('detailViewTr'),
    'attributes' => array(
//        'idAsamblea',
        'titulo',
        'descripcion',
        array(
            'name' => 'fechaInicio',
            'value' => FechasField::formatDate($model->fechaInicio)
        ),
        array(
            'name' => 'fechaFin',
            'value' => FechasField::formatDate($model->fechaFin)
        ),
//        'Conjuntos_idConjunto',
    ),
));

echo '<div class="container">';
echo CHtml::link('Ver las asambleas', array('index'), array('class' => 'btn btn-info'));
echo SiteController::$espacio_vacio;
if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)) {
    echo CHtml::link('Registrar una asamblea', array('create'), array('class' => 'btn btn-primary'));
    echo SiteController::$espacio_vacio;
    echo CHtml::link('Modificar asamblea', array('update', 'id' => $model->idAsamblea), array('class' => 'btn btn-success'));
    echo SiteController::$espacio_vacio;
    echo CHtml::link('Ver preguntas', array("/preguntas?asamblea=$model->idAsamblea"), array('class' => 'btn btn-warning'));
    echo SiteController::$espacio_vacio;
} else if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)) {
    $today = date('Y-m-d');
    $inicio = date($model->fechaInicio);
    $fin = date($model->fechaFin);
    if ($inicio <= $today && $today <= $fin) {
        echo CHtml::link('Responder a la asamblea', array("/preguntas?asamblea=$model->idAsamblea"), array('class' => 'btn btn-warning'));
        echo SiteController::$espacio_vacio;
    }
}
echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
echo '</div>';
