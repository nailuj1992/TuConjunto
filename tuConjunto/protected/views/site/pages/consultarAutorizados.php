<?php
/* @var $model Autorizado */
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->param = Funcion::autorizado;

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
<div class="ibox-content">
<div class="col-sm-12 title">
    <h1 class="font_titulo"><i class="fa fa-check-circle"></i> Consultar usuarios autorizados</h1>
</div>

<form method="get">
    <input type="number" autocomplete="off"  placeholder="Cédula" name="q" 

value="<?=isset($_GET['q']) ? CHtml::encode($_GET['q']) : '' ; 

?>" />
<input type="submit" value="Buscar" />
</form>
    <br>


<?php
       
$v1 = $_GET['q'];
if($v1)
{
$query ="". $_GET['q']."";



$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Autorizado', array(
        'criteria' => array(
            'condition' => "cedula=".$query."",
//           'with' => array('idRemitente0' => array('joinType' => 'RIGHT JOIN')),
        ),
            )),
    'columns' => array(
        array(
        'header'=> 'Nombre completo',
        'value' => 'CHtml::image(Yii::app()->request->baseUrl."/images/".$data->foto,"image",array("width" =>100)) ." ". $data->nombres ." ". $data->apellidos',
        'type'=>'raw',
        ),
        array(
            'name' => 'Cédula',
            'header' => 'Cédula',
            'value' => '$data->cedula',
        ),
        array(
            'name' => 'Día de la semana',
            'header' => 'Día de la semana',
            'value' => 'Autorizado::model()->getNombreDia($data->dia)',
        ),
       array(
            'name' => 'Hora de entrada',
            'header' => 'Hora de entrada',
            'value' => '$data->horaEntrada',
        ),
       array(
            'name' => 'Hora de salida',
            'header' => 'Hora de salida',
            'value' => '$data->horaSalida',
        ),
         array(
            'name'=>'autorizadoIdAutorizado.Inmuebles_idInmueble',
            'header'=> 'Autorizado por',
            'value'=>'Inmuebles::model()->getNombre($data->Inmuebles_idInmueble)'
            )
    ),
));
$hide=false;
$session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));
$contacto = Contactos::model()->findByAttributes(array('cedula'=>$query));
//$auth = Autorizado::model()->findAllByAttributes(array('Contactos_idContacto'=>$contacto->idContacto));
//foreach ($auth as $a){
//    if($a->siempre=='1'&&($session->Conjuntos_idConjunto==$contacto->Conjuntos_idConjunto)){
//        echo "<h2 class='font_title'><font color='grass'>";        
//        echo "✔ Ésta persona es residente del conjunto ";
//        echo Conjuntos::model()->findByPk($contacto->Conjuntos_idConjunto)->nombre;
//        echo "</font></h2 >";
//        $hide=true;
//    }
//    
//}

if(!$hide){
$condition = "false";
//if($contacto) {
//    $condition = "autorizadoIdAutorizado.Contactos_idContacto='".$contacto->idContacto."'";
//}
//$this->widget('zii.widgets.grid.CGridView', array(
//    'id' => 'datos-grid2',
//    'dataProvider' => new CActiveDataProvider('Horario', array(
//        'criteria' => array(
//            'condition' => $condition,
//            'with' => array('autorizadoIdAutorizado' => array('joinType' => 'LEFT JOIN')),
//        ),
//            )),
//    'columns' => array(
//    array(
//        'name'=>'diaSemana',
//        'header'=>'Día de la semana',
//        'value'=>'Horario::model()->getDia($data->diaSemana)'
//        ),
//    'horaEntrada',
//    'horaSalida',
//    array(
//        'name'=>'autorizadoIdAutorizado.Inmuebles_idInmueble',
//        'header'=> 'Autorizado por',
//        'value'=>'Inmuebles::model()->getNombre($data->autorizadoIdAutorizado->Inmuebles_idInmueble)'
//            )
//
//
//    ),
//));

}
}
else{
    $query="";
}


