<?php
/* @var $this CarteleraController */
/* @var $model Cartelera */
?>

<h1 class="font_titulo"> 
    <i class="fa fa-list-ul"></i> Anuncio "<?php echo $model->titulo; ?>"</h1>
<br>
<h3 class="font_titulo2">Fecha de publicación:  <?php echo $model->fechaPub; ?> </h3>

<div class="col-sm-12 divanuncio">
    <div class ="col-sm-4">        
        <?php echo(CHtml::image(Yii::app()->request->baseUrl . "/images/" . $model->fotoPrincipal, "image", array("width" => 350, "height" => 350))); ?>
    </div> 
    <div class="col-sm-8">
        <h2>
            <?php echo ($model->descripcion); ?>
        </h2>
    </div>
</div>

<?php echo CHtml::link('Ver anuncios', array('index'), array('class' => 'btn btn-primary'));
?>
