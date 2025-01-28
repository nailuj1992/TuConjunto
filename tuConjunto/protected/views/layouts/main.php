<?php
/* @var $this Controller */
$regresion = '../../../..';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="language" content="es">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/animate.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/custom.css" rel="stylesheet" type="text/css"/>

        <!-- Toastr style -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <!-- Gritter -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <?php
        if (!Yii::app()->user->isGuest) {
            $idUser = Yii::app()->user->id;
            $contactosModel = Contactos::model();
            $contacto = $contactosModel->find($contactosModel->buscar($idUser));
            $conjunto = Conjuntos::getConjunto($idUser);
            ?>
        
            <!-- ----------------------------------------------------------------------- -->
            <div id="wrapper">
                
                <nav class="navbar-default navbar-static-side" role="navigation">
                    
                    
                    <div class="sidebar-collapse">
                        <ul class="nav metismenu" id="side-menu">
                            <li class="nav-header">
                                <div class="dropdown profile-element">
                                    <span>
                                        <?php
                                        if ($contacto != null && $contacto->foto != "") {
                                            echo CHtml::image(Yii::app()->request->baseUrl . '/images/' . $contacto->foto, "image", array("class" => "img-circle", "width" => Contactos::$widthFoto));
                                        }
                                        ?>
                                    </span>
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <span class="clear">
                                            <span class="block m-t-xs">
                                                <strong class="font-bold">
                                                    <?php
                                                    if ($contacto != null) {
                                                        if ($contacto->nombres != null && $contacto->apellidos != null) {
                                                            echo "$contacto->nombres $contacto->apellidos";
                                                        } else {
                                                            echo Contactos::$usuarioDesconocido;
                                                        }
                                                    } else {
                                                        echo Yii::app()->user->name;
                                                    }
                                                    ?> <b class="caret"></b>
                                                </strong>
                                            </span>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                        <?php
                                        if ($contacto != null) {
                                            ?>
                                            <li>
                                                <?php echo CHtml::link('Ver Perfil', array('/perfil/' . $contacto->idContacto)); ?>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <li class="divider"></li>
                                        <li><?php echo CHtml::link('Cerrar sesión', array('/site/logout')); ?></li>
                                    </ul>
                                </div>
                                <div class="logo-element">
                                    TC
                                </div>
                            </li>
                            <?php
                            $inicioActive = '';
                            if (!$this->param) {
                                $inicioActive = 'class="active"';
                            }
                            echo "<li $inicioActive>";
                            ?>
                            <?php echo CHtml::link('<i class="fa fa-th-large"></i><span ' . $inicioActive . '>Inicio</span>', array('/')); ?>
                            <?php echo '</li>'; ?>
                            
                            
                            <?php                            
                            if (Yii::app()->user->isSuperAdmin) {
                                $conjuntoActive = '';
                                if ($this->param == Funcion::conjunto) {
                                    $conjuntoActive = 'class="active"';
                                }
                                echo "<li $conjuntoActive>";
                                echo CHtml::link('<i class="fa fa-diamond"></i><span ' . $conjuntoActive . '>Ver conjuntos</span>', array('/conjuntos/'));
                                echo "</li>";
                                ?>

                                <?php
                                $concejoActive = '';
                                if ($this->param == Funcion::usuarioConcejo) {
                                    $concejoActive = 'class="active"';
                                }
                                echo "<li $concejoActive>";
                                echo CHtml::link('<i class="fa fa-diamond"></i><span ' . $concejoActive . '>Ver usuarios del concejo</span>', array('/usuarioMaestroUno/'));
                                echo "</li>";
                                ?>

                                <?php
                                $administradorActive = '';
                                if ($this->param == Funcion::usuarioAdministrador) {
                                    $administradorActive = 'class="active"';
                                }
                                echo "<li $administradorActive>";
                                echo CHtml::link('<i class="fa fa-diamond"></i><span ' . $administradorActive . '>Ver usuarios administradores</span>', array('/usuarioMaestroDos/'));
                                echo "</li>";
                                ?>

                                <?php
                                $noticiaActive = '';
                                if ($this->param == Funcion::noticia) {
                                    $noticiaActive = 'class="active"';
                                }
                                echo "<li $noticiaActive>";
                                echo CHtml::link('<i class="fa fa-newspaper-o"></i><span ' . $noticiaActive . '>Ver noticias globales</span>', array('/noticias/'));
                                echo "</li>";
                                ?>

                                <?php
                                $textoActive = '';
                                if ($this->param == Funcion::textosPredeterminados) {
                                    $textoActive = 'class="active"';
                                }
                                echo "<li $textoActive>";
                                echo CHtml::link('<i class="fa fa-file-text"></i><span ' . $textoActive . '>Ver textos predeterminados</span>', array('/textosPredeterminados/'));
                                echo "</li>";
                                ?>

                                <li>
                                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Panel de Control </span><span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level collapse" style="display: none">
                                        <li>
                                            <a href="#">User Manager <span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <?php echo CHtml::link('Update Profile', array($regresion . CrugeUtil::uiaction('editprofile'))); ?>
                                                </li>
                                                <li>
                                                    <?php echo CHtml::link('Create User', array($regresion . CrugeUtil::uiaction('usermanagementcreate'))); ?>
                                                </li>
                                                <li>
                                                    <?php echo CHtml::link('Manage Users', array($regresion . CrugeUtil::uiaction('usermanagementadmin'))); ?>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-second-level collapse">
                                        <li>
                                            <a href="#">Custom Fields <span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <?php echo CHtml::link('List Profile Fields', array($regresion . CrugeUtil::uiaction('fieldsadminlist'))); ?>
                                                </li>
                                                <li>
                                                    <?php echo CHtml::link('Create Profile Field', array($regresion . CrugeUtil::uiaction('fieldsadmincreate'))); ?>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-second-level collapse">
                                        <li>
                                            <a href="#">Roles and Assignments <span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li style="display: none">
                                                    <?php echo CHtml::link('Roles', array($regresion . CrugeUtil::uiaction('rbaclistroles'))); ?>
                                                </li>
                                                <li>
                                                    <?php echo CHtml::link('Tasks', array($regresion . CrugeUtil::uiaction('rbaclisttasks'))); ?>
                                                </li>
                                                <li>
                                                    <?php echo CHtml::link('Operations', array($regresion . CrugeUtil::uiaction('rbaclistops'))); ?>
                                                </li>
                                                <li style="display: none">
                                                    <?php echo CHtml::link('Assign Roles to Users', array($regresion . CrugeUtil::uiaction('rbacusersassignments'))); ?>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-second-level collapse">
                                        <li>
                                            <a href="#">System <span class="fa arrow"></span></a>
                                            <ul class="nav nav-third-level">
                                                <li>
                                                    <?php echo CHtml::link('Sessions', array($regresion . CrugeUtil::uiaction('sessionadmin'))); ?>
                                                </li>
                                                <li>
                                                    <?php echo CHtml::link('System Variables', array($regresion . CrugeUtil::uiaction('systemupdate'))); ?>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <?php
                            } else {
                                if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo)) {
                                    ?>
                                    <?php
                                }
                                $rolAdmin = Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador) && $contacto != null && $contacto->Conjuntos_idConjunto != null;
                                if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolConcejo) || $rolAdmin) {
                                    if ($this->param == Funcion::conjunto || $this->param == Funcion::areaSocial || $this->param == Funcion::usuarioResidente || $this->param == Funcion::usuarioSeguridad || $this->param == Funcion::inmueble || $this->param == Funcion::parqueadero || $this->param == Funcion::mensaje || $this->param == Funcion::mascota || $this->param == Funcion::cartelera || $this->param == Funcion::noticia || $this->param == Funcion::vehiculo || $this->param == Funcion::asamblea || $this->param == Funcion::encuesta || $this->param == Funcion::documento || $this->param == Funcion::reserva || $this->param == Funcion::foro) {
                                        echo '<li class="active">';
                                    } else {
                                        echo '<li>';
                                    }
                                    ?>
                                    <a href="index.html"><i class="fa fa-home"></i> <span class="nav-label">Comunidad</span> <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level collapse">
                                        <?php
                                        $conjuntoActive = '';
                                        if ($this->param == Funcion::conjunto) {
                                            $conjuntoActive = 'class="active"';
                                        }
                                        echo "<li $conjuntoActive>";
                                        echo CHtml::link('<i class="fa fa-diamond"></i><span ' . $conjuntoActive . '>Tu conjunto</span>', array('/conjuntos/view', 'id' => $contacto->Conjuntos_idConjunto));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $areaActive = '';
                                        if ($this->param == Funcion::areaSocial) {
                                            $areaActive = 'class="active"';
                                        }
                                        echo "<li $areaActive>";
                                        echo CHtml::link('<i class="fa fa-map-marker"></i><span ' . $areaActive . '>Tus áreas sociales</span>', array('/areaSocial/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $residenteActive = '';
                                        if ($this->param == Funcion::usuarioResidente) {
                                            $residenteActive = 'class="active"';
                                        }
                                        echo "<li $residenteActive>";
                                        echo CHtml::link('<i class="fa fa-users"></i><span ' . $residenteActive . '>Tus residentes</span>', array('/usuarioResidente/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $vigilanteActive = '';
                                        if ($this->param == Funcion::usuarioSeguridad) {
                                            $vigilanteActive = 'class="active"';
                                        }
                                        echo "<li $vigilanteActive>";
                                        echo CHtml::link('<i class="fa fa-eye"></i><span ' . $vigilanteActive . '>Tus vigilantes</span>', array('/usuarioSeguridad/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $inmuebleActive = '';
                                        if ($this->param == Funcion::inmueble) {
                                            $inmuebleActive = 'class="active"';
                                        }
                                        echo "<li $inmuebleActive>";
                                        echo CHtml::link('<i class="fa fa-building"></i><span ' . $inmuebleActive . '>Tus inmuebles</span>', array('/inmuebles/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $parqueaderoActive = '';
                                        if ($this->param == Funcion::parqueadero) {
                                            $parqueaderoActive = 'class="active"';
                                        }
                                        echo "<li $parqueaderoActive>";
                                        echo CHtml::link('<i class="fa fa-caret-square-o-down "></i><span ' . $parqueaderoActive . '>Tus parqueaderos</span>', array('/parqueaderos/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $mensajeActive = '';
                                        if ($this->param == Funcion::mensaje) {
                                            $mensajeActive = 'class="active"';
                                        }
                                        echo "<li $mensajeActive>";
                                        echo CHtml::link('<i class="fa fa-envelope-o"></i><span ' . $mensajeActive . '>Tus mensajes</span>', array('/mensajes/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $reservaActive = '';
                                        if ($this->param == Funcion::reserva) {
                                            $reservaActive = 'class="active"';
                                        }
                                        echo "<li $reservaActive>";
                                        echo CHtml::link('<i class="fa fa-book"></i><span ' . $reservaActive . '>Tus reservas</span>', array('/reserva/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $mascotaActive = '';
                                        if ($this->param == Funcion::mascota) {
                                            $mascotaActive = 'class="active"';
                                        }
                                        echo "<li $mascotaActive>";
                                        echo CHtml::link('<i class="fa fa-paw"></i><span ' . $mascotaActive . '>Tus mascotas</span>', array('/mascotas/'));
                                        echo "</li>";
                                        ?>
                                        
                                         <?php
                                        $carteleraActive = '';
                                        if ($this->param == Funcion::cartelera) {
                                            $carteleraActive = 'class="active"';
                                        }
                                        echo "<li $carteleraActive>";
                                        echo CHtml::link('<i class="fa fa-list-ul"></i><span ' . $carteleraActive . '>Tu cartelera</span>', array('/cartelera/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $noticiaActive = '';
                                        if ($this->param == Funcion::noticia) {
                                            $noticiaActive = 'class="active"';
                                        }
                                        echo "<li $noticiaActive>";
                                        echo CHtml::link('<i class="fa fa-newspaper-o"></i><span ' . $noticiaActive . '>Tus noticias</span>', array('/noticias/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $vehiculoActive = '';
                                        if ($this->param == Funcion::vehiculo) {
                                            $vehiculoActive = 'class="active"';
                                        }
                                        echo "<li $vehiculoActive>";
                                        echo CHtml::link('<i class="fa fa-car"></i><span ' . $vehiculoActive . '>Tus vehículos</span>', array('/vehiculos/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $asambleaActive = '';
                                        if ($this->param == Funcion::asamblea) {
                                            $asambleaActive = 'class="active"';
                                        }
                                        echo "<li $asambleaActive>";
                                        echo CHtml::link('<i class="fa fa-exclamation-circle"></i><span ' . $asambleaActive . '>Tus asambleas</span>', array('/asambleas/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $encuestaActive = '';
                                        if ($this->param == Funcion::encuesta) {
                                            $encuestaActive = 'class="active"';
                                        }
                                        echo "<li $encuestaActive>";
                                        echo CHtml::link('<i class="fa fa-question"></i><span ' . $encuestaActive . '>Tus encuestas</span>', array('/encuestas/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $documentoActive = '';
                                        if ($this->param == Funcion::documento) {
                                            $documentoActive = 'class="active"';
                                        }
                                        echo "<li $documentoActive>";
                                        echo CHtml::link('<i class="fa fa-file-text"></i><span ' . $documentoActive . '>Tus documentos</span>', array('/documentos/'));
                                        echo "</li>";
                                        ?>
                                        
                                       <?php
                                        $foroActive = '';
                                        if ($this->param == Funcion::foro) {
                                            $foroActive = 'class="active"';
                                        }
                                        echo "<li $foroActive>";
                                        echo CHtml::link('<i class="fa fa-list-ul"></i><span ' . $foroActive . '>Contáctenos</span>', array('/foro/'));
                                        echo "</li>";
                                        ?>
                                    </ul>
                                    <?php echo '</li>'; ?>

                                    <?php
                                    if ($rolAdmin) {
                                        $seleccionarConjuntoActive = '';
                                        if ($this->param == Funcion::usuarioAdministrador) {
                                            $seleccionarConjuntoActive = 'class="active"';
                                        }
                                        echo "<li $seleccionarConjuntoActive>";
                                        echo CHtml::link('<i class="fa fa-diamond"></i><span ' . $seleccionarConjuntoActive . '>Seleccionar otro conjunto</span>', array('/usuarioMaestroDos/selectConjunto'));
                                        echo "</li>";
                                    }
                                } else {
                                    if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolAdministrador) && $contacto != null && $contacto->Conjuntos_idConjunto == null) {
                                        $seleccionarConjuntoActive = '';
                                        if ($this->param == Funcion::usuarioAdministrador) {
                                            $seleccionarConjuntoActive = 'class="active"';
                                        }
                                        echo "<li $seleccionarConjuntoActive>";
                                        echo CHtml::link('<i class="fa fa-diamond"></i><span ' . $seleccionarConjuntoActive . '>Seleccionar un conjunto</span>', array('/usuarioMaestroDos/selectConjunto'));
                                        echo "</li>";
                                    }
                                }
                                $rolResid = Yii::app()->user->checkAccess(CrugeAuthitem2::$rolResidente) && $contacto != null;
                                if ($rolResid && $contacto->Inmuebles_idInmueble != null) {
                                    if($contacto->nombres!='' || $contacto->apellidos!= '' || $contacto->cedula!=''){
                                    if ($this->param == Funcion::noticia || $this->param == Funcion::inmueble || $this->param == Funcion::asamblea || $this->param == Funcion::encuesta || $this->param == Funcion::mensaje || $this->param == Funcion::vehiculo || $this->param == Funcion::mascota || $this->param==Funcion::cartelera || $this->param == Funcion::reserva || $this->param == Funcion::autorizado) {
                                        echo '<li class="active">';
                                    } else {
                                        echo '<li>';
                                    }
                                    ?>
                                    <a href="index.html"><i class="fa fa-home"></i> <span class="nav-label">Comunidad</span> <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level collapse">
                                        <?php
                                        $inmuebleActive = $inmuebleActive = '';
                                        if ($this->param == Funcion::inmueble) {
                                            $inmuebleActive = 'class="active"';
                                        }
                                        echo "<li $inmuebleActive>";
                                        echo CHtml::link('<i class="fa fa-building"></i><span ' . $inmuebleActive . '>Tu inmueble</span>', array('/inmuebles/view', 'id' => $contacto->Inmuebles_idInmueble));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $asambleaActive = '';
                                        if ($this->param == Funcion::asamblea) {
                                            $asambleaActive = 'class="active"';
                                        }
                                        echo "<li $asambleaActive>";
                                        echo CHtml::link('<i class="fa fa-exclamation-circle"></i><span ' . $asambleaActive . '>Tus asambleas</span>', array('/asambleas/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $encuestaActive = '';
                                        if ($this->param == Funcion::encuesta) {
                                            $encuestaActive = 'class="active"';
                                        }
                                        echo "<li $encuestaActive>";
                                        echo CHtml::link('<i class="fa fa-question"></i><span ' . $encuestaActive . '>Tus encuestas</span>', array('/encuestas/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $mensajeActive = '';
                                        if ($this->param == Funcion::mensaje) {
                                            $mensajeActive = 'class="active"';
                                        }
                                        echo "<li $mensajeActive>";
                                        echo CHtml::link('<i class="fa fa-envelope-o"></i><span ' . $mensajeActive . '>Tus mensajes</span>', array('/mensajes/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $vehiculosActive = '';
                                        if ($this->param == Funcion::vehiculo) {
                                            $vehiculosActive = 'class="active"';
                                        }
                                        echo "<li $vehiculosActive>";
                                        echo CHtml::link('<i class="fa fa-car"></i><span ' . $vehiculosActive . '>Tus vehículos</span>', array('/vehiculos/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $mascotasActive = '';
                                        if ($this->param == Funcion::mascota) {
                                            $mascotasActive = 'class="active"';
                                        }
                                        echo "<li $mascotasActive>";
                                        echo CHtml::link('<i class="fa fa-paw"></i><span ' . $mascotasActive . '>Tus mascotas</span>', array('/mascotas/'));
                                        echo "</li>";
                                        ?>
                                        
                                        <?php
                                        $carteleraActive = '';
                                        if ($this->param == Funcion::cartelera) {
                                            $carteleraActive = 'class="active"';
                                        }
                                        echo "<li $carteleraActive>";
                                        echo CHtml::link('<i class="fa fa-list-ul"></i><span ' . $carteleraActive . '>Tu cartelera</span>', array('/cartelera/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $reservaActive = '';
                                        if ($this->param == Funcion::reserva) {
                                            $reservaActive = 'class="active"';
                                        }
                                        echo "<li $reservaActive>";
                                        echo CHtml::link('<i class="fa fa-book"></i><span ' . $reservaActive . '>Tus reservas</span>', array('/reserva/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $autorizadoActive = '';
                                        if ($this->param == Funcion::autorizado) {
                                            $autorizadoActive = 'class="active"';
                                        }
                                        echo "<li $autorizadoActive>";
                                        echo CHtml::link('<i class="fa fa-check"></i><span ' . $autorizadoActive . '>Tus autorizados</span>', array('/autorizado/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        $noticiaActive = '';
                                        if ($this->param == Funcion::noticia) {
                                            $noticiaActive = 'class="active"';
                                        }
                                        echo "<li $noticiaActive>";
                                        echo CHtml::link('<i class="fa fa-newspaper-o"></i><span ' . $noticiaActive . '>Tus noticias</span>', array('/noticias/'));
                                        echo "</li>";
                                        ?>
                                    </ul>
                                    <?php echo '</li>'; ?>

                                    <?php
                                    $seleccionarInmuebleActive = '';
                                    if ($this->param == Funcion::usuarioResidente) {
                                        $seleccionarInmuebleActive = 'class="active"';
                                    }
                                    echo "<li $seleccionarInmuebleActive>";
                                    echo CHtml::link('<i class="fa fa-building"></i><span ' . $seleccionarInmuebleActive . '>Seleccionar otro inmueble</span>', array('/usuarioResidente/chooseInmueble'));
                                    echo '</li>';
                                    ?>

                                    <?php
                                    if ($this->param == Funcion::documento|| $this->param == Funcion::foro) {
                                        echo '<li class="active">';
                                    } else {
                                        echo '<li>';
                                    }
                                    ?>
                                    <a href="index.html"><i class="fa fa-asterisk"></i> <span class="nav-label">Administración</span> <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level collapse">
                                        <?php
                                        $documentoActive = '';
                                        if ($this->param == Funcion::documento) {
                                            $documentoActive = 'class="active"';
                                        }
                                        echo "<li $documentoActive>";
                                        echo CHtml::link('<i class="fa fa-file-text"></i><span ' . $documentoActive . '>Tus documentos</span>', array('/documentos/'));
                                        echo "</li>";
                                        ?>

                                        <?php
                                        echo "<li>";
                                        echo CHtml::link('<i class="fa fa-question"></i><span class="active">Tus pagos</span>', '#');
                                        echo "</li>";
                                        ?>
                                        
                                       <?php
                                        $foroActive = '';
                                        if ($this->param == Funcion::foro) {
                                            $foroActive = 'class="active"';
                                        }
                                        echo "<li $foroActive>";
                                        echo CHtml::link('<i class="fa fa-check"></i><span ' . $foroActive . '>Contáctenos</span>', array('/foro/'));
                                        echo "</li>";
                                        ?>
                                    </ul>
                                    <?php echo '</li>'; ?>

                                    <?php
                                    if ($contacto != null) {
                                        if ($contacto->Inmuebles_idInmueble != null) {
                                            $inmueble = Inmuebles::model()->findByPk($contacto->Inmuebles_idInmueble);
                                            if ($inmueble->idTitular == null) {
                                                ?>
                                                <li>
                                                    <?php echo CHtml::link('<i class="fa fa-building"></i><span class="active">Ser titular del inmueble</span>', array('/inmuebles/titular')); ?>
                                                </li>
                                                <?php
                                            }
                                        }
                                    }
                                }} else if ($rolResid && $contacto->Inmuebles_idInmueble == null) {
                                    ?>
                                    <?php
                                    $seleccionarInmuebleActive = '';
                                    if ($this->param == Funcion::usuarioResidente) {
                                        $seleccionarInmuebleActive = 'class="active"';
                                    }
                                    echo "<li $seleccionarInmuebleActive>";
                                    echo CHtml::link('<i class="fa fa-building"></i><span ' . $seleccionarInmuebleActive . '>Seleccionar un inmueble</span>', array('/usuarioResidente/chooseInmueble'));
                                    echo '</li>';
                                    ?>
                                    <?php
                                }
                                if (Yii::app()->user->checkAccess(CrugeAuthitem2::$rolVigilante)) {
                                    ?>
                                    <?php
                                    $parqueaderoActive = '';
                                    if ($this->param == Funcion::parqueadero) {
                                        $parqueaderoActive = 'class="active"';
                                    }
                                    echo "<li $parqueaderoActive>";
                                    echo CHtml::link('<i class="fa fa-caret-square-o-down"></i><span ' . $parqueaderoActive . '>Tus parqueaderos</span>', array('/parqueaderos/'));
                                    echo '</li>';
                                    ?>

                                    <?php
                                    $vehiculoActive = '';
                                    if ($this->param == Funcion::vehiculo) {
                                        $vehiculoActive = 'class="active"';
                                    }
                                    echo "<li $vehiculoActive>";
                                    echo CHtml::link('<i class="fa fa-car"></i><span ' . $vehiculoActive . '">Tus vehículos</span>', array('/vehiculos/'));
                                    echo '</li>';
                                    ?>

                                    <?php
                                    $autorizadoActive = '';
                                    if ($this->param == Funcion::autorizado) {
                                        $autorizadoActive = 'class="active"';
                                    }
                                    echo "<li $autorizadoActive>";
                                    echo CHtml::link('<i class="fa fa-check"></i><span ' . $autorizadoActive . '>Tus autorizados</span>', array('/site/page/view/consultarAutorizados?q='));
                                    echo '</li>';
                                    ?>
                                    <?php
                                }
                                ?>
                                <li style="display: none">
                                    <?php echo CHtml::link('<i class="fa fa-edit"></i><span class="active">Contáctenos</span>', array('/site/contact')); ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </nav>

                <div id="page-wrapper" class="gray-bg dashbard-1">
                    <div class="row border-bottom">
                        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                            <div class="navbar-header">
                                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                            </div>
                            <ul class="nav navbar-top-links navbar-header">
                                <li>
                                    <h1 class="navbar-text m-r-sm text-center welcome-message">
                                        <?php
                                        if ($conjunto != null) {
                                            echo CHtml::encode($conjunto->nombre);
                                        }
                                        ?>
                                    </h1>
                                </li>
                            </ul>
                            <ul class="nav navbar-top-links navbar-right">
                                <li>
                                    <span class="m-r-sm text-muted welcome-message">
                                        <?php echo CHtml::encode(Yii::app()->name); ?>
                                    </span>
                                </li>
                                <?php
                                if ($contacto != null) {
                                    $inmueble = Inmuebles::model()->findByPk($contacto->Inmuebles_idInmueble);
                                    if ($contacto->Inmuebles_idInmueble != null && $inmueble->idTitular != null) {
                                        $asambleas = Asambleas::model()->findAll(Asambleas::model()->buscarNoRespondidasTimeout());
                                        ?>
                                        <li class="dropdown">
                                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                                <i class="fa fa-envelope"></i>  <?php
                                                if (sizeof($asambleas) > 0) {
                                                    echo '<span class="label label-warning">' . sizeof($asambleas) . '</span>';
                                                }
                                                ?>
                                            </a>
                                            <ul class="dropdown-menu dropdown-messages">
                                                <li style="display: none">
                                                    <div class="dropdown-messages-box">
                                                        <a href="#" class="pull-left">
                                                            <img alt="image" class="img-circle" src="img/a7.jpg">
                                                        </a>
                                                        <div class="media-body">
                                                            <small class="pull-right">46h ago</small>
                                                            <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                                            <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="divider" style="display: none"></li>
                                                <li>
                                                    <div class="text-center link-block">
                                                        <?php echo CHtml::link('<i class="fa fa-envelope"></i> <strong>Asambleas pendientes</strong>', array('/asambleas/')); ?>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-alerts">
                                        <li>
                                            <a href="#">
                                                <div>
                                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#">
                                                <div>
                                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#">
                                                <div>
                                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <div class="text-center link-block">
                                                <a href="#">
                                                    <strong>See All Alerts</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>


                                <li>
                                    <?php echo CHtml::link('<i class="fa fa-sign-out"></i> Cerrar sesión', array('/site/logout')); ?>
                                </li>
                                <li>
                                    <a class="right-sidebar-toggle">
                                        <i class="fa fa-tasks"></i>
                                    </a>
                                </li>
                            </ul>

                        </nav>
                    </div>

                    <?php
                    mainBlock($this, $content);
                    ?>
                </div>

                <!-- Chat Block -->
                <div class="small-chat-box fadeInRight animated">

                    <div class="heading" draggable="true">
                        <small class="chat-date pull-right">
                            02.19.2015
                        </small>
                        Small chat
                    </div>

                    <div class="content">

                        <div class="left">
                            <div class="author-name">
                                Monica Jackson <small class="chat-date">
                                    10:02 am
                                </small>
                            </div>
                            <div class="chat-message active">
                                Lorem Ipsum is simply dummy text input.
                            </div>

                        </div>
                        <div class="right">
                            <div class="author-name">
                                Mick Smith
                                <small class="chat-date">
                                    11:24 am
                                </small>
                            </div>
                            <div class="chat-message">
                                Lorem Ipsum is simpl.
                            </div>
                        </div>
                        <div class="left">
                            <div class="author-name">
                                Alice Novak
                                <small class="chat-date">
                                    08:45 pm
                                </small>
                            </div>
                            <div class="chat-message active">
                                Check this stock char.
                            </div>
                        </div>
                        <div class="right">
                            <div class="author-name">
                                Anna Lamson
                                <small class="chat-date">
                                    11:24 am
                                </small>
                            </div>
                            <div class="chat-message">
                                The standard chunk of Lorem Ipsum
                            </div>
                        </div>
                        <div class="left">
                            <div class="author-name">
                                Mick Lane
                                <small class="chat-date">
                                    08:45 pm
                                </small>
                            </div>
                            <div class="chat-message active">
                                I belive that. Lorem Ipsum is simply dummy text.
                            </div>
                        </div>


                    </div>
                    <div class="form-chat">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control">
                            <span class="input-group-btn"> <button
                                    class="btn btn-primary" type="button">Send
                                </button> </span></div>
                    </div>

                </div>
                <div id="small-chat">

                    <span class="badge badge-warning pull-right">5</span>
                    <a class="open-small-chat">
                        <i class="fa fa-comments"></i>

                    </a>
                </div>
                <!-- Chat Block END -->

                <!-- Tabs Block -->
                <div id="right-sidebar" class="animated">
                    <div class="sidebar-container">

                        <ul class="nav nav-tabs navs-3">

                            <li class="active"><a data-toggle="tab" href="#tab-1">
                                    Notes
                                </a></li>
                            <li><a data-toggle="tab" href="#tab-2">
                                    Projects
                                </a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3">
                                    <i class="fa fa-gear"></i>
                                </a></li>
                        </ul>

                        <div class="tab-content">


                            <div id="tab-1" class="tab-pane active">

                                <div class="sidebar-title">
                                    <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                                    <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                                </div>

                                <div>

                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a1.jpg">

                                                <div class="m-t-xs">
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">

                                                There are many variations of passages of Lorem Ipsum available.
                                                <br>
                                                <small class="text-muted">Today 4:21 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a2.jpg">
                                            </div>
                                            <div class="media-body">
                                                The point of using Lorem Ipsum is that it has a more-or-less normal.
                                                <br>
                                                <small class="text-muted">Yesterday 2:45 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                                                <div class="m-t-xs">
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                                <br>
                                                <small class="text-muted">Yesterday 1:10 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                                            </div>

                                            <div class="media-body">
                                                Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                                <br>
                                                <small class="text-muted">Monday 8:37 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a8.jpg">
                                            </div>
                                            <div class="media-body">

                                                All the Lorem Ipsum generators on the Internet tend to repeat.
                                                <br>
                                                <small class="text-muted">Today 4:21 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a7.jpg">
                                            </div>
                                            <div class="media-body">
                                                Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                                <br>
                                                <small class="text-muted">Yesterday 2:45 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                                                <div class="m-t-xs">
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                                <br>
                                                <small class="text-muted">Yesterday 1:10 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="sidebar-message">
                                        <a href="#">
                                            <div class="pull-left text-center">
                                                <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                                            </div>
                                            <div class="media-body">
                                                Uncover many web sites still in their infancy. Various versions have.
                                                <br>
                                                <small class="text-muted">Monday 8:37 pm</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                            </div>

                            <div id="tab-2" class="tab-pane">

                                <div class="sidebar-title">
                                    <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                                    <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                                </div>

                                <ul class="sidebar-list">
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Business valuation</h4>
                                            It is a long established fact that a reader will be distracted.

                                            <div class="small">Completion with: 22%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                            </div>
                                            <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Contract with Company </h4>
                                            Many desktop publishing packages and web page editors.

                                            <div class="small">Completion with: 48%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;" class="progress-bar"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Meeting</h4>
                                            By the readable content of a page when looking at its layout.

                                            <div class="small">Completion with: 14%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-primary pull-right">NEW</span>
                                            <h4>The generated</h4>
                                            There are many variations of passages of Lorem Ipsum available.
                                            <div class="small">Completion with: 22%</div>
                                            <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Business valuation</h4>
                                            It is a long established fact that a reader will be distracted.

                                            <div class="small">Completion with: 22%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                            </div>
                                            <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Contract with Company </h4>
                                            Many desktop publishing packages and web page editors.

                                            <div class="small">Completion with: 48%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 48%;" class="progress-bar"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <div class="small pull-right m-t-xs">9 hours ago</div>
                                            <h4>Meeting</h4>
                                            By the readable content of a page when looking at its layout.

                                            <div class="small">Completion with: 14%</div>
                                            <div class="progress progress-mini">
                                                <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="label label-primary pull-right">NEW</span>
                                            <h4>The generated</h4>
                                            <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                            There are many variations of passages of Lorem Ipsum available.
                                            <div class="small">Completion with: 22%</div>
                                            <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                        </a>
                                    </li>

                                </ul>

                            </div>

                            <div id="tab-3" class="tab-pane">

                                <div class="sidebar-title">
                                    <h3><i class="fa fa-gears"></i> Settings</h3>
                                    <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                                </div>

                                <div class="setings-item">
                                    <span>
                                        Show notifications
                                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                            <label class="onoffswitch-label" for="example">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                                    <span>
                                        Disable Chat
                                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">
                                            <label class="onoffswitch-label" for="example2">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                                    <span>
                                        Enable history
                                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                            <label class="onoffswitch-label" for="example3">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                                    <span>
                                        Show charts
                                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                            <label class="onoffswitch-label" for="example4">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                                    <span>
                                        Offline users
                                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                                            <label class="onoffswitch-label" for="example5">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                                    <span>
                                        Global search
                                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                                            <label class="onoffswitch-label" for="example6">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="setings-item">
                                    <span>
                                        Update everyday
                                    </span>
                                    <div class="switch">
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                            <label class="onoffswitch-label" for="example7">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="sidebar-content">
                                    <h4>Settings</h4>
                                    <div class="small">
                                        I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                        And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                        Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <!-- Tabs Block END -->
            </div>
            <!-- ----------------------------------------------------------------------- -->
        <?php
        } else {
            mainBlock($this, $content);
        }
        ?>

        <!-- Mainly scripts -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-2.1.1.js"></script>-->

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!--<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>-->

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Flot -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.spline.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.resize.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/flot/jquery.flot.pie.js"></script>

        <!-- Peity -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/peity/jquery.peity.min.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo/peity-demo.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/inspinia.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/pace/pace.min.js"></script>

        <!-- jQuery UI -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/jquery-ui/jquery-ui.min.js"></script>

        <!-- GITTER -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/gritter/jquery.gritter.min.js"></script>

        <!-- Sparkline -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/sparkline/jquery.sparkline.min.js"></script>

        <!-- Sparkline demo data  -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/demo/sparkline-demo.js"></script>

        <!-- ChartJS-->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/chartJs/Chart.min.js"></script>

        <!-- Toastr -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/plugins/toastr/toastr.min.js"></script>

        <script>
            $(document).ready(function () {
//                                setTimeout(function () {
//                                    toastr.options = {
//                                        closeButton: true,
//                                        progressBar: true,
//                                        showMethod: 'slideDown',
//                                        timeOut: 4000
//                                    };
//                                    toastr.success('Responsive Admin Theme', 'Welcome to INSPINIA');
//                
//                                }, 1300);


                var data1 = [
                    [0, 4], [1, 8], [2, 5], [3, 10], [4, 4], [5, 16], [6, 5], [7, 11], [8, 6], [9, 11], [10, 30], [11, 10], [12, 13], [13, 4], [14, 3], [15, 3], [16, 6]
                ];
                var data2 = [
                    [0, 1], [1, 0], [2, 2], [3, 0], [4, 1], [5, 3], [6, 1], [7, 5], [8, 2], [9, 3], [10, 2], [11, 1], [12, 0], [13, 2], [14, 8], [15, 0], [16, 0]
                ];
                $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                    data1, data2
                ],
                        {
                            series: {
                                lines: {
                                    show: false,
                                    fill: true
                                },
                                splines: {
                                    show: true,
                                    tension: 0.4,
                                    lineWidth: 1,
                                    fill: 0.4
                                },
                                points: {
                                    radius: 0,
                                    show: true
                                },
                                shadowSize: 2
                            },
                            grid: {
                                hoverable: true,
                                clickable: true,
                                tickColor: "#d5d5d5",
                                borderWidth: 1,
                                color: '#d5d5d5'
                            },
                            colors: ["#1ab394", "#1C84C6"],
                            xaxis: {
                            },
                            yaxis: {
                                ticks: 4
                            },
                            tooltip: false
                        }
                );

                var doughnutData = {
                    labels: ["App", "Software", "Laptop"],
                    datasets: [{
                            data: [300, 50, 100],
                            backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
                        }]
                };


                var doughnutOptions = {
                    responsive: false,
                    legend: {
                        display: false
                    }
                };


                if (document.getElementById("doughnutChart") != null) {
                    var ctx4 = document.getElementById("doughnutChart").getContext("2d");
                    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options: doughnutOptions});

                    var doughnutData = {
                        labels: ["App", "Software", "Laptop"],
                        datasets: [{
                                data: [70, 27, 85],
                                backgroundColor: ["#a3e1d4", "#dedede", "#9CC3DA"]
                            }]
                    };
                }


                var doughnutOptions = {
                    responsive: false,
                    legend: {
                        display: false
                    }
                };


                if (document.getElementById("doughnutChart2") != null) {
                    var ctx4 = document.getElementById("doughnutChart2").getContext("2d");
                    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options: doughnutOptions});
                }

            });
        </script>
    </body>
</html>
<?php

function mainBlock($that, $content) {
    echo '<div class = "container" id = "page">';
    if (isset($that->breadcrumbs)):
        $that->widget('zii.widgets.CBreadcrumbs', array(
            'links' => $that->breadcrumbs,
        ));
    endif;
    echo $content;
    echo '<div class="clear"></div>';
    echo '</div>';
}
