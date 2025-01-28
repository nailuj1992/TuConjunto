<?php
/* @var $this VehiculosController */
/* @var $model Vehiculos */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'vehiculos-form',
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
        <?php echo $form->labelEx($model, 'marca'); ?>
        <?php echo $form->textField($model, 'marca', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'marca'); ?>
    </div>
    
    
    <div class="hr-line-dashed"></div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'modelo'); ?>
        <?php echo $form->textField($model, 'modelo', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'modelo'); ?>
    </div>
    
    
    <div class="hr-line-dashed"></div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'serie'); ?>
        <?php echo $form->textField($model, 'serie', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'serie'); ?>
    </div>
    
    
    <div class="hr-line-dashed"></div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'color'); ?>
        <?php echo $form->textField($model, 'color', array('size' => 255, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'color'); ?>
    </div>
    
    
    <div class="hr-line-dashed"></div>


    <div class="form-group">
         <?php echo $form->labelEx($model, 'placa'); ?>
         <?php echo $form->textField($model, 'placa', array('size' => 6, 'maxlength' => 6,'class' => 'form-control')); ?>
         <?php echo $form->error($model, 'placa'); ?>
     </div>
    
    
    <div class="hr-line-dashed"></div>

    
    <div class="form-group">
         <?php echo $form->labelEx($model, 'observacion'); ?>
         <?php echo $form->textField($model, 'observacion', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
         <?php echo $form->error($model, 'observacion'); ?>
    </div>
    
    
    <div class="hr-line-dashed"></div>


    <div class="form-group">

        <?php echo CHtml::submitButton($model->isNewRecord ? 'Registrar vehículo' : 'Guardar cambios', array('class'=>"btn btn-primary")); 
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->