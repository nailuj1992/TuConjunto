<?php
/* @var $this InmueblesController */
/* @var $model Inmuebles */
?>

<h1 class="font_titulo">
    <i class="fa fa-building"></i> Crear un inmueble</h1>
    <br>

<?php
$this->renderPartial('_form', array('model' => $model));
