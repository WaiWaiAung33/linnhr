<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jobya - Responsive Job Board HTML Template</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Themesdesign" />

    <link rel="shortcut icon" href="images/favicon.ico">

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
    
    <!-- Start home -->
    <section class="bg-home" style="background-image: url('webbacklogo1.jpg');"> 
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h4 class="text-uppercase title mb-4">Job Detail</h4>
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
                    <h4 class="text-dark mb-3">Web Developer</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="job-detail border rounded p-4">
                        <div class="job-detail-content">
                            <img src="images/featured-job/img-4.png" alt="" class="img-fluid float-left mr-md-3 mr-2 mx-auto d-block">
                            <div class="job-detail-com-desc overflow-hidden d-block">
                                <h4 class="mb-2"><a href="#" class="text-dark">Web Developer</a></h4>
                                <p class="text-muted mb-0"><i class="mdi mdi-link-variant mr-2"></i>Web Themescode.pvt.Ltd</p>
                                <p class="text-muted mb-0"><i class="mdi mdi-map-marker mr-2"></i>659 Meadowcrest Lane Lexington, KY 40507</p>
                            </div>
                        </div>

                        <div class="job-detail-desc mt-4">
                            <p class="text-muted mb-3">Neque porro quisquam est qui dolorem ipsum dolor sit amet consectetur adipisci velit a quia non eius modi tempora incidunt ut labore dolore magnam aliquam quaerat voluptatem Nemo enim ipsam voluptatem quia voluptas sit aspernatur odit aut fugit sed quia consequuntur magni dolores eose.</p>

                            <p class="text-muted mb-0">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praelsentium voluptatum at deleniti atque corrupti quos dolores quas molestias excepturi occaecati cupiditate non provident, similique sunt culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga Temporibus autem quibusdam aut Ut at as enim ad minima veniam quis nostrum that exercitationem ullam corporis suscipit laboriosam officiis debitis aut rerum necessitatibus.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="text-dark mt-4">Job Description :</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="job-detail border rounded mt-2 p-4">
                                <div class="job-detail-desc">
                                    <p class="text-muted mb-3">Quis autem vel eum iure reprehenderit qui in ea voluptate velite esse quam nihil molestiae consequatur vel illum qui dolorem eum fugiat at quo voluptas nulla pariatur vero eos accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias at excepturi sint that occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est Quis autem vel eum iure reprehenderit qui in ea that voluptate esse quam nihil molestiae consequatur vel qui dolorem eum fugiat quo voluptas nulla by the pariatur laborum At vero eos et accusamus et iusto odio dignissimos ducimus blanditiis praesentium voluptatum deleniti atque corrupti quos dolores quas molestias excepturi sint occaecati cupiditate non provident et dolorum fuga.</p>

                                    <p class="text-muted mb-0">Itaque earum rerum hic tenetur sapiente delectus aut reiciendis voluptatibus maiores that alias consequatur aut perferendis doloribus asperiores repellat Sed ut perspiciatis unde omnis iste sit at natus error sit voluptatem accusantium doloremque laudantium niti totame rem aperiam eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="text-dark mt-4">Qualification :</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="job-detail border rounded mt-2 p-4">
                                <div class="job-detail-desc">
                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-2">Morbi mattis ullamcorper velit. Phasellus gravida semper nisi nullam vel sem.</p>
                                    </div>

                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-2">Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet.</p>
                                    </div>

                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-2">Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.</p>
                                    </div>

                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-2">Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis.</p>
                                    </div>

                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-2">Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu.</p>
                                    </div>

                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-2">Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis.</p>
                                    </div>

                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-2">Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi.</p>
                                    </div>

                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-0">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="text-dark mt-4">Primary Responsibilities :</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="job-detail border rounded mt-2 p-4">
                                <div class="job-detail-desc">
                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-2">HTML, CSS & Scss</p>
                                    </div>

                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-2">Javascript</p>
                                    </div>

                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-2">PHP</p>
                                    </div>

                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-2">Photoshop</p>
                                    </div>

                                    <div class="job-details-desc-item">
                                        <div class="float-left mr-3">
                                            <i class="mdi mdi-send text-primary"></i>
                                        </div>
                                        <p class="text-muted mb-0">Illustrator</p>
                                    </div>
                                </div>
                            </div>
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
                                <p class="text-muted mb-2">: Web Themes.pvt.Ltd</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-email text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: Webthemescom@gmail.com</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-web text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: https://www.WebThemes.com</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-cellphone-iphone text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: 1987 6543 21</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-currency-usd text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: $700 - $800/month</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-security text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: 1 To 3 Years.</p>
                            </div>

                            <div class="job-details-desc-item">
                                <div class="float-left mr-2">
                                    <i class="mdi mdi-clock-outline text-muted"></i>
                                </div>
                                <p class="text-muted mb-2">: 4 minutes ago</p>
                            </div>

                            <h6 class="text-dark f-17 mt-3 mb-0">Share Job :</h6>
                            <ul class="social-icon list-inline mt-3 mb-0">
                                <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-google-plus"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-whatsapp"></i></a></li>
                                <li class="list-inline-item"><a href="#" class="rounded"><i class="mdi mdi-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="job-detail border rounded mt-4 p-4">
                        <h5 class="text-muted text-center pb-2"><i class="mdi mdi-clock-outline mr-2"></i>Opening Hours</h5>

                        <div class="job-detail-time border-top pt-4">
                            <ul class="list-inline mb-0">
                                <li class="clearfix text-muted border-bottom pb-3">
                                    <div class="float-left">Monday</div>
                                    <div class="float-right">
                                        <h5 class="f-13 mb-0">9AM - 7PM</h5>
                                    </div>
                                </li>

                                <li class="clearfix text-muted border-bottom pb-3">
                                    <div class="float-left">Tuesday</div>
                                    <div class="float-right">
                                        <h5 class="f-13 mb-0">9AM - 7PM</h5>
                                    </div>
                                </li>

                                <li class="clearfix text-muted border-bottom pb-3">
                                    <div class="float-left">Wednesday</div>
                                    <div class="float-right">
                                        <h5 class="f-13 mb-0">9AM - 7PM</h5>
                                    </div>
                                </li>

                                <li class="clearfix text-muted border-bottom pb-3">
                                    <div class="float-left">Thursday</div>
                                    <div class="float-right">
                                        <h5 class="f-13 mb-0">9AM - 7PM</h5>
                                    </div>
                                </li>

                                <li class="clearfix text-muted border-bottom pb-3">
                                    <div class="float-left">Friday</div>
                                    <div class="float-right">
                                        <h5 class="f-13 mb-0">9AM - 7PM</h5>
                                    </div>
                                </li>

                                <li class="clearfix text-muted border-bottom pb-3">
                                    <div class="float-left">Saturday</div>
                                    <div class="float-right">
                                        <h5 class="f-13 mb-0">6:30AM - 1PM</h5>
                                    </div>
                                </li>

                                <li class="clearfix text-muted pb-0">
                                    <div class="float-left">Sunday</div>
                                    <div class="float-right">
                                        <h5 class="f-13 mb-0">Closed</h5>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="job-detail border rounded mt-4">
                        <a href="#" class="btn btn-primary btn-block">Apply For Job</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- JOB DETAILS END -->

    <!-- subscribe start -->
    <section class="section bg-light">
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
   

    <!-- Back to top -->
    <a href="#" class="back-to-top rounded text-center" id="back-to-top"> 
        <i class="mdi mdi-chevron-up d-block"> </i> 
    </a>
    <!-- Back to top -->

    <!-- javascript -->
    <script src="{{asset('js/jquerys.min.js')}}"></script>
    <script src="{{asset('js/bootstraps.bundle.min.js')}}"></script>
    <script src="{{asset('js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/plugins.js')}}"></script>

    <!-- selectize js -->
    <script src="{{asset('js/selectize.min.js')}}"></script>

    <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>

    <script src="{{asset('js/apps.js')}}"></script>

</body>
</html>