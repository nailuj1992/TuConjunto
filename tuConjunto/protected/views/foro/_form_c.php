<?php
/* @var $this DocumentosController */
/* @var $model Documentos */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'documentos-form',
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
        <?php echo $form->labelEx($model, 'tema'); ?>
        <?php echo $form->textField($model, 'tema', array('size' => 60, 'maxlength' => 100, 'class' => 'form-controlv2')); ?>
        <?php echo $form->error($model, 'tema'); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'mensaje'); ?>
        <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
               'model'=>$model,
               /*El atributo es la DescripcionNoticia*/
               'attribute'=>'mensaje',
        )); ?>
        <?php echo $form->error($model, 'mensaje'); ?>
        
    </div>

    <div class="hr-line-dashed"></div>


    <div class="form-group">

        <?php
        echo CHtml::submitButton($model->isNewRecord ? 'Enviar pregunta' : 'Guardar cambios', array('class' => "btn btn-primary"));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', 'javascript:history.back()', array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->