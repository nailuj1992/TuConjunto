<?php
/* @var $this ParqueaderosController */
/* @var $model Parqueaderos */
?>

<h1 class="font_titulo">
    <i class="fa fa-caret-square-o-down"></i> Modificar parqueadero número <?php echo $model->numero; ?></h1>
    <br>

<?php $this->renderPartial('_form_c', array('model' => $model)); ?>