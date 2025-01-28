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
$session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));
$quejas = Quejas::model()->findAll(array(
            'condition' => "idRemitente0.Conjuntos_idConjunto=".$session->Conjuntos_idConjunto."",
            'with' => array('idRemitente0' => array('joinType' => 'LEFT JOIN')),
        ));

$mPDF1 = Yii::app()->ePdf->mpdf();
$mPDF1->WriteHTML("Reporte de mensajes");

foreach($quejas as $q){
    
      $mPDF1->WriteHTML("[".
        Quejas::model()->getDate($q->idQueja).
        "]   ".
        Inmuebles::model()->getNombre($q->idRemitente).
        "--->".
        Inmuebles::model()->getNombre($q->idDestinatario).
        ":   ".
        Textospredeterminados::model()->getMensaje($q->idTextoPredeterminado).        
        "\r\n");
}
//Yii::app()->getRequest()->sendFile('test.txt',"hi"); 


        # Outputs ready PDF
        ob_clean();         
        $mPDF1->Output('ReporteDeMensajes.pdf', 'D');exit();


?>