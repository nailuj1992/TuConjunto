<?php
/* @var $this ConjuntosController */
/* @var $model Conjuntos */

$this->breadcrumbs = array(
    'Ver textos predeterminados' => array('index'),
    $model->idTexto => array('view', 'id' => $model->idTexto),
    'Modificar',
);

?>

<h1>Modificar texto "<?php echo $model->mensaje; ?>"</h1>

<?php $this->renderPartial('_form_u', array('model' => $model)); ?>
<?php     echo CHtml::link('Volver', array('index'),array('class'=>'btn btn-danger'));
?>