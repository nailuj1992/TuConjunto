<?php
/* @var $this ConjuntosController */
/* @var $model Conjuntos */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'conjuntos-form',
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
        <?php echo $form->labelEx($model, 'nombre', array('class' => 'font_titulo')); ?>
        <?php echo $form->textField($model, 'nombre', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'nombre', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'nit', array('class' => 'font_titulo')); ?>
        <?php echo $form->textField($model, 'nit', array('size' => 11, 'maxlength' => 11, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'nit', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'direccion', array('class' => 'font_titulo')); ?>
        <?php echo $form->textField($model, 'direccion', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'direccion', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'telefono', array('class' => 'font_titulo')); ?>
        <?php echo $form->textField($model, 'telefono', array('size' => 11, 'maxlength' => 11, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'telefono', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'departamento', array('class' => 'font_titulo')); ?>
        <?php
        echo $form->dropDownList($model, 'departamento', CHtml::listData(Departamentos::getDepartamentos(), 'idDepartamentos', 'nombre'), array(
            'empty' => Departamentos::$seleccioneDepartamento,
            'ajax' => array(
                'type' => 'POST', //request type
                'url' => CController::createUrl('dynamicCities'),
                'update' => '#Conjuntos_Ciudades_idCiudades',
            ),
            'class' => 'form-control font_texto',
        ));
        ?>
        <?php echo $form->error($model, 'departamento', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'Ciudades_idCiudades', array('class' => 'font_titulo')); ?>
        <?php $idDepto = $model->departamento ?>
        <?php if (isset($idDepto) && $idDepto != " " && Departamentos::model()->findByPk($idDepto)) { ?>
            <?php
            echo $form->dropDownList($model, 'Ciudades_idCiudades', CHtml::listData(Ciudades::getCiudadesDepto($idDepto), 'idCiudades', 'nombre'), array(
                'empty' => Ciudades::$seleccioneCiudad,
                'class' => 'form-control font_texto',
            ));
            ?>
            <?php
        } else {
            echo $form->dropDownList($model, 'Ciudades_idCiudades', array('empty' => Ciudades::$seleccioneCiudad), array('class' => 'form-control font_texto'));
        }
        ?>
        <?php echo $form->error($model, 'Ciudades_idCiudades', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'estrato', array('class' => 'font_titulo')); ?>
        <?php echo $form->dropDownList($model, 'estrato', Conjuntos::getEstratos(), array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'estrato', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'logo', array('class' => 'font_titulo')); ?>
        <label class="btn btn-success" for="Conjuntos_logo">
            <?php echo CHtml::activeFileField($model, 'logo', array('size' => 60, 'maxlength' => 250, 'accept' => 'image/*', 'class' => 'form-control-file', 'style' => 'display: none;', 'onchange' => "$('#upload-file-info').html($(this).val());")); ?>
            Buscar...
        </label>
        <span class='label label-info' id="upload-file-info"></span>
        <?php
        if (!$model->isNewRecord) {
            if ($model->logo != "") {
                echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->logo, "image", array("width" => 100));
            }
        }
        ?>
        <?php echo $form->error($model, 'logo', array('class' => 'font_texto')); ?>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'dominio', array('class' => 'font_titulo')); ?>
        <?php echo $form->textField($model, 'dominio', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'dominio', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php
        echo CHtml::submitButton('Registrar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->