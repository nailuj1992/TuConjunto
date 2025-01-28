<?php
/* @var $this UsuarioSeguridadController */
/* @var $model CrugeUser2 */
?>

<h1 class="font_titulo">
    <i class="fa fa-eye"></i> Ver a <?php echo $model->username; ?></h1>
    <br>

<?php
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'itemCssClass' => array('detailViewTr'),
    'attributes' => array(
        'username',
        'email',
    ),
));

echo '<div class="container">';
echo CHtml::link('Ver los usuarios vigilantes', array('index'), array('class' => 'btn btn-info'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Registrar un usuario vigilante', array('create'), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Modificar usuario vigilante', array('update', 'id' => $model->iduser), array('class' => 'btn btn-success'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
echo SiteController::$espacio_vacio;
echo '</div>';
