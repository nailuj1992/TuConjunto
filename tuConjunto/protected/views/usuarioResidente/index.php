<?php
/* @var $this UsuarioResidenteController */
/* @var $model CrugeUser2 */
?>

<h1 class="font_titulo">
    <i class="fa fa-users"></i> Tus residentes</h1>
    <br>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'cruge-user2-grid',
    'dataProvider' => $model->buscarResidente(CrugeAuthitem2::$rolResidente),
    'columns' => array(
        'username',
        'email',
        array(
            'header' => 'Última sesión',
            'value' => 'CrugeUser2::model()->getLogondate($data->iduser)'
        ),
        array(
            'header' => 'Estado de la cuenta',
            'value' => 'CrugeUser2::model()->getEstado($data->iduser)'
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
        ),
    ),
));

echo '<div class="container">';
echo CHtml::link('Registrar un nuevo residente', array('create'), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Agregar un residente existente', array('add'), array('class' => 'btn btn-warning'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Registrar varios residentes nuevos', array('excel'), array('class' => 'btn btn-success'));
echo SiteController::$espacio_vacio;
echo '</div>';
