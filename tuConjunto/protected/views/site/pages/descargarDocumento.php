<?php
/* @var $model Vehiculos */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#datos-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php
$v1 = $_GET['q'];
$session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));
$documento = Documentos::model()->findByPk($v1);
$url=Yii::app()->createAbsoluteUrl('documents/'.$documento->urlDocumento, array(), 'http');
$url=str_replace('/index.php','',$url);

Yii::app()->getRequest()->sendFile( $documento->urlDocumento , file_get_contents($url) );

?>