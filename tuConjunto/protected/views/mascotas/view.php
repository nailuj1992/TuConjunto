<?php
/* @var $this MascotasController */
/* @var $model Mascotas */
?>

<h1 class="font_titulo">Información de <?php echo $model->nombre; ?></h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'itemCssClass'=>array('detailViewTr'),

    'attributes' => array(
        'nombre',
        'raza',
        'descripcion',
        'color',
        'animal',
    ),
));
?>

<?php echo CHtml::link('Ver mascotas', array('index'),array('class'=>'btn btn-primary'));
?>
