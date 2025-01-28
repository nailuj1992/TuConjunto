<?php
/* @var $this AutorizadoController */
/* @var $model Autorizado */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'autorizado-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>
    <?php
    $session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->getId()));
    ?>
    
    <?php echo SiteController::$form_required; ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'nombres', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'nombres', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'nombres', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'apellidos', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'apellidos', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'apellidos', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'cedula', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'cedula', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'cedula', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>


    <!--<div class="form-group">-->
        <?php // echo $form->labelEx($model, 'genero', array('class' => 'font_titulo')); ?>
        <?php // echo CHtml::activeDropDownList($model, 'genero', $model->getGender(), array('class' => 'form-control font_texto')); ?>
        <?php // echo $form->error($model, 'genero', array('class' => 'font_texto')); ?>
    <!--</div>-->

    <!--<div class="hr-line-dashed"></div>-->

    <div class="form-group">
        <?php echo $form->labelEx($model, 'foto', array('class' => 'font_titulo2')); ?>
        <label class="btn btn-success" for="Autorizado_foto">
            <?php echo CHtml::activeFileField($model, 'foto', array('size' => 60, 'maxlength' => 250, 'accept' => 'image/*', 'class' => 'form-control-file', 'style' => 'display: none;', 'onchange' => "$('#upload-file-info').html($(this).val());")); ?>
            Buscar...
        </label>
        <span class='label label-info' id="upload-file-info"></span>
        <?php
        if (!$model->isNewRecord) {
            if ($model->foto != "") {
                echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->foto, "image", array("width" => Contactos::$widthFoto));
            }
        }
        ?>
        <?php echo $form->error($model, 'foto', array('class' => 'font_texto')); ?>
    </div>
    
    
    <div class="hr-line-dashed"></div>
    
    
    
    
    <div class="form-group">
         <?php echo $form->labelEx($model, 'dia',array('class' => 'font_titulo2')); ?>        
        <?php echo CHtml::activeDropDownList($model, 'dia', $model->getDia(), array('class' => '')); ?>
        <?php echo $form->error($model,'dia'); ?>
    </div>
    
    <div class="hr-line-dashed"></div>

    
        <div class="form-group">
        <?php echo $form->labelEx($model, 'horaEntrada', array('class' => 'font_titulo2')); ?>        
        <?php echo CHtml::activeDropDownList($model, 'horaEntrada', $model->getTime(), array('class' => '')); ?>
        <?php echo $form->error($model, 'horaEntrada', array('class' => 'font_texto')); ?>
        <?php echo $form->labelEx($model, 'horaSalida', array('class' => 'font_titulo2')); ?>        
        <?php echo CHtml::activeDropDownList($model, 'horaSalida', $model->getTime(), array('class' => '')); ?>
        <?php echo $form->error($model, 'horaSalida', array('class' => 'font_texto')); ?>
    </div>
    
    
<!--    <div class="form-group">
        <?php // echo $form->labelEx($model, 'siempre'); ?>
        <?php // echo $form->checkBox($model,'siempre'); ?>
        <?php // echo $form->error($model, 'siempre'); ?>
    </div>-->

    <div class="form-group">
        <?php
        echo CHtml::submitButton($model->isNewRecord ? 'Autorizar contacto' : 'Guardar cambios', array('class' => "btn btn-primary"));
        echo SiteController::$espacio_vacio;

        echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->