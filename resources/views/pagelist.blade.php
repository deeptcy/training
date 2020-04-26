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
						









<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Pages:</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Page Title</td>
          <td>Page URL</td>
          <td>Robots</td>
                 
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
     <tbody>
        @foreach($pages as $page)
        <tr> <td>{{$page->id}}</td>
            <td>{{$page->pagetitle}}</td>
            <td><a href="" target="_blank">{{$page->pagetitle}}</a></td>
			
			
            <td>{{$page->robots}}</td>
          
            <td>
                <a href="{{ route('pages.edit',$page->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
               
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
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
   <script src="{{ asset('assetsadmin/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script> -->
   <!--end::Page Vendors -->
   <!--begin::Page Scripts(used by this page) 
   <script src="{{ asset('assetsadmin/js/pages/crud/datatables/data-sources/ajax-server-side1.js') }}" type="text/javascript"></script>
   
   <script src="{{ asset('assetsadmin/js/pages/crud/metronic-datatable/base/cases.js?v='.$scriptVer) }}" type="text/javascript"></script>-->
	

  
   
   <!-- end::Global Config -->
   <!--begin::Global Theme Bundle(used by all pages) 
      <script src="{{ asset('assetsadmin/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
      <script src="{{ asset('assetsadmin/js/scripts.bundle.js') }}" type="text/javascript"></script>
      -->
   <!--end::Global Theme Bundle -->
   <!--begin::Page Scripts(used by this page) 
      <script src="{{ asset('assetsadmin/js/data-ajax1.js') }}" type="text/javascript"></script>-->
   <!--end::Page Scripts -->
</body>
<!-- end::Body -->
@endsection