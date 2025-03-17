<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1)
    header("Location: dashboard.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="./assets/js/font-awesome.js" crossorigin="anonymous"></script>
    <title>Home | Food Share</title>
    <style>
        .image {
            width: 50%;
            height: 50%;
        }

        .column {
            float: left;
            width: 25%;
            padding: 0 10px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0.2);
            padding: 10px;
            margin: 0 auto;
            float: none;
            margin-bottom: 10px;
        }

        .row {
            margin: 0 -5px;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 50px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .site-footer {
            background-color: #26272b;
            padding: 45px 0 20px;
            font-size: 15px;
            line-height: 24px;
            color: #F5F5F5;
        }

        .site-footer hr {
            border-top-color: #bbb;
            opacity: 0.5
        }

        .site-footer hr.small {
            margin: 20px 0
        }

        .site-footer h3 {
            color: #fff;
            font-size: 16px;
            text-transform: uppercase;
            margin-top: 5px;
            letter-spacing: 2px
        }

        .site-footer h4 {
            margin-right: 2px;
        }

        .site-footer a {
            color: #737373;
        }

        .site-footer a:hover {
            color: #3366cc;
            text-decoration: none;
        }

        .site-footer .social-icons {
            text-align: right
        }

        .site-footer .social-icons a {
            width: 40px;
            height: 40px;
            line-height: 40px;
            margin-left: 6px;
            margin-right: 0;
            border-radius: 100%;
            background-color: #33353d
        }

        .social-icons {
            padding-left: 0;
            margin-bottom: 0;
            list-style: none
        }

        .social-icons li {
            display: inline-block;
            margin-bottom: 4px
        }

        .social-icons a {
            background-color: #eceeef;
            color: #818a91;
            font-size: 16px;
            display: inline-block;
            line-height: 44px;
            width: 44px;
            height: 44px;
            text-align: center;
            margin-right: 8px;
            border-radius: 100%;
            -webkit-transition: all .2s linear;
            -o-transition: all .2s linear;
            transition: all .2s linear
        }

        .social-icons a:active,
        .social-icons a:focus,
        .social-icons a:hover {
            color: #fff;
            background-color: #29aafe
        }

        .social-icons a.facebook:hover {
            background-color: #3b5998
        }

        .social-icons a.twitter:hover {
            background-color: #00aced
        }

        .social-icons a.linkedin:hover {
            background-color: #007bb6
        }

        .social-icons a.dribbble:hover {
            background-color: #ea4c89
        }

        @media (max-width:767px) {
            .social-icons li.title {
                display: block;
                margin-right: 0;
                font-weight: 600
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid d-flex align-items-center">
            <a class="navbar-brand" href="#">
                <i class="fas fa-recycle nav_logo-icon" style="font-size: 2.5rem;"></i>
                <p class="mb-0 text-uppercase" style="font-size: 2rem;">Food share
            </a></p>

            <div class="ms-auto">
                <a href="./login.php" class="btn btn-primary me-2">Login</a>
                <a href="./signup.php" class="btn btn-primary">SignUp</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000">
                        <img src="images/m5.jpg" class="d-block w-100" alt="Hey childrens" height="620" width="500">
                        <div class="carousel-caption">
                            <h2><b><q>Make a difference in someone's life with just a meal.</q></b></h2>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="images/im3.jpg" class="d-block w-100" alt="..." height="620" width="500">
                        <div class="carousel-caption">
                            <h2><b><q>Let's put an end to empty stomachs. Donate today.</q></b></h2>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="images/im1.jpg" class="d-block w-100" alt="..." height="620" width="500">
                        <div class="carousel-caption">
                            <h2><b><q>Together, we can turn hunger into hope.</q></b></h2>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="4000">
                        <img src="images/m4.jpg" class="d-block w-100" alt="..." height="620" width="500">
                        <div class="carousel-caption">
                            <h2><b><q>Every donation feeds a dream.</q></b></h2>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="images/im2.jpg" class="d-block w-100" alt="..." height="620" width="500">
                        <div class="carousel-caption">
                            <h2><b><q>Feed their hearts, nourish their souls. Donate today.</q></b></h2>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="6000">
                        <img src="images/m6.jpg" class="d-block w-100" alt="..." height="620" width="500">
                        <div class="carousel-caption">
                            <h2><b><q>Harvest, <br>Happiness<br>for all</q></b></h2>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="container my-3" style="max-width:2000px;margin-top:100px">
        <div class="row justify-content-center">

            <div class="col">
                <div class="card" style="width: 21rem;">
                    <img src="images/image2.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 style="text-align:center; class=" card-title">Food is Donated</h4>
                        <p style="text-align:center; class=" card-text">Restuarants,Cafeterias,Hotels,Farmers and
                            individual person can post food in under a minute on the FoodShare</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 21rem;">
                    <img src="images/image5.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h4 style="text-align:center; class=" card-title">Food Is Picked Up</h4>
                        <p style="text-align:center;class=" card-text"> The charity or a network of volunteers, picks up
                            the food and serves it to hungry people</p>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 21rem;"> <br> <br> <br>
                    <img src="images/image6.jpg" class="card-img-top" alt="...">
                    <div class="card-body"> <br> <br>
                        <h4 style="text-align:center;class=" card-title">Food Is Deliver</h4>
                        <p style="text-align:center; class=" card-text">Excess food is distributed to needy people with
                            love</p>
                    </div>

                </div>
            </div>

            <div class="container-fluid"> <br>
                <div class="row">
                    <div class="col d-flex justify-content" style="position: relative; display: inline-block;">
                        <br> <img src="images/photo1.jpg" class="" alt="..." width="2000" height="500">
                        <div class="text" style="position: absolute;top: 84%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 21px; background-color: rgba(0, 0, 0, 0.5); padding: 5px 10px;">
                            FoodShare's mission: Channeling food donations to NGOs to aid the needy and supporting local
                            farmers by redistributing surplus produce, fostering community resilience through sustenance
                            and sustainability. </div>
                    </div>
                </div>
            </div>
        </div>

        <centre>
            <div class="container my-3">
        </centre>
        <div class="row justify-content-center">
            <centre>
                <div class="col d-flex justify-content-center">
                    <div class="card text h-100" style="width: 50rem;">
                        <img src="images/image1.jpg" class="centreImage" alt="...">
                        <div class="card-body">
                            <h3 class="card-text" style="text-align: center">Why Fight Hunger???</h3>
                            <h6>
                                <p class="card-text">
                                    <li>According to the Global Hunger Index 2021,<b>India ranks 101 out of
                                            116countries</b>, indicating a serious level of hunger.
                            </h6>
                            </li>
                            <br>
                            <li>The GHI considers factors such as undernourishment, child wasting, child stunting,
                                and child mortality.</li>
                            <br>
                            <li> The FAO estimates the number of undernourished people globally, including in India.
                                According to the FAO,<b> India has one of the largest numbers of undernourished
                                    people in the world.</li></b>
                            <br>
                            <li> Addressing hunger is essential for upholding human dignity and ensuring basic human
                                rights.</li>
                            </p>
                        </div>

                    </div>
                </div>
        </div>
    </div>

    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h3>About</h3>
                    <p class="text-justify">FOOD SHARE play a vital role in addressing hunger and ensuring that nutritious food reaches those who need it most. They rely heavily on volunteers, donations, and community support to operate effectively.</p>
                </div>
                <div class="col-sm-12 col-md-6">
                    <h4>Contact Us</h4>
                    <p>Email: foodshare@gmail.com</p>
                    <p>Phone: +91 7588391080</p>
                </div>
                <hr>

                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <p class="copyright-text">Copyright &copy; 2024 All Rights Reserved by
                                <a href="#">Food Share</a>.
                            </p>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <ul class="social-icons">
                                <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>