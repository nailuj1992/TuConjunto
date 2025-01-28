<?php
if (Yii::app()->user->isGuest) {
    ?>
    <!--<h1><?php echo CrugeTranslator::t('logon', "Login"); ?></h1>-->
    <?php if (Yii::app()->user->hasFlash('loginflash')): ?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('loginflash'); ?>
        </div>
    <?php else: ?>
        <div class="gray-bg">

            <div class="loginColumns animated fadeInDown">
                <div class="row">

                    <div class="col-md-6">
                        <h2 class="font-bold">Bienvenido a Tu Conjunto</h2>

                        <p>Esta es la clave para la gestión del tiempo.</p>

                        <p>Información, participación y decisión.</p>

                        <p><b>Tu Conjunto.</b></p>

                        <p>
                            <small><u>Demo</u><br>
                                <b>Usuario: </b>residente1<br>
                                <b>Contraseña: </b>residente1
                            </small>
                        </p>

                    </div>
                    <div class="col-md-6">
                        <div class="ibox-content">
                            <!-- Init form -->
                            <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                'id' => 'login-form',
                                'enableClientValidation' => true,
                                'clientOptions' => array(
                                    'validateOnSubmit' => true,
                                ),
                                'htmlOptions' => array(
                                    'class' => 'm-t',
                                    'role' => 'form',
                                ),
                            ));
                            ?>

                            <div class="form-group">
                                <?php
                                // Username field
                                echo $form->textField($model, 'username', array(
                                    'class' => 'form-control',
                                    'placeholder' => 'Nombre de usuario o correo',
                                ));
                                ?>
                                <?php echo $form->error($model, 'username'); ?>
                            </div>

                            <div class="form-group">
                                <?php
                                // Password field
                                echo $form->passwordField($model, 'password', array(
                                    'class' => 'form-control',
                                    'placeholder' => 'Contraseña',
                                ));
                                ?>
                                <?php echo $form->error($model, 'password'); ?>
                                <!--p class="hint">
                                    Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
                                </p-->
                            </div>

                            <?php
                            // Login button
                            echo CHtml::submitButton('Iniciar sesión', array(
                                'class' => 'btn btn-primary block full-width m-b',
                            ));
                            ?>

                                            <!--?php echo CHtml::link('<small>Forgot password?</small>', array('/')); ?>

                                            <p class="text-muted text-center">
                                                <small>Do not have an account?</small>
                                            </p>

                                            < ?php
                                            echo CHtml::link('Create an account', array('/'), array(
                                                'class' => 'btn btn-sm btn-white btn-block')
                                            );
                                            ?-->

                            <!-- End form -->
                            <?php $this->endWidget(); ?>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Powered by</strong> Data Global <small>&copy 2016</small>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!--div class="row">
        < ?php echo $form->labelEx($model, 'username'); ?>
        < ?php echo $form->textField($model, 'username'); ?>
        < ?php echo $form->error($model, 'username'); ?>
        </div>

        <div class="row">
        < ?php echo $form->labelEx($model, 'password'); ?>
        < ?php echo $form->passwordField($model, 'password'); ?>
        < ?php echo $form->error($model, 'password'); ?>
        </div>

        <div class="row rememberMe">
        < ?php echo $form->checkBox($model, 'rememberMe'); ?>
        < ?php echo $form->label($model, 'rememberMe'); ?>
        < ?php echo $form->error($model, 'rememberMe'); ?>
        </div>

        <div class="row buttons">
        < ?php Yii::app()->user->ui->tbutton(CrugeTranslator::t('logon', "Login")); ?>
        < ?php echo Yii::app()->user->ui->passwordRecoveryLink; ?>
        < ?php
        if (Yii::app()->user->um->getDefaultSystem()->getn('registrationonlogin') === 1)
            echo Yii::app()->user->ui->registrationLink;
        ?>
        </div-->

        <?php
        //	si el componente CrugeConnector existe lo usa:
        //
    if (Yii::app()->getComponent('crugeconnector') != null) {
            if (Yii::app()->crugeconnector->hasEnabledClients) {
                ?>
                <div class='crugeconnector'>
                    <span><?php echo CrugeTranslator::t('logon', 'You also can login with'); ?>:</span>
                    <ul>
                        <?php
                        $cc = Yii::app()->crugeconnector;
                        foreach ($cc->enabledClients as $key => $config) {
                            $image = CHtml::image($cc->getClientDefaultImage($key));
                            echo "<li>" . CHtml::link($image, $cc->getClientLoginUrl($key)) . "</li>";
                        }
                        ?>
                    </ul>
                </div>
                <?php
            }
        }
        ?>
    <?php
    endif;
} else {
    $this->redirect(Yii::app()->baseUrl);
}
