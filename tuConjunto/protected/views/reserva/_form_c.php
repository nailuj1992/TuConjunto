<?php
/* @var $this ReservaController */
/* @var $model Reservas */
/* @var $form CActiveForm */
?>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'reserva-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <?php echo SiteController::$form_required; ?>
    <?php // echo $form->errorSummary($model); ?>
       
    
      <div class="form-group">
        <?php echo $form->labelEx($model, 'fecha'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'fecha',
            'language' =>'es',
            'attribute' => 'fecha',
            'model' => $model,
            'flat' => true, //remove to hide the datepicker
            'options' => array(
                'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                'dateFormat'=>'yy-mm-dd',
            ),
            'htmlOptions' => array(
                'style' => ''
            ),
        ));
        ?>
        <?php echo $form->error($model, 'fecha'); ?>
    </div>
    
        <div class="hr-line-dashed"></div>
        
    <div class="form-group">
        <?php echo $form->labelEx($model, 'horaInicio', array('class' => 'font_titulo2')); ?>
        <?php echo CHtml::activeDropDownList($model, 'horaInicio', Autorizado::model()->getTime(), array('class' => 'form-controlv2')); ?>
        <?php echo $form->error($model, 'horaInicio', array('class' => 'font_texto')); ?>                 
    </div>       
                <div class="hr-line-dashed"></div>
        
    <div class="form-group">
        <?php echo $form->labelEx($model, 'horaFin', array('class' => 'font_titulo2')); ?>
        <?php echo CHtml::activeDropDownList($model, 'horaFin', Autorizado::model()->getTime(), array('class' => 'form-controlv2')); ?>
        <?php echo $form->error($model, 'horaFin', array('class' => 'font_texto')); ?>                 
    </div> 
    
    
    <div class="hr-line-dashed"></div>
    
    
    
    <div class="form-group">
         <?php echo $form->labelEx($model, 'AreaSocial_idAreaSocial'); ?>
        
        <?php $session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));?>
        <?php echo $form->dropDownList($model,'AreaSocial_idAreaSocial',CHtml::listData(Areasocial::model()->findAll(array("condition"=>"Conjuntos_idConjunto =".$session->Conjuntos_idConjunto),array(
        'empty'=>'Seleccione')), 'idAreaSocial', 'nombre'),
                array(
                    'empty'=>'Seleccione un área social',
                    'class' => 'form-controlv2 font_texto',            
                )); ?>
        <?php echo $form->error($model,'AreaSocial_idAreaSocial'); ?>
    </div>

    <div class="row buttons">

        <?php echo CHtml::submitButton($model->isNewRecord ? 'Reservar' : 'Guardar cambios', array('class'=>"btn btn-primary"));
        echo ' ';
        echo CHtml::link('Volver',array('index') , array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->