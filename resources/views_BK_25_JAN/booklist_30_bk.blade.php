@extends('layouts.admin') 
@section('content')
@php $scriptVer =  Config::get('constants.SCRIPT_VERSION'); @endphp
<!-- end::Head -->
<!-- begin::Body -->
 <meta name="_token" content="{{ csrf_token() }}" />
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
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
											Manage Books
										</h3>
                            </div>
							
							
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    
									
									<button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal" data-target="#bookadd_Modal">
                                        <i class="flaticon2-plus"></i> Add Book
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
                                                    <input type="text" class="form-control" placeholder="Search..." id="bookgeneralSearch">
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
                            <div class="kt-bookdatatable" id="kt_table_1"></div>

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
    <div class="modal fade" id="bookadd_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>

                </div>

                {{ Form::open(array('method'=>'post','url' => 'bookadd', 'id'=>'bookadd')) }}
                <div class="modal-body">
				<div class="alert alert-danger" style="display:none" id='addbookmessage'> </div>
                   

				   <div class="form-group">
                        <label for="book" class="form-control-label">Coursess:</label>
						 <select  class="form-control" id="courseId" name="courseId">
                         
@foreach($Courses as $Course)
    <option value="{{$Course['id']}}">{{$Course['name']}}</option>
@endforeach						
						
						 </select>
						
                    </div>
					
					
					
				   <div class="form-group">
                        <label for="book" class="form-control-label">Book:</label>
                        <input type="text" class="form-control" required='required'  id="name" id="name">
                    </div>
					
					 <div class="form-group">
                        <label for="option_aEdit" class="form-control-label">Description:</label>
                        <input type="text" required='required' class="form-control" id="description" name="description">
                    </div>
                

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Book</button>

                </div>
                <div class="modal-footer">

                </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <!--begin::Edit book Modal-->
    <div class="modal fade" id="bookedit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'bookedit', 'id'=>'bookedit')) }}
                <div class="modal-body">
				
				<div class="alert alert-danger" id='editbookmessage'> </div>
                                            
									   <div class="form-group">
                        <label for="book" class="form-control-label">Coursess:</label>
						 <select  class="form-control" id="courseIdEdit" name="courseIdEdit">
                         
@foreach($Courses as $Course)
    <option value="{{$Course['id']}}">{{$Course['name']}}</option>
@endforeach						
						
						 </select>
						
                    </div>			
											
                    <div class="form-group">
                        <label for="book" class="form-control-label">Book:</label>
                        <input type="text" required='required' class="form-control" id="bookEdit" name="bookEdit">
                        <input type='hidden' name='bookId' id='bookId'>
                    </div>
					 <div class="form-group">
                        <label for="option_aEdit" class="form-control-label">Description</label>
                        <input type="text" required='required' class="form-control" id="descriptionEdit" name="descriptionEdit">
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'bookdelete', 'id'=>'bookdelete')) }}
                <div class="modal-body">
                    Are you sure you want to delete this Book?
                    <input type='hidden' name='bookIdDelete' id='bookIdDelete'>
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

    <script src="{{ asset('assetsadmin/js/pages/crud/metronic-datatable/base/books.js?v='.$scriptVer) }}" type="text/javascript"></script>

    <script>
        function userdetails(userId) {
            var urlRoute = 'bookdetail/' + bookId;
            window.location.href = urlRoute;

        }
    </script>
    <script>
       


		$('#bookadd').on('submit', function(e) {
            e.preventDefault();
            var name = $('#name').val();      
            var couseid = $('#courseId').val();          
			
            var description = $('#description').val();
alert(couseid);
            $.ajax({
                type: "POST",
                url: './createbook',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": name,
					"couseid": couseid,
					"description": description,

                },
                success: function(msg) {  
				var status = msg.status;
				if(status =='success'){				
                        $('#bookadd_Modal').modal('toggle');
                        $('.kt-bookdatatable').KTDatatable().load();
				}else{
					
					
					errorString='';
						$.each( msg.message, function( key, value) {
							for(var l=0;l<value.length; l++){
								errorString +=  value[l] +'<br/>' ;
							}
						});
						$("#addbookmessage").html("<strong>Error!</strong> "+errorString);
						$("#addbookmessage").slideDown(function() {
							setTimeout(function() {
								$("#addbookmessage").slideUp();
							}, 5000);
						});
					
				}				
                }
            });
        });
        $('#bookedit').on('submit', function(e) {
			
            e.preventDefault();
            var bookId = $('#bookId').val();
            var bookEdit = $('#bookEdit').val();			
			var descriptionEdit = $('#descriptionEdit').val();
            	 var couseidEdit = $('#courseIdEdit').val();        
            $.ajax({
                type: "POST",
                url: './editbook',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "bookId": bookId,
					"name": bookEdit,  "couseid": couseidEdit,
					"description": descriptionEdit,
								
                },
                success: function(msg) {					
					var status = msg.status;
					if(status =='success'){				
							$('#bookedit_modal').modal('toggle');
							$('.kt-bookdatatable').KTDatatable().load();
					}else{
						errorString='';
						$.each( msg.message, function( key, value) {
							for(var l=0;l<value.length; l++){
								errorString +=  value[l] +'<br/>' ;
							}
						});
						$("#editbookmessage").html("<strong>Error!</strong> "+errorString);
						$("#editbookmessage").slideDown(function() {
							setTimeout(function() {
								$("#editbookmessage").slideUp();
							}, 5000);
						});
					}				
                }
            });

        });

        $('#bookedit_modal').on('show.bs.modal', function(e) {
			
		
			
			  $("#editbookmessage").hide();
            var bookId = $(e.relatedTarget).data('id');
            var bookEdit = $(e.relatedTarget).data('name');
            
            var descriptionEdit = $(e.relatedTarget).data('description');
            var courseid = $(e.relatedTarget).data('courseid');
			
		
		
				$('#courseIdEdit').val(courseid);
            
            $("#bookId").val(bookId);
            $("#bookEdit").val(bookEdit);
            			
            $("#descriptionEdit").val(descriptionEdit);
            
        });

        $('#deleteModal').on('show.bs.modal', function(e) {
            $("#bookIdDelete").val($(e.relatedTarget).data('id'));
        });

        $('#bookdelete').on('submit', function(e) {
            e.preventDefault();
            var bookIdDelete = $('#bookIdDelete').val();
            $.ajax({
                type: "POST",
                url: './deletebook',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "bookIdDelete": bookIdDelete
                },
                success: function(msg) {
					
				
					
                    if (msg.status == 'fail') {
                        alert(JSON.stringify(msg.status, null, 1));
                    } else {
                       
                        $('#deleteModal').modal('toggle');
                        $('.kt-bookdatatable').KTDatatable().load();
                    }          
					
                    
                }
            });
        });
    </script>
   </body>
<!-- end::Body -->
@endsection