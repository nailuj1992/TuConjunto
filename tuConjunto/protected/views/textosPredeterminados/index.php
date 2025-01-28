<?php
/* @var $this TextosPredeterminadosController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model TextosPredeterminados */
?>

<h1 class="font_titulo">Lista de textos predeterminados</h1>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('TextosPredeterminados', array(
        'criteria' => array(
            'condition' => "true"
        ),
            )),
    'columns' => array(
        'mensaje',
        array(
            'class' => 'CButtonColumn',
            'template' => '{update}',
        ),
    ),
));

    echo CHtml::link('Agregar nuevo texto', array('textosPredeterminados/create/'.$model->idTexto),array('class'=>'btn btn-primary'));
?>


