<?php
/* @var $this VehiculosController */
/* @var $model Vehiculos */

$this->breadcrumbs = array(
    'Ver vehículos' => array('index'),
    $model->idVehiculo,
);


?>

<h1>Vehículo con placas <?php echo $model->placa; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
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
