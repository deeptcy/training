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
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper" style="padding-top:80px;">
            @include('layouts.adminheader')
            <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">












               <!-- begin:: Content -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

							<!--Begin::App-->
							<div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

								<!--Begin:: App Aside Mobile Toggle-->
								<button class="kt-app__aside-close" id="kt_user_profile_aside_close">
									<i class="la la-close"></i>
								</button>

								<!--End:: App Aside Mobile Toggle-->
								
								
								
								




								<!--Begin:: App Content-->
								<div class="kt-grid__item kt-grid__item--fluid kt-app__content">
							
								<div id='ajaxmessagediv'>
								
								@if (\Session::has('message'))
    {!! \Session::get('message') !!}
@endif
						    </div>
								
									<div class="row">
										<div class="col-xl-12">
											<div class="kt-portlet">
												<div class="kt-portlet__head">
													<div class="kt-portlet__head-label">
														<h3 class="kt-portlet__head-title">Personal Information <small>update your personal informaiton</small></h3>
													</div>
												</div>
							
												
												<form enctype="multipart/form-data" method="POST" action="{{url('/updateprofile')}}" class="kt-form kt-form--label-right"> 
														{{ csrf_field() }}
													<div class="kt-portlet__body">
														<div class="kt-section kt-section--first">
															<div class="kt-section__body">
																<div class="row">
																	<label class="col-xl-3"></label>
																	<div class="col-lg-9 col-xl-6">
																		<h3 class="kt-section__title kt-section__title-sm">Customer Info:</h3>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="kt-avatar kt-avatar--outline" id="kt_user_avatar">
																		
																		<?php
																		if($User['photo_path'] ==''){
																			$imageFullPath = './userimage/default1.jpg';
																		}else{
																		$imageFullPath = './userimage/'. $User['photo_path']; 
																		}
																		?>
																		
																			<div class="kt-avatar__holder" style="background-image: url(<?php echo $imageFullPath;?>);"></div>
																			<label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
																				<i class="fa fa-pen"></i>
																				<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
																				
																																						


																			</label>
																			<span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
																				<i class="fa fa-times"></i>
																			</span>
																		</div>
																		        <?php if ($errors->has('profile_avatar')) :?>
        <span class="help-block">
            <strong>{{$errors->first('profile_avatar')}}</strong>
        </span>
        <?php endif;?>
																	</div>
																</div>
																
																
																
																
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">Name</label>
																	<div class="col-lg-9 col-xl-6">
																		<input class="form-control" name='name' required id ='name' type="text" value="{{$User['name']}}">
																		
																		
        <?php if ($errors->has('name')) :?>
        <span class="help-block">
            <strong>{{$errors->first('name')}}</strong>
        </span>
        <?php endif;?>

																	</div>
																</div>
																<!--
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
																	<div class="col-lg-9 col-xl-6">
																		<input class="form-control"   name='last_name' id ='last_name' type="text" value="Bold">
																	</div>
																</div>
																-->
																<div class="row">
																	<label class="col-xl-3"></label>
																	<div class="col-lg-9 col-xl-6">
																		<h3 class="kt-section__title kt-section__title-sm">Contact Info:</h3>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="input-group">
																			<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
																			<input type="text" class="form-control"   name='phone' id ='phone'  value="{{$User['phone']}}"  placeholder="Phone" aria-describedby="basic-addon1">
																	
																	
																					<?php if ($errors->has('phone')) :?>
																					<span class="help-block">
																						<strong>{{$errors->first('phone')}}</strong>
																					</span>
																					<?php endif;?>
																	</div>
																		<span class="form-text text-muted">We'll never share your phone with anyone else.</span>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="input-group">
																			<div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
																			<input readonly type="text" class="form-control" name='email' id ='email' value="{{$User['email']}}"  placeholder="Email" aria-describedby="basic-addon1">
																		</div>
																			<span class="form-text text-muted">We'll never share your email with anyone else.</span>
																	</div>
																</div>	
									
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label">Nationality</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="input-group">
																			<div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-flag"></i></span></div>
																		
																		<select  class="form-control" id="nation_code" name="nation_code">  
																		<option>Select Country</option>																		
																				@foreach($Nation as $Nationobj)
																					<option value="{{$Nationobj['nation_code']}}"  {{ ( $Nationobj['nation_code'] == $User['nation_code']) ? 'selected' : '' }} >{{$Nationobj['nation_name']}}</option>
																				@endforeach						
																			</select>																			
																		</div>
																			
																	</div>
																</div>
															
															</div>
														</div>
													</div>
													<div class="kt-portlet__foot">
														<div class="kt-form__actions">
															<div class="row">
																<div class="col-lg-3 col-xl-3">
																</div>
																<div class="col-lg-9 col-xl-9">
																	<button type="Submit" class="btn btn-success">Submit</button>&nbsp;
																	<button type="reset"  class="btn btn-secondary">Cancel</button>
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>

								<!--End:: App Content-->
							</div>

							<!--End::App-->
						</div>

						<!-- end:: Content -->










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
	
	<script src="{{ asset('assetsadmin/js/pages/dashboard.js?v='.$scriptVer) }}" type="text/javascript"></script>
	
	<script src="{{ asset('assetsadmin/js/pages/custom/user/profile.js?v='.$scriptVer) }}" type="text/javascript"></script>
	<script type="text/javascript">
	setTimeout(function() {
  $('#ajaxmessagediv').fadeOut('fast');
}, 1200); 




</script>
    <!--end::Global Theme Bundle -->
    <!--begin::Page Vendors(used by this page)
   <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script> -->
    <!--end::Page Vendors -->
    <!--begin::Page Scripts(used by this page) 
   <script src="{{ asset('assets/js/pages/crud/datatables/data-sources/ajax-server-side1.js') }}" type="text/javascript"></script>-->


   
   </body>
<!-- end::Body -->
@endsection