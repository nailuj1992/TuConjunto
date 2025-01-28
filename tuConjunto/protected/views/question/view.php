<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $id int (idAsamblea) */
?>

<h1 class="font_titulo">
    <i class="fa fa-question-circle"></i> Ver pregunta #<?php echo $model->idQuestion; ?></h1>
    <br>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'itemCssClass' => array('detailViewTr'),
    'attributes' => array(
        'pregunta',
        array(
            'name' => 'tipo',
            'value' => Question::getTipo($model->tipo),
        ),
        array(
            'name' => 'Encuestas_idEncuesta',
            'value' => Encuestas::model()->findByPk($model->Encuestas_idEncuesta)->titulo,
        ),
    ),
));

echo '<div class="container">';
echo CHtml::link('Ver las preguntas', array('index', 'encuesta' => $id), array('class' => 'btn btn-info'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Registrar una pregunta', array('create', 'encuesta' => $id), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Modificar pregunta', array('update', 'id' => $model->idQuestion, 'encuesta' => $id), array('class' => 'btn btn-success'));
echo SiteController::$espacio_vacio;
if ($model->tipo == Question::$SelMul) {
    echo CHtml::link('Ver opciones', array('viewChoices', 'id' => $model->idQuestion, 'encuesta' => $id), array('class' => 'btn btn-warning'));
    echo SiteController::$espacio_vacio;
}
echo CHtml::link('Volver', array('index', 'encuesta' => $id), array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
echo '</div>';
