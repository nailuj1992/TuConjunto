<?php
/* @var $this UsuarioMaestroDosController */
/* @var $model CrugeUser2 */
?>

<h1 class="font_titulo">Ver Conjuntos del administrador <?php echo $model->username; ?></h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'cruge-user2-grid',
    'dataProvider' => Conjuntos::buscarConjuntos(CrugeAuthitem2::$rolAdministrador, $model->iduser),
    'columns' => array(
        'nombre',
        'nit',
        'direccion',
        'telefono',
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'buttons' => array(
                'delete' => array(
                    'label' => 'Quitar asignación',
                    'url' => 'array("usuarioMaestroDos/deleteConjunto?idConjunto=$data->idConjunto&iduser=' . $model->iduser . '")',
                ),
            ),
        ),
    ),
));

echo '<div class="container">';
echo CHtml::link('Volver al usuario administrador', array('view', 'id' => $model->iduser), array('class' => 'btn btn-info'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Modificar usuario administrador', array('update', 'id' => $model->iduser), array('class' => 'btn btn-success'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Asignarle un conjunto', array('createConjunto', 'id' => $model->iduser), array('class' => 'btn btn-warning'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Volver', array('view', 'id' => $model->iduser), array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
echo '</div>';
