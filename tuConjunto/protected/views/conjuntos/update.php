<?php
/* @var $this ConjuntosController */
/* @var $model Conjuntos */
?>

<h1 class="font_titulo">
    <i class="fa fa-diamond"></i> Modificar conjunto: <?php echo $model->nombre; ?></h1>
    <br>

<?php
$this->renderPartial('_form_u', array('model' => $model));
