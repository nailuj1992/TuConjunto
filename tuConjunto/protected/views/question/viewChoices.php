<?php
/* @var $this QuestionController */
/* @var $model Answer */
/* @var $idEncuesta int (Encuestas) */
/* @var $question Question */
?>

<h1 class="font_titulo"><i class="fa fa-question-circle"></i> Ver opciones de la pregunta:</h1>
<h2 class="font_titulo"><?php echo $question->pregunta ?></h2>
<br>

<?php
$dataProvider = $model->buscar($idEncuesta, $question->idQuestion);
$columns = array(
    'contenido',
    array(
        'class' => 'CButtonColumn',
        'template' => '{update}',
        'buttons' => array(
            'update' => array(
                'label' => 'Editar',
                'url' => 'array("question/setChoice/?id=$data->Question_idQuestion&encuesta=' . $idEncuesta . '&answer=$data->idAnswer")'
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
echo CHtml::link('Ver las preguntas', array('index', 'encuesta' => $idEncuesta), array('class' => 'btn btn-info'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Registrar una pregunta', array('create', 'encuesta' => $idEncuesta), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Modificar pregunta', array('update', 'id' => $question->idQuestion, 'encuesta' => $idEncuesta), array('class' => 'btn btn-success'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Añadir una opción', array('addChoice', 'id' => $question->idQuestion, 'encuesta' => $idEncuesta), array('class' => 'btn btn-warning'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Volver', array('view', 'id' => $question->idQuestion, 'encuesta' => $idEncuesta), array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
echo '</div>';
