<?php
/* @var $this AsambleasController */
/* @var $model Asambleas */
?>

<h1 class="font_titulo">
    <i class="fa fa-exclamation-circle"></i> Modificar asamblea: <?php echo $model->titulo; ?></h1>
    <br>

<?php
$this->renderPartial('_form', array('model' => $model));
