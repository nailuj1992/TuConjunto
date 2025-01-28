<?php
/* @var $this PerfilController */
/* @var $model Contactos */
?>

<h1 class="font_titulo">Ver Perfil de 
    <?php
    if ($model->nombres != null && $model->apellidos != null) {
        echo "$model->nombres $model->apellidos";
    } else {
        echo Contactos::$usuarioDesconocido;
    }
    ?>
</h1>

<?php
$foto = $model->foto != "" ? CHtml::image(Yii::app()->request->baseUrl . '/images/' . $model->foto, 'alt', array("width" => Contactos::$widthFoto)) : "";
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $model,
    'itemCssClass' => array('detailViewTr'),
    'attributes' => array(
        'nombres',
        'apellidos',
        array(
            'name' => 'cedula',
            'value' => $model->cedula != null ? $model->cedula : "",
        ),
        'telefono',
        'celular',
        array(
            'name' => 'foto',
            'value' => "$foto",
            'type' => 'raw',
        ),
        array(
            'name' => 'genero',
            'value' => Contactos::model()->getGenero($model->genero),
        ),
    ),
));
?>
<?php
$user = CrugeUser2::model()->findByPk($model->cruge_user_iduser);
$this->widget('booster.widgets.TbDetailView', array(
    'data' => $user,
    'itemCssClass' => array('detailViewTr'),
    'attributes' => array(
        'username',
        'email',
    ),
));

echo '<div class="container">';
echo CHtml::link('Modificar datos', array('update', 'id' => $model->idContacto), array('class' => 'btn btn-success'));
echo SiteController::$espacio_vacio;
echo CHtml::link('Cambiar contraseña', array('change', 'id' => $model->idContacto), array('class' => 'btn btn-primary'));
echo SiteController::$espacio_vacio;
echo '</div>';
