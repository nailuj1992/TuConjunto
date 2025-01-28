<?php
/* @var $this PreguntasController */
/* @var $model Preguntas */
/* @var $id int (idAsamblea) */
?>

<h1 class="font_titulo">
    <i class="fa fa-question-circle"></i> Agregar pregunta</h1>
    <br>

<?php
$this->renderPartial('_form', array('model' => $model, 'id' => $id));
