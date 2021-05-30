<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Linn HR</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Themesdesign" />

    <link rel="icon" type="image/png" href="{{ asset('vendor/adminlte/dist/img/linn.png') }}" />

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstraps.min.css') }}">

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/materialdesignicons.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.css') }}" />

    <!-- selectize css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/selectize.css') }}" />

    <!--Slider-->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.transitions.css') }}" />

    <!-- Custom  Css -->
    <link rel="stylesheet" type="text/css" href="css/styles.css" />

    <script src=" {{ asset('toasterjquery.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('toasterbootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('toastermin.css') }}">
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
<script type="text/javascript">
    @if (Session::has('success'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.success("{{ session('success') }}");
    @endif

</script>

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
                    <!-- <li class="has-submenu"> -->
                    <!--  <a href="javascript:void(0)">Jobs</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{ route('joblist.jobList') }}">Job List</a></li>
                           
                            <li><a href="#">Job Details</a></li>
                           
                        </ul> -->
                    <!-- </li> -->

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

    <!-- Start Home -->
    <section>
        <div></div>
        <div class="home-center">

            <div class="home-form-position">
                <div class="row">

                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

    <!-- JOB LIST START -->
    <section class="section pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title title-line pb-5">Available job for you</h4>
                    </div>
                </div>
            </div>

            @foreach ($jobopenings as $i => $jobopening)
                <a href="{{ route('frontend.jobListdetail', $jobopening->id) }}">
                    @php
                        $todaydate = date('m/d/Y');
                        
                    @endphp
                    @if ($jobopening->close_date > $todaydate)

                        <div class="row">

                            <div class="col-lg-12 mt-4 pt-2">
                                <div class="job-list-box border rounded">
                                    <!--  <a href="{{ route('frontend.jobListdetail', $jobopening->id) }}" style="background-color: red"> -->
                                    <div class="p-3">
                                        <div class="row align-items-center">
                                            <div class="col-lg-2">
                                                <div class="company-logo-img">
                                                    @if ($jobopening->photo == '')

                                                        <img src="linn3.png" alt="photo" width="100">

                                                    @else
                                                        <!--  <div style="background-color: #D1F2EB ;margin:5px;padding: 5px;border-radius: 120px"> -->
                                                        <img src="{{ asset('uploads/jobopeningPhoto/' . $jobopening->photo) }}"
                                                            alt="photo" width="100">
                                                        <!-- </div> -->
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-7 col-md-9">
                                                <div class="job-list-desc">
                                                    <h6 class="mb-2"><a href="#"
                                                            class="text-dark">{{ $jobopening->title }}</a></h6>
                                                    <p class="text-muted mb-0"><i
                                                            class="mdi mdi-bank mr-2"></i>{{ $jobopening->viewDepartment->name }}
                                                    </p>
                                                    <ul class="list-inline mb-0">
                                                        <li class="list-inline-item mr-3">
                                                            <p class="text-muted mb-0">
                                                                {{ $jobopening->viewPosition->name }}</p>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3">
                                                <div class="job-list-button-sm text-right">
                                                    <span>Close Date :
                                                        {{ date('d-m-Y', strtotime($jobopening->close_date)) }}</span>

                                                    <div class="mt-3">
                                                        <a href="{{ route('cvform.show', $jobopening->id) }}"
                                                            class="btn btn-sm btn-primary">Apply</a>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>

                    @endif
                </a>
            @endforeach
        </div>




        </div>
        </div>
        </div>
        </div>
    </section>
    <!-- JOB LIST START -->

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
