<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact us</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Themesdesign" />

    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstraps.min.css')}}" type="text/css">

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/materialdesignicons.min.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome.css')}}" />

    <!-- selectize css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/selectize.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/nice-select.css')}}" />

    <!-- Custom  Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/styles.css')}}" />

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
             
            </div><!--end login button-->
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
                    <li><a href="{{route('frontend.home')}}">Home</a></li>
                     <li><a href="{{route('joblist.jobList')}}">Job List</a></li>
                   <!--  <li class="has-submenu">
                        <a href="javascript:void(0)">Jobs</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{route('joblist.jobList')}}">Job List</a></li>
                           
                            <li><a href="#">Job Details</a></li>
                           
                        </ul>
                    </li> -->
    
                    <li class="has-submenu">
                        <a href="{{route('frontend.jobabout')}}">About us</a>
                    
                    </li>
                    <li>
                        <a href="{{route('frontend.jobcontact')}}">contact</a>
                    </li>
                </ul><!--end navigation menu-->
            </div><!--end navigation-->
        </div><!--end container-->
        <!--end end-->
    </header><!--end header-->
    <!-- Navbar End -->

    <!-- MAP START -->
    <section class="section pt-0 bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                   
                </div>
            </div>
        </div>
        
        <div class="container mt-100 mt-60">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="contact-item mt-40">
                        <div class="float-left">
                            <div class="contact-icon d-inline-block border rounded-pill shadow text-primary mt-1 mr-4">
                                <i class="mdi mdi-earth"></i>
                            </div>
                        </div>
                        <div class="contact-details">
                            <h4 class="text-dark mb-1">Website</h4>
                            <p class="mb-0 text-muted">Brandcode Pvt.Ltd.co.in</p>
                            <p class="mb-0 text-muted">Themescode Pvt.Ltd.co.in</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="contact-item mt-40">
                        <div class="float-left">
                            <div class="contact-icon d-inline-block border rounded-pill shadow text-primary mt-1 mr-4">
                                <i class="mdi mdi-cellphone-iphone"></i>
                            </div>
                        </div>
                        <div class="contact-details">
                            <h4 class="text-dark mb-1">Call us</h4>
                            <p class="mb-0 text-muted">123 456 7890</p>
                            <p class="mb-0 text-muted">123 456 7890</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="contact-item mt-40">
                        <div class="float-left">
                            <div class="contact-icon d-inline-block border rounded-pill shadow text-primary mt-1 mr-4">
                                <i class="mdi mdi-email"></i>
                            </div>
                        </div>
                        <div class="contact-details">
                            <h4 class="text-dark mb-1">Email</h4>
                            <p class="mb-0 text-muted">Themescodeltd@gmail.com</p>
                            <p class="mb-0 text-muted">Brandcodeltd@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CONTACT END -->


  <!-- footer start -->
    <footer class="footer">
        <div class="container">
            <div class="row">
             
                <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <p class="text-white mb-4 footer-list-title">Branch</p>
                      <ul class="social list-inline mb-0">
                                <li><a href="#" style="color: white" class="unicode">Head Office</a></li>
                                <li><a href="#" style="color: white" class="unicode">Linn 1</a></li>
                                <li><a href="#" style="color: white" class="unicode">Linn 2</a></li>
                            </ul>
                              <ul class="social-icon social list-inline mb-0">
                            <li class="list-inline-item"><a href="https://www.facebook.com/linncomputerstore/" class="rounded"><i class="mdi mdi-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-google"></i></a></li>
                        </ul>
                </div>
                <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <p class="text-white mb-4 footer-list-title">Phone No</p>
                    <ul class="list-unstyled footer-list">
                        <li><a href="#" style="color: white" class="unicode">09 400887799</a></li>
                        <li><a href="#" style="color: white" class="unicode">067-24488, 26884</a></li>
                        <li><a href="#" style="color: white" class="unicode">067-414884,414885,432884</a></li>
                    </ul>
                </div>
            
                <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <p class="text-white mb-4 footer-list-title f-17">Address</p>
                    <ul class="list-unstyled text-foot mt-4 mb-0">
                         <li><a href="#" style="color: white" class="unicode">No. 14/585, 4th Street, Paung Laung Quarter, Pyinmana.</a></li>
                        <li><a href="#" style="color: white" class="unicode">No.11/7, Bogyoke Road, Pyinmana</a></li>
                        <li><a href="#" style="color: white" class="unicode">No.117, Thapyagone Quarter, Naypyitaw</a></li>
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
                        <p class="mb-0">© 2020 -2021 Job. Design with <i class="mdi mdi-heart text-danger"></i> by Linn.</p>
                    </div>
                </div>
            </div>
        </div><!--end container-->
    </footer><!--end footer-->
    <!-- Footer End -->

     <!-- Back to top -->
    <a href="#" class="back-to-top rounded text-center" id="back-to-top"> 
        <i class="mdi mdi-chevron-up d-block"> </i> 
    </a>
    <!-- Back to top -->
    <!-- javascript -->
    <script src="{{asset('js/jquerys.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/plugins.js')}}"></script>

    <!-- selectize js -->
    <script src="{{asset('js/selectize.min.js')}}"></script>

    <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
    <!-- CONTACT -->
    <script src="{{asset('js/contact.js')}}"></script>

    <script src="{{asset('js/apps.js')}}"></script>

</body>
</html>