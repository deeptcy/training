@extends('layouts.admin') 
@section('content')
@php $scriptVer =  Config::get('constants.SCRIPT_VERSION'); @endphp
<!-- end::Head -->
<!-- begin::Body -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <!-- begin:: Page -->
    @include('layouts.adminmobileheader')
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            @include('layouts.sidebar')
        </div>
        <!-- end:: Aside -->
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            @include('layouts.adminheader')
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

                <!-- begin:: Content -->
                <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon-presentation"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
											Manage Trainer
										</h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal" data-target="#addTrainerModal">
                                        <i class="flaticon2-plus"></i> Add Trainer
                                    </button>

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
                                                    <input type="text" class="form-control" placeholder="Search..." id="trainergeneralSearch">
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
                            <div class="kt-trainerdatatable" id="kt_table_1"></div>

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
    <div class="modal fade" id="addTrainerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Trainer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>

                </div>

                {{ Form::open(array('method'=>'post','url' => 'traineradd', 'id'=>'traineradd')) }}
                <div class="modal-body">
				
								<div class="alert alert-danger"  style="display:none"  id='addtrainermessage'> </div>

                    <div class="form-group">
                        <label for="trainer-name" class="form-control-label">Name:</label>
                        <input type="text" class="form-control" required id="trainerName" id="trainerName">
                    </div>
                    <div class="form-group">
                        <label for="trainer-email" class="form-control-label">Email:</label>
                        <input type="text" class="form-control" id="trainerEmail" id="trainerEmail">
                    </div>
                    <!--<div class="form-group">
                        <select multiple class="form-control" id="trainerRoles" name="trainerRoles">
                            <option value="agent">Agent</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>-->
                    <div class="form-group">
                        <label for="trainer-password" class="form-control-label">Password:</label>
                        <input type="password" class="form-control" id="trainerPassword" name="trainerPassword">
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

    <!--begin::Edit trainer Modal-->
    <div class="modal fade" id="traineredit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
			
												

                <div class="modal-header">
				

                    <h5 class="modal-title" id="exampleModalLabel">Edit Trainer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'traineredit', 'id'=>'traineredit')) }}
                <div class="modal-body">
				
							<div class="alert alert-danger" id='edittraineremessage'> </div>
                    <div class="form-group">
                        <label for="trainer-name" class="form-control-label">Name:</label>
                        <input type="text" required='required' class="form-control" id="trainerNameEdit" name="trainerNameEdit">
                        <input type='hidden' name='trainerId' id='trainerId'>
                    </div>
                    <div class="form-group">
                        <label for="trainer-email" required='required'   class="form-control-label">Email:</label>
                        <input type="text" class="form-control" id="trainerEmailEdit" name="trainerEmailEdit">
                    </div>
                   <!-- <div class="form-group">
                        <label for="trainer-email" class="form-control-label">Role:</label>
                        <select multiple class="form-control" id="trainerRoleEdit" name="trainerRoleEdit">
                            <option value="agent">Agent</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>-->

                    <div class="form-group">
                        <label for="trainer-email" class="form-control-label">Password:</label>
                        <input type="password" placeholder='*********' class="form-control" id="trainerPasswordEdit" id="trainerPasswordEdit">
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Trainer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'trainerdelete', 'id'=>'trainerdelete')) }}
                <div class="modal-body">
                    Are you sure you want to delete this trainer?
                    <input type='hidden' name='trainerIdDelete' id='trainerIdDelete'>
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

    <script src="{{ asset('assetsadmin/js/pages/crud/metronic-datatable/base/trainer.js?v='.$scriptVer) }}" type="text/javascript"></script>

    <script>
        function trainerdetails(trainerId) {
            var urlRoute = 'trainerdetail/' + trainerId;
            window.location.href = urlRoute;

        }
    </script>
	 
    <script>
        $('#traineradd').on('submit', function(e) {
            e.preventDefault();
            var trainerName = $('#trainerName').val();
            var trainerEmail = $('#trainerEmail').val();
            //var trainerRoles = $('#trainerRoles').val();
            var trainerPassword = $('#trainerPassword').val();
            $.ajax({
                type: "POST",
                url: './createtrainer',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "trainerName": trainerName,
                    "trainerEmail": trainerEmail,
                    //"trainerRoles": trainerRoles,
                    "trainerPassword": trainerPassword
                },
                success: function(msg) {
					var status = msg.status;
					if(status =='success'){				
							$('#addTrainerModal').modal('toggle');
							$('.kt-trainerdatatable').KTDatatable().load();
					}else{
						
						
						errorString='';
						$.each( msg.message, function( key, value) {
							for(var l=0;l<value.length; l++){
								errorString +=  value[l] +'<br/>' ;
							}
						});
						$("#addtrainermessage").html("<strong>Error!</strong> "+errorString);
						$("#addtrainermessage").slideDown(function() {
							setTimeout(function() {
								$("#addtrainermessage").slideUp();
							}, 5000);
						});
					}
					/*
					 var obj = JSON.parse(msg);
					
                    if (obj.status == 'fail') {
                        alert(JSON.stringify(obj.message, null, 1));
                    } else {
                        alert('Added ' + obj.status);
                        $('#addTrainerModal').modal('toggle');
                        $('.kt-trainerdatatable').KTDatatable().load();
                    }  */
                }
            });
        });
		
		
		
		
		
		$('#traineredit').on('submit', function(e) {
			
            e.preventDefault();
            var trainerId = $('#trainerId').val();
            var trainerNameEdit = $('#trainerNameEdit').val();
            var trainerEmailEdit = $('#trainerEmailEdit').val();
			//var trainerRoleEdit = $('#trainerRoleEdit').val();
            var trainerPasswordEdit = $('#trainerPasswordEdit').val();
            $.ajax({
                type: "POST",
                url: './edittrainer',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "trainerId": trainerId,
                    "trainerNameEdit": trainerNameEdit,
                    "trainerEmailEdit": trainerEmailEdit,
                    //"trainerRoleEdit": trainerRoleEdit,
                    "trainerPasswordEdit": trainerPasswordEdit				
                },
                success: function(msg) {				
					var status = msg.status;
					if(status =='success'){		
							$('#traineredit_modal').modal('toggle');
							$('.kt-trainerdatatable').KTDatatable().load();
							
					}else{
						
						errorString='';
						$.each( msg.message, function( key, value) {
							for(var l=0;l<value.length; l++){
								errorString +=  value[l] +'<br/>' ;
							}
							
						});
						
						$("#edittraineremessage").html("<strong>Error!</strong> "+errorString);
						$("#edittraineremessage").slideDown(function() {
							setTimeout(function() {
								$("#edittraineremessage").slideUp();
							}, 5000);
						});
					}				
                }
            });

        });
		$('#traineredit_modal').on('show.bs.modal', function(e) {
			  $("#edittraineremessage").hide();
            var trainerId = $(e.relatedTarget).data('id');
            var trainerNameEdit = $(e.relatedTarget).data('name');
            var trainerEmailEdit = $(e.relatedTarget).data('email');
            var roles = $(e.relatedTarget).data('roles');				 
			/*var rolesArray = roles.split(",");	

             $('#trainerRoleEdit option[value=admin]').attr('selected',false);
			 $('#trainerRoleEdit option[value=agent]').attr('selected',false);
			 
			rolesArray.forEach(function(item){
			if(item=='Admin'){
			 $('#trainerRoleEdit option[value=admin]').attr('selected','selected');
			}if(item=='Agent'){
			 $('#trainerRoleEdit option[value=agent]').attr('selected','selected');
			}
			});	*/		
            $("#trainerId").val(trainerId);
            $("#trainerNameEdit").val(trainerNameEdit);
            $("#trainerEmailEdit").val(trainerEmailEdit);
        });
        

     
        $('#deleteModal').on('show.bs.modal', function(e) {
            $("#trainerIdDelete").val($(e.relatedTarget).data('id'));
        });

        $('#trainerdelete').on('submit', function(e) {
            e.preventDefault();
            var trainerIdDelete = $('#trainerIdDelete').val();
            $.ajax({
                type: "POST",
                url: './deletetrainer',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "trainerIdDelete": trainerIdDelete
                },
                success: function(msg) {    // 			  $("#edittraineremessage").hide();

					
					//var obj = JSON.parse(msg);
					
                    if (msg.status == 'fail') {
                        //alert(JSON.stringify(obj.message, null, 1));
                    } else {
                        //alert('Trainer deleted ' + obj.status);
                        $('#deleteModal').modal('toggle');
                        $('.kt-trainerdatatable').KTDatatable().load();
                    }          
					
                    
                }
            });
        });

        /*
 $("#btnConfirm").on("click", function(){  	
   alert('code to delete trainer');
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