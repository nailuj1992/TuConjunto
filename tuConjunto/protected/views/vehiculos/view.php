<?php
/* @var $this VehiculosController */
/* @var $model Vehiculos */
?>

<h1 class="font_titulo">Vehículo con placas <?php echo $model->placa; ?></h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'marca',
        'modelo',
        'serie',
        'color',
        'observacion',
    ),
));
?>

<?php echo CHtml::link('Ver vehículos', array('index'),array('class'=>'btn btn-primary'));
?>
