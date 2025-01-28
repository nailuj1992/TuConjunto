<?php
/* @var $this InmueblesController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Inmuebles */
?>

<h1 class="font_titulo">
    <i class="fa fa-building"></i> Tus inmuebles</h1>
    <br>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'inmuebles-grid',
    'dataProvider' => $model->buscar(),
    'columns' => array(
        'idInmueble',
        array(
            'header' => 'Nombre',
            'value' => 'Inmuebles::getNombreInmueble($data)',
        ),
        array(
            'header' => 'Área construída',
            'value' => '$data->areaConstruida . " m2"',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
        ),
    ),
));

echo '<div class="container">';
echo CHtml::link('Registrar un inmueble', array('create'), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Registrar varios inmuebles', array('excel'), array('class' => 'btn btn-warning'));
echo SiteController::$espacio_vacio;
echo '</div>';
