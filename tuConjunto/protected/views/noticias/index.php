<?php
/* @var $this NoticiasController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Noticias */
?>

<h1 class="font_titulo">
<i class="fa fa-newspaper-o"></i> Tus noticias</h1>
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

 <h1 class="font_titulo2">Noticias globales</h1>
 
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Noticias', array(
        'criteria' => array(
            'condition' => "Conjuntos_idConjunto IS NULL"
        ),
            )),
    'columns' => array(
        'titulo',
        array(
            'name' => 'Descripcion',
            'header' => 'Descripción',
            'value' => 'Noticias::model()->getShortDesc($data->idNoticia)'
        ),
        array(
            'name' => 'Fecha',
            'header' => 'Fecha de publicación',
            'value' => '$data->fechaPub'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => $botones,
        ),
    ),
));

if(!(Yii::app()->user->isSuperAdmin)){
    
if(!(Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente) ||Yii::app()->user->checkAccess(CrugeAuthitem2::$rolVigilante))){
$botones=$botones."{update}";
}
$session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));
echo'<h1 class="font_titulo2">';
echo'Noticias del conjunto: ';
echo Conjuntos::model()->findByPk($session->Conjuntos_idConjunto)->nombre;
echo'</h1>'; 
    
    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Noticias', array(
        'criteria' => array(
            'condition' => "Conjuntos_idConjunto=".$session->Conjuntos_idConjunto.""

//            'condition' => "idDueno='".Yii::app()->user->getId()."'"
        ),
            )),
    'columns' => array(
        'titulo',
        array(
            'name' => 'Descripcion',
            'header' => 'Descripción',
            'value' => 'Noticias::model()->getShortDesc($data->idNoticia)'
        ),
        array(
            'name' => 'Fecha',
            'header' => 'Fecha de publicación',
            'value' => '$data->fechaPub'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => $botones,
        ),
    ),
));
    
}

if(!(Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente) ||Yii::app()->user->checkAccess(CrugeAuthitem2::$rolVigilante))||(Yii::app()->user->isSuperAdmin)){
echo CHtml::link($botonPublicar, array('noticias/create/'.$model->idNoticia),array('class'=>'btn btn-primary'));
}


    


