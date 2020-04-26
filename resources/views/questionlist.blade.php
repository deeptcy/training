@extends('layouts.admin') 
@section('content')
@php $scriptVer =  Config::get('constants.SCRIPT_VERSION'); @endphp
<!-- end::Head -->
<!-- begin::Body -->
 <meta name="_token" content="{{ csrf_token() }}" />
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
		<!-- begin:: Page -->
		<!-- begin:: Header Mobile -->
		   @include('layouts.adminmobileheader')	

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				@include('layouts.sidebar')	

				<!-- end:: Aside -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
				@include('layouts.adminheader')	
				
					<!-- end:: Header -->
					
			<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">	
					<!-- begin:: Content Head -->
						<div class="kt-subheader  kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
									<h3 class="kt-subheader__title"><i class="kt-font-brand flaticon-questions-circular-button"></i> &nbsp; Manage Questions</h3> 
									<!--	<span class="kt-subheader__separator kt-subheader__separator--v"></span>	-->
									
									<div class="kt-input-icon kt-input-icon--right kt-subheader__search kt-hidden">
										<input type="text" class="form-control" placeholder="Search order..." id="generalSearch">
										<span class="kt-input-icon__icon kt-input-icon__icon--right">
											<span><i class="flaticon2-search-1"></i></span>
										</span>
									</div>
								</div>
								<div class="kt-subheader__toolbar">
									<div class="kt-subheader__wrapper">	
										<button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal" data-target="#questionaddcsv_Modal">
                                        <i class="flaticon2-plus"></i> CSV Import
                                    </button> 									
										 <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal" data-target="#questionadd_Modal">
                                        <i class="flaticon2-plus"></i> Add Question
                                    </button>									
									</div>
								</div>
							</div>
						</div>

						<!-- end:: Content Head -->

                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
				<div id='ajaxmessagediv'></div>
                    <div class="kt-portlet kt-portlet--mobile">
                       
                        <div class="kt-portlet__body">

                            <!--begin: Search Form -->
                            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" class="form-control" placeholder="Search..." id="questiongeneralSearch">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                        <a href="#" class="btn btn-default kt-hidden">
                                            <i class="la la-cart-plus"></i> New Order
                                        </a>
                                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                                    </div>
                                </div>
                            </div>

                            <!--end: Search Form -->
                        </div>
                        <div class="kt-portlet__body kt-portlet__body--fit">

                            <!--begin: Datatable -->
                            <div class="kt-questiondatatable" id="kt_table_1"></div>

                            <!--end: Datatable -->
                        </div>
                    </div>
                </div>

                <!-- end:: Content -->

            </div>
            <!-- begin:: Footer -->
         @include('layouts.adminfooter')
            <!-- end:: Footer -->
        </div>
    </div>
    </div>
    <!-- end:: Page -->
    @include('layouts.adminotherpanels')

    <!--begin::Modal-->
    <div class="modal fade" id="questionaddcsv_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>

                </div>


 <form class="form-horizontal"  id='importquestionfrom'   enctype="multipart/form-data">
               <div class="modal-body">
				<div class="alert alert-danger" style="display:none" id='importquestionmessage'> </div>


							
					<div class="form-group">
					    <label for="course" class="form-control-label">Course :</label>
                        <select class="form-control" id="course_idParse" name="course_idParse">
                            @foreach($Courses as $Course)
								<option value="{{$Course['id']}}">{{$Course['name']}}</option>
							@endforeach
                        </select>
                    </div>					
							

                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                <label for="csv_file" class="col-md-4 control-label">CSV file to import</label>

                                <div class="col-md-6"><!--
                                    <input id="csv_file" type='file' name='file' id='file'  class="form-control" required>  -->
									
									<input required="" type="file" name="result_file" id="result_file" />


                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="header_added" id="header_added" > File contains header row?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Parse CSV
                                    </button>
                                </div>
                            </div>
							
					 </div>
                        </form>
						
				
				
				
            </div>
        </div>
    </div>	
    <!--end::Modal--> 


	<!--begin::Modal-->
    <div class="modal fade" id="questionadd_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>

                </div>

                {{ Form::open(array('method'=>'post','url' => 'questionadd', 'id'=>'questionadd')) }}
                <div class="modal-body">
				<div class="alert alert-danger" style="display:none" id='addquestionmessage'> </div>
                   



					<div class="form-group">
					    <label for="course" class="form-control-label">Course :</label>
                        <select class="form-control" id="course_id" name="course_id">
						@foreach($Courses as $Course)
							 <option value="{{$Course['id']}}">{{$Course['name']}}</option>
						@endforeach                           
                        </select>
                    </div>



				   <div class="form-group ">
                        <label for="question" class="form-control-label">Question:</label>
                        <input type="text" class="form-control" required='required'  id="question" id="question"placeholder="Your Question" data-rule="minlen:6,maxlen:10" data-msg="Please enter at least 6 chars">
                    </div>
					
					 <div class="form-group row">					 
						 <div class="col-sm-6">
							<label for="option_aEdit" class="form-control-label">Option A:</label>
							<input type="text" required='required' class="form-control" id="option_a" name="option_a"placeholder="Option A" data-rule="minlen:6" data-msg="Please enter at least 6 chars">
						</div> 
						
						<div class="col-sm-6">
							 <label for="option_b" class="form-control-label">Option B:</label>
                        <input type="text" required='required' class="form-control" id="option_b" name="option_b"placeholder="Option B" data-rule="minlen:6" data-msg="Please enter at least 6 chars">
						</div>
					
					</div>
				
					 <div class="form-group row">
					 <div class="col-sm-6">
                        <label for="option_c" class="form-control-label">Option C:</label>
                        <input type="text" required='required' class="form-control" id="option_c" name="option_c"placeholder="Option C" data-rule="minlen:6" data-msg="Please enter at least 6 chars">
						</div>
						
						<div class="col-sm-6">
						   <label for="option_d" class="form-control-label">Option D:</label>
                        <input type="text" required='required' class="form-control" id="option_d" name="option_d"placeholder="Option d" data-rule="minlen:6" data-msg="Please enter at least 6 chars">
                    </div>
                    </div>
					
					
					<div class="form-group">
                        <label for="correct_option" class="form-control-label">Correct Option:</label>
                        <input type="text" required='required' class="form-control" id="correct_option" name="correct_option" placeholder="Correct Option" data-rule="minlen:6" data-msg="Please enter at least 6 chars">
                    </div>
                   

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add </button>

                </div>
                <div class="modal-footer">

                </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <!--begin::Edit question Modal-->
    <div class="modal fade" id="questionedit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'questionedit', 'id'=>'questionedit')) }}
                <div class="modal-body">
				
				<div class="alert alert-danger" id='editquestionmessage'> </div>
                                            
										
					
					<div class="form-group">
					    <label for="course" class="form-control-label">Course :</label>
                        <select class="form-control" id="course_idEdit" name="course_idEdit">
                            @foreach($Courses as $Course)
								<option value="{{$Course['id']}}">{{$Course['name']}}</option>
							@endforeach
                        </select>
                    </div>					
										
										
											
                    <div class="form-group">
                        <label for="question" class="form-control-label">Question:</label>
                        <input type="text" required='required' class="form-control" id="questionEdit" name="questionEdit">
                        <input type='hidden' name='questionId' id='questionId'>
                    </div>
					
					
					 <div class="form-group row">
					 
					 <div class="col-sm-6">
                        <label for="option_aEdit" class="form-control-label">Option A:</label>
                        <input type="text" required='required' class="form-control" id="option_aEdit" name="option_aEdit">
						 </div>
						
						<div class="col-sm-6">  
						<label for="option_bEdit" class="form-control-label">Option B:</label>
                        <input type="text" required='required' class="form-control" id="option_bEdit" name="option_bEdit">   
                    </div></div>
					
					 <div class="form-group row">
					 
					 <div class="col-sm-6">
                        <label for="option_cEdit" class="form-control-label">Option C:</label>
                        <input type="text" required='required' class="form-control" id="option_cEdit" name="option_cEdit">
						</div>
						
						 <div class="col-sm-6"> <label for="option_dEdit" class="form-control-label">Option D:</label>
                        <input type="text" required='required' class="form-control" id="option_dEdit" name="option_dEdit">
                    </div>
					
                    </div>
					 
                       
					<div class="form-group">
                        <label for="correct_optionEdit" class="form-control-label">Correct Option:</label>
                        <input type="text" required='required' class="form-control" id="correct_optionEdit" name="correct_optionEdit">
                    </div>
					
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>

                </div>
                <div class="modal-footer">

                </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <!-- Confirm Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'questiondelete', 'id'=>'questiondelete')) }}
                <div class="modal-body">
                    Are you sure you want to delete this Question?
                    <input type='hidden' name='questionIdDelete' id='questionIdDelete'>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#2c77f4",
                    "light": "#ffffff",
                    "dark": "#282a3c",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>
    <!-- end::Global Config -->
    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="{{ asset('assetsadmin/plugins/global/plugins.bundle.js?v='.$scriptVer) }}" type="text/javascript"></script>

    <script src="{{ asset('assetsadmin/js/scripts.bundle.js?v='.$scriptVer) }}" type="text/javascript"></script>
    <!--end::Global Theme Bundle -->
    <!--begin::Page Vendors(used by this page)
   <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script> -->
    <!--end::Page Vendors -->
    <!--begin::Page Scripts(used by this page) 
   <script src="{{ asset('assets/js/pages/crud/datatables/data-sources/ajax-server-side1.js') }}" type="text/javascript"></script>-->

    <script src="{{ asset('assetsadmin/js/pages/crud/metronic-datatable/base/questions.js?v='.$scriptVer) }}" type="text/javascript"></script>

    <script>
        function userdetails(userId) {
            var urlRoute = 'questiondetail/' + questionId;
            window.location.href = urlRoute;

        }
    </script>
    <script>
        $('#importquestionfrom').on('submit', function(e) {
            e.preventDefault();
     		var file_data = $('#result_file').prop('files')[0];
        var header_added =  $('#header_added').is(":checked") ;
	var  course_idParse = $('#course_idParse').val();
	
	
        var form_data = new FormData();
        form_data.append('file', file_data);
		form_data.append('header_added', header_added);
		form_data.append('course_id', course_idParse);
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
	
	
            $.ajax({
                type: "POST",
                url: './import_parse',
                data: form_data,
            type: 'POST',
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,				  
                success: function(msg) {  
				var status = msg.status;
				if(status =='success'){				
                        $('#questionaddcsv_Modal').modal('toggle');
                        $('.kt-questiondatatable').KTDatatable().load();
				}else{ 

				//
				var errortype = msg.type; 
					if(errortype == 'duplicate'){
					errorString='';
						$.each( msg.data, function( key, value) {
							
								errorString +=  value +'<br/>' ;
							
						});
						$("#importquestionmessage").html("<strong>Duplicare Questions!  </strong> "+errorString);
						$("#importquestionmessage").slideDown(function() {
							setTimeout(function() {
								$("#importquestionmessage").slideUp();
							}, 8000);
						});
					}else if(errortype == 'answerlength'){
					errorString='Please check correct option length';
						
						$("#importquestionmessage").html("<strong>Error!  </strong> "+errorString);
						$("#importquestionmessage").slideDown(function() {
							setTimeout(function() {
								$("#importquestionmessage").slideUp();
							}, 8000);
						});
					}else{
						alert(JSON.stringify(msg, null, 1));
					}
				}				
                }
            });
        });   



		$('#questionadd').on('submit', function(e) {
            e.preventDefault();
            var question = $('#question').val();          
            var option_a = $('#option_a').val();
            var option_b = $('#option_b').val();
            var option_c = $('#option_c').val();
            var option_d = $('#option_d').val();
            var course_id = $('#course_id').val();
			
			
			var correctOption = $('#correct_option').val();	        
            $.ajax({
                type: "POST",
                url: './createquestion',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "question": question,
					"option_a": option_a,
					"option_b": option_b,
					"option_c": option_c,
					"option_d": option_d,
                    "correct_option": correctOption,
                    "course_id": course_id,
                },
                success: function(msg) {  
				var status = msg.status;
				if(status =='success'){				
                        $('#questionadd_Modal').modal('toggle');
                        $('.kt-questiondatatable').KTDatatable().load();
						
						$('#ajaxmessagediv').show(); 
							$('#ajaxmessagediv').html('<div class="alert alert-success alert-dismissible">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>  <strong>Success!</strong> Added Successfully.</div>');	
							setTimeout(function() {  $('#ajaxmessagediv').fadeOut('fast');}, 3000); 
				}else{
					
					
					errorString='';
						$.each( msg.message, function( key, value) {
							for(var l=0;l<value.length; l++){
								errorString +=  value[l] +'<br/>' ;
							}
						});
						$("#addquestionmessage").html("<strong>Error!</strong> "+errorString);
						$("#addquestionmessage").slideDown(function() {
							setTimeout(function() {
								$("#addquestionmessage").slideUp();
							}, 5000);
						});
					
				}				
                }
            });
        });
        $('#questionedit').on('submit', function(e) {
			
            e.preventDefault();
            var questionId = $('#questionId').val();
            var questionEdit = $('#questionEdit').val();			
			var option_aEdit = $('#option_aEdit').val();
            var option_bEdit = $('#option_bEdit').val();
            var option_cEdit = $('#option_cEdit').val();
            var option_dEdit = $('#option_dEdit').val();
            var course_idEdit = $('#course_idEdit').val();
			var correct_optionEdit = $('#correct_optionEdit').val();	
            $.ajax({
                type: "POST",
                url: './editquestion',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "questionId": questionId,
					"question": questionEdit,
					"option_a": option_aEdit,
					"option_b": option_bEdit,
					"option_c": option_cEdit,
					"option_d": option_dEdit,
                    "correct_option": correct_optionEdit,	
                    "course_id": course_idEdit,				
                },
                success: function(msg) {					
					var status = msg.status;
					if(status =='success'){				
							$('#questionedit_modal').modal('toggle');
							$('.kt-questiondatatable').KTDatatable().load();
							
							 $('#ajaxmessagediv').show(); 
							$('#ajaxmessagediv').html('<div class="alert alert-success alert-dismissible">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>  <strong>Success!</strong> Edit Successfully.</div>');	
							setTimeout(function() {  $('#ajaxmessagediv').fadeOut('fast');}, 3000); 
					}else{
						errorString='';
						$.each( msg.message, function( key, value) {
							for(var l=0;l<value.length; l++){
								errorString +=  value[l] +'<br/>' ;
							}
						});
						$("#editquestionmessage").html("<strong>Error!</strong> "+errorString);
						$("#editquestionmessage").slideDown(function() {
							setTimeout(function() {
								$("#editquestionmessage").slideUp();
							}, 5000);
						});
					}				
                }
            });

        });

        $('#questionedit_modal').on('show.bs.modal', function(e) {
			  $("#editquestionmessage").hide();
            var questionId = $(e.relatedTarget).data('id');
            var questionEdit = $(e.relatedTarget).data('question');
            var correct_optionEdit = $(e.relatedTarget).data('correct_option');
            var option_aEdit = $(e.relatedTarget).data('option_a');
            var option_bEdit = $(e.relatedTarget).data('option_b');
            var option_cEdit = $(e.relatedTarget).data('option_c');
            var option_dEdit = $(e.relatedTarget).data('option_d');	
			var course_idEdit = $(e.relatedTarget).data('course_id');	
  
			
            $("#questionId").val(questionId);
            $("#questionEdit").val(questionEdit);
            $("#correct_optionEdit").val(correct_optionEdit);			
            $("#option_aEdit").val(option_aEdit);
            $("#option_bEdit").val(option_bEdit);
            $("#option_cEdit").val(option_cEdit);
            $("#option_dEdit").val(option_dEdit);
            $("#course_idEdit").val(course_idEdit);
        });

        $('#deleteModal').on('show.bs.modal', function(e) {
            $("#questionIdDelete").val($(e.relatedTarget).data('id'));
        });

        $('#questiondelete').on('submit', function(e) {
            e.preventDefault();
            var questionIdDelete = $('#questionIdDelete').val();
            $.ajax({
                type: "POST",
                url: './deletequestion',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "questionIdDelete": questionIdDelete
                },
                success: function(msg) {
					
				
					
                    if (msg.status == 'fail') {
                        alert(JSON.stringify(msg.status, null, 1));
                    } else {
                       
                        $('#deleteModal').modal('toggle');
                        $('.kt-questiondatatable').KTDatatable().load();
						 $('#ajaxmessagediv').show(); 
							$('#ajaxmessagediv').html('<div class="alert alert-success alert-dismissible">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>  <strong>Success!</strong> Delete Successfully.</div>');	
							setTimeout(function() {  $('#ajaxmessagediv').fadeOut('fast');}, 3000); 
                    }          
					
                    
                }
            });
        });
    </script>
   </body>
<!-- end::Body -->
@endsection