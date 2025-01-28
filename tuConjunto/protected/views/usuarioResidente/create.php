<?php
/* @var $this UsuarioResidenteController */
/* @var $model Residente */
?>

<h1 class="font_titulo">
    <i class="fa fa-users"></i> Crear usuario residente</h1>
    <br>

<?php
$this->renderPartial('_form_c', array(
    'model' => $model,
));
