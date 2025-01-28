<?php
/* @var $this AutorizadoController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Autorizado */
?>

<h1 class="font_titulo">
<i class="fa fa-check"></i> Tus autorizados</h1>
<br>


<h1 class="font_titulo2">Autorizados activos</h1>
<?php
$session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->getId()));

if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)) {

    $inmueble = Inmuebles::model()->findByAttributes(array('idTitular' => $session->idContacto));
    if ($inmueble != null) {
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'datos-grid',
            'dataProvider' => new CActiveDataProvider('Autorizado', array(
                'criteria' => array(
                    'condition' => "Inmuebles_idInmueble=" . $inmueble->idInmueble . " AND bloqueado='0'",
                ),
                    )),
            'columns' => array(
                array(
                    'name' => 'Nombre completo',
                    'header' => 'Nombre completo',
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
                    'class' => 'CButtonColumn',
                    //'template'=>'{view}{update}', //Only shows Delete button
                    'template' => '{editar}{bloquear}', //Only shows Delete button
                    'header' => 'Acciones',
                    'buttons' => array(
                        'editar' => array
                            (
                            'label' => 'Editar', //Text label of the button.
                            'url'=>'array("autorizado/update/?id=$data->idAutorizado")',
                            'options' => array('class' => 'btn btn-primary', //HTML options for the button tag.
                                'click' => '...', //A JS function to be invoked when the button is clicked.
                            )
                        ),
                         'bloquear' => array
                            (
                            'label' => 'Bloquear', //Text label of the button.
                            'url'=>'array("autorizado/bloquear/?id=$data->idAutorizado")',
                            'options' => array('class' => 'btn btn-danger', //HTML options for the button tag.
                        )
                    ),
                        ),           

       ),
            ),
        ));
        
     ?> 


<!--<h1 class="font_titulo">Tus autorizados residentes</h1>-->
     
     <?php

        
//        $this->widget('zii.widgets.grid.CGridView', array(
//            'id' => 'datos-grid',
//            'dataProvider' => new CActiveDataProvider('Autorizado', array(
//                'criteria' => array(
//                    'condition' => "Inmuebles_idInmueble=" . $inmueble->idInmueble . " AND siempre='1'",
//                ),
//                    )),
//            'columns' => array(
//                array(
//                    'name' => 'Inmuebles_idInmueble',
//                    'header' => 'Nombres',
//                    'value' => 'Contactos::model()->findByPk($data->Contactos_idContacto)->nombres',
//                ),
//                array(
//                    'name' => 'Inmuebles_idInmueble',
//                    'header' => 'Apellidos',
//                    'value' => 'Contactos::model()->findByPk($data->Contactos_idContacto)->apellidos',
//                ),
//                array(
//                    'name' => 'Cédula',
//                    'header' => 'Cédula',
//                    'value' => 'Contactos::model()->findByPk($data->Contactos_idContacto)->cedula',
//                ),
//            ),
//        ));

        if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)) {
            echo CHtml::link('Autorizar contacto', array('autorizado/create/' . $model->idAutorizado), array('class' => 'btn btn-primary'));
            echo SiteController::$espacio_vacio;
        }
         ?>

<h1 class="font_titulo2">Autorizados bloqueados</h1>

<?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'datos-grid',
            'dataProvider' => new CActiveDataProvider('Autorizado', array(
                'criteria' => array(
                    'condition' => "Inmuebles_idInmueble=" . $inmueble->idInmueble . " AND bloqueado='1'",
                ),
                    )),
            'columns' => array(
                array(
                    'name' => 'Nombre completo',
                    'header' => 'Nombre completo',
                    'value' => '$data->nombres." ".$data->apellidos',
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
                    'class' => 'CButtonColumn',
                    'template' => '{desbloquear}',
                    'header' => 'Acciones',
                    'buttons' => array(
                         'desbloquear' => array
                            (
                            'label' => 'Desbloquear', //Text label of the button.
                            'url'=>'array("autorizado/desbloquear/?id=$data->idAutorizado")',
                            'options' => array('class' => 'btn btn-danger', //HTML options for the button tag.
                        )
                    ),
                        ),           

       ),
            ),
        ));
        
        
        
    } else {
        throw new CHttpException(401, "No eres titular, por tanto no puedes autorizar a personas.");
    }   
}


