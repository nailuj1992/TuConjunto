<?php
/* @var $this MascotasController */
/* @var $model Mascotas */
?>

<h1 class="font_titulo">
    <i class="fa fa-paw"></i>  Modificar mascota "<?php echo $model->nombre; ?>"</h1>
    <br>

<?php $this->renderPartial('_form_c', array('model' => $model)); ?>