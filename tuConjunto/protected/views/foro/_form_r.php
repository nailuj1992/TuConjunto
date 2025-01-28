<?php
/* @var $this ForoController */
/* @var $model Foro */
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

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'mensaje'); ?>
        <?php
        $this->widget('application.extensions.eckeditor.ECKEditor', array(
            'model' => $model,
            /* El atributo es la DescripcionNoticia */
            'attribute' => 'mensaje',
        ));
        ?>
<?php echo $form->error($model, 'mensaje'); ?>

    </div>

    <div class="hr-line-dashed"></div>


    <div class="form-group">

        <?php
        echo CHtml::submitButton($model->isNewRecord ? 'Enviar respuesta' : 'Guardar cambios', array('class' => "btn btn-primary"));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', 'javascript:history.back()', array('class' => 'btn btn-danger'));
        ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->