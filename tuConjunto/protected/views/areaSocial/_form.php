<?php
/* @var $this AreaSocialController */
/* @var $model Areasocial */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'areasocial-form',
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
        <?php echo $form->labelEx($model, 'nombre', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'nombre', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'nombre', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'precio', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'precio', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'precio', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'descripcion', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'descripcion', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'descripcion', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'tarifa', array('class' => 'font_titulo2')); ?>
        <br>
        <?php
        echo '<div class="form-control font_titulo2">';
        echo '<input type="radio" name="Areasocial[tarifa]"  value="F" required ' . ($model->tarifa == 'F' ? 'checked' : '') . '>Por jornada';
        echo '</div>';
        echo '<div class="form-control font_titulo2">';
        echo '<input type="radio" name="Areasocial[tarifa]"  value="H" required ' . ($model->tarifa == 'H' ? 'checked' : '') . '>Por hora';
        echo '</div>';
        ?>
        <?php echo $form->error($model, 'tarifa', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php
        echo CHtml::submitButton($model->isNewRecord ? 'Registrar' : 'Guardar', array('class' => "btn btn-primary"));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->