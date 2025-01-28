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

    <div class="form-group">
        <?php
        $zona = Inmuebles::getZona($model->zona) . " " . ($model->numZona != null ? "$model->numZona " : "");
        $tipo = Inmuebles::getTipoInmueble($model->tipo);
        echo "<h2 class=\"font_texto\">¿Está seguro de que desea ser el titular del inmueble $zona $tipo $model->nombre, <br>"
        . "con matrícula inmobiliaria <b>$model->matriculaInmobiliaria</b>?</h2>";
        ?>
    </div>

    <div class="form-group">
        <?php
        echo CHtml::submitButton('Sí', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('No', array('/'), array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->