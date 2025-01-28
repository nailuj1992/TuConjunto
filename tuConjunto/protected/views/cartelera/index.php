<?php
/* @var $this CarteleraController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Cartelera */
?>

<h1 class="font_titulo">
<i class="fa fa-list-ul"></i> Tu cartelera</h1>
<br>  

<?php


if(Yii::app()->user->isSuperAdmin){
    $botones='{view}{update}';
    $botonPublicar="Publicar noticia global";
    }
else{
    $botones='{view}';
    $botonPublicar="Publicar noticia";
    }
?>

<?php
$session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));
if($session->Inmuebles_idInmueble!=''){
    ?>
 <h1 class="font_titulo2">Tus anuncios publicados</h1>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Cartelera', array(
        'criteria' => array(
            'condition' => "Conjuntos_idConjunto=".$session->Conjuntos_idConjunto." AND idAutor =". $session->Inmuebles_idInmueble.""
        ),
            )),
    'columns' => array(
        array(
            'name' => 'Título',
            'header' => 'Título',
            'value' => 'CHtml::image(Yii::app()->request->baseUrl."/images/".$data->fotoPrincipal,"image",array("width" =>100)) ." ". $data->titulo',
            'type'=>'raw',
        ),
        array(
            'name' => 'Descripcion',
            'header' => 'Descripción',
            'value' => 'Cartelera::model()->getShortDesc($data->idCartelera)',
        ),
        array(
            'name' => 'Fecha',
            'header' => 'Fecha de publicación',
            'value' => '$data->fechaPub'
        ),
        array(
           'class' => 'CButtonColumn',
           'template' => '{ver}{editar}{borrar}', //Only shows Delete button
           'header' => 'Acciones',
           'buttons' => array(
               'ver' => array
                   (
                   'label' => 'Ver', //Text label of the button.
                   'url'=>'array("cartelera/view/?id=$data->idCartelera")',
                   'options' => array('class' => 'btn btn-success', //HTML options for the button tag.
                   )
               ),
                'editar' => array
                   (
                   'label' => 'Editar', //Text label of the button.
                   'url'=>'array("cartelera/update/?id=$data->idCartelera")',
                   'options' => array('class' => 'btn btn-primary', //HTML options for the button tag.
               )
           ),
                 'borrar' => array
                   (
                   'label' => 'Eliminar', //Text label of the button.
                   'url'=>'array("cartelera/delete/?id=$data->idCartelera")',
                   'options' => array('class' => 'btn btn-danger', //HTML options for the button tag.
               )
           ),
               ),           

       ),
    ),
));
if((Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente))){
echo CHtml::link('Publicar anuncio', array('cartelera/create/'.$model->idCartelera),array('class'=>'btn btn-primary'));
}

if(!(Yii::app()->user->isSuperAdmin)){
    
//if(!(Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente) ||Yii::app()->user->checkAccess(CrugeAuthitem2::$rolVigilante))){
//$botones=$botones."{update}";
//}
echo'<h1 class="font_titulo2">';
echo'Anuncios del conjunto: ';
echo Conjuntos::model()->findByPk($session->Conjuntos_idConjunto)->nombre;
echo'</h1>'; 


    
    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Cartelera', array(
        'criteria' => array(
            'condition' => "Conjuntos_idConjunto=".$session->Conjuntos_idConjunto." AND idAutor <>". $session->Inmuebles_idInmueble.""

//            'condition' => "idDueno='".Yii::app()->user->getId()."'"
        ),
            )),
    'columns' => array(
        array(
            'name' => 'Titulo',
            'header' => 'Título',
            'value' => 'CHtml::image(Yii::app()->request->baseUrl."/images/".$data->fotoPrincipal,"image",array("width" =>100)) ." ". $data->titulo',
            'type'=>'raw',
        ),
        array(
            'name' => 'Descripcion',
            'header' => 'Descripción',
            'value' => 'Cartelera::model()->getShortDesc($data->idCartelera)'
        ),
        array(
            'name' => 'Fecha',
            'header' => 'Fecha de publicación',
            'value' => '$data->fechaPub'
        ),
        array(
           'class' => 'CButtonColumn',
           //'template'=>'{view}{update}', //Only shows Delete button
           'template' => '{ver}', //Only shows Delete button
           'header' => 'Acciones',
           'buttons' => array(
               'ver' => array
                   (
                   'label' => 'Ver', //Text label of the button.
                   'url'=>'array("cartelera/view/?id=$data->idCartelera")',
                   'options' => array('class' => 'btn btn-success', //HTML options for the button tag.
                       'click' => '...', //A JS function to be invoked when the button is clicked.
                   )
               ),
               ),           

       ),
    ),
));
    
}
}

else {
    echo'<h1 class="font_titulo2">';
echo'Anuncios del conjunto: ';
echo Conjuntos::model()->findByPk($session->Conjuntos_idConjunto)->nombre;
echo'</h1>'; 
    
    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Cartelera', array(
        'criteria' => array(
            'condition' => "Conjuntos_idConjunto=".$session->Conjuntos_idConjunto.""

//            'condition' => "idDueno='".Yii::app()->user->getId()."'"
        ),
            )),
    'columns' => array(
         array(
            'name' => 'Título',
            'header' => 'Título',
            'value' => 'CHtml::image(Yii::app()->request->baseUrl."/images/".$data->fotoPrincipal,"image",array("width" =>100)) ." ". $data->titulo',
            'type'=>'raw',
        ),
        array(
            'name' => 'Descripcion',
            'header' => 'Descripción',
            'value' => 'Cartelera::model()->getShortDesc($data->idCartelera)'
        ),
        array(
            'name' => 'Fecha',
            'header' => 'Fecha de publicación',
            'value' => '$data->fechaPub'
        ),
        array(
           'class' => 'CButtonColumn',
           //'template'=>'{view}{update}', //Only shows Delete button
           'template' => '{ver}{borrar}', //Only shows Delete button
           'header' => 'Acciones',
           'buttons' => array(
               'ver' => array
                   (
                   'label' => 'Ver', //Text label of the button.
                   'url'=>'array("cartelera/view/?id=$data->idCartelera")',
                   'options' => array('class' => 'btn btn-success', //HTML options for the button tag.
                       'click' => '...', //A JS function to be invoked when the button is clicked.
                   )
               ),
               'borrar' => array
                   (
                   'label' => 'Eliminar', //Text label of the button.
                   'url'=>'array("cartelera/delete/?id=$data->idCartelera")',
                   'options' => array('class' => 'btn btn-danger', //HTML options for the button tag.
               )
           ),
               ),           

       ),
    ),
));
    
}


    


