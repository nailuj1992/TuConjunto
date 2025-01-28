<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = Yii::app()->name . ' - Error';
?>

<div class="middle-box text-center animated fadeInDown">
    <h1><?php echo $code; ?></h1>
    <!--h3 class="font-bold">Internal Server Error</h3-->

    <div class="error-desc">
        <?php echo CHtml::encode($message); ?>
        <br>
        <a href="javascript:history.back()" class="btn btn-primary m-t">Ir a la página anterior</a>
    </div>
</div>