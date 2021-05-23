<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact us</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Themesdesign" />

    <link rel="icon" type="image/png" href="{{ asset('vendor/adminlte/dist/img/linn.png') }}" />

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstraps.min.css') }}" type="text/css">

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/materialdesignicons.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.css') }}" />

    <!-- selectize css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selectize.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/nice-select.css') }}" />

    <!-- Custom  Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />
    <style>
        @font-face {
            font-family: "MyanmarSagar";
            src: url({{ asset('fonts/custom/myanmar_sagar.ttf') }});
        }

        @charset "UTF-8";

        * {
            font-family: MyanmarSagar, sans-serif !important;
            font-size: 1rem;
            font-weight: 300;
        }

        html,
        body,
        p {
            font-family: MyanmarSagar, sans-serif !important;
            line-height: 2.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

    </style>


</head>

<body style="background-color: #F4F7FC">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>
    <!-- Loader -->

    <!-- Navigation Bar-->
    <header id="topnav" class="defaultscroll scroll-active" style="background-color: #3498DB;">
        <!-- Tagline STart -->
        <div class="tagline">
            <div class="container">
                <div class="float-left">

                </div>
                <div class="float-right">

                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Tagline End -->

        <!-- Menu Start -->
        <div class="container">
            <!-- Logo container-->
            <div>
                <a href="index.html" class="logo">
                    <img src="images/logo-light.png" alt="" class="logo-light" height="18" />
                    <img src="images/logo-dark.png" alt="" class="logo-dark" height="18" />
                </a>
            </div>
            <div class="buy-button">

            </div>
            <!--end login button-->
            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li><a href="{{ route('joblist.jobList') }}">Job List</a></li>
                    <!--  <li class="has-submenu">
                        <a href="javascript:void(0)">Jobs</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{ route('joblist.jobList') }}">Job List</a></li>
                           
                            <li><a href="#">Job Details</a></li>
                           
                        </ul>
                    </li> -->

                    <li class="has-submenu">
                        <a href="{{ route('frontend.jobabout') }}">About us</a>

                    </li>
                    <li>
                        <a href="{{ route('frontend.jobcontact') }}">contact</a>
                    </li>
                </ul>
                <!--end navigation menu-->
            </div>
            <!--end navigation-->
        </div>
        <!--end container-->
        <!--end end-->
    </header>
    <!--end header-->
    <!-- Navbar End -->

    <!-- MAP START -->
    <section class="section pt-0 ">
        <div class="container-fluid">

        </div>


    </section>
    <!-- CONTACT END -->

    <section style="margin: 50px">
        <h4 style="font-weight: bold;">Head Office</h4>
        <div class="row" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color: white">
            <div class="col-md-4"
                style="text-align: center;padding-top: 40px;padding-bottom: 30px;border-right: 2px solid #B3B8C1;">
                <img src="{{ asset('uploads/images/address.png') }}" alt="photo" width="40px" height="40px"><br><br>
                <h3 style="font-weight: bold;">Address</h3>
                <p style="padding-top: 10px">No. 14/585, 4th Street, Paung Laung Quarter, Pyinmana.</p>
            </div>
            <div class="col-md-4"
                style="text-align: center;padding-top: 40px;padding-bottom: 30px;border-right: 2px solid #B3B8C1;">
                <img src="{{ asset('uploads/images/phone.png') }}" alt="photo" width="40px" height="40px"><br><br>
                <h3 style="font-weight: bold;">Call Us</h3>
                <p style="padding-top: 10px">09-789799799, 067-22884,23884,24884</p>
            </div>
            <div class="col-md-4" style="text-align: center;padding-top: 40px;padding-bottom: 30px">
                <img src="{{ asset('uploads/images/email.png') }}" alt="photo" width="50px" height="40px"><br><br>
                <h3 style="font-weight: bold;">Mail Us</h3>
                <p style="padding-top: 10px">info@linncomputer.com</p>
            </div>
        </div><br>

        <div>
            <h4 style="font-weight: bold;">Branches</h4>
            <div class="row">
                <div
                    style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color: #185BA9;padding-top: 40px;padding-bottom: 30px;width: 48%;margin-right: 4%;padding-left: 20px">
                    <p style="color: white"><i class="mdi mdi-map-marker"></i> No.117, Thapyagone Quarter, Naypyitaw</p>
                    <p style="color: white"><i class="mdi mdi-cellphone-iphone"></i><span>
                            067-414884,414885,432884</span></p>
                    <p style="color: white"><i class="mdi mdi-email"></i><span> info@linncomputer.com</span></p>
                </div>

                <div
                    style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);background-color: #185BA9;padding-top: 40px;padding-bottom: 30px;width: 48%;padding-left: 20px">
                    <p style="color: white"><i class="mdi mdi-map-marker"></i> No.11/7, Bogyoke Road, Pyinmana</p>
                    <p style="color: white"><i class="mdi mdi-cellphone-iphone"></i><span> 067-24488,26884</span></p>
                    <p style="color: white"><i class="mdi mdi-email"></i><span> info@linncomputer.com</span></p>
                </div>
            </div>
        </div>



    </section>
    <div style="margin-left: 43px;margin-right: 43px;margin-top: 43px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2)">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3755.336957395618!2d96.2027726147721!3d19.740833486709946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c8ba2f4e0cd0c1%3A0x371a6ba88980820f!2sLinn%20IT%20%26%20Mobile!5e0!3m2!1sen!2sde!4v1621188728715!5m2!1sen!2sde"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>




    <!-- footer start -->
    <footer class="footer">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <p class="text-white mb-4 footer-list-title" style="font-size: 15px">Branch</p>
                    <ul class="social list-inline mb-0">
                        <li><a href="#" style="color: white;font-size: 13px" class="unicode">Head Office</a></li>
                        <li><a href="#" style="color: white;font-size: 13px" class="unicode">Linn Naypyitaw Branch</a>
                        </li>
                        <li><a href="#" style="color: white;font-size: 13px" class="unicode">Linn Pyinmana Branch</a>
                        </li>
                        <!--  <li><a href="#" style="color: white" class="unicode">Yangon Showroom</a></li> -->
                    </ul><br>
                    <ul class="social-icon social list-inline mb-0">
                        <li class="list-inline-item"><a href="https://www.facebook.com/linncomputerstore/"
                                class="rounded"><i class="mdi mdi-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="rounded" style="font-size: 13px"><i
                                    class="mdi mdi-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="rounded" style="font-size: 13px"><i
                                    class="mdi mdi-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="rounded" style="font-size: 13px"><i
                                    class="mdi mdi-google"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <p class="text-white mb-4 footer-list-title" style="font-size: 15px">Phone No</p>
                    <ul class="list-unstyled footer-list">
                        <li><a href="#" style="color: white;font-size: 13px" class="unicode">09-789799799,
                                067-22884,23884,24884</a></li>
                        <li><a href="#" style="color: white;font-size: 13px"
                                class="unicode">067-414884,414885,432884</a></li>
                        <li><a href="#" style="color: white;font-size: 13px" class="unicode">09-422294884, 09-346038884,
                                09-400558855</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <p class="text-white mb-4 footer-list-title f-17" style="font-size: 15px">Address</p>
                    <ul class="list-unstyled text-foot mt-4 mb-0">
                        <li><a href="#" style="color: white;font-size: 13px" class="unicode">No. 14/585, 4th Street,
                                Paung Laung Quarter, Pyinmana.</a></li>
                        <li><a href="#" style="color: white;font-size: 13px" class="unicode">No.117, Thapyagone Quarter,
                                Naypyitaw </a></li>
                        <li><a href="#" style="color: white;font-size: 13px" class="unicode">No.11/7, Bogyoke Road,
                                Pyinmana</a></li>
                        <!--   <li><a href="#" style="color: white" class="unicode">Star mart 9 Mile Show Room, Pyay Road</a></li> -->

                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->
    <hr>
    <footer class="footer footer-bar">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="">
                        <p style="font-size: 13px" class="mb-0">© 2020 -2021 Job. Design with <i
                                class="mdi mdi-heart text-danger"></i> by Linn.</p>
                    </div>
                </div>
            </div>
        </div>
        <!--end container-->
    </footer>
    <!--end footer-->
    <!-- Footer End -->

    <!-- Back to top -->
    <a href="#" class="back-to-top rounded text-center" id="back-to-top">
        <i class="mdi mdi-chevron-up d-block"> </i>
    </a>
    <!-- Back to top -->
    <!-- javascript -->
    <script src="{{ asset('js/jquerys.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>

    <!-- selectize js -->
    <script src="{{ asset('js/selectize.min.js') }}"></script>

    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <!-- CONTACT -->
    <script src="{{ asset('js/contact.js') }}"></script>

    <script src="{{ asset('js/apps.js') }}"></script>

</body>

</html>
