<?php
/* @var $this EncuestasController */
/* @var $model Encuestas */
?>

<h1 class="font_titulo">
    <i class="fa fa-question-circle"></i> Modificar encuesta #<?php echo $model->idEncuesta; ?></h1>
    <br>

<?php
$this->renderPartial('_form', array('model' => $model));
