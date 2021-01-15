
@extends('adminlte::page')

@section('title', 'Employee')

@section('content_header')
<style type="text/css">
     tr:hover td {
        background: #c7d4dd !important;
   }
     tr {
        cursor: pointer;
    }
    .styled-table {
    border-collapse: collapse;
    /*margin: 25px 0;*/
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }
    .styled-table thead tr {
        background-color: #009879;
        color: #ffffff;
        text-align: left;
    }
    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #c7d4dd;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }
</style>
@stop

@section('content')
<div class="container">
    <div class="row">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-lg-10">
             <a class="btn btn-success unicode" href="{{route('employee.index')}}"> Back</a>
        </div>
        <div class="col-lg-2">
            <div class="pull-right">
              <form action="{{route('employee.destroy',$employees->id)}}" method="POST" onsubmit="return confirm('Do you really want to delete?');">
                                @csrf
                                @method('DELETE')

                                <a class="btn btn-sm btn-primary" href="{{route('employee.edit',$employees->id)}}"><i class="fa fa-fw fa-edit" /></i></a>

                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-trash" /></i></button> 
                            </form>
            </div>
        </div>
    </div>


<div class="row">
        <div class="col-lg-12">
            <div>
                <h6 class="text-center text-dark text-md"><b>{{$employees->name}} 's Information</b></h6>
            </div>
        </div>
    </div>
    <br>
    <div class="tabs">
        <div class="tabby-tab" style="margin-right: 5px;">
            <input type="radio" id="tab-1" name="tabby-tabs" checked >
            <label for="tab-1">Personal</label>
            <div class="tabby-content">
                   <br>
                   
                   <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight: bold;;font-size:15px;">Name</h6>
                                </div>

                                <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">

                                    <input type="text" name="name" class="form-control unicode" placeholder="Mg Mg" id="name" value="{{$employees->name}}" readonly> 

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight: bold;;font-size:15px;">Father's Name</h6>
                                </div>

                                <div class="col-md-8">
                                   <input type="text" name="father_name" class="form-control unicode" placeholder="U Mya" id="father" value="{{$employees->father_name}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight: bold;;font-size:15px;">Gender</h6>
                                </div>


                                 <div class="col-md-2 {{ $errors->first('gender', 'has-error') }}">
                                    <input type="radio" name="gender" value="male" {{ $employees->gender == 'male' ? 'checked' : '' }}> Male
                                    
                                </div>   
                                <div class="col-md-2">
                                    <input type="radio" name="gender" value="female" {{ $employees->gender == 'female' ? 'checked' : '' }}> Female
                                </div> 
                            </div><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight: bold;;font-size:15px;">Date of Birth</h6>
                                </div>

                                <div class="col-md-8 {{ $errors->first('lat', 'has-error') }}">
                                     <input type="text" name="date_of_birth" class="form-control unicode" id="date_of_birth" value="{{date('d-m-Y', strtotime($employees->date_of_birth))}}" readonly>

                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight: bold;;font-size:15px;">NRC</h6>
                                </div>

                                <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">
                                <input type="text" name="fullnrc" class="form-control unicode" id="fullnrc" value="{{$employees->fullnrc}}" readonly>
                                  </div>  
                            
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight: bold;;font-size:15px;">Photo</h6>
                                </div>

                                <div class="col-md-8 ">
                                    <img src="{{ asset('uploads/employeePhoto/'.$employees->photo) }}" alt="photo" width="200px" height="200px">
                                </div>
                            </div>
                        </div>
                    </div>
   

                    
                    
            </div>
        </div>
        <div class="tabby-tab" style="margin-right: 5px;">
            <input type="radio" id="tab-2" name="tabby-tabs">
            <label for="tab-2">Contact</label>
            <div class="tabby-content">
              <br>
                     <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-2">
                                    <h6 style="font-weight: bold;;font-size:15px;">Address</h6>
                                </div>

                                <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">

                                   <textarea name="address" rows="4" class="form-control unicode" id="address" readonly>{{$employees->address}}</textarea>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight: bold;;font-size:15px;">Mobile</h6>
                                </div>

                                <div class="col-md-8">
                                    <input type="number" name="phone_no" class="form-control unicode" id="mobile" value="{{$employees->phone_no}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                      <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-2">
                                    <h6 style="font-weight: bold;;font-size:15px;">City</h6>
                                </div>

                                <div class="col-md-8 {{ $errors->first('name', 'has-error') }}">

                                   <input type="text" name="city" class="form-control unicode" placeholder="Naypyidaw" id="city" value="{{$employees->city}}" readonly>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight: bold;;font-size:15px;">Township</h6>
                                </div>

                                <div class="col-md-8">
                                     <input type="text" name="township" class="form-control unicode" placeholder="pyinmana" id="township" readonly value="{{$employees->township}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

            </div>
        </div>


         <div class="tabby-tab" style="margin-right: 5px;">
            <input type="radio" id="tab-3" name="tabby-tabs">
            <label for="tab-3">Qualification</label>
            <div class="tabby-content">
              <br>
                     <div class="row">
                        
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <h6 style="font-weight: bold;;font-size:15px;">University/School</h6>
                                </div>

                                <div class="col-md-8">
                                    <input type="text" name="qualification" class="form-control unicode" id="mobile" value="{{$employees->qualification}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                  

            </div>
        </div>


        <div class="tabby-tab">
            <input type="radio" id="tab-4" name="tabby-tabs">
            <label for="tab-4">Employment</label>
            <div class="tabby-content">
             <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <!-- <label class="col-md-3 unicode" style="text-align: right;">Assign</label> -->
                                <div class="col-md-2">
                                    <h6 style="font-weight: bold;;font-size:15px;">Join Date</h6>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="join_date" class="form-control unicode" id="join_date" value="{{date('d-m-Y', strtotime($employees->join_date))}}" readonly>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-2">
                                    <h6 style="font-weight: bold;;font-size:15px;">Rank</h6>
                                </div>
                                <!-- <label class="col-md-3 unicode" id="appointment_label" style="text-align: right;">Appoint Date</label> -->
                                <div class="col-md-8">
                                       <input type="text"  class="form-control unicode"  value="{{$employees->viewPosition->name}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                     <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-2">
                                    <h6 style="font-weight: bold;;font-size:15px;" id="assign_label">Department</h6>
                                </div>
                                <!-- <label class="col-md-3 unicode" id="assign_label" style="text-align: right;">Assign Date</label> -->
                                <div class="col-md-8">
                                      <input type="text"  class="form-control unicode"  value="{{$employees->viewDepartment->name}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                                 <div class="row">
                                <div class="col-md-2">
                                    <h6 style="font-weight: bold;;font-size:15px;" id="assign_label">Branch</h6>
                                </div>
                                <!-- <label class="col-md-3 unicode" id="assign_label" style="text-align: right;">Assign Date</label> -->
                                <div class="col-md-8">
                                      <input type="text"  class="form-control unicode"  value="{{$employees->viewBranch->name}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
            </div>
        </div>

    </div>
@stop 



@section('css')
<style>
        /* ------------------- */
        /* TEMPLATE        -- */
        /* ----------------- */

        /* @import url(https://fonts.googleapis.com/css?family=Lato:400, 700, 900, 300); */

        
        p {
            margin: 0 0 15px;
            line-height: 24px;
            color: gainsboro;
        }
        h6{
            font-size: 15px;
            color:black;
        }
        a:hover {
            color: tomato;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
        }

        /* ------------------- */
        /* PEN STYLES      -- */
        /* ----------------- */

        /* MAKE IT CUTE ----- */
        .tabs {
            position: relative;
            display: flex;
            min-height: 1000px;
            border-radius: 8px 8px 0 0;
            overflow: hidden;
        }

        .tabby-tab {
            flex: 1;
        }

        .tabby-tab label {
            display: block;
            box-sizing: border-box;
            /* tab content must clear this */
            height: 45px;

            padding: 10px;
            text-align: center;
            background: #1179C2;
            cursor: pointer;
            color: white;
            transition: background 0.5s ease;
        }

        .tabby-tab label:hover {
            background: white;
            color: #1179C2;
            border-bottom:1px solid #1179C2;
        }

        .tabby-content {
            position: absolute;

            left: 0;
            bottom: 0;
            right: 0;
            /* clear the tab labels */
            top: 40px;

            padding: 20px;
            border-radius: 0 0 8px 8px;
            /* background:#efedf1; */
            /* show/hide */
            opacity: 0;
            transform: scale(0.1);
            transform-origin: top left;
            padding-bottom: 50px;
        }

        .tabby-content img {
            float: left;
            margin-right: 20px;
            border-radius: 8px;
        }
        /* MAKE IT WORK ----- */

        .tabby-tab [name="tabby-tabs"] {
            display: none;
        }
        [name="tabby-tabs"]:checked ~ label {
            background:  white;
            z-index: 2;
            color: #1179C2;
            border-bottom:1px solid #1179C2;
        }

        [name="tabby-tabs"]:checked ~ label ~ .tabby-content {
            z-index: 1;

            /* show/hide */
            opacity: 1;
            transform: scale(1);
        }


        /* BREAKPOINTS ----- */
         @media screen and (max-width: 767px) {
            .tabs {
                min-height: 400px;
            }
        }

        @media screen and (max-width: 480px) {
            .tabs {
                min-height: 580px;
            }
            .tabby-tab label {
                height: 60px;
            }
            .tabby-content {
                top: 60px;
            }
            .tabby-content img {
                float: none;
                margin-right: 0;
                margin-bottom: 20px;
            }
        } 


           #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            }

            #myImg:hover {opacity: 0.7;}

/* The Modal (background) */
            .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: -10;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(243, 237, 237); /* Fallback color */
            background-color: rgba(221, 215, 215, 0.9); /* Black w/ opacity */
            }
            .modal1 {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 72%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(243, 237, 237); /* Fallback color */
            background-color: rgba(221, 215, 215, 0.9); /* Black w/ opacity */
            }

            /* Modal Content (image) */
            .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 595px;
            max-height:842px;
            margin-left: 22%;
            }
            .modal-content1 {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 595px;
            max-height:442px;
            margin-left: 22%;
            }

            /* Caption of Modal Image */
            #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
            }

            /* Add Animation */
            .modal-content, #caption {  
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
            }

            @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)} 
            to {-webkit-transform:scale(1)}
            }

            @keyframes zoom {
            from {transform:scale(0)} 
            to {transform:scale(1)}
            }

            /* The Close Button */
            .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: red;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            }

            .close:hover,
            .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
            }

            /* 100% Image Width on Smaller Screens */
            @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
            }

</style>
@stop



@section('js')
    <script src=" {{ asset('js/business/moment.min.js') }}" ></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script>
        $(function() {
              $('table').on("click", "tr.table-tr", function() {
                window.location = $(this).data("url");
              });
            });
    </script>
        
@stop