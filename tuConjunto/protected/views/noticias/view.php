<?php
/* @var $this NoticiasController */
/* @var $model Noticias */
?>

<h1 class="font_titulo"> 
    <i class="fa fa-newspaper-o"></i> Noticia "<?php echo $model->titulo; ?>"</h1>
    <br>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'titulo',
        array(
            'name' => 'Descripcion',
            'type' => 'raw',
            'header' => 'Resumen',
            'value' => $model->descripcion
        ),
        array(
            'name' => 'Fecha de publicacion',
            'header' => 'FechaPub',
            'value' => $model->fechaPub
        ),
    ),
));
?>

<?php echo CHtml::link('Ver noticias', array('index'),array('class'=>'btn btn-primary'));
?>
