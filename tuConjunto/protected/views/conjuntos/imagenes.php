<?php
/* @var $this ConjuntosController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Imagenes */
/* @var $conjunto Conjuntos */
?>

<h1 class="font_titulo"> 
    <i class="fa fa-camera"></i> Ver imágenes</h1>
    <br>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'imagenes-grid',
    'dataProvider' => $model->buscar($conjunto->idConjunto),
    'columns' => array(
        array(
            'name' => 'nombre',
            'type' => 'html',
            'value' => '$data->nombre != "" ? CHtml::image(Yii::app()->request->baseUrl . \'/images/\' . $data->nombre, \'alt\', array("width" => Imagenes::$widthImagen)) : ""',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'buttons' => array(
                'delete' => array(
                    'label' => 'Borrar',
                    'url' => 'array("delImage", \'id\' => $data->idImagen)',
                ),
            ),
        ),
    ),
));

echo '<div class="container">';
$idConjunto = $conjunto->idConjunto;
$imagenes = Imagenes::model()->findAll(Imagenes::buscarCriteria($idConjunto));
if (sizeof($imagenes) < Imagenes::$maximoImagenes) {
    echo CHtml::link('Agregar una imagen', array('addImage', 'id' => $idConjunto), array('class' => 'btn btn-primary'));
    echo SiteController::$espacio_vacio;
}
echo CHtml::link('Ver conjunto', array('view', 'id' => $conjunto->idConjunto), array('class' => 'btn btn-warning'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Volver', array('view', 'id' => $conjunto->idConjunto), array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
echo '</div>';
