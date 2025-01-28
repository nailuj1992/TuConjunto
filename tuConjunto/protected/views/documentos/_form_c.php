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
        <?php echo $form->labelEx($model, 'nombre'); ?>
        <?php echo $form->textField($model, 'nombre', array('size' => 60, 'maxlength' => 255, 'class' => 'form-controlv2')); ?>
        <?php echo $form->error($model, 'nombre'); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'categoria'); ?>
        <?php echo CHtml::activeDropDownList($model, 'categoria', Documentos::model()->getCategories(), array('class' => 'form-controlv2')); ?>
        <?php echo $form->error($model, 'categoria'); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'urlDocumento'); ?>
        <label class="btn btn-success" for="Documentos_urlDocumento">
            <?php echo CHtml::activeFileField($model, 'urlDocumento', array('size' => 60, 'maxlength' => 250, 'accept' => 'application/pdf', 'class' => 'form-control-file', 'style' => 'display: none;', 'onchange' => "$('#upload-file-info').html($(this).val());")); ?>
            Buscar...
        </label>
        <span class='label label-info' id="upload-file-info"></span>
        <?php echo $form->error($model, 'urlDocumento'); ?>
    </div>
    
    
    <div class="hr-line-dashed"></div>


    <div class="form-group">

        <?php
        echo CHtml::submitButton($model->isNewRecord ? 'Subir documento' : 'Guardar cambios', array('class' => "btn btn-primary"));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', 'javascript:history.back()', array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->