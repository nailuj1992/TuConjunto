<?php
/* @var $this InmueblesController */
/* @var $model Archivosexcel */
?>

<h1 class="font_titulo">
    <i class="fa fa-building"></i> Agregar varios inmuebles</h1>
    <br>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'archivos-excel-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'nombre', array('class' => 'font_titulo2')); ?>
        <label class="btn btn-success" for="Archivosexcel_nombre">
            <?php echo CHtml::activeFileField($model, 'nombre', array('size' => 60, 'maxlength' => 250, 'accept' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'class' => 'form-control-file', 'style' => 'display: none;', 'onchange' => "$('#upload-file-info').html($(this).val());")); ?>
            Buscar...
        </label>
        <span class='label label-info' id="upload-file-info"></span>
        <?php echo $form->error($model, 'nombre', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php
        echo CHtml::submitButton('Agregar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Descargar plantilla', Yii::app()->baseUrl . "/download/inmuebles.xlsx", array('class' => 'btn btn-warning'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
