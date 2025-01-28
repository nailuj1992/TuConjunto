<?php
/* @var $this UsuarioResidenteController */
/* @var $model CrugeUser2 */
?>

<h1 class="font_titulo">
    <i class="fa fa-users"></i> Modificar usuario: <?php echo $model->username; ?></h1>
    <br>

<?php
$this->renderPartial('_form_u', array(
    'model' => $model,
));
