<?php
/* @var $this UsuarioSeguridadController */
/* @var $model CrugeUser2 */
?>

<h1 class="font_titulo">
    <i class="fa fa-eye"></i> Tus vigilantes</h1>
    <br>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'cruge-user2-grid',
    'dataProvider' => $model->buscar(CrugeAuthitem2::$rolVigilante),
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
echo CHtml::link('Registrar un usuario vigilante', array('create'), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo '</div>';
