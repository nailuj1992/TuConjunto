<?php
/* @var $this ForoController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Foro */
?>

<h1 class="font_titulo">
    <i class="fa fa-check"></i> Contáctenos</h1>
<br>

<?php
if((Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente))){

$session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Foro', array(
        'criteria' => array(
            'condition' => "idAutor =".$session->idContacto." AND respondeA IS NULL"
        ),
            )),
    'filter'=>$model,
    'columns' => array(
        'tema',
        array(
            'name' => 'Fecha',
            'header' => 'Fecha de publicación',
            'value' => '$data->fechaPub'
        ),
                array(
                    'class' => 'CButtonColumn',
                    //'template'=>'{view}{update}', //Only shows Delete button
                    'template' => '{leer}', //Only shows Delete button
                    'header' => 'Acciones',
                    'buttons' => array(
                        'leer' => array
                            (
                            'label' => 'Leer/Responder', //Text label of the button.
                            'url'=>'array("foro/view/$data->idForo")',
                            'options' => array('class' => 'btn btn-primary', //HTML options for the button tag.
                                'click' => '...', //A JS function to be invoked when the button is clicked.
                            )
                        ),
                        ),           

       ),
    ),
));

echo CHtml::link('Enviar pregunta', array('foro/create/'.$model->idForo),array('class'=>'btn btn-primary'));

}
?>



<?php


///////////////////////TABLA PARA ADMINISTRADORES
if((Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador))||(Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo))){

$session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'datos-grid',
    'dataProvider' => new CActiveDataProvider('Foro', array(
        'criteria' => array(
            'condition' => "Conjuntos_idConjunto =".$session->Conjuntos_idConjunto." AND respondeA IS NULL"
        ),
            )),
    'columns' => array(
        'tema',
        array(
            'name' => 'Fecha',
            'header' => 'Fecha de publicación',
            'value' => '$data->fechaPub'
        ),
                array(
                    'class' => 'CButtonColumn',
                    //'template'=>'{view}{update}', //Only shows Delete button
                    'template' => '{leer}', //Only shows Delete button
                    'header' => 'Acciones',
                    'buttons' => array(
                        'leer' => array
                            (
                            'label' => 'Leer/Responder', //Text label of the button.
                            'url'=>'array("foro/view/$data->idForo")',
                            'options' => array('class' => 'btn btn-primary', //HTML options for the button tag.
                                'click' => '...', //A JS function to be invoked when the button is clicked.
                            )
                        ),
                        ),           

       ),
    ),
));

echo CHtml::link('Enviar pregunta', array('foro/create/'.$model->idForo),array('class'=>'btn btn-primary'));

}
?>