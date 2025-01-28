<?php
/* @var $this UsuarioSeguridadController */
/* @var $model CrugeUser2 */
?>

<h1 class="font_titulo">
    <i class="fa fa-eye"></i> Crear usuario vigilante</h1>
    <br>

<?php
$this->renderPartial('_form', array(
    'model' => $model,
));
