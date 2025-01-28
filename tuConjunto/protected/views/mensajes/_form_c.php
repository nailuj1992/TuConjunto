<?php
/* @var $this QuejasController */
/* @var $model Quejas */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'quejas-form',
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
         <?php echo $form->labelEx($model, 'Destinatario'); ?>
        
        <?php $session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));?>
        <?php echo $form->dropDownList($model,'idDestinatario',CHtml::listData(Inmuebles::model()->findAll(array("condition"=>"Conjuntos_idConjunto =".$session->Conjuntos_idConjunto." AND idInmueble != ". $model->idRemitente)), 'idInmueble', 'nombre'), array(
            'empty' => '--Seleccione un  destinatario--',
            'class' => 'form-control font_texto',            
        )); ?>
        <?php echo $form->error($model,'idDestinatario'); ?>
    </div>
    
    
    <div class="hr-line-dashed"></div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'Texto'); ?>
        <?php
        echo $form->dropDownList($model, 'idTextoPredeterminado', CHtml::listData(Textospredeterminados::getTextos(), 'idTexto', 'mensaje'), array(
            'empty' => '--Seleccione un mensaje--',
            'class' => 'form-control font_texto',            
        ));
        ?>
        <?php echo $form->error($model, 'nombres'); ?>
    </div>
    
    
    <div class="hr-line-dashed"></div>


    <div class="form-group">
        <?php
        echo CHtml::submitButton($model->isNewRecord ? 'Enviar' : 'Guardar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver',  array('index'), array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->