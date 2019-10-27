<?php
$this->layout = 'ajax';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <title> Welcome to CheckResults.net</title>
    <?= $this->Plugins->css('bootstrap/css/bootstrap.min.css'); ?>
    <link href="frontEnd/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="frontEnd/assets/css/style.css" rel="stylesheet">
    <link href="frontEnd/assets/css/style-responsive.css" rel="stylesheet">

    <script src="frontEnd/assets/plugins/jquery/jquery-1.9.1.min.js"></script>
    <script src="frontEnd/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<header class="navbar-static-top">
    <nav class="navbar navbar-default m-b-0 ">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">CheckResults.net</a>
            </div>

        </div>
    </nav>
    <nav class="navbar navbar-inverse m-b-0">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

        </div>
    </nav>
</header>

<!-- body content -->
<div class=" content has-bg ">
    <div class="content-cover">
        <img src="img/hero-image.jpg">
    </div>
</div>

<!--services -->
<div class="content " id="services">
    <div class="container">
        <h2 class="content-title"> Features </h2>

        <div class="row">
            <div class="work col-sm-4 m-b-30">
<!--                <img src="assets/img/Website-Hosting.jpg">
-->                <div class="work-desc">
                    <h4> Student Information </h4>
                    <div class="work-description">
                        <p>

                        </p>
                    </div>
                </div>
            </div>

            <div class="work col-sm-4 m-b-30">
<!--                <img src="assets/img/website-design.jpg">
-->                <div class="work-desc">
                    <h4> Student Result Entry </h4>
                    <div class="work-description">
                        <p>We are committed to helping businesses succeed through exceptional digital services, focused on effective digital marketing campaigns that inspire customers, extend capabilities, and advance business...</p>
                    </div>
                </div>
            </div>

            <div class="work col-sm-4 m-b-30">
<!--                <img src="assets/img/computer-sales.jpg">
-->                <div class="work-desc">
                    <h4> Automatic Result Processing </h4>
                    <div class="work-description">
                        <p> We sale a wide range of computers and accessories. Ranging  from laptops to Desktops and other computer parts ...</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="work col-sm-4 m-b-30">
                <div class="work-desc">
                    <h4> Result Checking </h4>
                    <div class="work-description">
                        <p> Our professional Ict consultants offer </p>
                    </div>
                </div>
            </div>

            <div class="work col-sm-4 m-b-30">
                <div class="work-desc">
                    <h4> Transcript Generation </h4>
                    <div class="work-description">
                        <p> We also offer book and media publishing services </p>
                    </div>
                </div>
            </div>

            <div class="work col-sm-4 m-b-30">
                <div class="work-desc">
                    <h4> Graphic Design </h4>
                    <div class="work-description">
                        <p> Our in-house graphic designers, are always ready to take care of your graphic design projects at a reasonable amount ... </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- end of services ---->
<!-- footer link -->
<div class="footer">
    <div class="container">

        <div class="row">
            <div class="col-sm-3">
                <h4 class="footer-title"> Website </h4>
                <ul class="">
                    <li><a>Website and Web-App design </a></li>
                    <li><a>Website hosting</a></li>
                    <li><a>Website design</a></li>

                </ul>
            </div>
            <div class="col-sm-3">
                <h4 class="footer-title">  consultancy </h4>
                <ul class="">
                    <li><a>Ict consultancy</a></li>
                    <li><a>Entrepreneurship consultancy</a></li>
                    <li><a>Entrepreneurship training</a></li>


                </ul>
            </div>
            <div class="col-sm-3">
                <h4 class="footer-title"> Sales </h4>
                <ul class="">
                    <li><a> Computer Sales</a></li>
                    <li><a>Computer Repair</a></li>

                </ul>

            </div>
            <div class="col-sm-3">
                <address>
                    <strong> The Griffon Technology </strong> <br>
                    Abakaliki, Ebonyi state . <br>
                    P : (+234) 806 886 5957
                </address>
            </div>
        </div>
    </div>
</div>
<!-- end of footer link -->
<footer class="footer-copyright">
    <div class="container">
        <span class="text-center">Copyright &copy; TheGriffonTechnology. All rights reserved. </span>
        <ul class="social-media-list">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
        </ul>
    </div>
</footer>
</body>
</html>