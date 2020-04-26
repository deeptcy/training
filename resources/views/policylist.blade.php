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
									<h3 class="kt-subheader__title"><i class="kt-font-brand flaticon-layer"></i> &nbsp; Manage Policys</h3> 
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
										 <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal" data-target="#policyadd_Modal">
                                        <i class="flaticon2-plus"></i> Add Policy
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
                                                    <input type="text" class="form-control" placeholder="Search..." id="policygeneralSearch">
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
                            <div class="kt-policydatatable" id="kt_table_1"></div>

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
    <div class="modal fade" id="policyadd_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Policy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>

                </div>

                {{ Form::open(array('method'=>'post','url' => 'policyadd', 'id'=>'policyadd', 'enctype'=>"multipart/form-data")) }}
                <div class="modal-body">
				<div class="alert alert-danger" style="display:none" id='addpolicymessage'> </div>
                   

		
					
					
					
				   <div class="form-group">
                        <label for="policy" class="form-control-label">Policy:</label>
                        <input type="text" class="form-control" required='required'  name="title" id="title">
                    </div>
					
					 <div class="form-group">
                        <label for="option_aEdit" class="form-control-label">Description:</label>
                        <input type="text" required='required' class="form-control" id="qmsdesc" name="qmsdesc">
                    </div>
                
				 <div class="form-group">
				    <label for="option_aEdit" class="form-control-label">Choose File:</label>

            
	<input required="" type="file" name="policy_file"  class="form-control" id="policy_file" />
	
              
                </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Policy</button>

                </div>
                <div class="modal-footer">

                </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <!--begin::Edit policy Modal-->
    <div class="modal fade" id="policyedit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Policy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'policyedit', 'id'=>'policyedit')) }}
                <div class="modal-body">
				
				<div class="alert alert-danger" id='editpolicymessage'> </div>
                                            
				
											
                    <div class="form-group">
                        <label for="policy" class="form-control-label">Policy:</label>
                        <input type="text" required='required' class="form-control" id="policyEdit" name="policyEdit">
                        <input type='hidden' name='policyId' id='policyId'>
                    </div>
					 <div class="form-group">
                        <label for="option_aEdit" class="form-control-label">Description</label>
                        <input type="text" required='required' class="form-control" id="qmsdescEdit" name="qmsdescEdit">
                    </div>

					 <div class="form-group">
				    <label for="option_aEdit" class="form-control-label">Choose File:</label>

            
	<input  type="file" name="policy_fileEdit"  class="form-control" id="policy_fileEdit" />
	
              
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Policy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'policydelete', 'id'=>'policydelete')) }}
                <div class="modal-body">
                    Are you sure you want to delete this Policy?
                    <input type='hidden' name='policyIdDelete' id='policyIdDelete'>
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

    <script src="{{ asset('assetsadmin/js/pages/crud/metronic-datatable/base/policy.js?v='.$scriptVer) }}" type="text/javascript"></script>

    <script>
        function policydetail(userId) {
            var urlRoute = 'policydetail/' + policyId;
            window.location.href = urlRoute;

        }
    </script>
    <script>
       
		$('#policyadd').on('submit', function(e) {
			e.preventDefault();
			var file_data = $('#policy_file').prop('files')[0];
			var title = $('#title').val();      
            var qmsdesc = $('#qmsdesc').val();    		
        
			var form_data = new FormData();
			form_data.append('file', file_data);
			form_data.append('title', title);
			form_data.append('qmsdesc', qmsdesc);
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': $('meta[name=_token]').attr('content')
				}
			});
		
           $.ajax({
				type: "POST",
                url: './createpolicy',
				data: form_data,
			    contentType: false, // The content type used when sending data to the server.
				cache: false, // To unable request pages to be cached
				processData: false,	
                success: function(msg) {  
				var status = msg.status;
				if(status =='success'){				
                        $('#policyadd_Modal').modal('toggle');
                        $('.kt-policydatatable').KTDatatable().load();
						
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
						$("#addpolicymessage").html("<strong>Error!</strong> "+errorString);
						$("#addpolicymessage").slideDown(function() {
							setTimeout(function() {
								$("#addpolicymessage").slideUp();
							}, 3000);
						});
					
				}				
                }
            });
        });
        $('#policyedit').on('submit', function(e) {
			
            e.preventDefault();
			
				var file_data = $('#policy_fileEdit').prop('files')[0];
			 //var name = $('#name').val();      
          //  var courseid = $('#courseId').val();    		
           // var description = $('#description').val(); qmsdesc
			
            var policyId = $('#policyId').val();
            var policyEdit = $('#policyEdit').val();			
			var qmsdescEdit = $('#qmsdescEdit').val();
			  var form_data = new FormData();
			
        form_data.append('file', file_data);
		form_data.append('title', policyEdit);
		form_data.append('policyId', policyId);
	
		form_data.append('qmsdesc', qmsdescEdit);
			
			
			  $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
		
            	      
            $.ajax({
                type: "POST",
                url: './editpolicy',
                data: form_data,
			          contentType: false, // The content type used when sending data to the server.
                  cache: false, // To unable request pages to be cached
            processData: false,	
			success: function(msg) {					
					var status = msg.status;
					if(status =='success'){				
							$('#policyedit_modal').modal('toggle');
							$('.kt-policydatatable').KTDatatable().load();
							
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
						$("#editpolicymessage").html("<strong>Error!</strong> "+errorString);
						$("#editpolicymessage").slideDown(function() {
							setTimeout(function() {
								$("#editpolicymessage").slideUp();
							}, 3000);
						});
					}				
                }
            });

        });




        $('#policyedit_modal').on('show.bs.modal', function(e) {
			
			$("#editpolicymessage").hide();
            var policyId = $(e.relatedTarget).data('id');
            var policyEdit = $(e.relatedTarget).data('title');
            var qmsdescEdit = $(e.relatedTarget).data('description');
            
		
           $("#policyId").val(policyId);
            $("#policyEdit").val(policyEdit);
            			
            $("#qmsdescEdit").val(qmsdescEdit);
            
        });

        $('#deleteModal').on('show.bs.modal', function(e) {
            $("#policyIdDelete").val($(e.relatedTarget).data('id'));
        });

        $('#policydelete').on('submit', function(e) {
            e.preventDefault();
            var policyIdDelete = $('#policyIdDelete').val();
            $.ajax({
                type: "POST",
                url: './deletepolicy',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "policyIdDelete": policyIdDelete
                },
                success: function(msg) {
					
				
					
                    if (msg.status == 'fail') {
                        alert(JSON.stringify(msg.status, null, 1));
                    } else {
                       
                        $('#deleteModal').modal('toggle');
                        $('.kt-policydatatable').KTDatatable().load();
						
						
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