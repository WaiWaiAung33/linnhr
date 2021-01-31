<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Themesdesign" />

    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstraps.min.css') }}">

    <!--Material Icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/materialdesignicons.min.css')}}" />

    <link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome.css')}}" />

    <!-- selectize css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/selectize.css')}}" />

    <!--Slider-->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}" />
    <link rel="stylesheet" href="{{asset('css/owl.theme.css')}}" />
    <link rel="stylesheet" href="{{asset('css/owl.transitions.css')}}" />

    <!-- Custom  Css -->
    <link rel="stylesheet" type="text/css" href="css/styles.css" />

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
    <header id="topnav" class="defaultscroll scroll-active">
        <!-- Tagline STart -->
        <div class="tagline">
            <div class="container">
                <div class="float-left">

                    <div class="phone">
                        <i class="mdi mdi-phone-classic"></i> 09 400887799
                    </div>
                    <div class="email">
                        <a href="#">
                            <i class="mdi mdi-email"></i> linncomputer@gmail.com
                        </a>
                    </div>
                </div>
                <div class="float-right">
                    <ul class="topbar-list list-unstyled d-flex" style="margin: 11px 0px;">
                       
                        <li class="list-inline-item">
                            <select id="select-lang" class="demo-default">
                                <option value="">Language</option>
                                <option value="4">English</option>
                            </select>
                        </li>
                    </ul>
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
                 <a href="https://shopping.linncomputer.com/"> <img src="{{ asset('uploads/images/shopping-cart.png') }}" alt="photo" width="20"> Linn OnlineShop </a>
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
    
            <div id="navigation" >
                <!-- Navigation Menu-->   
                <ul class="navigation-menu">
                    <li><a href="{{route('frontend.home')}}">Home</a></li>
                    <li class="has-submenu">
                        <a href="javascript:void(0)">Jobs</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{route('joblist.jobList')}}">Job List</a></li>
                           
                            <li><a href="{{route('frontend.jobListdetail')}}">Job Details</a></li>
                           
                        </ul>
                    </li>
    
                    <li class="has-submenu">
                        <a href="#">About us</a>
                    
                    </li>
                    <li>
                        <a href="#">contact</a>
                    </li>
                </ul><!--end navigation menu-->
            </div><!--end navigation-->
        </div><!--end container-->
        <!--end end-->
    </header><!--end header-->
    <!-- Navbar End -->

    <!-- Start Home -->
    <section class="bg-home" style="background-image: url('uploads/images/webbacklogo.jpg');">
        <div class="bg-overlay"></div>
        <div class="home-center">
          
                    <div class="home-form-position">
                        <div class="row">
                           <div class="col-md-12 col-md-offset-1 col-sm-12 text-center">
                            <h2  style="color:white " class="unicode" class="unicode">JOB LIST VIEW </h2><br>
                          
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end home -->

   
 <!-- JOB LIST START -->
    <section class="section pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title title-line pb-5">Available job for you</h4>
                        <p class="text-muted para-desc mx-auto mb-1">Post a job to tell us about your project. We'll quickly match you with the right freelancers.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <div class="left-sidebar">
                        <div class="accordion" id="accordionExample">
                            <div class="card rounded mt-4">
                                <a data-toggle="collapse" href="#collapseOne" class="job-list" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="card-header" id="headingOne">
                                        <h6 class="mb-0 text-dark f-18">Date Posted</h6>
                                    </div>
                                </a>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                                    <div class="card-body p-0">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted" for="customRadio1">Last Hour</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted" for="customRadio2">Last 24 hours</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted" for="customRadio3">Last 7 days</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted" for="customRadio4">Last 14 days</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio5" name="customRadio" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted" for="customRadio5">Last 30 days</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- collapse one end -->
                            <div class="card rounded mt-4">
                                <a data-toggle="collapse" href="#collapsetwo" class="job-list" aria-expanded="true" aria-controls="collapsetwo">
                                    <div class="card-header" id="headingtwo">
                                        <h6 class="mb-0 text-dark f-18">Categories</h6>
                                    </div>
                                </a>
                                <div id="collapsetwo" class="collapse show" aria-labelledby="headingtwo">
                                    <div class="card-body p-0">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio7" name="customRadio1" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio7">Digital & Creative</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio8" name="customRadio1" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio8">Accountancy</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio9" name="customRadio1" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio9">Banking</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio10" name="customRadio1" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio10">IT Contractor</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio11" name="customRadio1" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio11">Graduate</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio12" name="customRadio1" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio12">Estate Agency</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- collapse one end -->
                            <div class="card rounded mt-4">
                                <a data-toggle="collapse" href="#collapsethree" class="job-list" aria-expanded="true" aria-controls="collapsethree">
                                    <div class="card-header" id="headingthree">
                                        <h6 class="mb-0 text-dark f-18">Experince</h6>
                                    </div>
                                </a>
                                <div id="collapsethree" class="collapse show" aria-labelledby="headingthree">
                                    <div class="card-body p-0">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio13" name="customRadio2" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio13">1Year to 2Year</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio14" name="customRadio2" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio14">2Year to 3Year</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio15" name="customRadio2" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio15">3Year to 4Year</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio16" name="customRadio2" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio16">IT Contractor</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- collapse one end -->
                            <div class="card rounded mt-4">
                                <a data-toggle="collapse" href="#collapsefour" class="job-list" aria-expanded="true" aria-controls="collapsefour">
                                    <div class="card-header" id="headingfour">
                                        <h6 class="mb-0 text-dark f-18">Gender</h6>
                                    </div>
                                </a>
                                <div id="collapsefour" class="collapse show" aria-labelledby="headingfour">
                                    <div class="card-body p-0">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio17" name="customRadio3" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio17">Male</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio18" name="customRadio3" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio18">Female</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio19" name="customRadio3" class="custom-control-input">
                                            <label class="custom-control-label ml-1 text-muted f-15" for="customRadio19">Others</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- collapse one end -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-9 mt-4 pt-2">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="show-results">
                                <div class="float-left">
                                   <!--  <h5 class="text-dark mb-0 pt-2 f-18">Showing results 0-20</h5> -->
                                </div>
                                <div class="sort-button float-right">
                                 <!--    <select class="nice-select rounded">
                                        <option data-display="Select">Nothing</option>
                                        <option value="1">Web Developer</option>
                                        <option value="2">PHP Developer</option>
                                        <option value="3">Web Designer</option>
                                    </select> -->
                                </div>
                            </div>
                        </div>
                    </div>

                     @foreach($jobopenings as $i=>$jobopening)
                    <div class="row">
                        <div class="col-lg-12 mt-4 pt-2">
                            <div class="job-list-box border rounded">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col-lg-2">
                                            <div class="company-logo-img">
                                                 @if($jobopening->photo == '')

                                                         <img src="linn3.png" alt="photo" width="100">
                                                       
                                                         @else
                                                         <!--  <div style="background-color: #D1F2EB ;margin:5px;padding: 5px;border-radius: 120px"> -->
                                                          <img src="{{ asset('uploads/jobopeningPhoto/'.$jobopening->photo) }}" alt="photo" width="100">
                                                      <!-- </div> -->
                                                         @endif
                                            </div>
                                        </div>

                                        <div class="col-lg-7 col-md-9">
                                            <div class="job-list-desc">
                                                <h6 class="mb-2"><a href="#" class="text-dark">{{$jobopening->title}}</a></h6>
                                                <p class="text-muted mb-0"><i class="mdi mdi-bank mr-2"></i>{{$jobopening->viewDepartment->name}}</p>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item mr-3">
                                                        <p class="text-muted mb-0">{{$jobopening->viewPosition->name}}</p>
                                                    </li>

                                                  
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="job-list-button-sm text-right">
                                                <span class="badge">Close Date : {{date('d-m-Y',strtotime($jobopening->close_date))}}</span>

                                                <div class="mt-3">
                                                    <a href="{{route('cvform.show',$jobopening->id)}}" class="btn btn-sm btn-primary">Apply</a>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                                 @endforeach
                        </div>
                        
                 
                        
                     
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- JOB LIST START -->


    

    
  

    <!-- subscribe start -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="float-left position-relative notification-icon mr-2">
                        <i class="mdi mdi-bell-outline text-primary"></i>
                        <span class="badge badge-pill badge-danger">1</span>
                    </div>
                    <h5 class="mt-2 mb-0">Your Job Notification</h5>
                </div>
                <div class="col-lg-8 col-md-7 mt-4 mt-sm-0">
                    <form>
                        <div class="form-group mb-0">
                            <div class="input-group mb-0">
                                <input name="email" id="email" type="email" class="form-control" placeholder="Your email :" required="" aria-describedby="newssubscribebtn">
                                <div class="input-group-append">
                                    <button class="btn btn-primary submitBnt" type="submit" id="newssubscribebtn">Subscribe</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- subscribe end -->

    <!-- footer start -->
    <footer class="footer">
          <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="widget clearfix" >


                            <div >
                            <h4 class="widget-title" style="color: white;" class="unicode">Branch</h4>
                            </div>
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
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-4">
                        <div class="widget clearfix">
                             <div style="margin-left: 20px">
                            <h4 class="widget-title"  style="color: white;padding-left: 20px;" class="unicode">Phone No</h4>
                        </div>
                            <ul style="list-style-type: none;">
                                <li><a href="#" style="color: white" class="unicode">09 400887799</a></li>
                                <li><a href="#" style="color: white" class="unicode">067-24488, 26884</a></li>
                                <li><a href="#" style="color: white" class="unicode">067-414884,414885,432884</a></li>
                            </ul>
                        </div><!-- end widget -->
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-4">
                        <div class="widget clearfix">
                             <div style="margin-left: 20px">
                            <h4 class="widget-title" style="color: white;padding-left: 20px;" class="unicode">Address</h4>
                        </div>
                            <ul style="list-style-type: none;">
                                <li><a href="#" style="color: white" class="unicode">No. 14/585, 4th Street, Paung Laung Quarter, Pyinmana.</a></li>
                                <li><a href="#" style="color: white" class="unicode">No.11/7, Bogyoke Road, Pyinmana</a></li>
                                <li><a href="#" style="color: white" class="unicode">No.117, Thapyagone Quarter, Naypyitaw</a></li>
                            </ul>
                        </div><!-- end widget -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
    </footer>
   

    <!-- javascript -->
    <script type="text/javascript" src="{{asset('js/jquerys.min.js')}}"></script>


     <script type="text/javascript" src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.easing.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
     <script type="text/javascript" src="{{asset('js/selectize.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.nice-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/counter.int.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/apps.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/home.js')}}"></script>
   
</body>
</html>