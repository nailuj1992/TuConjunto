<?php
/* @var $this PreguntasController */
/* @var $model Preguntas */
/* @var $id int (idAsamblea) */
?>

<h1 class="font_titulo">
    <i class="fa fa-question-circle"></i> Modificar pregunta #<?php echo $model->idPregunta; ?></h1>
    <br>

<?php
$this->renderPartial('_form', array('model' => $model, 'id' => $id));
