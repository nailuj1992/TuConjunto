<?php
/* @var $this TextosPredeterminadosController */
/* @var $model TextosPredeterminados */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'textospredeterminados-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    
       <div class="row">
        <?php echo $form->labelEx($model, 'mensaje'); ?>
        <?php echo $form->textField($model, 'mensaje', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'mensaje'); ?>
    </div>
    
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Guardar cambios',array('class'=>"btn btn-primary")); ?>
    </div>

    <?php $this->endWidget(); ?>
    
</div><!-- form -->