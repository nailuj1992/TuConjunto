<?php

$baseurl = 'http://localhost/'
//'http://tuconjunto.com.co/'
;

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'aliases' => array(
        'booster' => realpath(__DIR__ . '/../extensions/yiibooster'),
        'ext' => realpath(__DIR__ . '/../extensions'),
    ),
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Tu Conjunto',
    'sourceLanguage' => 'es',
    'language' => 'es',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.yiibooster.widgets',
        'application.extensions.phpmailer.*',
        'application.modules.cruge.components.*',
        'application.modules.cruge.extensions.crugemailer.*',
        'application.models.persistence.*',
        'application.controllers.*',
        'application.models.logic.*',
        'application.extensions.phpexcel.*',
        'application.extensions.EFullCalendar.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'tuconjunto',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        'cruge' => array(
            'tableprefix' => 'cruge_',
            // para que utilice a protected.modules.cruge.models.auth.CrugeAuthDefault.php
            //
            // en vez de 'default' pon 'authdemo' para que utilice el demo de autenticacion alterna
            // para saber mas lee documentacion de la clase modules/cruge/models/auth/AlternateAuthDemo.php
            //
            'availableAuthMethods' => array('default'),
            'availableAuthModes' => array('username', 'email'),
            'baseUrl' => $baseurl,
            // NO OLVIDES PONER EN FALSE TRAS INSTALAR
            'debug' => false,
            'rbacSetupEnabled' => true,
            'allowUserAlways' => true,
            // MIENTRAS INSTALAS..PONLO EN: false
            // lee mas abajo respecto a 'Encriptando las claves'
            //
            'useEncryptedPassword' => true,
            // Algoritmo de la funci�n hash que deseas usar
            // Los valores admitidos est�n en: http://www.php.net/manual/en/function.hash-algos.php
            'hash' => 'sha1', //'md5',
            // a donde enviar al usuario tras iniciar sesion, cerrar sesion o al expirar la sesion.
            //
            // esto va a forzar a Yii::app()->user->returnUrl cambiando el comportamiento estandar de Yii
            // en los casos en que se usa CAccessControl como controlador
            //
            // ejemplo:
            // 'afterLoginUrl'=>array('/site/welcome'),  ( !!! no olvidar el slash inicial / )
            // 'afterLogoutUrl'=>array('/site/page','view'=>'about'),
            //
            'afterLoginUrl' => null,
            'afterLogoutUrl' => null,
            'afterSessionExpiredUrl' => null,
            // manejo del layout con cruge.
            //
            'loginLayout' => '//layouts/column2',
            'registrationLayout' => '//layouts/column2',
            'activateAccountLayout' => '//layouts/column2',
            'editProfileLayout' => '//layouts/column2',
            // en la siguiente puedes especificar el valor "ui" o "column2" para que use el layout
            // de fabrica, es basico pero funcional.  si pones otro valor considera que cruge
            // requerir� de un portlet para desplegar un menu con las opciones de administrador.
            //
            'generalUserManagementLayout' => 'ui',
        ),
    ),
    // application components
    'components' => array(
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder
                /* 'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                  'mode'              => '', //  This parameter specifies the mode of the new document.
                  'format'            => 'A4', // format A4, A5, ...
                  'default_font_size' => 0, // Sets the default document font size in points (pt)
                  'default_font'      => '', // Sets the default font-family for the new document.
                  'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                  'mgr'               => 15, // margin_right
                  'mgt'               => 16, // margin_top
                  'mgb'               => 16, // margin_bottom
                  'mgh'               => 9, // margin_header
                  'mgf'               => 9, // margin_footer
                  'orientation'       => 'P', // landscape or portrait orientation
                  ) */
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
                /* 'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                  'orientation' => 'P', // landscape or portrait orientation
                  'format'      => 'A4', // format A4, A5, ...
                  'language'    => 'en', // language: fr, en, it ...
                  'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                  'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                  'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                  ) */
                )
            ),
        ),
        //...
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'application.modules.cruge.components.CrugeWebUser',
            'loginUrl' => array('/cruge/ui/login'),
        ),
        'authManager' => array(
            'class' => 'application.modules.cruge.components.CrugeAuthManager',
        ),
        'format' => array(
            'datetimeFormat' => "d M, Y h:m:s a",
        ),
        'crugemailer' => array(
            'class' => 'application.modules.cruge.components.CrugeMailer',
            'mailfrom' => 'directorcomercial@tsanjuan.com',
            'subjectprefix' => 'Tu Conjunto - ',
            'debug' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                // Link: http://www.yiiframework.com/wiki/175/how-to-create-a-rest-api/
                'post/<id:\d+>/<title:.*?>' => 'post/view',
                'posts/<tag:.*?>' => 'post/index',
                // REST patterns
                array('api/list', 'pattern' => 'api/<model:\w+>', 'verb' => 'GET'),
                array('api/view', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'GET'),
                array('api/update', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'PUT'),
                array('api/delete', 'pattern' => 'api/<model:\w+>/<id:\d+>', 'verb' => 'DELETE'),
                array('api/create', 'pattern' => 'api/<model:\w+>', 'verb' => 'POST'),
                // Other controllers
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => /* YII_DEBUG ? null : */'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
        'bootstrap' => array(
            'class' => 'booster.components.Booster', //'class'=>'bootstrap.components.Bootstrap',
        ),
        'widgetFactory' => array(
            'widgets' => array(
                'CLinkPager' => array(
                    'htmlOptions' => array(
                        'class' => 'pagination'
                    ),
                    'header' => false,
                    'maxButtonCount' => 5,
                    'cssFile' => false,
                ),
                'CGridView' => array(
                    'htmlOptions' => array(
                        'class' => 'table-responsive font_texto'
                    ),
                    'pagerCssClass' => 'dataTables_paginate paging_bootstrap',
                    'itemsCssClass' => 'table table-striped table-hover',
                    'cssFile' => false,
                    'summaryCssClass' => 'dataTables_info',
                    'summaryText' => 'Mostrando {start} - {end} entre {count} resultados',
                    'template' => '{items}'
                    . '<div class="row" style="margin-right:0px;margin-left:0px">'
                    . '<div class="col-md-5 col-sm-12">{summary}</div>'
                    . '<div class="col-md-7 col-sm-12">{pager}</div>'
                    . '</div><br>',
                ),
            ),
        ),
        'sendgrid' => array(
            'class' => 'ext.yii-sendgrid.YiiSendGrid', //path to YiiSendGrid class  
            'username' => 'tuconjunto', //replace with your actual username  
            'password' => ')g,3wF)b}c7V', //replace with your actual password  
        //alias to the layouts path. Optional  
        //'viewPath' => 'application.views.mail',  
        //wheter to log the emails sent. Optional  
        //'enableLog' => YII_DEBUG, 
        //if enabled, it won't actually send the emails, only log. Optional  
        //'dryRun' => false, 
        //ignore verification of SSL certificate  
        //'disableSslVerification'=>true,
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);
