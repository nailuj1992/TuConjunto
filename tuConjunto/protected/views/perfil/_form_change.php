<?php
/* @var $this UsuarioResidenteController */
/* @var $contacto Contactos */
/* @var $model CambiarCredenciales */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'cambiar-credenciales-form',
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
        <?php echo $form->labelEx($model, 'username', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'username', array('class' => 'form-control font_texto', 'disabled' => 'disabled')); ?>
        <?php echo $form->error($model, 'username', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'email', array('class' => 'font_titulo2')); ?>
        <?php echo $form->emailField($model, 'email', array('class' => 'form-control font_texto', 'disabled' => 'disabled')); ?>
        <?php echo $form->error($model, 'email', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'password', array('class' => 'font_titulo2')); ?>
        <?php echo $form->passwordField($model, 'password', array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'password', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'new', array('class' => 'font_titulo2')); ?>
        <?php echo $form->passwordField($model, 'new', array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'new', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'renew', array('class' => 'font_titulo2')); ?>
        <?php echo $form->passwordField($model, 'renew', array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'renew', array('class' => 'font_texto')); ?>
    </div>

    <div class="container">
        <?php
        echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('view', 'id' => $contacto->idContacto), array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->