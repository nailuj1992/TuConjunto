<?php
/* @var $this QuejasController */
/* @var $model Quejas */

$this->breadcrumbs = array(
    'Ver mensajes' => array('index'),
    $model->idQueja,
);


?>

<h1>Mensaje para <?php echo Inmuebles::model()->getNombre($model->idDestinatario); ?></h1>



<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
     
//        'idRemitente',
         array(
            'name' => 'Remitente',
            'header' => 'Remitente',
            'value' => Inmuebles::model()->getNombre($model->idRemitente)
        ),
//        'idDestinatario',
        array(
            'name' => 'Destinatario',
            'header' => 'Destinatario',
            'value' => Inmuebles::model()->getNombre($model->idDestinatario)
        ),
//        'idTextoPredeterminado',
        array(
            'name' => 'Mensaje',
            'header' => 'Mensaje',
            'value' => Textospredeterminados::model()->getMensaje($model->idTextoPredeterminado)
        ),
    ),
));
?>

<?php echo CHtml::link('Ver mensajes', array('index'),array('class'=>'btn btn-primary'));
?>
