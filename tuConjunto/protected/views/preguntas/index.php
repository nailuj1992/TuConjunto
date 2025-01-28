<?php
/* @var $this PreguntasController */
/* @var $model Preguntas */
/* @var $id int (idAsamblea) */
?>

<h1 class="font_titulo">
    <i class="fa fa-question-circle"></i> Tus preguntas</h1>
    <br>

<?php
$dataProvider = $model->buscar($id);
if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)) {
    $columns = array(
        'pregunta',
        array(
            'header' => 'Asamblea',
            'value' => 'Asambleas::model()->findByPk($data->Asambleas_idAsamblea)->titulo',
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Acciones',
            'template' => '{view}{update}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Ver',
                    'url' => 'array("preguntas/view/?id=$data->idPregunta&asamblea=' . $id . '")'
                ),
                'update' => array(
                    'label' => 'Editar',
                    'url' => 'array("preguntas/update/?id=$data->idPregunta&asamblea=' . $id . '")'
                ),
            ),
        ),
    );
} else if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)) {
    $columns = array(
        'pregunta',
        array(
            'class' => 'CButtonColumn',
            'header' => 'Acciones',
            'template' => '{Sí}{No}',
            'buttons' => array(
                'Sí' => array(
                    'label' => 'Sí',
                    'url' => 'array("preguntas/answer?pregunta=$data->idPregunta&opcion=S&asamblea=' . $id . '")',
                    'options' => array('class' => 'btn btn-primary',
                        'click' => '...',
                    ),
                ),
                'No' => array(
                    'label' => 'No',
                    'url' => 'array("preguntas/answer?pregunta=$data->idPregunta&opcion=N&asamblea=' . $id . '")',
                    'options' => array('class' => 'btn btn-danger',
                        'click' => '...',
                    ),
                ),
            ),
        ),
    );
    $dataProvider = $model->buscarNoRespondidas($id);
} else {
    $columns = array();
}
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'preguntas-grid',
    'dataProvider' => $dataProvider,
    'columns' => $columns,
));

echo '<div class="container">';
if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)) {
    echo CHtml::link('Volver a la asamblea', array('/asambleas/view', 'id' => $id), array('class' => 'btn btn-info'));
    echo SiteController::$espacio_vacio;
    echo CHtml::link('Modificar asamblea', array('/asambleas/update', 'id' => $id), array('class' => 'btn btn-success'));
    echo SiteController::$espacio_vacio;
    echo CHtml::link('Registrar una pregunta', array('create', 'asamblea' => $id), array('class' => 'btn btn-primary'));
    echo SiteController::$espacio_vacio;
}
echo CHtml::link('Volver', array('/asambleas/view', 'id' => $id), array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
echo '</div>';
