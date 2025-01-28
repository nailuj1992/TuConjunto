<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<!--<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>Congratulations! You have successfully created your Yii application.</p>

<p>You may change the content of this page by modifying the following two files:</p>
<ul>
        <li>View file: <code><?php echo __FILE__; ?></code></li>
        <li>Layout file: <code><?php echo $this->getLayoutFile('main'); ?></code></li>
</ul>

<p>For more details on how to further develop this application, please read
the <a href="http://www.yiiframework.com/doc/">documentation</a>.
Feel free to ask in the <a href="http://www.yiiframework.com/forum/">forum</a>,
should you have any questions.</p>-->


<!-- Main Page -->
<?php
if (!Yii::app()->user->isGuest) {
    $session=Contactos::model()->findByAttributes(array('cruge_user_iduser'=>Yii::app()->user->getId()));
    if($session->nombres!='' || $session->apellidos!= '' || $session->cedula!=''){
    $conjunto = Conjuntos::getConjunto(Yii::app()->user->id);
    if ($conjunto != null) {
        ?>
        <div class="row  border-bottom white-bg dashboard-header">
            <div class="col-sm-8">
                <?php
                if ($conjunto->logo != "") {
                    echo '<div align="center">';
                    echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $conjunto->logo, "image", array("width" => Conjuntos::$widthLogo));
                    echo '</div>';
                }
                ?>
                <?php echo "<h1 align=\"center\">$conjunto->nombre</h1>"; ?>
            </div>
            <div class="col-sm-4">
                <ul class="list-group clear-list m-t">
                    <li class="list-group-item fist-item">
                        <span class="label label-success">NIT</span> <?php echo "$conjunto->nit"; ?>
                    </li>
                    <li class="list-group-item">
                        <span class="label label-info">Dirección</span> <?php echo "$conjunto->direccion"; ?>
                    </li>
                    <?php
                    if ($conjunto->telefono != null) {
                        ?>
                        <li class="list-group-item">
                            <span class="label label-primary">Teléfono</span> <?php echo "$conjunto->telefono"; ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
        $imagenes = Imagenes::model()->findAll(array('condition' => "Conjuntos_idConjunto = $conjunto->idConjunto"));
        if (sizeof($imagenes) > 0) {
            ?>
            <div id="page-top" class="landing-page">
                <div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
                    <?php if (sizeof($imagenes) > 1) { ?>
                        <ol class="carousel-indicators">
                            <li data-target="#inSlider" data-slide-to="0" class="active"></li>
                            <?php
                            for ($i = 1; $i < sizeof($imagenes); $i++) {
                                echo '<li data-target="#inSlider" data-slide-to="' . $i . '"></li>';
                            }
                            ?>
                        </ol>
                    <?php } ?>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <!--div class="container">
                                <div class="carousel-caption blank">
                                    <h1>Bienvenido a<br>
                                        Tu Conjunto</h1>
                                    <p>Información, participación y decisión.</p>
                                </div>
                            </div-->
                            <!-- Set background for slide in css -->
                            <!--<div class="header-back two"></div>-->
                            <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $imagenes[0]->nombre, "image", array("width" => Imagenes::$widthImagen)); ?>
                        </div>
                        <?php for ($i = 1; $i < sizeof($imagenes); $i++) { ?>
                            <div class="item">
                                <!--div class="container">
                                    <div class="carousel-caption">
                                        <br><br>
                                        <h1>Bienvenido a<br>
                                            Tu Conjunto</h1>
                                        <p>Esta es la clave para la<br>
                                            gestión del tiempo.</p>
                                    </div>
                                </div-->
                                <!-- Set background for slide in css -->
                                <!--<div class="header-back one"></div>-->
                                <?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $imagenes[$i]->nombre, "image", array("width" => Imagenes::$widthImagen)); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if (sizeof($imagenes) > 1) { ?>
                        <a class="left carousel-control" href="#inSlider" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#inSlider" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title titulo">
                                    <h5>Noticias del conjunto</h5>
                                </div>
                                <div class="ibox-content">
                                    <?php
                                    $session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->id));

                                    $criteria = new CDbCriteria;
                                    $criteria->condition = "Conjuntos_idConjunto = $session->Conjuntos_idConjunto";
                                    $criteria->order = "fechaPub DESC";

                                    $noticias = Noticias::model()->findAll($criteria);
                                    ?>
                                    <div>
                                        <div class="feed-activity-list">
                                            <?php
                                            for ($i = 0; $i < sizeof($noticias); $i++) {
                                                if ($i >= Noticias::$maxNoticias) {
                                                    break;
                                                }
                                                $noticia = $noticias[$i];
                                                if ($noticia != null) {
                                                    ?>
                                                    <div class="feed-element">
                                                        <!--a href="#" class="pull-left">
                                                            <img alt="image" class="img-circle" src="img/profile.jpg">
                                                        </a-->
                                                        <div class="media-body">
                                                            <h2 class="subtitulo"><b><?php echo $noticia->titulo; ?></b></h2>
                                                            <div class="well">
                                                                <?php echo Noticias::model()->getShortDesc($noticia->idNoticia); ?>
                                                            </div>
                                                        </div>
                                                        <small class="pull-left"><?php echo CHtml::link('Ver más', array("/noticias/view", 'id' => $noticia->idNoticia), array('class' => 'btn btn-warning ver')); ?></small>
                                                        <small class="pull-right"><?php echo "<b>Fecha de publicación:</b> $noticia->fechaPub"; ?></small>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <?php echo CHtml::link('<i class="fa fa-arrow-down"></i> Ver más noticias', array("/noticias"), array('class' => 'btn btn-primary btn-block m-t')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title global">
                                    <h5>Noticias generales</h5>
                                </div>
                                <div class="ibox-content">
                                    <?php
                                    $session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->id));

                                    $criteria = new CDbCriteria;
                                    $criteria->condition = "Conjuntos_idConjunto IS NULL";
                                    $criteria->order = "fechaPub DESC";

                                    $noticias = Noticias::model()->findAll($criteria);
                                    ?>
                                    <div>
                                        <div class="feed-activity-list">
                                            <?php
                                            for ($i = 0; $i < sizeof($noticias); $i++) {
                                                if ($i >= Noticias::$maxNoticias) {
                                                    break;
                                                }
                                                $noticia = $noticias[$i];
                                                if ($noticia != null) {
                                                    ?>
                                                    <div class="feed-element">
                                                        <!--a href="#" class="pull-left">
                                                            <img alt="image" class="img-circle" src="img/profile.jpg">
                                                        </a-->
                                                        <div class="media-body">
                                                            <h2 class="subtitulo"><b><?php echo $noticia->titulo; ?></b></h2>
                                                            <div class="well">
                                                                <?php echo Noticias::model()->getShortDesc($noticia->idNoticia); ?>
                                                            </div>
                                                        </div>
                                                        <small class="pull-left"><?php echo CHtml::link('Ver más', array("/noticias/view", 'id' => $noticia->idNoticia), array('class' => 'btn btn-warning ver')); ?></small>
                                                        <small class="pull-right"><?php echo "<b>Fecha de publicación:</b> $noticia->fechaPub"; ?></small>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <?php echo CHtml::link('<i class="fa fa-arrow-down"></i> Ver más noticias', array("/noticias"), array('class' => 'btn btn-primary btn-block m-t')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title calendario">
                                    <h5>Calendario de eventos</h5>
                                </div>
                                <div class="ibox-content" align="center">
                                    <?php
                                    $this->widget('ext.EFullCalendar.EFullCalendar', array(
                                        'lang' => 'es',
                                        'themeCssFile' => 'cupertino/theme.css',
                                        'id' => 'calendar',
                                        'options' => array(
                                            'header' => array(
                                                'left' => 'prev,next,today',
                                                'center' => 'title',
                                                'right' => 'month,agendaWeek,agendaDay',
                                            ),
                                            'events' => $this->createUrl('/eventos/calendarEvents'), // URL to get event
                                        ),
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <div><strong>Powered by</strong> Data Global &copy; 2016</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        if (!Yii::app()->user->isSuperAdmin) {
            ?>
            <div class="row  border-bottom white-bg dashboard-header">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <?php echo "<h1 align=\"center\">Seleccione un conjunto primero</h1>"; ?>
                </div>
                <div class="col-sm-3">
                </div>

            </div>
            <?php
        } else {
            ?>
            <div class="row  border-bottom white-bg dashboard-header">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <?php echo "<h1 align=\"center\">Super Administrador</h1>"; ?>
                </div>
                <div class="col-sm-3">
                </div>

            </div>
            <?php
        }
    }
    ?>
    <?php
}

    else{
        $this->redirect(array('/perfil/update/' . $session->idContacto));       
    }



        } 
        else {
    $this->redirect("index.php/cruge/ui/login");
}
