<?php
/* @var $this UsuarioResidenteController */
/* @var $model Residente */
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
                $('#Residente_password').val(data);
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
        <?php echo $form->labelEx($model, 'idInmueble', array('class' => 'font_titulo2')); ?>
        <?php
        $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
        $inmuebles = Inmuebles::getInmuebles($conjunto->idConjunto);
        echo CHtml::activeDropDownList($model, 'idInmueble', CHtml::listData($inmuebles, 'idInmueble', function($inmueble) {
            return Inmuebles::getNombreInmueble($inmueble);
        }), array(
            'empty' => Inmuebles::$seleccioneInmueble,
            'class' => 'form-control font_texto',
        ));
        ?>
        <?php echo $form->error($model, 'idInmueble', array('class' => 'font_texto')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->error($model, 'idConjunto'); ?>
    </div>

    <div class="form-group">
        <?php
        echo CHtml::submitButton('Crear', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
        echo SiteController::$espacio_vacio;
        ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->