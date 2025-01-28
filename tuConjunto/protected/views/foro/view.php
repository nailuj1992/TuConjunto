<?php
/* @var $this ForoController */
/* @var $model Foro */
?>

<h1 class="font_titulo"> 
    <i class="fa fa-question-circle"></i> Foro "<?php echo $model->tema; ?>"</h1>
<br>
<h3 class="font_titulo2">Fecha de publicación:  <?php echo $model->fechaPub; ?> </h3>

<div class="col-sm-12 divanuncio">
    <div class ="col-sm-2 divforo">        
        <?php
        $autor = Contactos::model()->findByPk($model->idAutor);

        echo(CHtml::image(Yii::app()->request->baseUrl . "/images/" . $autor->foto, "image", array("width" => 100, "height" => 100)));
        ?>
        <h4> <?php echo( $autor->nombres . " " . $autor->apellidos) ?> </h4>
    </div> 
    <div class="col-sm-10">
        <h2>
            <?php echo ($model->mensaje); ?>
        </h2>
    </div>
</div>

<?php
$criteria = new CDbCriteria;
$criteria->condition = "respondeA = $model->idForo";
$criteria->order = "fechaPub";

$respuestas = Foro::model()->findAll($criteria);

for ($i = 0; $i < sizeof($respuestas); $i++) {
//    if ($i >= Noticias::$maxNoticias) {
//        break;
//    }
    $ans = $respuestas[$i];
    if ($ans != null) {
        ?>

        <div class="col-sm-12 divanuncio">
            <div class="hr-line-dashed"></div>

            <div class ="col-sm-2 divforo">        
                <?php
                $autor = Contactos::model()->findByPk($ans->idAutor);

                echo(CHtml::image(Yii::app()->request->baseUrl . "/images/" . $autor->foto, "image", array("width" => 100, "height" => 100)));
                ?>
                <h4> <?php echo( $autor->nombres . " " . $autor->apellidos) ?> </h4>
            </div> 
            <div class="col-sm-10">
                <h2>
                    <?php echo ($ans->mensaje); ?>
                </h2>
            </div>
        </div>
        <?php
    }
}
?>



<?php
echo CHtml::link('Responder', array('response', "pregunta" => $model->idForo), array('class' => 'btn btn-primary'));

echo CHtml::link('Volver', array('index'), array('class' => 'btn btn-danger'));
?>
