<?php
/* @var $this InmueblesController */
/* @var $model Inmuebles */
?>

<h1 class="font_titulo"> <i class="fa fa-building"></i> Tu inmueble: <?php echo Inmuebles::getNombreInmueble($model); ?></h1>
<br>

<?php
if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)) {
    $columns = array(
        'idInmueble',
        array(
            'name' => 'Nombre',
            'value' => Inmuebles::getNombreInmueble($model),
        ),
        'coeficienteCopropiedad',
        'matriculaInmobiliaria',
        'areaConstruida',
    );
} else if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)) {
    $columns = array(
        array(
            'name' => 'Nombre',
            'value' => Inmuebles::getNombreInmueble($model),
        ),
        'coeficienteCopropiedad',
        'matriculaInmobiliaria',
        'areaConstruida',
    );
} else {
    $columns = array();
}
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'itemCssClass' => array('detailViewTr'),
    'attributes' => $columns,
));

echo '<div class="container">';
if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)) {
    echo CHtml::link('Ver los inmuebles', array('index'), array('class' => 'btn btn-info'));
    echo SiteController::$espacio_vacio;
    echo CHtml::link('Registrar un inmueble', array('create'), array('class' => 'btn btn-primary'));
    echo SiteController::$espacio_vacio;
}
echo CHtml::link('Modificar inmueble', array('update', 'id' => $model->idInmueble), array('class' => 'btn btn-success'));
echo SiteController::$espacio_vacio;
if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)) {
    echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
    echo SiteController::$espacio_vacio;
}
echo '</div>';
