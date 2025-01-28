<?php
/* @var $this VehiculosController */
/* @var $model Vehiculos */

$this->breadcrumbs = array(
    'Ver vehículos' => array('index'),
    $model->idParqueadero,
);


?>

<h1>Parqueadero número <?php echo $model->numero; ?></h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'numero',
        'ubicacion',
        'Inmuebles_idInmueble',

    ),
));
?>

<?php echo CHtml::link('Ver parqueaderos', array('index'),array('class'=>'btn btn-primary'));
?>
