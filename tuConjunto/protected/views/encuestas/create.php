<?php
/* @var $this EncuestasController */
/* @var $model Encuestas */
?>

<h1 class="font_titulo">
    <i class="fa fa-question-circle"></i> Crear una encuesta</h1>
    <br>

<?php
$this->renderPartial('_form', array('model' => $model));
