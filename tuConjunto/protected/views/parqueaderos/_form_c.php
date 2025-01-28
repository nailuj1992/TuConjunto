<?php
/* @var $this ParqueagerosController */
/* @var $model Parqueaderos */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'parqueaderos-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <?php echo SiteController::$form_required; ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'numero'); ?>
        <?php echo $form->textField($model, 'numero', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'numero'); ?>
    </div>
    
            <div class="hr-line-dashed"></div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'ubicacion'); ?>
        <?php echo $form->textField($model, 'ubicacion', array('size' => 60, 'maxlength' => 255,'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'ubicacion'); ?>
    </div>
            
            <div class="hr-line-dashed"></div>


    <div class="form-group">
         <?php echo $form->labelEx($model, 'Inmueble'); ?>
        
        <?php $session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));?>
        <?php echo $form->dropDownList($model,'Inmuebles_idInmueble',CHtml::listData(Inmuebles::model()->findAll(array("condition"=>"Conjuntos_idConjunto =".$session->Conjuntos_idConjunto.""),array(
        'empty'=>'Seleccione')), 'idInmueble', 'nombre'),
                array(
                'empty' => '--Seleccione un inmueble--',
                'class' => 'form-control font_texto', ) ); ?>
        <?php echo $form->error($model,'Inmuebles_idInmueble'); ?>
    </div>

    <div class="form-group">

        <?php echo CHtml::submitButton($model->isNewRecord ? 'Agregar parqueadero' : 'Guardar cambios', array('class'=>"btn btn-primary"));
              echo SiteController::$espacio_vacio;
              echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
              ?>

    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->