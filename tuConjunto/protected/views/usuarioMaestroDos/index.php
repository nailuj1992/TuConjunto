<?php
/* @var $this UsuarioMaestroDosController */
/* @var $model CrugeUser2 */
?>

<h1 class="font_titulo">Ver Usuarios Administradores</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'cruge-user2-grid',
    'dataProvider' => $model->buscar(CrugeAuthitem2::$rolAdministrador),
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
echo CHtml::link('Registrar un usuario administrador', array('create'), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo '</div>';
