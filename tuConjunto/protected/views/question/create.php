<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $id int (idAsamblea) */
?>

<h1 class="font_titulo">
    <i class="fa fa-question-circle"></i> Agregar una pregunta</h1>
    <br>

<?php
$this->renderPartial('_form_c', array('model' => $model, 'id' => $id));
