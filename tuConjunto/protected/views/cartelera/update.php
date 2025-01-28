<?php
/* @var $this CarteleraController */
/* @var $model Cartelera */

?>

<h1 class="font_titulo">
    <i class="fa fa-list-ul"></i> Editar anuncio "<?php echo $model->titulo; ?>"</h1>
    <br>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
