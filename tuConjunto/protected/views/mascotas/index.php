<?php
/* @var $this MascotasController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Mascotas */
?>


<h1 class="font_titulo">   
    <i class="fa fa-paw"></i> Tus mascotas</h1>
<br>

<?php
$session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->getId()));

if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)) {

    $model->Inmuebles_idInmueble = $session->Inmuebles_idInmueble;

    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'datos-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array(
                'name' => 'nombre',
                'header' => 'Nombre completo',
                'value' =>function($data){
                    return ($data->foto!=''||!(is_null($data->foto)) ) ? (CHtml::image(Yii::app()->request->baseUrl."/images/mascota_". $data->idMascota . "_". $data->foto,"image",array("width" =>100)) ." ". $data->nombre)
 : (CHtml::image(Yii::app()->request->baseUrl."/images/noimage.png","image",array("width" =>100)) ." ". $data->nombre)
 ;
                }, 
                'type' => 'raw',
            ),
            'raza',
            'descripcion',
            'color',
            'animal',
            array(
                'class' => 'CButtonColumn',
                'template' => '{view}{update}',
            ),
        ),
    ));
}


if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo)) {
//    $model->inmueblesIdInmueble->Conjuntos_idConjunto = $session->Conjuntos_idConjunto;
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'datos-grid',
//        'dataProvider' => new CActiveDataProvider('Mascotas', array(
//            'criteria' => array(
//                'condition' => "inmueblesIdInmueble.Conjuntos_idConjunto=" . $session->Conjuntos_idConjunto . "",
//                'with' => array('inmueblesIdInmueble' => array('joinType' => 'RIGHT JOIN')),
//            ),
//                )),
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            'nombre',
            'raza',
            'descripcion',
            'color',
            'animal',
            array(
                'name' => 'inmueblesIdInmueble',
                'header' => 'Inmueble',
                'value' => function($data) {
                    echo Inmuebles::model()->getNombreInmueble(Inmuebles::model()->findByPk($data->Inmuebles_idInmueble));
                }
            ),
            'inmueblesIdInmueble.nombre',
            array(
                'class' => 'CButtonColumn',
                'template' => '{view}',
            ),
        ),
    ));
}
if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)) {
    echo CHtml::link('Registrar mascota', array('mascotas/create/' . $model->idMascota), array('class' => 'btn btn-primary'));
}
?>


