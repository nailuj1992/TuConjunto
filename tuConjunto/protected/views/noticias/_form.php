<?php
/* @var $this NoticiasController */
/* @var $model Noticias */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'noticias-form',
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
        <?php echo $form->labelEx($model, 'titulo'); ?>
        <?php echo $form->textField($model, 'titulo', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'titulo'); ?>
    </div>
    
        <div class="hr-line-dashed"></div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'descripcion'); ?>
        <?php $this->widget('application.extensions.eckeditor.ECKEditor', array(
               'model'=>$model,
               /*El atributo es la DescripcionNoticia*/
               'attribute'=>'descripcion',
        )); ?>
        <?php echo $form->error($model, 'descripcion'); ?>
        
    </div>
        
            <div class="hr-line-dashed"></div>


    <div class="form-group">

        <?php echo CHtml::submitButton($model->isNewRecord ? 'Publicar' : 'Guardar cambios', array('class'=>"btn btn-primary")); 
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Cancelar', array('index'), array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->