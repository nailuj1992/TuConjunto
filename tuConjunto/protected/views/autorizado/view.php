<?php
/* @var $this AutorizadoController */
/* @var $model Autorizado */
?>

<h1 class="font_titulo">Información del autorizado <?php echo $model->nombre; ?></h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'itemCssClass' => array('detailViewTr'),
    'attributes' => array(
        'idAutorizado',
        'Contactos_idContacto',
        'Inmuebles_idInmueble',
    ),
));
?>

<?php
echo CHtml::link('Ver Autorizados', array('index'), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Volver', 'javascript:history.back()', array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
