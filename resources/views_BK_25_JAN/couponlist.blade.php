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
											Manage Coupons
										</h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    
									
									<button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal" data-target="#couponadd_Modal">
                                        <i class="flaticon2-plus"></i> Add Coupon
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
                                                    <input type="text" class="form-control" placeholder="Search..." id="coupongeneralSearch">
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
                            <div class="kt-coupondatatable" id="kt_table_coupon"></div>

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
    <div class="modal fade" id="couponadd_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>

                </div>

                {{ Form::open(array('method'=>'post','url' => 'couponadd', 'id'=>'couponadd')) }}
                <div class="modal-body">
				<div class="alert alert-danger" style="display:none" id='addcouponmessage'> </div>
                    <div class="form-group">
                        <label for="coupon" class="form-control-label">Coupon code:</label>
                        <input type="text" class="form-control" required='required'  id="code" name="code">
                    </div>
					
					  <div class="form-group has-feedback">
                     <div class="col-md-12">
                        <label class="radio-inline">
                        <input type="radio" value="fixed" name="coupontype" checked> Fixed  
                        </label>
                        <label class="radio-inline"> &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio"  value="percent" name="coupontype"> Percentage
                        </label>                               
                     </div>
                  </div>
					
					 <div class="form-group">
                        <label for="option_aEdit" class="form-control-label">Amount:</label>
                        <input type="text" required='required' class="form-control" id="amount" name="amount">
                    </div>
					
					
                 <div class="form-group">
                        <label for="option_aEdit" class="form-control-label">Description:</label>
                        <input type="text" required='required' class="form-control" id="description" name="description">
                    </div>
                

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Coupon</button>

                </div>
                <div class="modal-footer">

                </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <!--begin::Edit coupon Modal-->
    <div class="modal fade" id="couponedit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'couponedit', 'id'=>'couponedit')) }}
                <div class="modal-body">
				
				<div class="alert alert-danger" id='editcouponmessage'> </div>
                                            
										
											
                    <div class="form-group">
                        <label for="coupon" class="form-control-label">Coupon:</label>
                        <input type="text" required='required' class="form-control" id="couponEdit" name="couponEdit">
                        <input type='hidden' name='couponId' id='couponId'>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'coupondelete', 'id'=>'coupondelete')) }}
                <div class="modal-body">
                    Are you sure you want to delete this Coupon?
                    <input type='hidden' name='couponIdDelete' id='couponIdDelete'>
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

    <script src="{{ asset('assetsadmin/js/pages/crud/metronic-datatable/base/coupons.js?v='.$scriptVer) }}" type="text/javascript"></script>

    <script>
        function userdetails(userId) {
            var urlRoute = 'coupondetail/' + couponId;
            window.location.href = urlRoute;

        }
    </script>
    <script>
       


		$('#couponadd').on('submit', function(e) {
            e.preventDefault();
          
			var couponForm = $("#couponadd");
            var formData = couponForm.serialize();	
			   $.ajaxSetup({
      	headers: {
      		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      	}
      });		
            $.ajax({
                type: "POST",
                url: './createcoupon',
                data: formData,
                success: function(msg) {  
				var status = msg.status;
				if(status =='success'){				
                        $('#couponadd_Modal').modal('toggle');
                        $('.kt-coupondatatable').KTDatatable().load();
				}else{
					
					
					errorString='';
						$.each( msg.message, function( key, value) {
							for(var l=0;l<value.length; l++){
								errorString +=  value[l] +'<br/>' ;
							}
						});
						$("#addcouponmessage").html("<strong>Error!</strong> "+errorString);
						$("#addcouponmessage").slideDown(function() {
							setTimeout(function() {
								$("#addcouponmessage").slideUp();
							}, 5000);
						});
					
				}				
                }
            });
        });
        $('#couponedit').on('submit', function(e) {
			
            e.preventDefault();
            var couponId = $('#couponId').val();
            var couponEdit = $('#couponEdit').val();			
			var descriptionEdit = $('#descriptionEdit').val();
            	
            $.ajax({
                type: "POST",
                url: './editcoupon',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "couponId": couponId,
					"name": couponEdit,
					"description": descriptionEdit,
								
                },
                success: function(msg) {					
					var status = msg.status;
					if(status =='success'){				
							$('#couponedit_modal').modal('toggle');
							$('.kt-coupondatatable').KTDatatable().load();
					}else{
						errorString='';
						$.each( msg.message, function( key, value) {
							for(var l=0;l<value.length; l++){
								errorString +=  value[l] +'<br/>' ;
							}
						});
						$("#editcouponmessage").html("<strong>Error!</strong> "+errorString);
						$("#editcouponmessage").slideDown(function() {
							setTimeout(function() {
								$("#editcouponmessage").slideUp();
							}, 5000);
						});
					}				
                }
            });

        });

        $('#couponedit_modal').on('show.bs.modal', function(e) {
			  $("#editcouponmessage").hide();
            var couponId = $(e.relatedTarget).data('id');
            var couponEdit = $(e.relatedTarget).data('name');
            
            var descriptionEdit = $(e.relatedTarget).data('description');
            
            $("#couponId").val(couponId);
            $("#couponEdit").val(couponEdit);
            			
            $("#descriptionEdit").val(descriptionEdit);
            
        });

        $('#deleteModal').on('show.bs.modal', function(e) {
            $("#couponIdDelete").val($(e.relatedTarget).data('id'));
        });

        $('#coupondelete').on('submit', function(e) {
            e.preventDefault();
            var couponIdDelete = $('#couponIdDelete').val();
            $.ajax({
                type: "POST",
                url: './deletecoupon',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "couponIdDelete": couponIdDelete
                },
                success: function(msg) {
					
				
					
                    if (msg.status == 'fail') {
                        alert(JSON.stringify(msg.status, null, 1));
                    } else {
                       
                        $('#deleteModal').modal('toggle');
                        $('.kt-coupondatatable').KTDatatable().load();
                    }          
					
                    
                }
            });
        });
    </script>
   </body>
<!-- end::Body -->
@endsection