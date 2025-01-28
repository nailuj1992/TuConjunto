<?php
/* @var $this ConjuntosController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Conjuntos */
?>

<h1 class="font_titulo">Ver conjuntos</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'conjuntos-grid',
    'dataProvider' => $model->search(),
    'columns' => array(
        'nombre',
        'nit',
        'direccion',
        'telefono',
        'estrato',
        'dominio',
        array(
            'class' => 'CButtonColumn',
            'header' => 'Acciones',
            'template' => '{view}{update}',
        ),
    ),
));

echo '<div class="container">';
echo CHtml::link('Registrar un conjunto', array('create'), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo '</div>';