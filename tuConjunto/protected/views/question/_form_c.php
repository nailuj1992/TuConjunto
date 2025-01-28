<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $id int (idAsamblea) */
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
    ));
    ?>

    <?php echo SiteController::$form_required; ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'pregunta', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'pregunta', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'pregunta', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'tipo', array('class' => 'font_titulo2')); ?>
        <?php echo CHtml::activeDropDownList($model, 'tipo', Question::getTipos(), array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'tipo', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php
        echo CHtml::submitButton('Crear', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('index', 'encuesta' => $id), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->