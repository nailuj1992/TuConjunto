<?php
/* @var $this AreaSocialController */
/* @var $model Areasocial */
?>

<h1 class="font_titulo">Área social: "<?php echo $model->nombre; ?>"</h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'nombre',
        'descripcion',
        array(
            'name' => 'Tarifa',
            'header' => 'Tarifa',
            'value' => Areasocial::model()->getTarifa($model->idAreaSocial)
        ),
    ),
));
?>

<?php
echo CHtml::link('Ver áreas sociales', array('index'), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Modificar área social', array('update', 'id' => $model->idAreaSocial), array('class' => 'btn btn-success'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Volver',  array('index'), array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
