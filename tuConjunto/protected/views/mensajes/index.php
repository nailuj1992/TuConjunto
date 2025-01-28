<?php
/* @var $this QuejasController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Quejas */
?>

<h1 class="font_titulo">
<i class="fa fa-envelope-o"></i> Tus mensajes</h1>
<br>  

<?php
if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)) {
    ?>
    <?php
    $session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->getId()));

    $inmueblesession = Inmuebles::model()->findByAttributes(array('idTitular' => $session->idContacto));

    if ($inmueblesession->idInmueble && $inmueblesession->idInmueble) {
        echo "<h1 class='font_titulo2'>";
        echo "Mensajes enviados";
        echo "</h1>";

        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'datos-grid',
            'dataProvider' => new CActiveDataProvider('Quejas', array(
                'criteria' => array(
                    'condition' => "idRemitente=" . $inmueblesession->idInmueble . "",
                    'with' => array('idRemitente0' => array('joinType' => 'RIGHT JOIN')),
                    'with' => array('idTextoPredeterminado0' => array('joinType' => 'RIGHT JOIN'))
                ),
                    )),
            'columns' => array(
                array(
                    'name' => 'Destinatario',
                    'header' => 'Destinatario',
                    'value' => 'Inmuebles::model()->getNombre($data->idDestinatario)'
                ),
                array(
                    'name' => 'fecha',
                    'header' => 'Fecha',
                    'value' => 'Quejas::model()->getDate($data->idQueja)')
                ,
                array(
                    'name' => 'State',
                    'header' => 'Mensaje',
                    'value' => 'Textospredeterminados::model()->getMensaje($data->idTextoPredeterminado)'
                ),
            ),
        ));
        echo CHtml::link('Enviar mensaje', array('mensajes/create/' . $model->idQueja), array('class' => 'btn btn-primary'));
        ?>


        <h1 class="font_titulo2">Mensajes recibidos</h1>


        <?php
        $session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->getId()));

        $inmueblesession = Inmuebles::model()->findByAttributes(array('idTitular' => $session->idContacto));

        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'datos-grid',
            'dataProvider' => new CActiveDataProvider('Quejas', array(
                'criteria' => array(
                    'condition' => "idDestinatario=" . $inmueblesession->idInmueble . "",
                    'with' => array('idRemitente0' => array('joinType' => 'RIGHT JOIN')),
                    'with' => array('idTextoPredeterminado0' => array('joinType' => 'RIGHT JOIN'))
                ),
                    )),
            'columns' => array(
                array(
                    'name' => 'Remitente',
                    'header' => 'Remitente',
                    'value' => 'Inmuebles::model()->getNombre($data->idRemitente)'
                ),
                array(
                    'name' => 'fecha',
                    'header' => 'Fecha',
                    'value' => 'Quejas::model()->getDate($data->idQueja)')
                ,
                array(
                    'name' => 'State',
                    'header' => 'Mensaje',
                    'value' => 'Textospredeterminados::model()->getMensaje($data->idTextoPredeterminado)'
                ),
            ),
        ))
        ;
    } else {
        throw new CHttpException(500, "No eres titular del inmueble.");
    }
}
?>





<?php
////////////////////REPORTE DE QUEJAS PARA ADMINISTRADORES

if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)) {

    echo "<h1 class='font_titulo2'>";
    echo "Reporte de mensajes";
    echo "</h1>";
    ?>
    <?php
    $session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->getId()));
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'datos-grid',
        'dataProvider' => new CActiveDataProvider('Quejas', array(
            'criteria' => array(
                'condition' => "idRemitente0.Conjuntos_idConjunto=" . $session->Conjuntos_idConjunto . "",
                'with' => array('idRemitente0' => array('joinType' => 'LEFT JOIN')),
            ),
                )),
        'columns' => array(
            array(
                'name' => 'Remitente',
                'header' => 'Remitente',
                'value' => 'Inmuebles::model()->getNombre($data->idRemitente)'
            ),
            array(
                'name' => 'Destinatario',
                'header' => 'Destinatario',
                'value' => 'Inmuebles::model()->getNombre($data->idDestinatario)'
            ),
            array(
                'name' => 'fecha',
                'header' => 'Fecha',
                'value' => 'Quejas::model()->getDate($data->idQueja)')
            ,
//        'idTextoPredeterminado',
            array(
                'name' => 'State',
                'header' => 'Mensaje',
                'value' => 'Textospredeterminados::model()->getMensaje($data->idTextoPredeterminado)'
            ),
        ),
    ));

    echo CHtml::link('Descargar reporte', array('/site/page/view/descargaReporte'), array('class' => 'btn btn-primary'));
}
