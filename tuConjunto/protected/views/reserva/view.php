<?php
/* @var $this MascotasController */
/* @var $model Mascotas */

$this->breadcrumbs = array(
    'Ver mascota' => array('index'),
    $model-> idMascota,
);


?>

<h1>Información de <?php echo $model->nombre; ?></h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'itemCssClass'=>array('detailViewTr'),

    'attributes' => array(
        'nombre',
        'raza',
        'descripcion',
        'color',
        'dechaNacimiento',
        'animal',
        'Inmuebles_idInmueble',
    ),
));
?>

<?php echo CHtml::link('Ver mascotas', array('index'),array('class'=>'btn btn-primary'));
?>
