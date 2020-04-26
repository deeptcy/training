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
    <div class="col-sm-8 offset-sm-1">
        <h1 class="display-3">Update Page: {{ $page->pagetitle }} </h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('pages.update', $page->id) }}">
            @method('PATCH') 
            @csrf
			
			
			    <div class="form-group">
                <label for="pagetitle">Page Title:</label>
                <input type="text" class="form-control" name="pagetitle" value="{{ $page->pagetitle }}" />
            </div>
			
			
			
            <div class="form-group">
                <label for="pagetitle">Meta Title:</label>
                <input type="text" class="form-control" name="metaTitle" value="{{ $page->metaTitle }}" />
            </div>

            <div class="form-group">
                <label for="pagetitle">Meta Description:</label>
                <input type="text" class="form-control" name="metaDesc" value="{{ $page->metaDesc }}" />
            </div>

            <div class="form-group">
                <label for="pagetitle">Meta Keywords:</label>
                <input type="text" class="form-control" name="metaKeywords" value="{{ $page->metaKeywords }}" />
            </div>

        

            <div class="form-group">
                <label for="pagetitle">Canonical:</label>
                <input type="text" class="form-control" name="canonical" value="{{ $page->canonical }}" />
            </div>

            <div class="form-group">
                <label for="pagetitle">Robots:</label>
                <input type="text" class="form-control" name="robots" value="{{ $page->robots }}" />
            </div>
			
			<div class="form-group">
                <label for="pagetitle">Banner Title:</label>
                <input type="text" class="form-control" name="bannerTitle" value="{{ $page->bannerTitle }}" />
            </div>
			<div class="form-group">
                <label for="pagetitle">Banner Description:</label>
                <input type="text" class="form-control" name="bannerDesc" value="{{ $page->bannerDesc }}" />
            </div>
			
            <div class="form-group">
                <label for="last_name">Page Content:</label>
				
					<textarea name="pagecontent" class="summernote" rows="18">{{ $page->pagecontent }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
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
   <script src="{{ asset('assetsadmin/js/pages/crud/datatables/data-sources/ajax-server-side1.js') }}" type="text/javascript"></script>-->
   
   
  <script src="{{ asset('assetsadmin/js/pages/crud/forms/widgets/summernote.js?v='.$scriptVer) }}" type="text/javascript"></script>
	
   
  <script>
	  $('.summernote').summernote({
  height: 300,                 // set editor height
  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
  focus: true                  // set focus to editable area after initializing summernote
});
   </script>
   
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