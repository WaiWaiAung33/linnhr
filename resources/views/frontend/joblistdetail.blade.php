<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Detail</title>
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

<body>
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
                    <!--   <li class="has-submenu">
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

    <!-- Start home -->
    <section>
        <div></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h4 class="text-uppercase title mb-4">{{ $jobopenings->title }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end home -->

    <!-- JOB DETAILS START -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="text-dark mb-3">Job Detail:</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="job-detail border rounded p-2">
                        <div class="job-detail-desc mt-4">
                            <h6>{{ $jobopenings->title }}</h6>
                            <p class="text-muted mb-3">{{ $jobopenings->description }}</p>
                        </div>
                    </div>

                    <!--   <div class="row">
                        <div class="col-lg-12">
                            <h5 class="text-dark mt-4">Primary Responsibilities :</h5>
                        </div>
                    </div>
 -->
                    <div class="row">
                        <div class="col-lg-12">

                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-5 mt-4 mt-sm-0">
                    <div class="job-detail border rounded p-4">
                        <h5 class="text-muted text-center pb-2"><i class="mdi mdi-map-marker mr-2"></i>Location</h5>

                        <div class="job-detail-location pt-4 border-top">
                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-bank text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: Naypyidaw</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-email text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: info@linncomputer.com</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-cellphone-iphone text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: 09-789799799</p>
                            </div>

                            <h6 class="text-dark f-17 mt-3 mb-0">Share Job :</h6>
                            <ul class="social-icon list-inline mt-3 mb-0">
                                <li class="list-inline-item"><a href="https://www.facebook.com/linncomputerstore/"
                                        class="rounded"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="rounded"><i
                                            class="mdi mdi-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="rounded"><i
                                            class="mdi mdi-google-plus"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="rounded"><i
                                            class="mdi mdi-whatsapp"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="rounded"><i
                                            class="mdi mdi-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="job-detail border rounded mt-4">
                        <a href="{{ route('cvform.show', $jobopenings->id) }}"
                            class="btn btn-primary btn-block">Apply
                            For Job</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- JOB DETAILS END -->

    <footer class="footer">
        @include('footer')
    </footer>
     <!-- footer end -->
    <hr>
    <footer class="footer footer-bar">
        @include('footerbar')
    </footer>
    <!-- Back to top -->
    <a href="#" class="back-to-top rounded text-center" id="back-to-top">
        <i class="mdi mdi-chevron-up d-block"> </i>
    </a>
    <!-- Back to top -->


    <!-- javascript -->
    <script type="text/javascript" src="{{ asset('js/jquerys.min.js') }}"></script>


    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/selectize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/counter.int.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/apps.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/home.js') }}"></script>
    <script type="text/javascript" src="{{ asset('toastermin.js') }}"></script>

</body>

</html>
