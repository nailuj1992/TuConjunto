<?php
/* @var $this PerfilController */
/* @var $model Contactos */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'perfil-form',
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
        <?php echo $form->labelEx($model, 'nombres', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'nombres', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'nombres', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'apellidos', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'apellidos', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'apellidos', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'cedula', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'cedula', array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'cedula', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'telefono', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'telefono', array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'telefono', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'celular', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'celular', array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'celular', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'foto', array('class' => 'font_titulo2')); ?>
        <label class="btn btn-success" for="Contactos_foto">
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

    <div class="form-group">
        <?php echo $form->labelEx($model, 'genero', array('class' => 'font_titulo2')); ?>
        <?php echo CHtml::activeDropDownList($model, 'genero', $model->getGender(), array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'genero', array('class' => 'font_texto')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->error($model, 'Conjuntos_idConjunto', array('class' => 'font_texto')); ?>
    </div>

    <div class="container">
        <?php
        echo CHtml::submitButton('Guardar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('view', 'id' => $model->idContacto), array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->