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
									<h3 class="kt-subheader__title"><i class="kt-font-brand flaticon-users-1"></i> &nbsp; Manage Candidate Courses</h3> 
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
										 <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal" data-target="#addUserModal">
                                        <i class="flaticon2-plus"></i> Add Courses
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
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-list"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
											Courses
										</h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    
									
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">

                            <!--begin: Search Form -->
                            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" class="form-control" placeholder="Search..." id="coursegeneralSearch">
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
                            <div class="kt-coursedatatable" id="kt_table_1"></div>

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

   


	<!--begin::Add Modal-->
    <div class="modal fade" id="courseadd_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>

                </div>

                {{ Form::open(array('method'=>'post','url' => 'courseadd', 'id'=>'courseadd')) }}
                <div class="modal-body">
				<div class="alert alert-danger" style="display:none" id='addcoursemessage'> </div>
                   
					<div class="form-group">
					    <label for="course" class="form-control-label">Course Type:</label>
                        <select class="form-control" id="course_type" name="course_type">
                            <option value="Basic">Basic</option>
                            <option value="Advanced">Advance</option>
                        </select>
                    </div>


				    <div class="form-group">
                        <label for="course" class="form-control-label">Course:</label>
                        <input type="text" class="form-control" required='required'  id="name" id="name">
                    </div>
					
					 <div class="form-group">
                        <label for="option_aEdit" class="form-control-label">Description:</label>
                        <input type="text" required='required' class="form-control" id="description" name="description">
                    </div>
                
				
					
					<div class="form-group">
                        <label for="course" class="form-control-label">Price:</label>
                        <input type="text" class="form-control" required='required'  id="cost" id="cost">
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Course</button>

                </div>
                <div class="modal-footer">

                </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <!--begin::Edit course Modal-->
    <div class="modal fade" id="courseedit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'courseedit', 'id'=>'courseedit')) }}
                <div class="modal-body">
				
				<div class="alert alert-danger" id='editcoursemessage'> </div>
                                            
					<div class="form-group">
					    <label for="course" class="form-control-label">Course Type:</label>
                        <select class="form-control" id="course_typeEdit" name="course_typeEdit">
                            <option value="Basic">Basic</option>
                            <option value="Advanced">Advance</option>
                        </select>
                    </div>

					
											
                    <div class="form-group">
                        <label for="course" class="form-control-label">Course:</label>
                        <input type="text" required='required' class="form-control" id="courseEdit" name="courseEdit">
                        <input type='hidden' name='courseId' id='courseId'>
                    </div>
					 <div class="form-group">
                        <label for="option_aEdit" class="form-control-label">Description</label>
                        <input type="text" required='required' class="form-control" id="descriptionEdit" name="descriptionEdit">
                    </div>
					<div class="form-group">
                        <label for="course" class="form-control-label">Price:</label>
                        <input type="text" class="form-control" required='required'  id="costEdit" id="costEdit">
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'coursedelete', 'id'=>'coursedelete')) }}
                <div class="modal-body">
                    Are you sure you want to delete this Course?
                    <input type='hidden' name='courseIdDelete' id='courseIdDelete'>
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

    <script src="{{ asset('assetsadmin/js/pages/crud/metronic-datatable/base/candidatecourses.js?v='.$scriptVer) }}" type="text/javascript"></script>

    <script>
        function userdetails(userId) {
            var urlRoute = 'coursedetail/' + courseId;
            window.location.href = urlRoute;

        }
    </script>
    <script>
       


		$('#courseadd').on('submit', function(e) {
            e.preventDefault();
            var name = $('#name').val();          
            var description = $('#description').val();
			  var course_type = $('#course_type').val();  
			  var cost = $('#cost').val();   
				
            $.ajax({
                type: "POST",
                url: './createcourse',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": name,
					"description": description,
					"cost": cost,
					"course_type": course_type,

                },
                success: function(msg) {  
				var status = msg.status;
				if(status =='success'){				
                        $('#courseadd_Modal').modal('toggle');
                        $('.kt-coursedatatable').KTDatatable().load();
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
						$("#addcoursemessage").html("<strong>Error!</strong> "+errorString);
						$("#addcoursemessage").slideDown(function() {
							setTimeout(function() {
								$("#addcoursemessage").slideUp();
							}, 3000);
						});
					
				}				
                }
            });
        });
        $('#courseedit').on('submit', function(e) {
            e.preventDefault();
            var courseId = $('#courseId').val();
            var courseEdit = $('#courseEdit').val();			
			var descriptionEdit = $('#descriptionEdit').val();
			
			var course_typeEdit = $('#course_typeEdit').val();	
			var costEdit = $('#costEdit').val();	
				 
            $.ajax({
                type: "POST",
                url: './editcourse',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "courseId": courseId,
					"name": courseEdit,
					"description": descriptionEdit,
					"course_type": course_typeEdit,
					"cost": costEdit,
								
                },
                success: function(msg) {					
					var status = msg.status;
					if(status =='success'){				
							$('#courseedit_modal').modal('toggle');
							$('.kt-coursedatatable').KTDatatable().load();
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
						$("#editcoursemessage").html("<strong>Error!</strong> "+errorString);
						$("#editcoursemessage").slideDown(function() {
							setTimeout(function() {
								$("#editcoursemessage").slideUp();
							}, 3000);
						});
					}				
                }
            });

        });

        $('#courseedit_modal').on('show.bs.modal', function(e) {
			  $("#editcoursemessage").hide();
            var courseId = $(e.relatedTarget).data('id');
            var courseEdit = $(e.relatedTarget).data('name');            
            var descriptionEdit = $(e.relatedTarget).data('description');
              var course_typeEdit = $(e.relatedTarget).data('course_type'); 
			  var costEdit = $(e.relatedTarget).data('cost');  
			  
			  
            $("#courseId").val(courseId);
            $("#courseEdit").val(courseEdit);            			
            $("#descriptionEdit").val(descriptionEdit);
			
			$("#course_typeEdit").val(course_typeEdit);       
			$("#costEdit").val(costEdit); 
        });

        $('#deleteModal').on('show.bs.modal', function(e) {
            $("#courseIdDelete").val($(e.relatedTarget).data('id'));
        });

        $('#coursedelete').on('submit', function(e) {
            e.preventDefault();
            var courseIdDelete = $('#courseIdDelete').val();
            $.ajax({
                type: "POST",
                url: './deletecourse',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "courseIdDelete": courseIdDelete
                },
                success: function(msg) {					
                    if (msg.status == 'fail') {
                        alert(JSON.stringify(msg.status, null, 1));
                    } else {
                       
                        $('#deleteModal').modal('toggle');
                        $('.kt-coursedatatable').KTDatatable().load();
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