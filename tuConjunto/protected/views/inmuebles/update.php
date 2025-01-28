<?php
/* @var $this InmueblesController */
/* @var $model Inmuebles */
?>

<h1 class="font_titulo"> <i class="fa fa-building"></i> Modificar Inmueble: <?php echo Inmuebles::getNombreInmueble($model); ?></h1>
<br>

<?php
$this->renderPartial('_form', array('model' => $model));
