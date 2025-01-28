<?php
/* @var $this UsuarioMaestroDosController */
/* @var $model Inmuebles */
/* @var $contacto Contactos */
/* @var $form CActiveForm */
?>

<h1 class="font_titulo"> 
    <i class="fa fa-building"></i> Escoger inmueble</h1>
    <br>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'inmuebles-form',
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
        <?php echo $form->labelEx($model, 'idInmueble', array('class' => 'font_titulo2')); ?>
        <?php
        $inmuebles = Inmuebles::getInmuebles($contacto->Conjuntos_idConjunto);
        echo CHtml::activeDropDownList($model, 'idInmueble', CHtml::listData($inmuebles, 'idInmueble', 'nombre'), array(
            'empty' => Inmuebles::$seleccioneInmueble,
            'class' => 'form-control font_texto',
        ));
        ?>
        <?php echo $form->error($model, 'idInmueble', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php
        echo CHtml::submitButton('Seleccionar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('/'), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->