<?php
/* @var $this ConjuntosController */
/* @var $model Imagenes */
?>

<h1 class="font_titulo">
    <i class="fa fa-camera"></i> Agregar imagen</h1>
    <br>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'imagenes-form',
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
        <label class="btn btn-success" for="Imagenes_nombre">
            <?php echo CHtml::activeFileField($model, 'nombre', array('size' => 60, 'maxlength' => 250, 'accept' => 'image/*', 'class' => 'form-control-file', 'style' => 'display: none;', 'onchange' => "$('#upload-file-info').html($(this).val());")); ?>
            Buscar...
        </label>
        <span class='label label-info' id="upload-file-info"></span>
        <?php
        if (!$model->isNewRecord) {
            if ($model->nombre != "") {
                echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->nombre, "image", array("width" => 100));
            }
        }
        ?>
        <?php echo $form->error($model, 'nombre', array('class' => 'font_texto')); ?>
    </div>

    <div class="container">
        <?php
        echo CHtml::submitButton('Agregar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('imagenes', 'id' => $model->Conjuntos_idConjunto), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
