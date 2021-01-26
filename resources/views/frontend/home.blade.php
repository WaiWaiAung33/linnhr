<!doctype html>
<!--[if IE 9]> <html class="no-js ie9 fixed-layout" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js " lang="en"> <!--<![endif]-->
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <!-- Site Meta -->
    <title class="unicode">Linn Profile</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom & Default Styles -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/carousel.css">
    <link rel="stylesheet" href="style.css">



</head>
<body>
    
    <div id="wrapper">
        <div class="topbar" style="background-color: #AED6F1">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <a class="navbar-brand" href="index.html"><img src="{{ asset('uploads/images/linn_logo2.png') }}" alt="Linda" style="height:10"></a>
                    </div>
                    <div class="col-md-7 col-sm-12">
                        <nav class="topbar-menu"><br><br>
                            <div class="list-inline text-right navbar-right">
                                <a href="https://web.facebook.com/linncomputerstore/"><img src="{{ asset('uploads/jobopeningPhoto/flogo.png') }}" alt="Linda" style="height:10" width="50" class="unicode">Linn Facebook</a>
                               <!--  <a href="https://linn.com.mm/"><i class="fa fa-cart-arrow-down"> Linn OnlineShop </i></a> -->
                            </div><!-- end list -->
                        </nav><!-- end menu -->
                    </div><!-- end col -->
                </div><!-- end row --><br>
            </div><!-- end container -->
       <!-- end topbar -->
        <section class="section transheader homepage parallax" data-stellar-background-ratio="0.1" style="background-color:#AED6F1; ">
            <div class="container">
                <div class="row">   
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center">
                        <h2  style="color:#000 " class="unicode" class="unicode">Linn IT Solution Co.,Ltd </h2><br>
                        <h4 class="lead" style="color:#2E86C1" class="unicode">ဝန်ထမ်းလျှောက်လွှာခေါ်ယူခြင်း</h4>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->
    </div>
   <?php
    $colors = ["#f89f51","#4dd153","#2da0f3","#af74f7","#17b6e6","#6094c1","#ee335d"];
   ?>
<div class="row" style="margin: 20px">
    @foreach($jobopenings as $i=>$jobopening)
    
    <div class="col-md-3">
                    <div class="card text-white" style="background-color: {!! $colors[$i] !!};border-radius: 5px 5px 5px 5px">
                        <a href="{{route('cvform.show',$jobopening->id)}}" class="text-white">
                         <p style="margin-top: 5px;margin-left: 5px;color: white" class="unicode">Close Date:<span style="float: right;">{{date('d-m-Y',strtotime($jobopening->close_date))}}</span></p>
                        <div class="card-body row">
                            <div class="col-md-4" >
                            @if($jobopening->photo == '')

                             <img src="linn3.png" alt="photo" width="100">
                           
                             @else
                             <!--  <div style="background-color: #D1F2EB ;margin:5px;padding: 5px;border-radius: 120px"> -->
                              <img src="{{ asset('uploads/jobopeningPhoto/'.$jobopening->photo) }}" alt="photo" width="100">
                          <!-- </div> -->
                             @endif
                             </div>
                             <div class="col-md-8" >
                           <h4 style="color: white" class="unicode">{{$jobopening->description}}</h4>
                            <p style="color: white" class="unicode">{{$jobopening->viewDepartment->name}}</p>
                            <p style="color: white" class="unicode">{{$jobopening->viewPosition->name}}</p>
                             <a href="{{route('cvform.show',$jobopening->id)}}" style="float: right;margin-right: 5px;margin-bottom: 5px" class="btn btn-sm btn-primary" class="unicode">Apply</a>
                            </div>
           
                            
                            
                        </div>
                        </a>
                    </div>
                </div>
    @endforeach

    </div> 
        <section class="section overfree">
           
            <div class="container">
                <div class="section-title text-center">
                    <small class="unicode">Welcome to the best Linn Services</small>
                    <h3 class="unicode">Top Reasons to Choose Us</h3>
                    <!-- <hr>
                    <p class="lead"> Best Service!! Best</p> -->
                </div><!-- end section-title -->

                <div class="row service-list text-center">
                    <div class="col-md-4 col-sm-12 col-xs-12 first">
                        <div class="service-wrapper wow fadeIn">    
                              <img src="{{ asset('uploads/images/trophy.png') }}" alt="photo" width="80px" height="80px">
                            <div class="service-details">
                                <h4 class="unicode"><a href="service-01.html" title="">What We Do</a></h4>
                                <p class="unicode">We listen to your feedback. We provide a high level of support. We focus on the quality of our services.</p>
                                <a href="https://web.facebook.com/linncomputerstore/" class="readmore" target="_blank" class="unicode">View Details</a>
                            </div>
                        </div><!-- end service-wrapper -->
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="service-wrapper wow fadeIn">    
                             <img src="{{ asset('uploads/images/sharing-content.png') }}" alt="photo" width="80px" height="80px">
                            <div class="service-details">
                                <h4 class="unicode"><a href="service-02.html" title="">Who We Are</a></h4>
                                <p class="unicode">We are best service provider</p>
                                <a href="https://web.facebook.com/linncomputerstore/" class="readmore" target="_blank" class="unicode">View Details</a>
                            </div>
                        </div><!-- end service-wrapper -->
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-12 col-xs-12 last">
                        <div class="service-wrapper wow fadeIn">    
                        <img src="{{ asset('uploads/images/our-mission.png') }}" alt="photo" width="80px" height="80px">
                            <div class="service-details">
                                <h4 class="unicode"><a href="service-02.html" title="">Our Mission</a></h4>
                                <p class="unicode"> To provide our customers with special services "Give us a chance and we will prove our efficiency"</p>
                                <a href="https://web.facebook.com/linncomputerstore/" class="readmore" target="_blank" class="unicode">View Details</a>
                            </div>
                        </div><!-- end service-wrapper -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end section -->

       <footer class="footer primary-footer" style="background-color: #2a3c66;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="widget clearfix" >
                            <div style="margin-left: 20px">
                            <h4 class="widget-title" style="color: white;padding-left: 20px;" class="unicode">Branch</h4>
                            </div>
                            <ul style="list-style-type: none;">
                                <li><a href="#" style="color: white" class="unicode">Head Office</a></li>
                                <li><a href="#" style="color: white" class="unicode">Linn 1</a></li>
                                <li><a href="#" style="color: white" class="unicode">Linn 2</a></li>
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
        </footer><!-- end primary-footer -->
      

    <!-- jQuery Files -->
    <script src="{{ asset('jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap.min.js') }}"></script>
    <script src="{{ asset('parallax.js') }}"></script>
    <script src="{{ asset('animate.js') }}"></script>
    <script src="{{ asset('owl.carousel.js') }}"></script>
    <script src="{{ asset('custom.js') }}"></script>

</body>
</html>