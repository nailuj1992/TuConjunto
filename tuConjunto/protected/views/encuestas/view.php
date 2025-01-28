<?php
/* @var $this EncuestasController */
/* @var $model Encuestas */
?>

<h1 class="font_titulo">
    <i class="fa fa-question-circle"></i> Ver encuesta #<?php echo $model->idEncuesta; ?></h1>
    <br>

<?php
$respondidas = Question::model()->findAll(Question::buscarRespondidas($model->idEncuesta));
$haRespondido = sizeof($respondidas) > 0 ? Inmuebleanswer::$siRespondido : Inmuebleanswer::$noRespondido;
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'itemCssClass' => array('detailViewTr'),
    'attributes' => array(
//        'idEncuesta',
        'titulo',
        'descripcion',
        array(
            'name' => 'fechaInicio',
            'value' => FechasField::formatDate($model->fechaInicio)
        ),
        array(
            'name' => 'fechaFin',
            'value' => FechasField::formatDate($model->fechaFin)
        ),
//        array(
//            'name' => '¿Ha respondido?',
//            'value' => "$haRespondido",
//        ),
//        'Conjuntos_idConjunto',
    ),
));

echo '<div class="container">';
echo CHtml::link('Ver las encuestas', array('index'), array('class' => 'btn btn-info'));
echo SiteController::$espacio_vacio;
if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador)) {
    echo CHtml::link('Registrar una encuesta', array('create'), array('class' => 'btn btn-primary'));
    echo SiteController::$espacio_vacio;
    echo CHtml::link('Modificar encuesta', array('update', 'id' => $model->idEncuesta), array('class' => 'btn btn-success'));
    echo SiteController::$espacio_vacio;
    echo CHtml::link('Ver preguntas', array("/question?encuesta=$model->idEncuesta"), array('class' => 'btn btn-warning'));
    echo SiteController::$espacio_vacio;
} else if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente)) {
    $today = date('Y-m-d');
    $inicio = date($model->fechaInicio);
    $fin = date($model->fechaFin);
    if ($inicio <= $today && $today <= $fin && $haRespondido == Inmuebleanswer::$noRespondido) {
        echo CHtml::link('Responder a la encuesta', array("/question/answer?encuesta=$model->idEncuesta"), array('class' => 'btn btn-warning'));
        echo SiteController::$espacio_vacio;
    }
}
echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
echo '</div>';
