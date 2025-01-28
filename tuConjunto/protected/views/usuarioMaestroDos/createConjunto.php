<?php
/* @var $this UsuarioMaestroDosController */
/* @var $model Conjuntosporcontactos */
/* @var $model1 CrugeUser2 */
/* @var $iduser iduser */
/* @var $form CActiveForm */
?>

<h1 class="font_titulo">Asignar conjunto al Administrador <?php echo $model1->username ?></h1>

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
        <?php echo $form->labelEx($model, 'Conjuntos_idConjunto', array('class' => 'font_titulo')); ?>
        <?php
        echo CHtml::activeDropDownList($model, 'Conjuntos_idConjunto', CHtml::listData(Conjuntos::model()->findAll(), 'idConjunto', 'nombre'), array(
            'empty' => Conjuntos::$seleccioneConjunto,
            'class' => 'form-control font_texto',
        ));
        ?>
        <?php echo $form->error($model, 'Conjuntos_idConjunto', array('class' => 'font_texto')); ?>
    </div>

    <div class="container">
        <?php
        echo CHtml::submitButton('Asignar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('viewConjuntos', 'id' => $model1->iduser), array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->