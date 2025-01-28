<?php
/* @var $this UsuarioResidenteController */
/* @var $contacto Contactos */
/* @var $model CambiarCredenciales */
?>

<h1 class="font_titulo">Cambiar contraseña de  
    <?php
    if ($contacto->nombres != null && $contacto->apellidos != null) {
        echo "$contacto->nombres $contacto->apellidos";
    } else {
        echo Contactos::$usuarioDesconocido;
    }
    ?>
</h1>

<?php
$this->renderPartial('_form_change', array(
    'contacto' => $contacto,
    'model' => $model,
));
