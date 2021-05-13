
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Linn HR</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('vendor/adminlte/dist/img/linn.png') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	{{-- <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}"> --}}
<!--===============================================================================================-->	
	{{-- <link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}"> --}}
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" href='https://mmwebfonts.comquas.com/fonts/?font=pyidaungsu' />
    <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notosansmyanmarui.css" />

     <style type="text/css" media="screen">
            @font-face {
                font-family:'Noto Sans Myanmar';
                src:local('Noto Sans Myanmar'), url('https://www.mmwebfonts.com/fonts/NotoSansMyanmar-Regular.woff') format('woff'), url('https://www.mmwebfonts.com/fonts/NotoSansMyanmar-Regular.ttf') format('ttf');
            }

            @font-face {
                font-family:'Noto Sans Myanmar';
                src:local('Noto Sans Myanmar'), url('https://www.mmwebfonts.com/fonts/NotoSansMyanmar-Bold.woff') format('woff'), url('https://www.mmwebfonts.com/fonts/NotoSansMyanmar-Bold.ttf') format('ttf');
                font-weight:bold;
            }


            body{
                 font-family: "Noto Sans Myanmar","Pyidaungsu" !important;

            }

            .login100-form-title{
            	font-family: "Noto Sans Myanmar","Pyidaungsu" !important;
            }
            input,button{
            	font-family: "Noto Sans Myanmar","Pyidaungsu" !important;
            	font-size: 14px !important;
            }

            .login100-form-btn{
            	background: #365ba9 !important;
            }

    </style>     
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('uploads/loginbglight.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Linn HR 
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" method="POST" action="{{ route('login') }}">
					 @csrf

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100 @error('email') is-invalid @enderror" type="email" placeholder="User name" name="email" value="{{ old('email') }}" required>
						
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
				
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100  @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	{{-- <script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script> --}}
	<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	{{-- <script src="{{asset('vendor/select2/select2.min.js')}}"></script> --}}
<!--===============================================================================================-->
	{{-- <script src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script> --}}
	{{-- <script src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script> --}}
<!--===============================================================================================-->
	{{-- <script src="{{asset('vendor/countdowntime/countdowntime.js')}}"></script> --}}
<!--===============================================================================================-->
	<script src="{{asset('js/main.js')}}"></script>

</body>
</html>