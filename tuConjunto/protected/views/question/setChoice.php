<?php
/* @var $this QuestionController */
/* @var $model Answer */
/* @var $idEncuesta int (Encuestas) */
/* @var $question Question */
/* @var $form CActiveForm */
?>

<h1 class="font_titulo"><i class="fa fa-question-circle"></i> Modificar opción</h1>
<br>

<?php
$this->renderPartial('_form_choice', array('model' => $model, 'idEncuesta' => $idEncuesta, 'question' => $question));
