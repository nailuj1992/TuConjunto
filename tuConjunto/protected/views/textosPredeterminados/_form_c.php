<?php
/* @var $this TextosPredeterminadosController */
/* @var $model TextosPredeterminados */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

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

    <?php echo SiteController::$form_required; ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'mensaje'); ?>
        <?php echo $form->textField($model, 'mensaje', array('size' => 60, 'maxlength' => 255,'class' => 'form-controlv2')); ?>
        <?php echo $form->error($model, 'mensaje'); ?>
    </div>


    <div class="form-group">

        <?php   echo CHtml::submitButton($model->isNewRecord ? 'Agregar texto' : 'Save', array('class'=>"btn btn-primary")); 
                echo SiteController::$espacio_vacio;
                echo CHtml::link('Volver',  array('index'), array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->