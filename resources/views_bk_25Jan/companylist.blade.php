@extends('layouts.admin') 
@section('content')
@php $scriptVer =  Config::get('constants.SCRIPT_VERSION'); @endphp
<!-- end::Head -->
<!-- begin::Body -->

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
									<h3 class="kt-subheader__title">Manage Company</h3> 
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
										 <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal" data-target="#addCompanyModal">
                                        <i class="flaticon2-plus"></i> Add Company
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
                                                    <input type="text" class="form-control" placeholder="Search..." id="companygeneralSearch">
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
                            <div class="kt-companydatatable" id="kt_table_company"></div>

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
    <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>

                </div>

                {{ Form::open(array('method'=>'post','url' => 'companyadd', 'id'=>'companyadd')) }}
                <div class="modal-body">
				
								<div class="alert alert-danger"  style="display:none"  id='addcompanymessage'> </div>

                    <div class="form-group">
                        <label for="company-name" class="form-control-label">Name:</label>
                        <input type="text" class="form-control" required id="companyName" id="companyName">
                    </div>
                    <div class="form-group">
                        <label for="company-email" class="form-control-label">Email:</label>
                        <input type="text" class="form-control" id="companyEmail" id="companyEmail">
                    </div>
                   <!-- <div class="form-group">
                        <select multiple class="form-control" id="companyRoles" name="companyRoles">
                            <option value="agent">Agent</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>-->
                    <div class="form-group">
                        <label for="company-password" class="form-control-label">Password:</label>
                        <input type="password" class="form-control" id="companyPassword" name="companyPassword">
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Company</button>

                </div>
                <div class="modal-footer">

                </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <!--begin::Edit company Modal-->
    <div class="modal fade" id="companyedit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
			
												

                <div class="modal-header">
				

                    <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'companyedit', 'id'=>'companyedit')) }}
                <div class="modal-body">
				
							<div class="alert alert-danger" id='editcompanyemessage'> </div>
                    <div class="form-group">
                        <label for="company-name" class="form-control-label">Name:</label>
                        <input type="text"  maxlength='10' class="form-control" id="companyNameEdit" name="companyNameEdit">
                        <input type='hidden' name='companyId' id='companyId'>
                    </div>
                    <div class="form-group">
                        <label for="company-email" required='required'   class="form-control-label">Email:</label>
                        <input type="text" class="form-control" id="companyEmailEdit" name="companyEmailEdit">
                    </div>
                    <!--<div class="form-group">
                        <label for="company-email" class="form-control-label">Role:</label>
                        <select multiple class="form-control" id="companyRoleEdit" name="companyRoleEdit">
                            <option value="agent">Agent</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>-->

                    <div class="form-group">
                        <label for="company-email" class="form-control-label">Password:</label>
                        <input type="password" placeholder='*********' class="form-control" id="companyPasswordEdit" id="companyPasswordEdit">
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Company</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'companydelete', 'id'=>'companydelete')) }}
                <div class="modal-body">
                    Are you sure you want to delete this company?
                    <input type='hidden' name='companyIdDelete' id='companyIdDelete'>
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

    <script src="{{ asset('assetsadmin/js/pages/crud/metronic-datatable/base/company.js?v='.$scriptVer) }}" type="text/javascript"></script>

    <script>
        function companydetails(companyId) {
            var urlRoute = 'companydetail/' + companyId;
            window.location.href = urlRoute;

        }
    </script>
	 
    <script>
        $('#companyadd').on('submit', function(e) {
            e.preventDefault();
            var companyName = $('#companyName').val();
            var companyEmail = $('#companyEmail').val();
            //var companyRoles = $('#companyRoles').val();
            var companyPassword = $('#companyPassword').val();
            $.ajax({
                type: "POST",
                url: './createcompany',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "companyName": companyName,
                    "companyEmail": companyEmail,
                    //"companyRoles": companyRoles,
                    "companyPassword": companyPassword
                },
                success: function(msg) {
					var status = msg.status;
					if(status =='success'){				
							$('#addCompanyModal').modal('toggle');
							$('.kt-companydatatable').KTDatatable().load();
							 $('#ajaxmessagediv').show(); 
							
								$('#ajaxmessagediv').html('<div class="alert alert-success alert-dismissible">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>  <strong>Success!</strong>  Added Successfully.</div>');	
							setTimeout(function() {  $('#ajaxmessagediv').fadeOut('fast');}, 3000); 
							
							


					}else{
						errorString='';
						$.each( msg.message, function( key, value) {
							for(var l=0;l<value.length; l++){
								errorString +=  value[l] +'<br/>' ;
							}
						});
						$("#addcompanymessage").html("<strong>Error!</strong> "+errorString);
						$("#addcompanymessage").slideDown(function() {
							setTimeout(function() {
								
								$("#addcompanymessage").slideUp();
								
							}, 3000);
							$("#addCompanyModal").trigger('reset');
						});
					}
					/*
					 var obj = JSON.parse(msg);
					
                    if (obj.status == 'fail') {
                        alert(JSON.stringify(obj.message, null, 1));
                    } else {
                        alert('Added ' + obj.status);
                        $('#addCompanyModal').modal('toggle');
                        $('.kt-companydatatable').KTDatatable().load();
                    }  */
                }
            });
        });
        $('#companyedit').on('submit', function(e) {
			
            e.preventDefault();
            var companyId = $('#companyId').val();
            var companyNameEdit = $('#companyNameEdit').val();
            var companyEmailEdit = $('#companyEmailEdit').val();
			//var companyRoleEdit = $('#companyRoleEdit').val();
            var companyPasswordEdit = $('#companyPasswordEdit').val();
            $.ajax({
                type: "POST",
                url: './editcompany',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "companyId": companyId,
                    "companyNameEdit": companyNameEdit,
                    "companyEmailEdit": companyEmailEdit,
                    //"companyRoleEdit": companyRoleEdit,
                    "companyPasswordEdit": companyPasswordEdit				
                },
                success: function(msg) {				
					var status = msg.status;
					if(status =='success'){		
							$('#companyedit_modal').modal('toggle');
							$('.kt-companydatatable').KTDatatable().load();
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
						
						$("#editcompanyemessage").html("<strong>Error!</strong> "+errorString);
						$("#editcompanyemessage").slideDown(function() {
							setTimeout(function() {
								$("#editcompanyemessage").slideUp();
							}, 3000);
						});
					}				
                }
            });

        });
		$('#companyedit_modal').on('show.bs.modal', function(e) {
			  $("#editcompanyemessage").hide();
            var companyId = $(e.relatedTarget).data('id');
            var companyNameEdit = $(e.relatedTarget).data('name');
            var companyEmailEdit = $(e.relatedTarget).data('email');
           // var roles = $(e.relatedTarget).data('roles');				 
			/*var rolesArray = roles.split(",");	

             $('#companyRoleEdit option[value=admin]').attr('selected',false);
			 $('#companyRoleEdit option[value=agent]').attr('selected',false);
			 
			rolesArray.forEach(function(item){
			if(item=='Admin'){
			 $('#companyRoleEdit option[value=admin]').attr('selected','selected');
			}if(item=='Agent'){
			 $('#companyRoleEdit option[value=agent]').attr('selected','selected');
			}
			});	*/
			
            $("#companyId").val(companyId);
            $("#companyNameEdit").val(companyNameEdit);
            $("#companyEmailEdit").val(companyEmailEdit);
        });

		
		
		
		
		
		
        $('#deleteModal').on('show.bs.modal', function(e) {
            $("#companyIdDelete").val($(e.relatedTarget).data('id'));
        });

        $('#companydelete').on('submit', function(e) {
            e.preventDefault();
            var companyIdDelete = $('#companyIdDelete').val();
            $.ajax({
                type: "POST",
                url: './deletecompany',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "companyIdDelete": companyIdDelete
                },
                success: function(msg) {    // 			  $("#editcompanyemessage").hide();

					
					//var obj = JSON.parse(msg);
					
                    if (msg.status == 'fail') {
                        //alert(JSON.stringify(obj.message, null, 1));
                    } else {
                       // alert('Company deleted ' + obj.status);
                        $('#deleteModal').modal('toggle');
                        $('.kt-companydatatable').KTDatatable().load();
						$('#ajaxmessagediv').show(); 
							$('#ajaxmessagediv').html('<div class="alert alert-success alert-dismissible">  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>  <strong>Success!</strong> Delete Successfully.</div>');	
							setTimeout(function() {  $('#ajaxmessagediv').fadeOut('fast');}, 3000);
                    }          
					
                    
                }
            });
        });

        /*
 $("#btnConfirm").on("click", function(){  	
   alert('code to delete company');
  });    */
    </script>
    <!-- end::Global Config -->
    <!--begin::Global Theme Bundle(used by all pages) 
      <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
      <script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
      -->
    <!--end::Global Theme Bundle -->
    <!--begin::Page Scripts(used by this page) 
      <script src="{{ asset('assets/js/data-ajax1.js') }}" type="text/javascript"></script>-->
    <!--end::Page Scripts -->
</body>
<!-- end::Body -->
@endsection