<?php
$progression = "tuConjunto/";
?>
<!DOCTYPE html>
<!--html>
    <head>
        <title> TU CONJUNTO </title>
    </head>
    <body>
        </br>
        <iframe style= "box-shadow: 10px 10px 5px #888888; display: block; margin-left: auto; margin-right: auto;" width="660" height="415" src="https://www.youtube.com/embed/p0YbuWi-YTU" frameborder="0" allowfullscreen></iframe> 
        </br>
        </br>
        <img style= "box-shadow: 10px 10px 5px #888888; display: block; margin-left: auto; margin-right: auto;" src= "http://tuconjunto.com.co/tu-conjunto-en-contruccion.png"></img>
    </body>
</html-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>TU CONJUNTO</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo $progression ?>css/bootstrap.min.css" rel="stylesheet">

        <!-- Animation CSS -->
        <link href="<?php echo $progression ?>css/animate.css" rel="stylesheet">
        <link href="<?php echo $progression ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo $progression ?>css/style.css" rel="stylesheet">
        <link href="<?php echo $progression ?>css/custom.css" rel="stylesheet">
    </head>
    <body id="page-top" class="landing-page">
        <div class="navbar-wrapper">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header page-scroll">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo $progression ?>index.php">Ingresar</a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a class="page-scroll" href="#page-top">Inicio</a></li>
                            <li><a class="page-scroll" href="#features">Características</a></li>
                            <!--<li><a class="page-scroll" href="#testimonials">Testimonios</a></li>
                            <li><a class="page-scroll" href="#pricing">Precios</a></li>-->
                            <li><a class="page-scroll" href="#contact">Contáctenos</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <?php
        $viewMoreLink = '<p><a target=\'_blank\' class="btn btn-lg btn-primary" href="https://www.youtube.com/watch?v=p0YbuWi-YTU" role="button">Ver Más</a></p>';
        ?>

        <div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#inSlider" data-slide-to="0" class="active"></li>
                <li data-target="#inSlider" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <div class="container">
                        <div class="carousel-caption blank">
                            <h1>Bienvenido a<br>
                                Tu Conjunto</h1>
                            <p>Información, participación y decisión.</p>
                            <?php echo $viewMoreLink; ?>
                        </div>
                    </div>
                    <!-- Set background for slide in css -->
                    <div class="header-back two"></div>
                </div>
                <div class="item">
                    <div class="container">
                        <div class="carousel-caption">
                            <br><br>
                            <h1>Bienvenido a<br>
                                Tu Conjunto</h1>
                            <p>Esta es la clave para la<br>
                                gestión del tiempo.</p>
                            <?php echo $viewMoreLink; ?>
                        </div>
                        <!--div class="carousel-image wow zoomIn">
                            <img src="img/landing/laptop.png" alt="laptop"/>
                        </div-->
                    </div>
                    <!-- Set background for slide in css -->
                    <div class="header-back one"></div>
                </div>
            </div>
            <a class="left carousel-control" href="#inSlider" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#inSlider" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <section id="features" class="container features">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>Características</h1>
                    <div class="ibox float-e-margins">
                        <div class="ibox-content text-center">
                            <figure>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="http://www.youtube.com/embed/p0YbuWi-YTU?rel=0&autoplay=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                                    <!--autoplay=0 => No se reproduce automaticamente.-->
                                    <!--autoplay=1 => Sí se reproduce automaticamente.-->
                                </div>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 text-center wow fadeInLeft">
                    <div>
                        <i class="fa fa-users features-icon"></i>
                        <h2 class="titulo1">Módulos de administración</h2>
                        <ul class="menu1">
                            Noticias y actividades.
                            <br>Consulta y reserva de áreas sociales.
                            <br>Documentos (contratos y actas).
                            <br>Control de visitantes.
                        </ul>
                    </div>
                    <div class="m-t-lg">
                    </div>
                </div>
                <div class="col-md-6 text-center  wow zoomIn">
                    <i class="fa fa-comment features-icon"></i>
                    <h2 class="titulo2">Módulo de comunicación</h2>
                    <ul class="menu2">
                        Chat.
                        <br>Contacto con el administrador 24/7.
                        <br>Publicidad (oferta para residentes).
                    </ul>
                </div>
                <div class="col-md-3 text-center wow fadeInRight">
                    <div class="gly">
                        <i class="fa fa-briefcase features-icon"></i>
                        <h2>Módulo de participación y decisión</h2>
                        <ul>
                            Asamblea virtual.
                            <br>Encuestas.
                            <br>Contratación.
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="features" style="display: none;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="navy-line" display="none"></div>
                        <h1>Even more great feautres</h1>
                        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
                    </div>
                </div>
                <div class="row features-block">
                    <div class="col-lg-3 features-text wow fadeInLeft">
                        <small>INSPINIA</small>
                        <h2>Perfectly designed </h2>
                        <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with latest jQuery plugins.</p>
                        <a href="" class="btn btn-primary">Learn more</a>
                    </div>
                    <div class="col-lg-6 text-right m-t-n-lg wow zoomIn">
                        <!--img src="img/landing/iphone.jpg" class="img-responsive" alt="dashboard"-->
                    </div>
                    <div class="col-lg-3 features-text text-right wow fadeInRight">
                        <small>INSPINIA</small>
                        <h2>Perfectly designed </h2>
                        <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with latest jQuery plugins.</p>
                        <a href="" class="btn btn-primary">Learn more</a>
                    </div>
                </div>
            </div>

        </section>

        <section class="timeline gray-section" style="display: none;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="navy-line"></div>
                        <h1>Our workflow</h1>
                        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
                    </div>
                </div>
                <div class="row features-block">

                    <div class="col-lg-12">
                        <div id="vertical-timeline" class="vertical-container light-timeline center-orientation">
                            <div class="vertical-timeline-block">
                                <div class="vertical-timeline-icon navy-bg">
                                    <i class="fa fa-briefcase"></i>
                                </div>

                                <div class="vertical-timeline-content">
                                    <h2>Meeting</h2>
                                    <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the sale.
                                    </p>
                                    <a href="#" class="btn btn-xs btn-primary"> More info</a>
                                    <span class="vertical-date"> Today <br/> <small>Dec 24</small> </span>
                                </div>
                            </div>

                            <div class="vertical-timeline-block">
                                <div class="vertical-timeline-icon navy-bg">
                                    <i class="fa fa-file-text"></i>
                                </div>

                                <div class="vertical-timeline-content">
                                    <h2>Decision</h2>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                                    <a href="#" class="btn btn-xs btn-primary"> More info</a>
                                    <span class="vertical-date"> Tomorrow <br/> <small>Dec 26</small> </span>
                                </div>
                            </div>

                            <div class="vertical-timeline-block">
                                <div class="vertical-timeline-icon navy-bg">
                                    <i class="fa fa-cogs"></i>
                                </div>

                                <div class="vertical-timeline-content">
                                    <h2>Implementation</h2>
                                    <p>Go to shop and find some products. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's. </p>
                                    <a href="#" class="btn btn-xs btn-primary"> More info</a>
                                    <span class="vertical-date"> Monday <br/> <small>Jan 02</small> </span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </section>

        <section id="testimonials" class="navy-section testimonials" style="margin-top: 0">

            <div class="container" style="display: none;">
                <div class="row">
                    <div class="col-lg-12 text-center wow zoomIn">
                        <i class="fa fa-comment big-icon"></i>
                        <h1>
                            What our users say
                        </h1>
                        <div class="testimonials-text">
                            <i>"Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."</i>
                        </div>
                        <small>
                            <strong>12.02.2014 - Andy Smith</strong>
                        </small>
                    </div>
                </div>
            </div>

        </section>

        <section class="comments gray-section" style="margin-top: 0">
            <div class="container" style="display: none;">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="navy-line"></div>
                        <h1>What our partners say</h1>
                        <p>Donec sed odio dui. Etiam porta sem malesuada. </p>
                    </div>
                </div>
                <div class="row features-block">
                    <div class="col-lg-4">
                        <div class="bubble">
                            "Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."
                        </div>
                        <div class="comments-avatar">
                            <a href="" class="pull-left">
                                <img alt="image" src="img/landing/avatar3.jpg">
                            </a>
                            <div class="media-body">
                                <div class="commens-name">
                                    Andrew Williams
                                </div>
                                <small class="text-muted">Company X from California</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="bubble">
                            "Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."
                        </div>
                        <div class="comments-avatar">
                            <a href="" class="pull-left">
                                <img alt="image" src="img/landing/avatar1.jpg">
                            </a>
                            <div class="media-body">
                                <div class="commens-name">
                                    Andrew Williams
                                </div>
                                <small class="text-muted">Company X from California</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="bubble">
                            "Uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like)."
                        </div>
                        <div class="comments-avatar">
                            <a href="" class="pull-left">
                                <img alt="image" src="img/landing/avatar2.jpg">
                            </a>
                            <div class="media-body">
                                <div class="commens-name">
                                    Andrew Williams
                                </div>
                                <small class="text-muted">Company X from California</small>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </section>

        <section class="features">
            <div class="container" style="display: none;">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="navy-line"></div>
                        <h1>More and more extra great feautres</h1>
                        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-lg-offset-1 features-text">
                        <small>INSPINIA</small>
                        <h2>Perfectly designed </h2>
                        <i class="fa fa-bar-chart big-icon pull-right"></i>
                        <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
                    </div>
                    <div class="col-lg-5 features-text">
                        <small>INSPINIA</small>
                        <h2>Perfectly designed </h2>
                        <i class="fa fa-bolt big-icon pull-right"></i>
                        <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-lg-offset-1 features-text">
                        <small>INSPINIA</small>
                        <h2>Perfectly designed </h2>
                        <i class="fa fa-clock-o big-icon pull-right"></i>
                        <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
                    </div>
                    <div class="col-lg-5 features-text">
                        <small>INSPINIA</small>
                        <h2>Perfectly designed </h2>
                        <i class="fa fa-users big-icon pull-right"></i>
                        <p>INSPINIA Admin Theme is a premium admin dashboard template with flat design concept. It is fully responsive admin dashboard template built with Bootstrap 3+ Framework, HTML5 and CSS3, Media query. It has a huge collection of reusable UI components and integrated with.</p>
                    </div>
                </div>
            </div>

        </section>
        <section id="pricing" class="pricing">
            <div class="container" style="display: none;">
                <div class="row m-b-lg">
                    <div class="col-lg-12 text-center">
                        <div class="navy-line"></div>
                        <h1>App Pricing</h1>
                        <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 wow zoomIn">
                        <ul class="pricing-plan list-unstyled">
                            <li class="pricing-title">
                                Basic
                            </li>
                            <li class="pricing-desc">
                                Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                            </li>
                            <li class="pricing-price">
                                <span>$16</span> / month
                            </li>
                            <li>
                                Dashboards
                            </li>
                            <li>
                                Projects view
                            </li>
                            <li>
                                Contacts
                            </li>
                            <li>
                                Calendar
                            </li>
                            <li>
                                AngularJs
                            </li>
                            <li>
                                <a class="btn btn-primary btn-xs" href="#">Signup</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-4 wow zoomIn">
                        <ul class="pricing-plan list-unstyled selected">
                            <li class="pricing-title">
                                Standard
                            </li>
                            <li class="pricing-desc">
                                Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                            </li>
                            <li class="pricing-price">
                                <span>$22</span> / month
                            </li>
                            <li>
                                Dashboards
                            </li>
                            <li>
                                Projects view
                            </li>
                            <li>
                                Contacts
                            </li>
                            <li>
                                Calendar
                            </li>
                            <li>
                                AngularJs
                            </li>
                            <li>
                                <strong>Support platform</strong>
                            </li>
                            <li class="plan-action">
                                <a class="btn btn-primary btn-xs" href="#">Signup</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-4 wow zoomIn">
                        <ul class="pricing-plan list-unstyled">
                            <li class="pricing-title">
                                Premium
                            </li>
                            <li class="pricing-desc">
                                Lorem ipsum dolor sit amet, illum fastidii dissentias quo ne. Sea ne sint animal iisque, nam an soluta sensibus.
                            </li>
                            <li class="pricing-price">
                                <span>$160</span> / month
                            </li>
                            <li>
                                Dashboards
                            </li>
                            <li>
                                Projects view
                            </li>
                            <li>
                                Contacts
                            </li>
                            <li>
                                Calendar
                            </li>
                            <li>
                                AngularJs
                            </li>
                            <li>
                                <a class="btn btn-primary btn-xs" href="#">Signup</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row m-t-lg">
                    <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg">
                        <p>*Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. <span class="navy">Various versions</span>  have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                    </div>
                </div>
            </div>

        </section>

        <section id="contact" class="gray-section contact">
            <div class="container">
                <div class="row m-b-lg">
                    <div class="col-lg-12 text-center">
                        <div class="navy-line"></div>
                        <h1>Contáctenos</h1>
                        <p>Acá encontrarás información de contacto para negocios con TuConjunto.com.co.</p>
                    </div>
                </div>
                <div class="row m-b-lg">
                    <div class="col-lg-3 col-lg-offset-3">
                        <address>
                            <strong><span class="navy">TuConjunto, SAS.</span></strong><br/>
                            Bogotá D.C, Colombia<br/>
                            <abbr title="Phone">Teléfono:</abbr> (+57) 312 481 7790
                        </address>
                    </div>
                    <div class="col-lg-4">
                        <p class="text-color">
                            “La riqueza perdida puede ser recuperada con trabajo duro. El conocimiento perdido puede ser recuperado con dedicación al estudio. Pero el tiempo 			perdido se pierde para siempre.”
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <a href="mailto:negocios@tuconjunto.com.co" class="btn btn-primary">Envíanos un correo (negocios@tuconjunto.com.co)</a>
                       <!-- <p class="m-t-sm">
                            Or follow us on social platform
                        </p>
                        <ul class="list-inline social-icon">
                            <li><a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                        </ul>-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                        <p><strong>&copy; 2016-2017 TuConjunto</strong><br/><!-- consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.--></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mainly scripts -->
        <script src="<?php echo $progression ?>js/jquery-2.1.1.js"></script>
        <script src="<?php echo $progression ?>js/bootstrap.min.js"></script>
        <script src="<?php echo $progression ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo $progression ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="<?php echo $progression ?>js/inspinia.js"></script>
        <script src="<?php echo $progression ?>js/plugins/pace/pace.min.js"></script>
        <script src="<?php echo $progression ?>js/plugins/wow/wow.min.js"></script>


        <script>

            $(document).ready(function () {

                $('body').scrollspy({
                    target: '.navbar-fixed-top',
                    offset: 80
                });

                // Page scrolling feature
                $('a.page-scroll').bind('click', function (event) {
                    var link = $(this);
                    $('html, body').stop().animate({
                        scrollTop: $(link.attr('href')).offset().top - 50
                    }, 500);
                    event.preventDefault();
                    $("#navbar").collapse('hide');
                });
            });

            var cbpAnimatedHeader = (function () {
                var docElem = document.documentElement,
                        header = document.querySelector('.navbar-default'),
                        didScroll = false,
                        changeHeaderOn = 200;
                function init() {
                    window.addEventListener('scroll', function (event) {
                        if (!didScroll) {
                            didScroll = true;
                            setTimeout(scrollPage, 250);
                        }
                    }, false);
                }
                function scrollPage() {
                    var sy = scrollY();
                    if (sy >= changeHeaderOn) {
                        $(header).addClass('navbar-scroll')
                    } else {
                        $(header).removeClass('navbar-scroll')
                    }
                    didScroll = false;
                }
                function scrollY() {
                    return window.pageYOffset || docElem.scrollTop;
                }
                init();

            })();

            // Activate WOW.js plugin for animation on scrol
            new WOW().init();

        </script>

    </body>
</html>
