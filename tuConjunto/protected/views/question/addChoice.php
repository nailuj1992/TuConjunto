<?php
/* @var $this QuestionController */
/* @var $model Answer */
/* @var $idEncuesta int (Encuestas) */
/* @var $question Question */
/* @var $form CActiveForm */
?>

<h1 class="font_titulo">
    <i class="fa fa-question-circle"></i> Añadir opción de pregunta</h1>
    <br>

<?php
$this->renderPartial('_form_choice', array('model' => $model, 'idEncuesta' => $idEncuesta, 'question' => $question));
