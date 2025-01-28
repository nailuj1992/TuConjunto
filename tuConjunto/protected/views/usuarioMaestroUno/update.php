<?php
/* @var $this UsuarioMaestroUnoController */
/* @var $model CrugeUser2 */
?>

<h1 class="font_titulo">Modificar Usuario <?php echo $model->username; ?></h1>

<?php
$this->renderPartial('_form', array(
    'model' => $model,
));
