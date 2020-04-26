@extends('layouts.home')
@section('content')
<body id="page-top">
   @include('layouts.headerinner')











<div class="space"></div>
<div class="space"></div>


	<div class="container mt-15">
      <div class="row">
        <div class="col-sm-12">
          <div class="contact-mf">
            <div  class="box-shadow-full">		
				<div class="row">
					<div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12 about-txt text-left">
						<!--
						<ul class="nav nav-tabs">
						  <li class="nav-item">
							<a class="nav-link active" href="#">Active</a>
						  </li>
						  <li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
							<div class="dropdown-menu">
							  <a class="dropdown-item" href="#">Action</a>
							  <a class="dropdown-item" href="#">Another action</a>
							  <a class="dropdown-item" href="#">Something else here</a>
							  <div class="dropdown-divider"></div>
							  <a class="dropdown-item" href="#">Separated link</a>
							</div>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" href="#">Link</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link disabled" href="#">Disabled</a>
						  </li>
						</ul>
						-->	
						
						<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item">
							<a class="nav-link active" id="manual-tab" data-toggle="tab" href="#manual" role="tab" aria-controls="manual" aria-selected="true">Manual</a>
						  </li>
						  
						  <li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Internal Audit</a>
							<div class="dropdown-menu">							  	 
							<a class="nav-link" id="schedule-tab" data-toggle="tab" href="#schedule" role="tab" aria-controls="schedule" aria-selected="false">Schedule</a>							
							<a class="nav-link" id="qa-tab" data-toggle="tab" href="#qa" role="tab" aria-controls="qa" aria-selected="false">Quality Audit (NC)</a>					
							</div>
						  </li>					
						  <li class="nav-item">
							<a class="nav-link" id="moc-tab" data-toggle="tab" href="#moc" role="tab" aria-controls="moc" aria-selected="false">MoC</a>
						  </li>						  
						  <li class="nav-item">
							<a class="nav-link" id="competencylist-tab" data-toggle="tab" href="#competencylist" role="tab" aria-controls="competencylist" aria-selected="false">Competency List</a>
						  </li>						  
						  <li class="nav-item">
							<a class="nav-link" id="reviewmeeting-tab" data-toggle="tab" href="#reviewmeeting" role="tab" aria-controls="reviewmeeting" aria-selected="false">Management Review Meeting</a>
						  </li>						  
												  
						  <li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Form</a>
							<div class="dropdown-menu">							  	 
							<a class="nav-link" id="nc-tab" data-toggle="tab" href="#nc" role="tab" aria-controls="nc" aria-selected="false">Non-Conformity</a>							
							<a class="nav-link" id="cf-tab" data-toggle="tab" href="#cf" role="tab" aria-controls="cf" aria-selected="false">Customer Feedback</a>					
							</div>
						  </li>						  
						</ul>
						
						
						<div class="tab-content" id="myTabContent" style="min-height:400px">
						  <div class="tab-pane fade show active" id="manual" role="tabpanel" aria-labelledby="manual-tab">manual </div>		
						  <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="profile-tab">schedule</div>		
						  <div class="tab-pane fade" id="qa" role="tabpanel" aria-labelledby="profile-tab">Quality Audit</div>					  
						  <div class="tab-pane fade" id="moc" role="tabpanel" aria-labelledby="moc-tab">moc</div>						  
						  <div class="tab-pane fade" id="competencylist" role="tabpanel" aria-labelledby="frm-tab">competencylist</div>			  
						  <div class="tab-pane fade" id="frm" role="tabpanel" aria-labelledby="frm-tab">frm</div>		  
						  <div class="tab-pane fade" id="reviewmeeting" role="tabpanel" aria-labelledby="reviewmeeting-tab">reviewmeeting</div>
						  <div class="tab-pane fade" id="nc" role="tabpanel" aria-labelledby="contact-tab">Non-Conformity</div>
						  <div class="tab-pane fade" id="cf" role="tabpanel" aria-labelledby="contact-tab">Customer Feedback</div>
						</div>
						
						
						
					</div> 
				</div>
			</div>
		  </div>
		</div>
	  </div>
	</div>










  
  
  
  
  


   @include('layouts.footer')
   

   
   
     <script type="text/javascript">




	 </script>

	
	
</body>
@endsection