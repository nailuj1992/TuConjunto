<?php
/* @var $this EncuestasController */
/* @var $model Encuestas */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'encuestas-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo SiteController::$form_required; ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'titulo', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'titulo', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'titulo', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'descripcion', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'descripcion', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'descripcion', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'fechaInicio', array('class' => 'font_titulo2')); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', FechasField::getFechaSelector($model, 'fechaInicio')); ?>
        <?php echo $form->error($model, 'fechaInicio', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'fechaFin', array('class' => 'font_titulo2')); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', FechasField::getFechaSelector($model, 'fechaFin')); ?>
        <?php echo $form->error($model, 'fechaFin', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php
        echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', $model->isNewRecord ? array('index') : array('view', 'id' => $model->idEncuesta), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->