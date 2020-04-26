@extends('layouts.home')
@section('content')
<body id="page-top">
   @include('layouts.header')





  <!--/ Intro Skew Star /-->
<!--   <div id="home" class="intro route bg-image" style="background-image: url(img/headerimage.jpg)">
    <div class="overlay-itro"></div>
    <div class="intro-content display-table">
      <div class="table-cell">
        <div class="container">
    
          <h1 class="intro-title mb-4">U2 Marine Services Ltd. </h1>
          <p class="intro-subtitle"><span class="text-slider-items">Asset Management,Audits and Inspections,LNG Specific,Manuals</span><strong class="text-slider"></strong></p>
          
        </div>
      </div>
    </div>
  </div> -->

<div class="mainvedio intro route" id="home">
  <div class="overlay"></div>
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="https://ak8.picdn.net/shutterstock/videos/6193928/preview/stock-footage-aerial-view-of-luxury-yacht-navigating-close-to-the-coast.mp4" type="video/mp4">
  </video>
  <div class="container h-100 intro-content display-table">
    <div class=" table-cell">
      <div class="container">
       <h1 class="intro-title mb-4">U2 Marine Services Ltd. </h1>
          <p class="intro-subtitle"><span class="text-slider-items">Asset Management,Audits and Inspections,LNG Specific,Manuals</span><strong class="text-slider"></strong></p>
      </div>
    </div>
  </div>
</div>


  <!-- use this video tag for the vedio -->
 <!--  <div class="vedio" id="home">
    
  </div> -->


<div class="space"></div>
  

<div class="container">
<section class="section_four" id="training">
 <div class="container-fluid">
   <div class="row training_row">
     <div class="col-md-6 training_img">
       <img src="img/training.jpg">
     </div>
     <div class="col-md-6 training_txt">
       <h1 class="text-center underline">Training</h1>
       <p>
         Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
         tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
         quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
         consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
         cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
         proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
       </p>
       <div class="text-center training_btn">
          <!-- <button>REGISTER</button>
         <button>LOGIN</button>  -->
		 <button type="button" class="btn btn-brand btn-icon-sm"  data-toggle="modal" data-target="#SignUp">
           REGISTER
        </button>
		 
		<button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal" data-target="#userLoginModal">
          Login
        </button>
		  
		  
		  
       </div>
     
     </div>
   </div>
 </div> 
</section>
</div>


<div class="space" id="service"></div>
<div class="services_txt_head container" >
  <h1 class="text-center underline">services</h1>
  <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
  <p></p>
</div>

<section>

  <div class="container">
  <div class="row"><!--
    <div class="col-md-3">
     <a href="asset.html"> <div class="main">
        <div class="main-ig">
          <img src="img/shipcargo.jpg" alt="wr">
        </div>
        <div class="overlay">
             <h4 class="text-center underline2">ASSET MANAGEMENT</h4>
        </div>
      
      </div></a>
    </div>-->
    <div class="col-md-6">
      <a href="AUDITSANDINSPECTIONS.html"><div class="main">
        <div class="main-ig">
          <img src="img/audit.jpg" alt="wr">
        </div>
        <div class="overlay">
           <h4 class="text-center underline2">AUDITS & INSPECTIONS</h4>
        </div>
        
      </div></a>
    </div>
    <div class="col-md-6">
      <a href="LNGSpecific.html"><div class="main">
        <div class="main-ig">
          <img src="img/LNGSPECIFIC.jpg" alt="wr">
        </div>
        <div class="overlay">
          <h4 class="text-center underline2">LNG SPECIFIC</h4>
        </div>
       
      </div></a>
    </div><!--
    <div class="col-md-3">
      <a href="manuals.html"><div class="main">
        <div class="main-ig">
          <img src="img/manual.jpg" alt="wr">
        </div>
        <div class="overlay">
          <h4 class="text-center underline2">Manual</h4>
        </div>
        
      </div></a>
    </div>-->

  </div>
</div>
</section>



















<div class="space" id="aboutid"  ></div>
	<div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="contact-mf">
            <div  class="box-shadow-full">
			
		
    <div class="row">
      <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12 about-txt text-left">
        <h1 class="btmline underline text-center  ">ABOUT US</h1>
        <p class="aboutp">U2 Marine Services is a multipurpose marine services providing company focused on bringing in the very best skills to clients in the maritime sector and related business areas. Within a very short period, U2 Marine has achieved a broad client base within Oil, Chemical and Gas Industry across the globe. Our consultants are ex – Master Mariners and Chief Engineers who have wide ranging experience in the Oil, Chemical and Gas transportation industries and enjoy over 100 years of combined experience among themselves.</p>
      </div> 
      <!--<div class="col-md-5 col-lg-5 col-xl-5 col-sm-12 col-xs-12 about_img text-right">
        <img src="img/about.jpg">
      </div>-->
    </div>
	<div class="space"></div>		
	<div class="row">
    <div class="col-md-4">
      <div class="main">
        <div class="main-ig">
          <img src="img/mission.jpg" alt="wr">
        </div>
        <div class="overlay">
          <h4 class="text-center underline2">over mission</h4>     
        </div>
        
      </div>
    </div>
    <div class="col-md-4">
      <div class="main">
        <div class="main-ig">
          <img src="img/vision.jpg" alt="wr">
        </div>
        <div class="overlay">
           <h4 class="text-center underline2">our vision</h4>
        </div>
     
      </div>
    </div>
    <div class="col-md-4">
      <div class="main">
        <div class="main-ig">
          <img src="img/values.jpg" alt="wr">
        </div>
        <div class="overlay">
          <h4 class="text-center underline2">core values</h4>
        </div>
      
      </div>
    </div>
  </div>		
			
			
			
			
			
			
			
			
			
			
			
		

			</div>
		  </div>
		</div>
	  </div>
	</div>

<!--


<div class="space"></div>
<section class="section_two" >
  <div class="container">
    <div class="row" id="about">
      <div class="col-md-7 col-lg-7 col-xl-7 col-sm-12 col-xs-12 about-txt text-left">
        <h1 class="btmline underline text-center  ">ABOUT US</h1>
        <p class="aboutp">U2 Marine Services is a multipurpose marine services providing company focused on bringing in the very best skills to clients in the maritime sector and related business areas. Within a very short period, U2 Marine has achieved a broad client base within Oil, Chemical and Gas Industry across the globe. Our consultants are ex – Master Mariners and Chief Engineers who have wide ranging experience in the Oil, Chemical and Gas transportation industries and enjoy over 100 years of combined experience among themselves.</p>
      </div> 
      <div class="col-md-5 col-lg-5 col-xl-5 col-sm-12 col-xs-12 about_img text-right">
        <img src="img/about.jpg">
      </div>
    </div>
  </div>
</section>
<div class="space"></div>

<section class="container">
  <div class="">
  
  
  
  <div class="row">
    <div class="col-md-4">
      <div class="main">
        <div class="main-ig">
          <img src="img/mission.jpg" alt="wr">
        </div>
        <div class="overlay">
          <h4 class="text-center underline2">over mission</h4>     
        </div>
        
      </div>
    </div>
    <div class="col-md-4">
      <div class="main">
        <div class="main-ig">
          <img src="img/vision.jpg" alt="wr">
        </div>
        <div class="overlay">
           <h4 class="text-center underline2">our vision</h4>
        </div>
     
      </div>
    </div>
    <div class="col-md-4">
      <div class="main">
        <div class="main-ig">
          <img src="img/values.jpg" alt="wr">
        </div>
        <div class="overlay">
          <h4 class="text-center underline2">core values</h4>
        </div>
      
      </div>
    </div>
  </div>
  
  
  
</div>
</section>

-->
<div class="space"></div>


  <div class="section-counter paralax-mf bg-image" style="background-image: url(img/abc.jpg)">
    <div class="overlay-mf"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-lg-3">
          <div class="counter-box counter-box pt-4 pt-md-0">
            <div class="counter-ico">
              <span class="ico-circle"><i class="ion-checkmark-round"></i></span>
            </div>
            <div class="counter-num">
              <p class="counter">450</p>
              <span class="counter-text">WORKS COMPLETED</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-lg-3">
          <div class="counter-box pt-4 pt-md-0">
            <div class="counter-ico">
              <span class="ico-circle"><i class="ion-ios-calendar-outline"></i></span>
            </div>
            <div class="counter-num">
              <p class="counter">15</p>
              <span class="counter-text">YEARS OF EXPERIENCE</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-lg-3">
          <div class="counter-box pt-4 pt-md-0">
            <div class="counter-ico">
              <span class="ico-circle"><i class="ion-ios-people"></i></span>
            </div>
            <div class="counter-num">
              <p class="counter">550</p>
              <span class="counter-text">TOTAL CLIENTS</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-lg-3">
          <div class="counter-box pt-4 pt-md-0">
            <div class="counter-ico">
              <span class="ico-circle"><i class="ion-ribbon-a"></i></span>
            </div>
            <div class="counter-num">
              <p class="counter">36</p>
              <span class="counter-text">AWARD WON</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!--/ Section Contact-Footer Star /-->
  <section class="paralax-mf footer-paralax bg-image sect-mt4 route" style="background-image: url(img/contact-bg.jpg)">
    <div class="overlay-mf"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="contact-mf">
            <div id="contact" class="box-shadow-full">
             





			 <div class="row">
                <div class="col-md-6">
                  <div class="title-box-2">
                    <h5 class="title-left">
                      Send Message Us
                    </h5>
                  </div>
                  <div>
                      <div id="sendmessage">Your message has been sent. Thank you!</div>
                      <div id="errormessage"></div>
                      <div class="row">
                        <div class="col-md-12 mb-3">
                          <div class="form-group">
                            <input type="text" name="name" class="form-control" id="contectname" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                            <div class="validation"></div>
                          </div>
                        </div>
                        <div class="col-md-12 mb-3">
                          <div class="form-group">
                            <input type="email" class="form-control" name="email" id="contectemail" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                            <div class="validation"></div>
                          </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                              <div class="validation"></div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                          <div class="form-group">
                            <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                            <div class="validation"></div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <button class="button button-a button-big button-rouded">Send Message</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="title-box-2 pt-4 pt-md-0">
                    <h5 class="title-left">
                      Get in Touch
                    </h5>
                  </div>
                  <div class="more-info">
                    <p class="lead">
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis dolorum dolorem soluta quidem
                      expedita aperiam aliquid at.
                      Totam magni ipsum suscipit amet? Autem nemo esse laboriosam ratione nobis
                      mollitia inventore?
                    </p>
                    <ul class="list-ico">
                     
                      <li><span class="ion-ios-telephone"></span> +44 74620 40500</li>
                      <li><span class="ion-email"></span>info@u2marineservices.com</li>
                    </ul>
                  </div>
                  <div class="socials">
                    <ul>
                      <li><a href=""><span class="ico-circle"><i class="ion-social-facebook"></i></span></a></li>
                      <li><a href=""><span class="ico-circle"><i class="ion-social-instagram"></i></span></a></li>
                      <li><a href=""><span class="ico-circle"><i class="ion-social-twitter"></i></span></a></li>
                      <li><a href=""><span class="ico-circle"><i class="ion-social-pinterest"></i></span></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  
  
  
  
  


  <div class="modal fade" id="SignUp" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog " role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Register</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               </button>
            </div>
            <form method="POST" id="Register">
               <div class="modal-body">
			   
			   
                  <div class='alert alert-success' style="display:none" id="registersuccess-msg"></div>
				  
				   <div class="form-group has-feedback">
                     <div class="col-md-12">
                        <label class="radio-inline">
                        <input type="radio" value="candidate" name="candidatetype" checked> Candidate  
                        </label>
                        <label class="radio-inline"> &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio"  value="company" name="candidatetype"> Company
                        </label>                               
                     </div>
                  </div>
				  
				    
				  
				  <div class="form-group has-feedback" id='dobdiv'>
                     <input id="dob" class="form-control" name='dob' placeholder="DOB" />
                     <span class="glyphicon glyphicon-user form-control-feedback"></span>
                     <span class="text-danger">
                     <strong id="dob-error"></strong>
                     </span>
                  </div>
				  
	  <div class="form-group has-feedback">
                     <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name">
                     <span class="glyphicon glyphicon-user form-control-feedback"></span>
                     <span class="text-danger">
                     <strong id="name-error"></strong>
                     </span>
                  </div>

				  
				  
                  <!--<div class="form-group has-feedback" id='rankdiv' >
                     <input type="text" name="rank" value="{{ old('rank') }}" class="form-control" placeholder="Rank">
                     <span class="glyphicon glyphicon-user form-control-feedback"></span>
                     <span class="text-danger">
                     <strong id="rank-error"></strong>
                     </span>
                  </div>-->
                  <div class="form-group has-feedback">
                     <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                     <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                     <span class="text-danger">
                     <strong id="email-error"></strong>
                     </span>
                  </div>
                  <div class="form-group has-feedback">
                     <input type="password" name="password" class="form-control" placeholder="Password">
                     <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                     <span class="text-danger">
                     <strong id="password-error"></strong>
                     </span>
                  </div>
                  <div class="form-group has-feedback">
                     <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
                     <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                  </div>
               
                  <div class="modal-footer">
                     <button type="button" class="training_btnpopup btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="button" id="submitRegisterForm" class="training_btnpopup btn btn-primary btn-prime white btn-flat">Register</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!--begin::Modal-->
   <div class="modal fade" id="userLoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog " role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Login</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               </button>
            </div>
            <form method="POST" id='Login'>
               <div class="modal-body">
                  <div class='alert alert-success' style="display:none" id="loginsuccess-msg"></div>
                  <div class="form-group row">
                     <label for="email" class="login-modal col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                     <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <span class="text-danger">
                        <strong id="email-errorlogin"></strong>
                        </span>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                     <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <span class="text-danger">
                        <strong id="password-errorlogin"></strong>
                        </span>
                     </div>
                  </div>
                  <div class="modal-footer">
                     
                     <button type="button" id='submitLoginForm' class="training_btnpopup btn btn-primary">Login</button>
					 <button type="button" class="training_btnpopup btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>


   @include('layouts.footer')
   
   
   
   
     <script type="text/javascript">
      $('body').on('click', '#submitRegisterForm', function(){
      
      // $('#submitRegisterForm').on('submit', function(e) {	
            var registerForm = $("#Register");
            var formData = registerForm.serialize();
      
      
      
      
      $.ajaxSetup({
      	headers: {
      		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      	}
      });
      
      
            $( '#name-error' ).html( "" );
            $( '#email-error' ).html( "" );
            $( '#password-error' ).html( "" );
            $.ajax({
                url:'./registeruser',
                type:'POST',
                data:formData,
                success:function(data) {				
                    if(data.status=='fail') {  //alert('in if');					
                        if(data.errors.name){
                            $( '#name-error' ).html( data.errors.name[0] );
                        }
                        if(data.errors.email){
                            $( '#email-error' ).html( data.errors.email[0] );
                        }
                       // if(data.errors.rank){
                           // $( '#rank-error' ).html( data.errors.rank[0] );
                        //}
                        if(data.errors.dob){
                            $( '#dob-error' ).html( data.errors.dob[0] );
                        }
                        if(data.errors.password){
                            $( '#password-error' ).html( data.errors.password[0] );
                        }
                        
                    }
                    if(data.status=='success') { 
      		
      		
      		$("#registersuccess-msg").show()
      		 $('#registersuccess-msg').html( data.message);
      		
                        setTimeout(function(){  $('#registersuccess-msg').show();
						$("#Register").trigger('reset');
							 $('#registersuccess-msg').html('');
							 	$("#registersuccess-msg").hide();
                         $('#SignUp').modal('hide');
                           
						   
                        }, 3000);                 }
                },
            });
        }); 
      
      
      $('body').on('click', '#submitLoginForm', function(){
      
      // $('#submitRegisterForm').on('submit', function(e) {	
            var loginForm = $("#Login");
            var formData = loginForm.serialize();
      
      
      
      
      $.ajaxSetup({
      	headers: {
      		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      	}
      });
      
      
      
       
            $( '#email-errorlogin' ).html( "" );
            $( '#password-errorlogin' ).html( "" );
      
           // $( '#name-error' ).html( "" );
           // $( '#email-error' ).html( "" );
           // $( '#password-error' ).html( "" );
            $.ajax({
                url:'./loginuserfrm',
                type:'POST',
                data:formData,
                success:function(data) {				
                    if(data.status=='fail') {  //alert('in if');					
                        if(data.errors.email){
                            $( '#email-errorlogin' ).html( data.errors.email[0] );
                        }
                        if(data.errors.password){
                            $( '#password-errorlogin' ).html( data.errors.password[0] );
                        }
                        
                    }else if(data.status=='credentials') {  //alert('in if');					
                        if(data.message){
                            $( '#email-errorlogin' ).html( data.message);
                        }
                        
                    }
                    if(data.status=='success') { 
      		
      		 $("#loginsuccess-msg").show()
      		 $('#loginsuccess-msg').html( data.message);
      		
                        setInterval(function(){  $('#loginsuccess-msg').show();
                            $('#userLoginModal').modal('hide');
                           
      					var urlRoute ='dashboard';
         window.location.href = urlRoute; 
                        }, 3000);  
      	
                    }
                },
            });
        });
   </script>
   
     <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	
	
	    <script>
        $('#dob').datepicker({
            uiLibrary: 'bootstrap4',
			 format: 'yyyy-mm-dd'
        });
		
		
					  
				  $('input[type=radio][name=candidatetype]').change(function() {
    if (this.value == 'candidate') {
        $("#dobdiv").show(); 
		//$("#rankdiv").show();
    }
    else if (this.value == 'company') {
        $("#dobdiv").hide();
        //$("#rankdiv").hide();
    }
});
		
    </script>
	
	
</body>
@endsection