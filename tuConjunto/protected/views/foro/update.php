<?php
/* @var $this DocumentosController */
/* @var $model Documentos */
?>

<h1 class="font_titulo"><i class="fa fa-file-text"></i> Modificar documento "<?php echo $model->nombre; ?>"</h1>
<br>

<?php $this->renderPartial('_form_c', array('model' => $model)); ?>