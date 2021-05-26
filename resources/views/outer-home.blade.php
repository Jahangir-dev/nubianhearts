<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= getStoreSettings('name') ?></title>

        <?=
        __yesset([
            'dist/Assets/Bootstrap-4.5.0/css/bootstrap.min.css',
            'dist/Assets/fontawesome-5.13.0/css/all.min.css',
            'dist/Assets/OwlCarousel2-2.3.4/assets/owl.carousel.min.css',
            'dist/Assets/OwlCarousel2-2.3.4/assets/owl.theme.default.min.css',
            'dist/Assets/CSS/style.css'
                ], true)
        ?>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

        <link rel="shortcut icon" href="<?= __yesset('favicon.ico') ?>" type="image/x-icon">
        <link rel="icon" href="<?= __yesset('favicon.ico') ?>" type="image/x-icon">

    </head>

    <body>

        <div class="top-banner">
            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <a class="navbar-brand" href="#">
                                    <img src="<?= __yesset('dist/Assets/images/logo_white.png') ?> alt="">
                                </a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item login-btn">
                                            <a class="nav-link" href="#">Login</a>
                                        </li>
                                        <li class="nav-item login-btn">
                                            <a class="nav-link" href="#">Register</a>
                                        </li>
                                    </ul>

                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>


            <section class="slide-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"><span>01</span></li>
                                    <li data-target="#myCarousel" data-slide-to="1"><span>02</span></li>
                                    <li data-target="#myCarousel" data-slide-to="2"><span>03</span></li>

                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="fill">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-1 col-sm-2"></div>
                                                    <div class="col-lg-2  col-sm-10">
                                                        <img src="<?= __yesset('dist/Assets/images/Group-1.png') ?>" alt="" class="side-img">
                                                    </div>
                                                    <div class="col-lg-5 ">
                                                        <div class="slider-text">
                                                            <h5>YOUR <span>BETTER HALF</span> &nbsp;IS HERE!</h5>
                                                            <p>JOIN US AND CONNECT WITH BEAUTIFUL BLACK AND AFRICAN SINGLES  </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <img src="<?= __yesset('dist/Assets/images/slider-img.png') ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="fill">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-1 col-sm-2"></div>
                                                    <div class="col-lg-2  col-sm-10">
                                                        <img src="" alt="" class="side-img">
                                                        <img src="<?= __yesset('dist/Assets/images/Group-1.png') ?>" alt="" class="side-img">
                                                    </div>
                                                    <div class="col-lg-5 ">
                                                        <div class="slider-text">
                                                            <h5>MEET BIG <span>AND</span> &nbsp;BEAUTIFUL LOVE <span> &nbsp;&nbsp;HERE</span> !</h5>
                                                            <p>Lorem Ipsum is simply dummy text of the printing &nbsp;&nbsp;and typesetting industry. Lorem Ipsum has been &nbsp;&nbsp;&nbsp;&nbsp;the industry's standard dummy text ever since  </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <img src="<?= __yesset('dist/Assets/images/slider-img.png') ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="fill">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-lg-1 col-sm-2"></div>
                                                    <div class="col-lg-2  col-sm-10">
                                                        <img src="<?= __yesset('dist/Assets/images/Group-1.png') ?>" alt="" class="side-img">
                                                    </div>
                                                    <div class="col-lg-5 ">
                                                        <div class="slider-text">
                                                            <h5>MEET BIG <span>AND</span> &nbsp;BEAUTIFUL LOVE <span> &nbsp;&nbsp;HERE</span> !</h5>
                                                            <p>Lorem Ipsum is simply dummy text of the printing &nbsp;&nbsp;and typesetting industry. Lorem Ipsum has been &nbsp;&nbsp;&nbsp;&nbsp;the industry's standard dummy text ever since  </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <img src="<?= __yesset('dist/Assets/images/slider-img.png') ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        <div class="step">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="heading">Steps To Find Your Soul Mate</h1>

                        <p>Are you looking for your soulmate? <br>Well, <span>Nubian Hearts</span> is a <span>Dating</span> platform that will help you out for this. <br>
                            All you need to do is to follow these steps, and soon you will be dating the love of your life.</p>

                        <section class="timeline">
                            <div class="timeline__block">
                                <div class="timeline__midpoint"></div>
                                <div class="timeline__content timeline__content--right">
                                    <h3 class="timeline__year">Create Profile</h3>
                                    <div class="timeline__text--right">
                                        <div class="row">
                                            <div class="col-md-8 col">
                                                <p>To get started at Nubian Hearts, you need to create your profile by providing all the necessary details for your loved one to find you out.</p>
                                            </div>
                                            <div class="col-md-4 col">
                                                <img src="<?= __yesset('dist/Assets/images/timeline/01.png') ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="timeline__block">
                                <div class="timeline__midpoint"></div>
                                <div class="timeline__content timeline__content--left">
                                    <h3 class="timeline__year">Find Match</h3>
                                    <div class="timeline__text--left">
                                        <div class="row">
                                            <div class="col-md-4 col">
                                                <img src="<?= __yesset('dist/Assets/images/timeline/02.png') ?>" alt="" style="height: 65%; margin-top: 20px; padding-right: 10px;">
                                            </div>
                                            <div class="col-md-8 col">
                                                <p>Once you are done with creating your profile for dating, then the next step is to start looking for your soulmate over this Dating Platform.</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="timeline__block">
                                <div class="timeline__midpoint"></div>
                                <div class="timeline__content timeline__content--right">
                                    <h3 class="timeline__year">Start Dating</h3>
                                    <div class="timeline__text--right" style="padding-bottom: 0px;">
                                        <div class="row">
                                            <div class="col-md-4 col">
                                                <img src="<?= __yesset('dist/Assets/images/timeline/03.png') ?>" alt="" style="height: 65%; margin-top: 20px; padding-right: 10px;">
                                            </div>
                                            <div class="col-md-8 col">
                                                <p>Now when you have found your soulmate then you can start a new journey of your life with your life partner. So enjoy your love life.</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section> 

                    </div>
                </div>
            </div>
        </div>


        <div class="fun-facts">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="heading">ANIMATED FUN FACTS</h1>

                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="single-fact">
                                    <img src="<?= __yesset('dist/Assets/images/01.png') ?>" alt="">
                                    <div class="number">5</div>
                                    <div class="title">TOTAL MEMBERS</div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="single-fact">
                                    <img src="<?= __yesset('dist/Assets/images/02.png') ?>" alt="">
                                    <div class="number">3</div>
                                    <div class="title">ONLINE MEMBERS</div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="single-fact">
                                    <img src="<?= __yesset('dist/Assets/images/03.png') ?>" alt="">
                                    <div class="number">3</div>
                                    <div class="title">MEN ONLINE</div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="single-fact">
                                    <img src="<?= __yesset('dist/Assets/images/04.png') ?>" alt="">
                                    <div class="number">2</div>
                                    <div class="title">WOMEN ONLINE</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>


        <div class="testimonials">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="heading">LAST ADDED PROFILES</h1>
                        <div class="owl-carousel">
                            <div> 
                                <div class="content">
                                    <img src="<?= __yesset('dist/Assets/images/avatar.jpg') ?>" alt="">
                                    <div class="name">
                                        username
                                    </div>
                                    <div class="title">
                                        Psakistan, Sadiqabad
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="top">
                <div class="circle"></div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="sub-footer first">
                            <div class="title">
                                <span>Nubian Hearts</span><br>
                                Headquarters
                            </div>
                            <div class="menu">
                                <a href="#">Terms of Use</a>
                                <a href="#">About Us</a>
                                <a href="#">Contact</a>
                                <a href="#">Privacy Policy</a>
                                <a href="#">Cookie Policy</a>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="sub-footer second">
                            <div class="title">
                                Follow us on
                            </div>
                            <div class="social-icons">
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x icon-background1"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x"></i>
                                    </span>
                                </a>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x icon-background1"></i>
                                        <i class="fab fa-instagram fa-stack-1x"></i>
                                    </span>
                                </a>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x icon-background1"></i>
                                        <i class="fab fa-linkedin-in fa-stack-1x"></i>
                                    </span>
                                </a>
                                <a href="#">
                                    <span class="fa-stack fa-lg">
                                        <i class="fa fa-circle fa-stack-2x icon-background1"></i>
                                        <i class="fab fa-twitter fa-stack-1x"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4  col-md-12">
                        <div class="sub-footer last">
                            <img src="<?= __yesset('dist/Assets/images/logo_white.png') ?>" class="footer-logo" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4">
                        <p>Copyright © 2021, NubianHearts</p>
                    </div>
                </div>
            </div>
        </div>
        <?=
        __yesset([
            'dist/Assets/JS/jquery-3.5.1.min.js',
            'dist/Assets/JS/popper.min.js',
            'dist/Assets/Bootstrap-4.5.0/js/bootstrap.min.js',
            'dist/Assets/OwlCarousel2-2.3.4/owl.carousel.min.js',
            'dist/Assets/JS/custom.js'
                ], true)
        ?>
    </body>

</html>
