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
									<h3 class="kt-subheader__title"><i class="kt-font-brand flaticon-layer"></i> &nbsp; Manage Manuals</h3> 
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
										 <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal" data-target="#manualadd_Modal">
                                        <i class="flaticon2-plus"></i> Add Manual
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
                                                    <input type="text" class="form-control" placeholder="Search..." id="manualgeneralSearch">
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
                            <div class="kt-manualdatatable" id="kt_table_1"></div>

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
    <div class="modal fade" id="manualadd_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Manual</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>

                </div>

                {{ Form::open(array('method'=>'post','url' => 'manualadd', 'id'=>'manualadd', 'enctype'=>"multipart/form-data")) }}
                <div class="modal-body">
				<div class="alert alert-danger" style="display:none" id='addmanualmessage'> </div>
                   
					
				    <div class="form-group">
                        <label for="manual" class="form-control-label">Manual:</label>
                        <input type="text" class="form-control" required='required'  name="manual_title" id="manual_title">
                    </div>					
					<div class="form-group">
                        <label for="option_aEdit" class="form-control-label">Description:</label>                     
						<textarea name="manual_text"  id="manual_text" class="summernote" rows="18"></textarea>
                    </div>			

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Manual</button>

                </div>
                <div class="modal-footer">

                </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <!--begin::Edit manual Modal-->
    <div class="modal fade" id="manualedit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Manual</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'manualedit', 'id'=>'manualedit')) }}
                <div class="modal-body">
				
				<div class="alert alert-danger" id='editmanualmessage'> </div>
                                            
				
											
                    <div class="form-group">
                        <label for="manual" class="form-control-label">Manual:</label>
                             <input type="text" class="form-control" required='required'  name="manual_titleEdit" id="manual_titleEdit">
                        <input type='hidden' name='manualId' id='manualId'>
                    </div>
					 <div class="form-group">
                        <label for="option_aEdit" class="form-control-label">Description</label>
						
							<textarea name="manual_textEdit"  id="manual_textEdit" class="summernote" rows="18"></textarea>
							
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Manual</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'manualdelete', 'id'=>'manualdelete')) }}
                <div class="modal-body">
                    Are you sure you want to delete this Manual?
                    <input type='hidden' name='manualIdDelete' id='manualIdDelete'>
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

    <script src="{{ asset('assetsadmin/js/pages/crud/metronic-datatable/base/manual.js?v='.$scriptVer) }}" type="text/javascript"></script>

   
  <script src="{{ asset('assetsadmin/js/pages/crud/forms/widgets/summernote.js?v='.$scriptVer) }}" type="text/javascript"></script>
	
   
  <script>
	  $('.summernote').summernote({
  height: 300,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true                  // set focus to editable area after initializing summernote
});
   </script>


    <script>
        function manualdetail(userId) {
            var urlRoute = 'manualdetail/' + manualId;
            window.location.href = urlRoute;

        }
    </script>
    <script>
       
		$('#manualadd').on('submit', function(e) {
			e.preventDefault();
			//var file_data = $('#manual_file').prop('files')[0];
			var manual_text	 = $('#manual_text').val();      
            var manual_title = $('#manual_title').val();    		
        
			var form_data = new FormData();
		//	form_data.append('file', file_data);
			form_data.append('manual_title', manual_title);
			form_data.append('manual_text', manual_text);
			$.ajaxSetup({
				headers: {
					'X-CSRF-Token': $('meta[name=_token]').attr('content')
				}
			});
		
           $.ajax({
				type: "POST",
                url: './createmanual',
				data: form_data,
			    contentType: false, // The content type used when sending data to the server.
				cache: false, // To unable request pages to be cached
				processData: false,	
                success: function(msg) {  
				var status = msg.status;
				if(status =='success'){				
                        $('#manualadd_Modal').modal('toggle');
                        $('.kt-manualdatatable').KTDatatable().load();
						
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
						$("#addmanualmessage").html("<strong>Error!</strong> "+errorString);
						$("#addmanualmessage").slideDown(function() {
							setTimeout(function() {
								$("#addmanualmessage").slideUp();
							}, 3000);
						});
					
				}				
                }
            });
        });
        $('#manualedit').on('submit', function(e) {
			
            e.preventDefault();
			
			//	var file_data = $('#manual_fileEdit').prop('files')[0];
			 //var name = $('#name').val();      
          //  var courseid = $('#courseId').val();    		
           // var description = $('#description').val(); qmsdesc
			
            var manualId = $('#manualId').val();
            var manual_textEdit = $('#manual_textEdit').val();			
			var manual_titleEdit = $('#manual_titleEdit').val();
			  var form_data = new FormData();
			

		form_data.append('manual_title', manual_titleEdit);
		form_data.append('manualId', manualId);
	
		form_data.append('manual_text', manual_textEdit);
			
			
			  $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            }
        });
		
            	      
            $.ajax({
                type: "POST",
                url: './editmanual',
                data: form_data,
			          contentType: false, // The content type used when sending data to the server.
                  cache: false, // To unable request pages to be cached
            processData: false,	
			success: function(msg) {					
					var status = msg.status;
					if(status =='success'){				
							$('#manualedit_modal').modal('toggle');
							$('.kt-manualdatatable').KTDatatable().load();
							
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
						$("#editmanualmessage").html("<strong>Error!</strong> "+errorString);
						$("#editmanualmessage").slideDown(function() {
							setTimeout(function() {
								$("#editmanualmessage").slideUp();
							}, 3000);
						});
					}				
                }
            });

        });




        $('#manualedit_modal').on('show.bs.modal', function(e) {
			
			$("#editmanualmessage").hide();
            var manualId = $(e.relatedTarget).data('id');
           
            var manual_titleEdit = $(e.relatedTarget).data('manual_title');
             var manual_textEdit = $(e.relatedTarget).data('manual_text');
		
		
		$('#manual_textEdit').summernote('editor.pasteHTML', manual_textEdit);
		
           $("#manualId").val(manualId);
            $("#manual_titleEdit").val(manual_titleEdit);
            
        });

        $('#deleteModal').on('show.bs.modal', function(e) {
            $("#manualIdDelete").val($(e.relatedTarget).data('id'));
        });

        $('#manualdelete').on('submit', function(e) {
            e.preventDefault();
            var manualIdDelete = $('#manualIdDelete').val();
            $.ajax({
                type: "POST",
                url: './deletemanual',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "manualIdDelete": manualIdDelete
                },
                success: function(msg) {
					
				
					
                    if (msg.status == 'fail') {
                        alert(JSON.stringify(msg.status, null, 1));
                    } else {
                       
                        $('#deleteModal').modal('toggle');
                        $('.kt-manualdatatable').KTDatatable().load();
						
						
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