<?php
/* @var $this PerfilController */
/* @var $model Contactos */
?>
<?php
if($model->nombres!='' || $model->apellidos!= '' || $model->cedula!=''){   
    
echo('<h1 class="font_titulo">');
echo("Modificar perfil de ");
    if ($model->nombres != null && $model->apellidos != null) {
        echo "$model->nombres $model->apellidos";
    } else {
        echo Contactos::$usuarioDesconocido;
    }
echo("</h1>");
}

else{
    echo('<h1 class="font_titulo">');
    echo("¡Bienvenido/a a TuConjunto!");
    echo("</h1>");
    echo('<h2>');
    echo("Por favor completa tu registro llenando el siguiente formulario.");
    echo("</h2>");
}
?>

<?php
$this->renderPartial('_form', array('model' => $model));
