<?php
/* @var $this UsuarioMaestroDosController */
/* @var $model CrugeUser2 */
?>

<h1 class="font_titulo">Ver a <?php echo $model->username; ?></h1>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'itemCssClass' => array('detailViewTr'),
    'attributes' => array(
        'iduser',
        'username',
        'email',
    ),
));

echo '<div class="container">';
echo CHtml::link('Ver los usuarios administradores', array('index'), array('class' => 'btn btn-info'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Registrar un usuario administrador', array('create'), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Modificar usuario administrador', array('update', 'id' => $model->iduser), array('class' => 'btn btn-success'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Ver sus conjuntos', array('viewConjuntos', 'id' => $model->iduser), array('class' => 'btn btn-warning'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
echo '</div>';
