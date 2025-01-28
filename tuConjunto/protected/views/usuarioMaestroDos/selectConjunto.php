<?php
/* @var $this UsuarioMaestroDosController */
/* @var $model Conjuntosporcontactos */
/* @var $model1 CrugeUser2 */
/* @var $iduser iduser */
/* @var $form CActiveForm */
?>

<h1 class="font_titulo"><i class="fa fa-diamond"></i> Seleccionar conjunto</h1>
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
        <?php echo $form->labelEx($model, 'Conjuntos_idConjunto', array('class' => 'font_titulo2')); ?>
        <?php
        $conjuntos = Conjuntos::buscarConjuntos2(CrugeAuthitem2::$rolAdministrador, Yii::app()->user->id);
        echo CHtml::activeDropDownList($model, 'Conjuntos_idConjunto', CHtml::listData($conjuntos, 'idConjunto', 'nombre'), array(
            'empty' => Conjuntos::$seleccioneConjunto,
            'class' => 'form-control font_texto',
        ));
        ?>
        <?php echo $form->error($model, 'Conjuntos_idConjunto', array('class' => 'font_texto')); ?>
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