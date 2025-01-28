<?php
/* @var $this QuejasController */
/* @var $model Quejas */
?>

<h1 class="font_titulo">
<i class="fa fa-envelope-o"></i> Enviar mensaje</h1>
<br>

<?php
$this->renderPartial('_form_c', array('model' => $model)); ?>
