<?php
/* @var $this CarteleraController */
/* @var $model Cartelera */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'noticias-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <?php echo SiteController::$form_required; ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'titulo'); ?>
        <?php echo $form->textField($model, 'titulo', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'titulo'); ?>
    </div>
    
    <div class="hr-line-dashed"></div>
    
     <div class="form-group">
        <?php echo $form->labelEx($model, 'fotoPrincipal', array('class' => 'font_titulo2')); ?>
        <label class="btn btn-success" for="Cartelera_fotoPrincipal">
            <?php echo CHtml::activeFileField($model, 'fotoPrincipal', array('size' => 60, 'maxlength' => 250, 'accept' => 'image/*', 'class' => 'form-control-file', 'style' => 'display: none;', 'onchange' => "$('#upload-file-info').html($(this).val());")); ?>
            Buscar...
        </label>
        <span class='label label-info' id="upload-file-info"></span>
        <?php
        if (!$model->isNewRecord) {
            if ($model->fotoPrincipal != "") {
                echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->fotoPrincipal, "image", array("width" => Contactos::$widthFoto));
            }
        }
        ?>
        <?php echo $form->error($model, 'fotoPrincipal', array('class' => 'font_texto')); ?>
    </div>
    
    
    <div class="hr-line-dashed"></div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'descripcion'); ?>
        <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
               'model'=>$model,
               /*El atributo es la DescripcionNoticia*/
               'attribute'=>'descripcion',
        )); ?>
        <?php echo $form->error($model, 'descripcion'); ?>
        
    </div>
        
            <div class="hr-line-dashed"></div>


    <div class="form-group">

        <?php echo CHtml::submitButton($model->isNewRecord ? 'Publicar' : 'Guardar cambios', array('class'=>"btn btn-primary")); 
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Cancelar', array('index'), array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->