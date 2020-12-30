<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // header("location: login.php");
    // exit;
}
// Include config file
require_once "config.php";


?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>dashboard</title>

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="profile" href="#">

    <!--Google Font-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"></script>

    <!-- Mobile specific meta -->
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone-no">
    <style>
        body {
            background: url('images/uploads/ft-bg.jpg') no-repeat;
            background-color: black;
        }

        #navbar {
            width: 100%;
            margin-top: 30px;
            margin-left: 30px;
            display: block;
            transition: top 0.3s;
        }

        #navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        footer {
            position: static;
            bottom: 0;
            width: 100%;
            color: lightblue;
            text-align: center;
            margin-top: 50px;
        }


        @media screen and (max-width: 600px) {
            #navbar {
                width: 30%;
            }

            .container {
                text-align: left;
            }

            .signup-content {
                padding: left auto;
            }
        }

        @media screen and (max-width: 1000px) {
            .container {
                text-align: left;
            }
        }

        /* #navbar .dropdown {
            display: none;
        } */

        footer {
            background: url('images/uploads/ft-bg.jpg') no-repeat;
            background-position: center;

        }

        section {
            background-color: black;
        }

        .carouselOfImages {
            max-width: 960px;
            margin: auto;
        }

        .carouselImage {
            width: 200px;
            height: 200px;
            margin-top: 75px;
            margin-bottom: 135px;
            border-radius: 5px;
            counter-increment: carousel-cell;
            transition: transform 0.5s;
            transform: scale(1);
        }

        .carouselImage img {
            height: 235px;
        }

        .carouselImage.is-selected {
            z-index: 10;
            transform: scale(1.5);
        }

        .carouselImage.nextToSelected {
            transform: scale(1.25);
            z-index: 5;
        }

        /*! Flickity v2.0.5
https://flickity.metafizzy.co
---------------------------------------------- */

        .flickity-enabled {
            position: relative;
        }

        .flickity-enabled:focus {
            outline: none;
        }

        .flickity-viewport {
            overflow: hidden;
            position: relative;
            height: 100%;
        }

        .flickity-slider {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        /* draggable */

        .flickity-enabled.is-draggable {
            -webkit-tap-highlight-color: transparent;
            tap-highlight-color: transparent;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .flickity-enabled.is-draggable .flickity-viewport {
            cursor: move;
            cursor: -webkit-grab;
            cursor: grab;
        }

        .flickity-enabled.is-draggable .flickity-viewport.is-pointer-down {
            cursor: -webkit-grabbing;
            cursor: grabbing;
        }

        /* ---- previous/next buttons ---- */

        .flickity-prev-next-button {
            position: absolute;
            top: 50%;
            width: 44px;
            height: 44px;
            border: none;
            border-radius: 50%;
            background: white;
            background: hsla(0, 0%, 100%, 0.75);
            cursor: pointer;
            /* vertically center */
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        .flickity-prev-next-button:hover {
            background: white;
        }

        .flickity-prev-next-button:focus {
            outline: none;
            box-shadow: 0 0 0 5px #09F;
        }

        .flickity-prev-next-button:active {
            opacity: 0.6;
        }

        .flickity-prev-next-button.previous {
            left: 10px;
        }

        .flickity-prev-next-button.next {
            right: 10px;
        }

        /* right to left */
        .flickity-rtl .flickity-prev-next-button.previous {
            left: auto;
            right: 10px;
        }

        .flickity-rtl .flickity-prev-next-button.next {
            right: auto;
            left: 10px;
        }

        .flickity-prev-next-button:disabled {
            opacity: 0.3;
            cursor: auto;
        }

        .flickity-prev-next-button svg {
            position: absolute;
            left: 20%;
            top: 20%;
            width: 60%;
            height: 60%;
        }

        .flickity-prev-next-button .arrow {
            fill: #333;
        }

        /* ---- page dots ---- */

        .flickity-page-dots {
            position: absolute;
            width: 100%;
            bottom: -25px;
            padding: 0;
            margin: 0;
            list-style: none;
            text-align: center;
            line-height: 1;
        }

        .flickity-rtl .flickity-page-dots {
            direction: rtl;
        }

        .flickity-page-dots .dot {
            display: inline-block;
            width: 10px;
            height: 10px;
            margin: 0 0px;
            background: #333;
            border-radius: 50%;
            opacity: 0.25;
            cursor: pointer;
        }

        .flickity-page-dots .dot.is-selected {
            opacity: 1;
        }

        /* Centered text */
        .carouselImage:hover .inner1 {
            position: absolute;
            top: 60%;
            left: 40%;
            transform: translate(-50%, -50%);
        }

        .carouselImage:hover .inner2 {
            position: absolute;
            top: 80%;
            left: 40%;
            transform: translate(-50%, -50%);
        }

        .inner1 a:hover,
        .inner2 a:hover {
            width: 75px;
            height: 20px;
            background: red;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            color: white;
        }
    </style>
    <script>
        function passchecker() {
            var str = document.getElementById("spassword").value;
            var regularExpression = /^([0-9]+[a-zA-Z]+|[a-zA-Z]+[0-9]+)[0-9a-zA-Z]*$/;
            if (str.length >= 8) {
                document.getElementById("r1").style = "color : lightgreen";
                document.getElementById("spassword").style.border = "";
                if (regularExpression.test(str)) {
                    document.getElementById("r2").style = "color : lightgreen";
                    if (/[a-z]/.test(str) && /[A-Z]/.test(str)) {
                        document.getElementById("r3").style = "color : lightgreen";
                    } else {
                        document.getElementById("spassword").style.border = "solid red";
                        alert("The password is not valid, please refil the password");
                        document.getElementById("spassword").value = "";
                        changeColor();
                    }
                } else {
                    document.getElementById("spassword").style.border = "solid red";
                    alert("The password is not valid, please refil the password");
                    document.getElementById("spassword").value = "";
                    changeColor();
                }
            } else {
                document.getElementById("spassword").style.border = "solid red";
                alert("The password is not valid, please refil the password");
                document.getElementById("spassword").value = "";
                changeColor();
            }
        }

        function changeColor() {
            var block = document.getElementsByClassName('rules');
            for (var i = 0; i < block.length; i++) {
                block[i].style = "color: red";
            }
        }

        function comparepass() {
            var pass1 = document.getElementById("spassword");
            var pass2 = document.getElementById("repassword");
            if (pass2.value != pass1.value) {
                document.getElementById("repassword").style.border = "solid red";
                alert("The password is not the same, please refil the password");
                document.getElementById("repassword").value = "";
            } else
                document.getElementById("repassword").style.border = "";
        }
        $(document).ready(function() {
            var $imagesCarousel = $('.carouselOfImages').flickity({
                contain: true,
                autoPlay: true,
                wrapAround: true,
                friction: 0.3
            });

            function resizeCells() {
                var flkty = $imagesCarousel.data('flickity');
                var $current = flkty.selectedIndex
                var $length = flkty.cells.length
                if ($length <= '5') {
                    $imagesCarousel.flickity('destroy');
                }
                $('.carouselOfImages .carouselImage').removeClass("nextToSelected");
                $('.carouselOfImages .carouselImage').eq($current - 1).addClass("nextToSelected");
                if ($current + 1 == $length) {
                    var $endCell = "0"
                } else {
                    var $endCell = $current + 1
                }
                $('.carouselOfImages .carouselImage').eq($endCell).addClass("nextToSelected");
            };
        });
    </script>
</head>

<body>

    <!-- BEGIN | Header -->
    <header class="header">
        <nav id="navbar" class="navbar navbar-dark bg-transparent">
            <div class="container-fluid">
                <!-- <div class="navbar-header"> -->
                <a name="top" href="dashboard.php"><img class="logo" src="images/logo1.png" alt="Chunema" width="200" height="90"></a>
                <!-- </div> -->

                <ul class="nav navbar-nav navbar-right" style="margin-right: 30px;">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">
                                <?php echo $_SESSION['username']; ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="profile.php">Profile</a></li>
                                <li><a href="cart.php">Cart</a></li>
                            </ul>
                        </li>
                        <li><a href="logout.php">Log Out</a></li>
                    <?php else : ?>
                        <li><a href="login.php">Sign In</a></li>
                        <li><a href="signup.php">Sign Up</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
    </header>
    <!-- END | Header -->
    <div>
        <section class="items">
            <div class="carouselOfImages">
                <div class="carouselImage" style="background-size:cover;">
                    <img src="images/uploads/slider1.jpg" />
                    <div class="inner1">
                        <a href="single.php"> Read more</a>
                    </div>
                    <div class="inner2">
                        <a href="#"> Book Now!</a>
                    </div>
                </div>
                <div class="carouselImage" style="background-size:cover;">
                    <img src="images/uploads/slider2.jpg" />
                    <div class="inner1">
                        <a href="single.php"> Read more</a>
                    </div>
                    <div class="inner2">
                        <a href="#"> Book Now!</a>
                    </div>
                </div>
                <div class="carouselImage" style="background-size:cover;">
                    <img src="images/uploads/slider3.jpg" />
                    <div class="inner1">
                        <a href="single.php"> Read more</a>
                    </div>
                    <div class="inner2">
                        <a href="#"> Book Now!</a>
                    </div>
                </div>
                <div class="carouselImage" style="background-size:cover;">
                    <img src="images/uploads/slider4.jpg" />
                    <div class="inner1">
                        <a href="single.php"> Read more</a>
                    </div>
                    <div class="inner2">
                        <a href="#"> Book Now!</a>
                    </div>
                </div>
                <div class="carouselImage" style="background-size:cover;">
                    <img src="images/uploads/slider5.jpg" />
                    <div class="inner1">
                        <a href="single.php"> Read more</a>
                    </div>
                    <div class="inner2">
                        <a href="#"> Book Now!</a>
                    </div>
                </div>
                <div class="carouselImage" style="background-size:cover;">
                    <img src="images/uploads/slider6.jpg" />
                    <div class="inner1">
                        <a href="single.php"> Read more</a>
                    </div>
                    <div class="inner2">
                        <a href="#"> Book Now!</a>
                    </div>
                </div>
            </div>
        </section>


    </div>
    <!-- footer section-->
    <footer id="footer">
        <div class="container fluid text-center text-md-left ">
            <div class="row">
                <div class="col-md-2 mb-md-0 mb-2">
                    <a href="dashboard.html"><img class="logo" src="images/logo1.png" alt="" width="200" height="90" style="margin-top:10px"></a>
                    <p>5th Star Avenue, Selangor <br>
                        56500 Unimy</p>
                    <p>Call us: <a href="#">012-345 6789</a></p>
                </div>
                <div class="col-md-3 mb-md-0 mb-3">
                    <h4>Resources</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">About</a></li>
                        <li><a href="#">Chunema</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Forums</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Help Center</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-md-0 mb- 2">
                    <h4>Legal</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Security</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-md-0 mb-3">
                    <h4>Account</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Watchlist</a></li>
                        <li><a href="#">Collections</a></li>
                        <li><a href="#">User Guide</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-md-0 mb-2">
                    <h4>Newsletter</h4>
                    <p style="color:cornflowerblue">Subscribe to our newsletter system now <br> to get latest news from
                        us.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter your email...">
                    </form>
                    <a href="#" class="btn">Subscribe now <i class="ion-ios-arrow-forward"></i></a>
                </div>
            </div>
        </div>
        <div>
            <div class="backtotop">
                <p><a href="#top" id="back-to-top">Back to top <i class="ion-ios-arrow-thin-up"></i></a></p>
            </div>
        </div>
    </footer>
    <!-- end of footer section-->
</body>

</html>