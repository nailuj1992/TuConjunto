<?php
/* @var $this ReservaController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Reserva */
?>




<?php

//////RESERVAS RESIDENTE

$session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));

if(Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)){
    
?>

<h1 class="font_titulo">
<i class="fa fa-book"></i> Tus reservas</h1>
<br>    
    <?php


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Reserva', array(
        'criteria' => array(
            'condition' => "inmueblesIdInmueble.idTitular=".$session->idContacto."",
            'with' => array('inmueblesIdInmueble' => array('joinType' => 'RIGHT JOIN')),

        ),
            )),
    'columns' => array(
        'fecha',
        'horaInicio',
        'horaFin',
        array(
          'name'=>'AreaSocial_idAreaSocial',
          'header' => 'Área social',
          'value' => 'Areasocial::model()->findByPk($data->AreaSocial_idAreaSocial)->nombre ',
        ),
        array(
          'name'=>'aprobada',
          'header' => 'Estado',
          'type' => 'raw',
          'value' => 'Reserva::model()->getEstado($data->aprobada)',
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
        ),
    ),
));
}


//////////////LISTA DE RESERVAS PARA ADMINS

if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)){

    ?><h1 class="font_titulo">
        <i class="fa fa-book"></i> Ver reservas pendientes</h1>
        <br>
        <h1 class="font_titulo2"> Reservas pendientes</h1>
                <?php

    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Reserva', array(
        'criteria' => array(
            'condition' => "inmueblesIdInmueble.Conjuntos_idConjunto=".$session->Conjuntos_idConjunto." AND aprobada ='P'",
            'with' => array('inmueblesIdInmueble' => array('joinType' => 'RIGHT JOIN')),

        ),
            )),
    'columns' => array(
        array(
          'name'=>'Inmuebles_idInmueble',
          'header' => 'Solicitante',
          'value' => 'Inmuebles::model()->getNombreInmueble(Inmuebles::model()->findByPk($data->Inmuebles_idInmueble))',
        
        ),
        'fecha',
        'horaInicio',
        'horaFin',
        array(
          'name'=>'AreaSocial_idAreaSocial',
          'header' => 'Área social',
          'value' => 'Areasocial::model()->findByPk($data->AreaSocial_idAreaSocial)->nombre ',
        ),
        array(
          'name'=>'aprobada',
          'header' => 'Estado',
          'type' => 'raw',
          'value' => 'Reserva::model()->getEstado($data->aprobada)',
        ),
         array(
                    'class' => 'CButtonColumn',
                    //'template'=>'{view}{update}', //Only shows Delete button
                    'template' => '{aprobar}  {rechazar}', //Only shows Delete button
                    'header' => 'Acciones',
                    'buttons' => array(
                        'aprobar' => array
                            (
                            'label' => 'Aprobar', //Text label of the button.
                            'url'=>'array("reserva/aprobar/?id=$data->idReserva")',
                            'options' => array('class' => 'btn btn-primary', //HTML options for the button tag.
                                'click' => '...', //A JS function to be invoked when the button is clicked.
                            )
                        ),
                         'rechazar' => array
                            (
                            'label' => 'Rechazar', //Text label of the button.
                            'url'=>'array("reserva/rechazar/?id=$data->idReserva")',
                            'options' => array('class' => 'btn btn-danger', //HTML options for the button tag.
                        )
                    ),
                        ),           
             
                ),
        
        
    ),
));



?>        <h1 class="font_titulo2"> Reservas aprobadas/rechazadas</h1><?php


$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Reserva', array(
        'criteria' => array(
            'condition' => "inmueblesIdInmueble.Conjuntos_idConjunto=".$session->Conjuntos_idConjunto." AND aprobada !='P'",
            'with' => array('inmueblesIdInmueble' => array('joinType' => 'RIGHT JOIN')),

        ),
            )),
    'columns' => array(
        array(
          'name'=>'Inmuebles_idInmueble',
          'header' => 'Solicitante',
          'value' => 'Inmuebles::model()->getNombreInmueble(Inmuebles::model()->findByPk($data->Inmuebles_idInmueble))',        
        ),
        'fecha',
        'horaInicio',
        'horaFin',
        array(
          'name'=>'AreaSocial_idAreaSocial',
          'header' => 'Área social',
          'value' => 'Areasocial::model()->findByPk($data->AreaSocial_idAreaSocial)->nombre ',
        ),
        array(
          'name'=>'aprobada',
          'header' => 'Estado',
          'type' => 'raw',
          'value' => 'Reserva::model()->getEstado($data->aprobada)',
        ),       
    ),
));

}




if(Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)){
    echo CHtml::link('Hacer reserva', array('reserva/create/'.$model->idReserva),array('class'=>'btn btn-primary'));
}
    ?>


