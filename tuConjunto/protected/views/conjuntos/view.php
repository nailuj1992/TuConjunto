<?php
/* @var $this ConjuntosController */
/* @var $model Conjuntos */
?>

<h1 class="font_titulo">
    <i class="fa fa-diamond"></i> Tu conjunto: <?php echo $model->nombre; ?></h1>
    <br>

<?php
$logo = $model->logo != "" ? CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->logo, 'alt', array("width" => Conjuntos::$widthLogo)) : "";
$ciudad = Ciudades::model()->findByPk($model->Ciudades_idCiudades);
$departamento = Departamentos::model()->findByPk($ciudad->Departamentos_idDepartamentos);

$deptoColumn = array(
    'name' => 'Departamento',
    'value' => "$departamento->nombre",
);
$ciudadColumn = array(
    'name' => 'Ciudades_idCiudades',
    'value' => "$ciudad->nombre",
);
$logoColumn = array(
    'name' => 'logo',
    'value' => "$logo",
    'type' => 'raw',
);
if (Yii::app()->user->isSuperAdmin) {
    $columns = array('idConjunto', 'nombre', 'nit', 'direccion', 'telefono', $deptoColumn, $ciudadColumn, 'estrato', $logoColumn, 'dominio');
} else {
    $columns = array('nombre', 'nit', 'direccion', 'telefono', $deptoColumn, $ciudadColumn, 'estrato', $logoColumn, 'dominio');
}

$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'itemCssClass' => array('detailViewTr'),
    'attributes' => $columns,
));

echo '<div class="container">';
if (Yii::app()->user->isSuperAdmin) {
    echo CHtml::link('Ver los conjuntos', array('index'), array('class' => 'btn btn-info'));
    echo SiteController::$espacio_vacio;
    echo CHtml::link('Registrar un conjunto', array('create'), array('class' => 'btn btn-primary'));
    echo SiteController::$espacio_vacio;
}
echo CHtml::link('Modificar conjunto', array('update', 'id' => $model->idConjunto), array('class' => 'btn btn-success'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Ver imágenes', array('imagenes', 'id' => $model->idConjunto), array('class' => 'btn btn-warning'));
echo SiteController::$espacio_vacio;
if (Yii::app()->user->isSuperAdmin) {
    echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
    echo SiteController::$espacio_vacio;
}
echo '</div>';
