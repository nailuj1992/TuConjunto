<?php
/* @var $this PreguntasController */
/* @var $model Preguntas */
/* @var $id int (idAsamblea) */
?>

<h1 class="font_titulo">
    <i class="fa fa-question-circle"></i> Ver pregunta #<?php echo $model->idPregunta; ?></h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'itemCssClass' => array('detailViewTr'),
    'attributes' => array(
        'pregunta',
        array(
            'name' => 'Asambleas_idAsamblea',
            'value' => Asambleas::model()->findByPk($model->Asambleas_idAsamblea)->titulo,
        ),
    ),
));

echo '<div class="container">';
echo CHtml::link('Ver las preguntas', array('index', 'asamblea' => $id), array('class' => 'btn btn-info'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Registrar una pregunta', array('create', 'asamblea' => $id), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Modificar pregunta', array('update', 'id' => $model->idPregunta, 'asamblea' => $id), array('class' => 'btn btn-success'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Volver', array('index', 'asamblea' => $id), array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
echo '</div>';
