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

    <script src=" {{ asset('toasterjquery.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
   

</head>
<script type="text/javascript">
      @if(Session::has('success'))
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
    
            <div id="navigation" >
                <!-- Navigation Menu-->   
                <ul class="navigation-menu">
                    <li><a href="{{route('frontend.home')}}">Home</a></li>
                    <li><a href="{{route('joblist.jobList')}}">Job List</a></li>
                    <!-- <li class="has-submenu"> -->
                       <!--  <a href="javascript:void(0)">Jobs</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{route('joblist.jobList')}}">Job List</a></li>
                           
                            <li><a href="#">Job Details</a></li>
                           
                        </ul> -->
                    <!-- </li> -->
    
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
    <!-- end home -->


     <!-- popular category start -->
    <section class="section">
        <div class="container" >
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title title-line pb-5">Popular Department</h4>
                    </div>
                </div>
            </div>

          
            <div class="row">
             @foreach($departments as $department)
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <a href="javascript:void(0)">
                        <div class="popu-category-box bg-light rounded text-center p-4">
                            <div class="popu-category-icon mb-3">
                                <i class="mdi mdi-account d-inline-block rounded-pill h3 text-primary"></i>
                            </div>
                            <div class="popu-category-content">
                                <h5 class="mb-2 text-dark title">{{$department->name}}</h5>
                                <p class="text-success mb-0 rounded">{{$department->viewJobopening->count()}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
         

            
        </div>
    </section>
    <!-- popular category end -->

   

    <!-- all jobs start -->
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title title-line pb-5">Find Your Jobs</h4>
                       
                    </div>
                </div>
            </div>
           

            @foreach($jobopenings as $i=>$jobopening)
            <div class="row" >
                <div class="col-12">
                    <div class="tab-content mt-2" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="recent-job" role="tabpanel" aria-labelledby="recent-job-tab">

                            
                            <div class="row" >
                                <div class="col-lg-12" >

                                    <div class="job-box bg-white overflow-hidden border rounded mt-4 position-relative overflow-hidden" >
                                        <div class="lable text-center pt-2 pb-2">
                                            <ul class="list-unstyled best text-white mb-0 text-uppercase">
                                                <li class="list-inline-item"><i class="mdi mdi-star"></i></li>
                                            </ul>
                                        </div>
                                         
                                        <div class="p-4" >
                                           <a href="{{route('frontend.jobListdetail',$jobopening->id)}}" >
                                            <div class="row align-items-center" >
                                                <div class="col-md-2">
                                                    <div class="mo-mb-2">
                                                         @if($jobopening->photo == '')

                                                         <img src="linn3.png" alt="photo" width="100">
                                                       
                                                         @else
                                                         <!--  <div style="background-color: #D1F2EB ;margin:5px;padding: 5px;border-radius: 120px"> -->
                                                          <img src="{{ asset('uploads/jobopeningPhoto/'.$jobopening->photo) }}" alt="photo" width="100">
                                                      <!-- </div> -->
                                                         @endif
                                                    </div>
                                                
                                                </div>

                                                <div class="col-md-3">
                                                    <div>
                                                        <h5 class="f-18"><a href="#" class="text-dark">{{$jobopening->title}}</a></h5>
                                                        <p class="text-muted mb-0">{{$jobopening->viewPosition->name}}</p>
                                                    </div>
                                                </div>
                                             
                                                <div class="col-md-2">
                                                 
                                                </div>
                                            </div>
                                        </a>
                                        </div>
                                        <div class="p-3 bg-light">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div>
                                                        <p class="text-muted mb-0 mo-mb-2"><span class="text-dark">Close Date :</span> {{date('d-m-Y',strtotime($jobopening->close_date))}}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <!-- <div>
                                                        <p class="text-muted mb-0 mo-mb-2"><span class="text-dark">Notes :</span> {{$jobopening->description}} </p>
                                                    </div> -->
                                                </div>
                                                <div class="col-md-2">
                                                    <div>
                                                        <a href="{{route('cvform.show',$jobopening->id)}}" class="text-primary">Apply Now <i class="mdi mdi-chevron-double-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                       
                               
                                </div>
                            </div>
                        </div>
                          @endforeach

        
    </section>
    <!-- all jobs end -->

    <!-- How it Work start -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title title-line pb-5">Top Reasons to Choose Us</h4>
                      
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mt-4 pt-2">
                    <div class="how-it-work-box bg-light p-4 text-center rounded shadow">
                        <div class="how-it-work-img position-relative rounded-pill mb-3">

                            <img src="{{ asset('uploads/images/trophy.png') }}" alt="" class="mx-auto d-block" height="50">
                        </div>
                        <div>
                            <h5>What We Do</h5>
                            <p class="text-muted">We listen to your feedback. We provide a high level of support. We focus on the quality of our services.</p>
                            <a href="#" class="text-primary">Read more <i class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4 pt-2">
                    <div class="how-it-work-box bg-light p-4 text-center rounded shadow">
                        <div class="how-it-work-img position-relative rounded-pill mb-3">
                            <img src="{{ asset('uploads/images/sharing-content.png') }}" alt="" class="mx-auto d-block" height="50">
                        </div>
                        <div>
                            <h5>Who We Are</h5>
                            <p class="text-muted">We are best service provider.</p>
                            <a href="#" class="text-primary">Read more <i class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-4 pt-2">
                    <div class="how-it-work-box bg-light p-4 text-center rounded shadow">
                        <div class="how-it-work-img position-relative rounded-pill mb-3">
                            <img src="{{ asset('uploads/images/our-mission.png') }}" alt="" class="mx-auto d-block" height="50">
                        </div>
                        <div>
                            <h5>Our Mission</h5>
                            <p class="text-muted">To provide our customers with special services "Give us a chance and we will prove our efficiency".</p>
                            <a href="#" class="text-primary">Read more <i class="mdi mdi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- How it Work end -->

    

    
  

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
    <script type="text/javascript" src="{{asset('toastermin.js')}}"></script>
   
</body>
</html>
