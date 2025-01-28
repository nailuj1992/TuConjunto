<?php
/* @var $this VehiculosController */
/* @var $model Vehiculos */
/* @var $form CActiveForm */
?>

<div class="form">

  <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'horario-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php // echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'nombre'); ?>
        <?php echo $form->textField($model, 'nombre', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'nombre'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'raza'); ?>
        <?php echo $form->textField($model, 'raza', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'raza'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'descripcion'); ?>
        <?php echo $form->textField($model, 'descripcion', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'descripcion'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'color'); ?>
        <?php echo $form->textField($model, 'color', array('size' => 11, 'maxlength' => 11,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'color'); ?>
    </div>

   <div class="form-group">
        <?php echo $form->labelEx($model, 'fechaNacimiento'); ?>
        <?php echo $form->textField($model, 'fechaNacimiento', array('size' => 6, 'maxlength' => 6,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'fechaNacimiento'); ?>
    </div>
    
       <div class="form-group">
        <?php echo $form->labelEx($model, 'animal'); ?>
        <?php echo $form->textField($model, 'animal', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'animal'); ?>
    </div>
    
        </div>
    
       <div class="form-group">
        <?php echo $form->labelEx($model, 'Inmuebles_idInmueble'); ?>
        <?php echo $form->textField($model, 'Inmuebles_idInmueble', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'Inmuebles_idInmueble'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Guardar cambios',array('class'=>"btn btn-primary"));
        echo ' ';
        echo CHtml::link('Volver', 'javascript:history.back()', array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>
    
</div><!-- form -->