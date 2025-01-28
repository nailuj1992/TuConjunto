<?php
/* @var $this UsuarioResidenteController */
/* @var $model CrugeUser2 */
/* @var $form CActiveForm */
?>

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
        <?php echo $form->labelEx($model, 'username', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'username', array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'username', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'email', array('class' => 'font_titulo2')); ?>
        <?php echo $form->emailField($model, 'email', array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'email', array('class' => 'font_texto')); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'password', array('class' => 'font_titulo2')); ?>
        <?php echo $form->textField($model, 'password', array('class' => 'form-control font_texto')); ?>
        <?php echo $form->error($model, 'password', array('class' => 'font_texto')); ?>

        <script>
            function fnSuccess(data) {
                $('#CrugeUser2_password').val(data);
            }
            function fnError(e) {
                alert("error: " + e.responseText);
            }
        </script>
        <?php
        echo '<br>';
        echo CHtml::ajaxbutton(
                CrugeTranslator::t("Generar una nueva clave"), Yii::app()->user->ui->ajaxGenerateNewPasswordUrl, array('success' => 'js:fnSuccess', 'error' => 'js:fnError'), array('class' => 'btn btn-warning')
        );
        ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->error($model, 'idConjunto'); ?>
    </div>

    <div class="form-group">
        <?php
        echo CHtml::submitButton('Guardar', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('view', 'id' => $model->iduser), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->