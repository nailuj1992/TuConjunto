<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $id int (idEncuesta) */
?>

<h1 class="font_titulo">
    <i class="fa fa-question-circle"></i> Tus preguntas</h1>
    <br>

<?php
$dataProvider = $model->buscar($id);
$columns = array(
    'pregunta',
    array(
        'name' => 'Tipo',
        'value' => 'Question::getTipo($data->tipo)',
    ),
    array(
        'header' => 'Encuesta',
        'value' => 'Encuestas::model()->findByPk($data->Encuestas_idEncuesta)->titulo',
    ),
    array(
        'class' => 'CButtonColumn',
        'template' => '{view}{update}',
        'buttons' => array(
            'view' => array(
                'label' => 'Ver',
                'url' => 'array("question/view/?id=$data->idQuestion&encuesta=' . $id . '")'
            ),
            'update' => array(
                'label' => 'Editar',
                'url' => 'array("question/update/?id=$data->idQuestion&encuesta=' . $id . '")'
            ),
        ),
    ),
);

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'preguntas-grid',
    'dataProvider' => $dataProvider,
    'columns' => $columns,
));

echo '<div class="container">';
echo CHtml::link('Volver a la encuesta', array('/encuestas/view', 'id' => $id), array('class' => 'btn btn-info'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Modificar encuesta', array('/encuestas/update', 'id' => $id), array('class' => 'btn btn-success'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Registrar una pregunta', array('create', 'encuesta' => $id), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Volver', array('/encuestas/view', 'id' => $id), array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
echo '</div>';
