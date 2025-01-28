<?php
/* @var $this NoticiasController */
/* @var $model Noticias */
?>

<h1 class="font_titulo">
    <i class="fa fa-newspaper-o"></i> Publicar noticia</h1>
    <br>

<?php $this->renderPartial('_form', array('model' => $model)); ?>

