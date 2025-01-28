<?php
/* @var $this MascotasController */
/* @var $model Mascotas */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'mascotas-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <?php echo SiteController::$form_required; ?>

    <?php // echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'nombre'); ?>
        <?php echo $form->textField($model, 'nombre', array('size' => 60, 'maxlength' => 255,'class' => 'form-controlv2')); ?>
        <?php echo $form->error($model, 'nombre'); ?>
    </div>
    
    <div class="hr-line-dashed"></div>
    
    <div class="form-group">
        <?php echo $form->labelEx($model, 'raza'); ?>
        <?php echo $form->textField($model, 'raza', array('size' => 60, 'maxlength' => 255,'class' => 'form-controlv2')); ?>
        <?php echo $form->error($model, 'raza'); ?>
    </div>
    
    <div class="hr-line-dashed"></div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'descripcion'); ?>
        <?php echo $form->textField($model, 'descripcion', array('size' => 60, 'maxlength' => 255,'class' => 'form-controlv2')); ?>
        <?php echo $form->error($model, 'descripcion'); ?>
    </div>
    
    <div class="hr-line-dashed"></div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'color'); ?>
        <?php echo $form->textField($model, 'color', array('size' => 11, 'maxlength' => 11,'class' => 'form-controlv2')); ?>
        <?php echo $form->error($model, 'color'); ?>
    </div>
    
    <div class="hr-line-dashed"></div>


   
    <div class="form-group">
        <?php echo $form->labelEx($model, 'animal'); ?>
        <?php echo $form->textField($model, 'animal', array('size' => 60, 'maxlength' => 255,'class' => 'form-controlv2')); ?>
        <?php echo $form->error($model, 'animal'); ?>
    </div>
        
    <div class="hr-line-dashed"></div>
    
         <div class="form-group">
        <?php echo $form->labelEx($model, 'foto', array('class' => 'font_titulo2')); ?>
        <label class="btn btn-success" for="Mascotas_foto">
            <?php echo CHtml::activeFileField($model, 'foto', array('size' => 60, 'maxlength' => 250, 'accept' => 'image/*', 'class' => 'form-control-file', 'style' => 'display: none;', 'onchange' => "$('#upload-file-info').html($(this).val());")); ?>
            Buscar...
        </label>
        <span class='label label-info' id="upload-file-info"></span>
        <?php
        if (!$model->isNewRecord) {
            if ($model->foto != "") {
                echo CHtml::image(Yii::app()->request->baseUrl . '/images/mascota_'. $model->idMascota . '_' . $model->foto, "image", array("width" => Contactos::$widthFoto));
            }
        }
        ?>
        <?php echo $form->error($model, 'foto', array('class' => 'font_texto')); ?>
    </div>
        
        
    <div class="form-group">

        <?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar mascota' : 'Guardar cambios', array('class'=>"btn btn-primary"));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver',  array('index'), array('class' => 'btn btn-danger'));
        ?>
    </div>    
        </div>



    <?php $this->endWidget(); ?>

</div><!-- form -->