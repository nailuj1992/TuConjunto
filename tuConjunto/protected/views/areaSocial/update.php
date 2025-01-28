<?php
/* @var $this AreaSocialController */
/* @var $model Areasocial */
?>

<h1 class="font_titulo">Modificar área social "<?php echo $model->nombre; ?>"</h1>

<?php
$this->renderPartial('_form', array('model' => $model));
