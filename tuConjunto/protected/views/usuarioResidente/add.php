<?php
/* @var $this UsuarioResidenteController */
/* @var $model Residente */
/* @var $form CActiveForm */
?>

<h1 class="font_titulo">
    <i class="fa fa-users"></i> Agregar residente existente al conjunto</h1>
    <br>

<div class="ibox-content">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'cruge-user2-form',
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
        <?php echo $form->labelEx($model, 'email', array('class' => 'font_titulo2')); ?>
        <?php echo $form->emailField($model, 'email', array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'email', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'idInmueble', array('class' => 'font_titulo2')); ?>
        <?php
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $inmuebles = Inmuebles::getInmuebles($conjunto->idConjunto);
        echo CHtml::activeDropDownList($model, 'idInmueble', CHtml::listData($inmuebles, 'idInmueble', function($inmueble) {
            return Inmuebles::getNombreInmueble($inmueble);
        }), array(
            'empty' => Inmuebles::$seleccioneInmueble,
            'class' => 'form-control font_texto',
            'required' => true,
        ));
        ?>
        <?php echo $form->error($model, 'idInmueble', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php
        echo CHtml::submitButton('Agregar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
