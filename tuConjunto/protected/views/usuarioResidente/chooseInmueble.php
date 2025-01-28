<?php
/* @var $this UsuarioResidenteController */
/* @var $model Inmueblesporcontacto */
/* @var $inmuebles Inmuebles */
/* @var $form CActiveForm */
?>

<h1 class="font_titulo">
    <i class="fa fa-building"></i> Escoger inmueble</h1>
    <br>
    
<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'inmueblesporcontacto-form',
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
        <?php echo $form->labelEx($model, 'Inmuebles_idInmueble', array('class' => 'font_titulo2')); ?>
        <?php
        $inmuebles = Inmuebles::buscarInmuebles(CrugeAuthitem2::$rolResidente, Yii::app()->user->id);
        echo CHtml::activeDropDownList($model, 'Inmuebles_idInmueble', CHtml::listData($inmuebles, 'idInmueble', function($inmueble) {
            return Inmuebles::getNombreInmueble($inmueble);
        }, 'nombreConjunto'), array(
            'empty' => Inmuebles::$seleccioneInmueble,
            'class' => 'form-control font_texto',
        ));
        ?>
        <?php echo $form->error($model, 'Inmuebles_idInmueble', array('class' => 'font_texto')); ?>
    </div>

    <div class="container">
        <?php
        echo CHtml::submitButton('Seleccionar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('/'), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->