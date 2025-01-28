<?php
/* @var $this VehiculosController */
/* @var $model Vehiculos */
?>

<h1 class="font_titulo">
    <i class="fa fa-car"></i> Modificar vehículo con placas <?php echo $model->placa; ?></h1>
    <br>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
