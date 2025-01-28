<?php
/* @var $this QuestionController */
/* @var $model Answer */
/* @var $idEncuesta int (Encuestas) */
/* @var $question Question */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'question-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <?php echo SiteController::$form_required; ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'contenido', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'contenido', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'contenido', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php
        echo CHtml::submitButton('Agregar opción', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('viewChoices', 'id' => $question->idQuestion, 'encuesta' => $idEncuesta), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->