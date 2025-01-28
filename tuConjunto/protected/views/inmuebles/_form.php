<?php
/* @var $this InmueblesController */
/* @var $model Inmuebles */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'inmuebles-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <?php echo SiteController::$form_required; ?>

    <?php if (!$model->isNewRecord && Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)) { ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'zona', array('class' => 'font_titulo2')); ?>
            <?php echo $form->dropDownList($model, 'zona', Inmuebles::getZonas(), array('class' => 'form-control font_texto')); ?>
            <?php echo $form->error($model, 'zona', array('class' => 'font_texto')); ?>
        </div>


        <div class="hr-line-dashed"></div>


        <div class="form-group">
            <?php echo $form->labelEx($model, 'numZona', array('class' => 'font_titulo2')); ?>
            <?php echo $form->textField($model, 'numZona', array('class' => 'form-control font_texto')); ?>
            <?php echo $form->error($model, 'numZona', array('class' => 'font_texto')); ?>
        </div>


        <div class="hr-line-dashed"></div>


        <div class="form-group">
            <?php echo $form->labelEx($model, 'tipo', array('class' => 'font_titulo2')); ?>
            <?php echo $form->dropDownList($model, 'tipo', $model->getTiposInmuebles(), array('class' => 'form-control font_texto')); ?>
            <?php echo $form->error($model, 'tipo', array('class' => 'font_texto')); ?>
        </div>


        <div class="hr-line-dashed"></div>


        <div class="form-group">
            <?php echo $form->labelEx($model, 'nombre', array('class' => 'font_titulo2')); ?>
            <?php echo $form->textField($model, 'nombre', array('class' => 'form-control font_texto')); ?>
            <?php echo $form->error($model, 'nombre', array('class' => 'font_texto')); ?>
        </div>


        <div class="hr-line-dashed"></div>
        
            <div class="form-group">
        <?php echo $form->labelEx($model, 'coeficienteCopropiedad', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'coeficienteCopropiedad', array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'coeficienteCopropiedad', array('class' => 'font_texto')); ?>
    </div>
        
        
    <div class="hr-line-dashed"></div>
    

    <div class="form-group">
        <?php echo $form->labelEx($model, 'areaConstruida', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'areaConstruida', array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'areaConstruida', array('class' => 'font_texto')); ?>
    </div>

    <?php } ?>




    <div class="hr-line-dashed"></div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'matriculaInmobiliaria', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'matriculaInmobiliaria', array('size' => 60, 'maxlength' => 255, 'class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'matriculaInmobiliaria', array('class' => 'font_texto')); ?>
    </div>







    <div class="form-group">
        <?php
        echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', $model->isNewRecord ? array('index') : array('view', 'id' => $model->idInmueble), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->