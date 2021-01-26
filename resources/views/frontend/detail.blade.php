<!DOCTYPE html>
<html>
<head>
  <title>Linn CV Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   <script type="text/javascript" src="{{ asset('select2/js/select2.min.js') }}"></script>
  

  <!-- for signature -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
  
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
  
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">



  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="blueimp-file-upload/js/jquery.fileupload.js"></script>
    <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>
   
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
 <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>

<style type="text/css">
  .kbw-signature { width: 100%; height: 200px;}
    #sig canvas{
            width: 100% !important;
            height: 100%;
            background-color: white;
        }
    hr.headerline {
      background: linear-gradient(to right, blue, lightblue);
      height: 5px
  }

  hr.footer{
  height: 2px solid blue;
  }

  input {
    width: 100%;
    border: none;
    border-bottom: 2px dotted black;
    outline: 0;
    border-width: 0 0 2px;
    border-color: black;
   
  }

  input:focus {
    border-color: blue
  }

  u {
      text-decoration: none;
      border-bottom: 5px solid blue;
    }​

  u.next{
      text-decoration: none;
      border-bottom: 2px solid red;
    }

    #sign{
      border:4px solid #ccc;
    }
    div.photo {
      border-top: 3px solid blue;
      /*height: 200px;*/
      /*margin: 10px auto;*/
      position: relative;
      width: 100%;
      margin-bottom: 100px;
  }

  div.next {
      background: #fff none repeat scroll 0 0;
      height: auto;
      left: 80%;
      padding: 3px 5px;
      position: absolute;
      top: -50px;
      width: 100px;
      height: 100px;
      border: 1px solid black
  }

  div.sign{
    border:1px solid black;
    width: 100px;
    height: 100px;
    }

  #myDiv{
    background-color: red;
  }

  #mySpan{
  writing-mode: vertical-lr; 
  transform: rotate(180deg);
  /*font-size: 80px;*/
  /*font-size: 4.6em;*/
  font-size: 4.8vw;
  /*background-color: green;*/
  width: 12%;
  text-align: right;
  color: gray;
  /*height: 1000px;*/

  }
 </style>
</head>

<script type="text/javascript">
  $(document).ready(function(){
     $("#date_of_birth").datepicker({ dateFormat: 'dd-mm-yy' });
     $("#appliedate").datepicker({ dateFormat: 'dd-mm-yy' });
     $("select[name='nrc_code']").change(function(){
       var code_id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "<?php echo route('select-ajax-codes') ?>",
            method: 'POST',
            dataType: 'html',
            data: {
                nrc_code: code_id,
                _token: token
            },
            success: function(data) {
                $("select[name='nrc_state']").html(data);
            }
        });

    });
     
  
  });

</script>

<body style="background-color: #E5E4E2">
<div class="container" style="background-color: white;width: 60%" >
  <form method="POST" action="{{route('cvform.store')}}" enctype="multipart/form-data">
  @csrf
  <div class="row">
    <div class="col-md-8">
      <img src="{{ asset('uploads/jobopeningPhoto/linn3.png') }}" style="width:200;height: 200;float: left;">
      <h4 style="margin-top: 70px;color: blue;font-weight: bold;text-align: center;">CV Form</h4>
    </div>
    <div class="photo">
      <input type="file" id="imgupload" style="display:none" name="myPhoto" onchange="PreviewImage();"/> 
      <div class="next" id="file" type="file">
        <img id="blah" src="{{ asset('uploads/jobopeningPhoto/nophoto.png') }}" alt="your image" style="width: 90px;height: 90px;" />
      </div>
  </div>
  </div>
  <div class="row">
   
    <div class="col-md-12">
    <div class="row">
      <div class="col-md-4" style="text-align: left;">
        <label>၁။ အမည်</label>
      </div>
      <div class="col-md-8">
        <input type="text" name="name">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4" style="text-align: left;">
        <label>၂။ အမျိုးသား မှတ်ပုံတင်အမှတ်</label>
      </div>
      <div class="col-md-2">
        <select class="form-control select2bs4" name="nrc_code" id="code_id" onchange="changeNRC();">
              <option value="">-</option>
              @foreach ($nrccodes as $nrccode )
                <option  value="{{$nrccode->id}}">{{$nrccode->name}}</option>
             
              @endforeach
          </select>   
      </div>
      <div class="col-md-2">
         <select class="form-control" name="nrc_state" id="state_id">
            <option value="">-</option>
           <!--  @foreach ($departments as $department )
              <option  value="{{$department->id}}">{{$department->name}}</option>
            @endforeach -->
        </select>   
      </div>
      <div class="col-md-2">
         <select name="nrc_status" id="nrc_status" class="form-control select2bs4">
                      <option value="N" selected>N</option>
                      <option value="P">P</option>
                      <option value="E">E</option>
                      <option value="A">A</option>
                      <option value="F">F</option>
                      <option value="TH">TH</option>
                      <option value="G">G</option>

      </select>
      </div>
      <div class="col-md-2">
         <input type="text" name="nrc" class="form-control unicode" id="nrc">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4" style="text-align: left;">
        <label>၃။ မွေးသက္ကရာဇ်</label>
      </div>
      <div class="col-md-8">
        <input type="text" name="dob" id="date_of_birth">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4" style="text-align: left;">
        <label>၄။ ပညာအရည်အချင်း</label>
      </div>
      <div class="col-md-8">
        <input type="text" name="education">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4" style="text-align: left;">
        <label>၅။ ကိုးကွယ်သည့်ဘာသာ/လူမျိုး</label>
      </div>
      <div class="col-md-8">
        <input type="text" name="religion">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4" style="text-align: left;">
        <label>၆။ ကျား/မ</label>
      </div>
      <div class="col-md-1">
          <input type="radio" name="marrical_status" value="male" id="gender" checked> 
          
      </div> 
      <div class="col-md-1"><label>ကျား</label></div>  
      <div class="col-md-1">
          <input type="radio" name="marrical_status" value="female" id="gender"> 
      </div> 
      <div class="col-md-2">
        <label>မ</label>
      </div>
     <!--  <div class="col-md-6">
        <input type="text" name="marrical_status">
      </div> -->
    </div>
    <br>
    <div class="row">
      <div class="col-md-4" style="text-align: left;">
        <label>၇။ E-Mail Address</label>
      </div>
      <div class="col-md-8">
        <input type="text" name="email">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4" style="text-align: left;">
        <label>၈။ မိဘအမည်</label>
      </div>
      <div class="col-md-8">
        <input type="text" name="pName">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4" style="red;text-align: left;">
        <label>၉။ မိဘ၏ ဖုန်းနံပါတ်</label>
      </div>
      <div class="col-md-8">
        <input type="number" name="pPhone">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4" style="text-align: left;">
        <label>၁၀။ လုပ်ငန်းအတွေ့အကြုံ</label>
      </div>
      <div class="col-md-8">
        <input type="text" name="experience">
      </div>
    </div>
    <br>

     <div class="row">
      <div class="col-md-4" style="text-align: left;">
        <label>၁၁။ တာဝန်ထမ်းဆောင်လိုသောဌာန</label>
      </div>
    
      <div class="col-md-8">
        <input type="text" name="department" value="{{$jobopenings->viewDepartment->name}}" readonly>
      </div>
     
    </div>

    <br>

    <div class="row">
      <div class="col-md-4" style="text-align: left;">
        <label>၁၂။ တာဝန်ထမ်းဆောင်လိုသောရာထူး</label>
      </div>
    

      <div class="col-md-8">
        <input type="text" name="location" value="{{$jobopenings->viewPosition->name}}" readonly>
      </div>
     
    </div>

    <br>
    <!-- <div class="row">
      <div class="col-md-6" style="text-align: left;">
        <label>၁၂။ တာဝန်ထမ်းဆောင်လိုသောရာထူး</label>
      </div>
      <div class="col-md-6">
        <input type="text" name="location">
      </div>
    </div>
    <br> -->
    <div class="row">
    <div class="col-md-4">
      ၁၃။ မျှော်မှန်းလစာ
    </div> 
      <div class="col-md-8">
        <input type="text" name="salary">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4">
        <label>၁၄။ အဆောင်နေ/မနေ</label>
      </div>
       <div class="col-md-1">
          <input type="radio" name="isHostel" value="နေ" checked> 
          
      </div> 
      <div class="col-md-1"><label>နေ</label></div>  
      <div class="col-md-1">
          <input type="radio" name="isHostel" value="နေ" > 
      </div> 
      <div class="col-md-2">
        <label>မနေ</label>
      </div>
     <!--  <div class="col-md-6">
        <input type="text" name="isHostel">
      </div> -->
    </div>
    <br>
    <div class="row">
      <div class="col-md-4">
        <label>၁၅။ လျှောက်လွှာတင်သည့်ရက်စွဲ</label>
      </div>
      <div class="col-md-8">
        <input type="text" name="appliedDate" id="appliedate">
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4">
        <label>၁၆။ ဆက်သွယ်ရန် လိပ်စာအပြည့်အစုံ</label>
      </div>
      <div class="col-md-8">
        <input type="text" name="address" >
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-4">
        <label>၁၇။ဖုန်းနံပါတ်</label>
      </div>
      <div class="col-md-8">
        <input type="number" name="phone">
      </div>
    </div>
    <br>
    <div class="row">
        <label style="text-align: right;" class="col-md-12">လက်မှတ်</label>
    </div>
    <div class="row">
      <div class="col-md-7"></div>
        <div class="col-md-5">
                    <div id="sig" ></div>
                    <br/>
                    <div class="row" style="justify-content: center;">
                        <button id="clear" class="btn btn-danger btn-sm" style="margin-right: 10px;">Clear Signature</button>
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                            
                        <textarea id="signature64" name="signed" style="display: none"></textarea>
                </div>
            <br/>
    </div>
    <br>
  </div>
  <div class="row col-md-12" style="background-color: #85C1E9;height: 100px;margin-left: 1px;">
    <div class="col-md-6">
      <div class="row" style="align-items: center;">
        <img src="{{ asset('uploads/jobopeningPhoto/flogo.png') }}" style="width: 60px;height:60px;">
      <a href="https://www.facebook.com/linncomputerstore" target="blank"><p style="font-size: 18px;color: white;">www.facebook.com/linncomputer</p></a>
      </div>
    </div>

    <div class="col-md-6" style="align-items: center;justify-content: center;margin-top: 10px;">
        <div class="row">
        <img src="{{ asset('uploads/jobopeningPhoto/wlogo1.png') }}" style="width: 30px;height:30px;margin-right: 10px;">
      <a href="https://shopping.linncomputer.com/" target="blank"><p style="font-size: 18px;color: white">shopping.linncomputer.com</p></a>
      </div>
      </div>
    </div>
  </div>
  </form>
</div>
<!-- <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div data-toggle="signature" style="background-color: white">
          <input type="text" name="Signature">
      </div>
      </div>  
    </div>
</div> -->
  
</div>
</body>
</html>
<script>
  function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("imgupload").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("blah").src = oFREvent.target.result;
        };
    };

    // $(function () {
    //   $('[data-toggle=signature]').signature()
    // })

    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

   $(document).ready(function(){
    $(".sign").focus(function(){
      $("#myModal").modal();
    });
    $('.next').click(function(){ $('#imgupload').trigger('click'); });
  });
 var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>