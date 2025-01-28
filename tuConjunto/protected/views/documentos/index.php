<?php
/* @var $this DocumentosController */
/* @var $dataProvider CActiveDataProvider */
/* @var $model Documentos */
?>

<h1 class="font_titulo">
    <i class="fa fa-file-text"></i> Tus documentos</h1>
<br>

<div class="container">
    <h2>Selecciona una categoría:</h2>
    <div class="panel-group" id="accordion">


        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Documentos jurídicos</a>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <?php
                $session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->id));

                $criteria = new CDbCriteria;
                $criteria->condition = "Conjuntos_idConjunto = $session->Conjuntos_idConjunto AND categoria='DJ'";
//            $criteria->order = "fechaPub DESC";

                $docs = Documentos::model()->findAll($criteria);
                ?>
                <div>
                    <div class="feed-activity-list">
                        <?php
                        for ($i = 0; $i < sizeof($docs); $i++) {
//                        if ($i >= Noticias::$maxNoticias) {
//                            break;
//                        }
                            $documento = $docs[$i];
                            if ($documento != null) {
                                ?>
                                <div class="feed-element">
                                    <!--a href="#" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/profile.jpg">
                                    </a-->
                                    <div class="media-body">
                                        <div class="col-sm-5">
                                            <h2 class="font_titulo2"><b><?php echo ($documento->nombre); ?></b></h2>
                                        </div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-4" id="botongrande">
                                            <?php echo CHtml::link('Ver', array("' . Yii::app()->request->baseUrl . '/../../documents/$documento->urlDocumento"), array('class' => 'btn btn-primary'));
                                            if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo)) {                                            
                                              echo CHtml::link('Editar', array("documentos/update/?id=$documento->idDocumentos"), array('class' => 'btn btn-success'));
                                            }?>

                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Contratos</a>
                </h4>
            </div>
            
            <div id="collapse2" class="panel-collapse collapse">
                <?php
                $session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->id));

                $criteria = new CDbCriteria;
                $criteria->condition = "Conjuntos_idConjunto = $session->Conjuntos_idConjunto AND categoria='C'";
//            $criteria->order = "fechaPub DESC";

                $docs = Documentos::model()->findAll($criteria);
                ?>
                <div>
                    <div class="feed-activity-list">
                        <?php
                        for ($i = 0; $i < sizeof($docs); $i++) {
//                        if ($i >= Noticias::$maxNoticias) {
//                            break;
//                        }
                            $documento = $docs[$i];
                            if ($documento != null) {
                                ?>
                                <div class="feed-element">
                                    <!--a href="#" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/profile.jpg">
                                    </a-->
                                    <div class="media-body">
                                        <div class="col-sm-5">
                                            <h2 class="font_titulo2"><b><?php echo ($documento->nombre); ?></b></h2>
                                        </div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-4" id="botongrande">
                                            <?php echo CHtml::link('Ver', array("' . Yii::app()->request->baseUrl . '/../../documents/$documento->urlDocumento"), array('class' => 'btn btn-primary'));
                                            if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo)) {                                            
                                              echo CHtml::link('Editar', array("documentos/update/?id=$documento->idDocumentos"), array('class' => 'btn btn-success'));
                                            }?>

                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Actas del concejo</a>
                </h4>
            </div>
             <div id="collapse3" class="panel-collapse collapse">
                <?php
                $session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->id));

                $criteria = new CDbCriteria;
                $criteria->condition = "Conjuntos_idConjunto = $session->Conjuntos_idConjunto AND categoria='ACO'";
//            $criteria->order = "fechaPub DESC";

                $docs = Documentos::model()->findAll($criteria);
                ?>
                <div>
                    <div class="feed-activity-list">
                        <?php
                        for ($i = 0; $i < sizeof($docs); $i++) {
//                        if ($i >= Noticias::$maxNoticias) {
//                            break;
//                        }
                            $documento = $docs[$i];
                            if ($documento != null) {
                                ?>
                                <div class="feed-element">
                                    <!--a href="#" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/profile.jpg">
                                    </a-->
                                    <div class="media-body">
                                        <div class="col-sm-5">
                                            <h2 class="font_titulo2"><b><?php echo ($documento->nombre); ?></b></h2>
                                        </div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-4" id="botongrande">
                                            <?php echo CHtml::link('Ver', array("' . Yii::app()->request->baseUrl . '/../../documents/$documento->urlDocumento"), array('class' => 'btn btn-primary'));
                                            if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo)) {                                            
                                              echo CHtml::link('Editar', array("documentos/update/?id=$documento->idDocumentos"), array('class' => 'btn btn-success'));
                                            }?>

                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Actas del comité de convivencia</a>
                </h4>
            </div>
             <div id="collapse4" class="panel-collapse collapse">
                <?php
                $session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->id));

                $criteria = new CDbCriteria;
                $criteria->condition = "Conjuntos_idConjunto = $session->Conjuntos_idConjunto AND categoria='ACM'";
//            $criteria->order = "fechaPub DESC";

                $docs = Documentos::model()->findAll($criteria);
                ?>
                <div>
                    <div class="feed-activity-list">
                        <?php
                        for ($i = 0; $i < sizeof($docs); $i++) {
//                        if ($i >= Noticias::$maxNoticias) {
//                            break;
//                        }
                            $documento = $docs[$i];
                            if ($documento != null) {
                                ?>
                                <div class="feed-element">
                                    <!--a href="#" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/profile.jpg">
                                    </a-->
                                    <div class="media-body">
                                        <div class="col-sm-5">
                                            <h2 class="font_titulo2"><b><?php echo ($documento->nombre); ?></b></h2>
                                        </div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-4" id="botongrande">
                                            <?php echo CHtml::link('Ver', array("' . Yii::app()->request->baseUrl . '/../../documents/$documento->urlDocumento"), array('class' => 'btn btn-primary'));
                                            if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo)) {                                            
                                              echo CHtml::link('Editar', array("documentos/update/?id=$documento->idDocumentos"), array('class' => 'btn btn-success'));
                                            }?>

                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>



        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Actas de asamblea</a>
                </h4>
            </div>
             <div id="collapse5" class="panel-collapse collapse">
                <?php
                $session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->id));

                $criteria = new CDbCriteria;
                $criteria->condition = "Conjuntos_idConjunto = $session->Conjuntos_idConjunto AND categoria='AA'";
//            $criteria->order = "fechaPub DESC";

                $docs = Documentos::model()->findAll($criteria);
                ?>
                <div>
                    <div class="feed-activity-list">
                        <?php
                        for ($i = 0; $i < sizeof($docs); $i++) {
//                        if ($i >= Noticias::$maxNoticias) {
//                            break;
//                        }
                            $documento = $docs[$i];
                            if ($documento != null) {
                                ?>
                                <div class="feed-element">
                                    <!--a href="#" class="pull-left">
                                        <img alt="image" class="img-circle" src="img/profile.jpg">
                                    </a-->
                                    <div class="media-body">
                                        <div class="col-sm-5">
                                            <h2 class="font_titulo2"><b><?php echo ($documento->nombre); ?></b></h2>
                                        </div>
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-4" id="botongrande">
                                            <?php echo CHtml::link('Ver', array("' . Yii::app()->request->baseUrl . '/../../documents/$documento->urlDocumento"), array('class' => 'btn btn-primary'));
                                            if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo)) {                                            
                                              echo CHtml::link('Editar', array("documentos/update/?id=$documento->idDocumentos"), array('class' => 'btn btn-success'));
                                            }?>

                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>    
    </div> 
    
    <?php
     if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo)) {                                            

    echo CHtml::link('Subir documento', array('documentos/create/' . $model->idDocumentos), array('class' => 'btn btn-primary'));
     }?>
</div>



<?php
$session = Contactos::model()->findByAttributes(array('cruge_user_iduser' => Yii::app()->user->getId()));
//if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador) || Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo)) {
//
//
//    $this->widget('zii.widgets.grid.CGridView', array(
//        'id' => 'datos-grid',
//        'dataProvider' => new CActiveDataProvider('Documentos', array(
//            'criteria' => array(
//                'condition' => "Conjuntos_idConjunto=" . $session->Conjuntos_idConjunto . "",
////            'with' => array('inmueblesIdInmueble' => array('joinType' => 'RIGHT JOIN')),
//            ),
//                )),
//        'columns' => array(
//            'nombre',
//            'categoria',
//            'urlDocumento',
//            array(
//                'class' => 'CButtonColumn',
//                'template' => '{update}',
//            ),
//        ),
//    ));
//}
//VISTA USUARIO DESCARGAR ARCHIVOS
//else {
//    $this->widget('zii.widgets.grid.CGridView', array(
//        'id' => 'datos-grid',
//        'dataProvider' => new CActiveDataProvider('Documentos', array(
//            'criteria' => array(
//                'condition' => "Conjuntos_idConjunto=" . $session->Conjuntos_idConjunto . "",
////            'with' => array('inmueblesIdInmueble' => array('joinType' => 'RIGHT JOIN')),
//            ),
//                )),
//        'columns' => array(
//            'nombre',
//            'categoria',
//            array(
//                'class' => 'CButtonColumn',
//                //'template'=>'{view}{update}', //Only shows Delete button
//                'template' => '{horarios}', //Only shows Delete button
//                'header' => 'Acciones',
//                'buttons' => array(
//                    'horarios' => array
//                        (
//                        'label' => 'Ver', //Text label of the button.
//                        ///////////////////////////////////////////////////// IMPORTANTE: Esta URL solo sirve en el servidos, colocar otro /../ para que funcione en local
//                        'url' => 'array("' . Yii::app()->request->baseUrl . '/../../documents/$data->urlDocumento")', //A PHP expression for generating the URL of the button.
//                        'options' => array('class' => 'btn btn-primary', //HTML options for the button tag.
//                            'click' => '...', //A JS function to be invoked when the button is clicked.
//                            'visible' => '...', //A PHP expression for determining whether the button is visible.
//                        )
//                    ),
//                ),
//            ),
//        ),
//    ));
//}
?>