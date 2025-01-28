<?php
/* @var $this QuestionController */
/* @var $encuesta Encuestas */
/* @var $preguntas array Question */
/* @var $pregunta Question */
/* @var $respuestas array Answer */
/* @var $respuesta Answer */
/* @var $form CActiveForm */
?>

<h1 class="font_titulo">Responder a la encuesta</h1>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'answer-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
    ));
    ?>

    <div class="form-group">
        <?php
        for ($i = 0; $i < sizeof($preguntas); $i++) {
            $pregunta = $preguntas[$i];
            $respuestas = Answer::model()->findAll(array('condition' => "Question_idQuestion = $pregunta->idQuestion"));
            echo '<label class="font_titulo">' . ($i + 1) . '. ' . $pregunta->pregunta . '</label>';
            foreach ($respuestas as $respuesta) {
                echo '<div class="form-control font_texto">';
                echo '<input type="radio" name="Respuestas[pregunta' . $respuesta->Question_idQuestion . ']"  value="' . $respuesta->idAnswer . '" required>' . $respuesta->contenido . '';
                echo '</div>';
            }
        }
        ?>
    </div>

    <div class="container">
        <?php
        echo CHtml::submitButton('Responder', array('class' => 'btn btn-primary'));
        echo SiteController::$espacio_vacio;
        echo CHtml::link('Volver', array('/encuestas/view', 'id' => $encuesta->idEncuesta), array('class' => 'btn btn-danger'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
