<?php
/* @var $this MascotasController */
/* @var $model Mascotas */

$this->breadcrumbs = array(
    'Ver conjuntos' => array('index'),
    $model->idMascota => array('view', 'id' => $model->idMascota),
    'Modificar',
);

?>

<h1>Modificar mascota <?php echo $model->nombre; ?></h1>

<?php $this->renderPartial('_form_u', array('model' => $model)); ?>