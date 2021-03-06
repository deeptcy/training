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
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
											Manage User
										</h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <button type="button" class="btn btn-brand btn-icon-sm" data-toggle="modal" data-target="#addUserModal">
                                        <i class="flaticon2-plus"></i> Add New
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
                                                    <input type="text" class="form-control" placeholder="Search..." id="usergeneralSearch">
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
                            <div class="kt-userdatatable" id="kt_table_1"></div>

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
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>

                </div>

                {{ Form::open(array('method'=>'post','url' => 'useradd', 'id'=>'useradd')) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user-name" class="form-control-label">Name:</label>
                        <input type="text" class="form-control" required id="userName" id="userName">
                    </div>
                    <div class="form-group">
                        <label for="user-email" class="form-control-label">Email:</label>
                        <input type="text" class="form-control" id="userEmail" id="userEmail">
                    </div>
                    <div class="form-group">
                        <select multiple class="form-control" id="userRoles" name="userRoles">
                            <option value="agent">Agent</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="user-password" class="form-control-label">Password:</label>
                        <input type="password" class="form-control" id="userPassword" name="userPassword">
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>

                </div>
                <div class="modal-footer">

                </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <!--begin::Edit user Modal-->
    <div class="modal fade" id="useredit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'useredit', 'id'=>'useredit')) }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user-name" class="form-control-label">Name:</label>
                        <input type="text" required='required' class="form-control" id="userNameEdit" name="userNameEdit">
                        <input type='hidden' name='userId' id='userId'>
                    </div>
                    <div class="form-group">
                        <label for="user-email" required='required'   class="form-control-label">Email:</label>
                        <input type="text" class="form-control" id="userEmailEdit" name="userEmailEdit">
                    </div>
                    <div class="form-group">
                        <label for="user-email" class="form-control-label">Role:</label>
                        <select multiple class="form-control" id="userRoleEdit" name="userRoleEdit">
                            <option value="agent">Agent</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="user-email" class="form-control-label">Password:</label>
                        <input type="password" placeholder='*********' class="form-control" id="userPasswordEdit" id="userPasswordEdit">
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{ Form::open(array('method'=>'post','url' => 'userdelete', 'id'=>'userdelete')) }}
                <div class="modal-body">
                    Are you sure you want to delete this user?
                    <input type='hidden' name='userIdDelete' id='userIdDelete'>
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

    <script src="{{ asset('assetsadmin/js/pages/crud/metronic-datatable/base/users.js?v='.$scriptVer) }}" type="text/javascript"></script>

    <script>
        function userdetails(userId) {
            var urlRoute = 'userdetail/' + userId;
            window.location.href = urlRoute;

        }
    </script>
    <script>
        $('#useradd').on('submit', function(e) {
            e.preventDefault();
            var userName = $('#userName').val();
            var userEmail = $('#userEmail').val();
            var userRoles = $('#userRoles').val();
            var userPassword = $('#userPassword').val();
            $.ajax({
                type: "POST",
                url: './createuser',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "userName": userName,
                    "userEmail": userEmail,
                    "userRoles": userRoles,
                    "userPassword": userPassword
                },
                success: function(msg) {
					 var obj = JSON.parse(msg);
					
                    if (obj.status == 'fail') {
                        alert(JSON.stringify(obj.message, null, 1));
                    } else {
                        alert('Added ' + obj.status);
                        $('#addUserModal').modal('toggle');
                        $('.kt-userdatatable').KTDatatable().load();
                    }
                }
            });
        });
        $('#useredit').on('submit', function(e) {
            e.preventDefault();
            var userId = $('#userId').val();
            var userNameEdit = $('#userNameEdit').val();
            var userEmailEdit = $('#userEmailEdit').val();
			var userRoleEdit = $('#userRoleEdit').val();
            var userPasswordEdit = $('#userPasswordEdit').val();
            $.ajax({
                type: "POST",
                url: './edituser',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "userId": userId,
                    "userNameEdit": userNameEdit,
                    "userEmailEdit": userEmailEdit,
                    "userRoleEdit": userRoleEdit,
                    "userPasswordEdit": userPasswordEdit
                },
                success: function(msg) {
					
					var obj = JSON.parse(msg);
					
                    if (obj.status == 'fail') {
                        alert(JSON.stringify(obj.message, null, 1));
                    } else {
                        alert('User update ' + obj.status);
                        $('#useredit_modal').modal('toggle');
                        $('.kt-userdatatable').KTDatatable().load();
                    }                   
                }
            });

        });

        $('#useredit_modal').on('show.bs.modal', function(e) {
            var userId = $(e.relatedTarget).data('id');
            var userNameEdit = $(e.relatedTarget).data('name');
            var userEmailEdit = $(e.relatedTarget).data('email');
            var roles = $(e.relatedTarget).data('roles');				 
			var rolesArray = roles.split(",");
			 $('#userRoleEdit option[value=admin]').attr('selected',false);
			 $('#userRoleEdit option[value=agent]').attr('selected',false);
			 
			rolesArray.forEach(function(item){
			if(item=='Admin'){
			 $('#userRoleEdit option[value=admin]').attr('selected','selected');
			}if(item=='Agent'){
			 $('#userRoleEdit option[value=agent]').attr('selected','selected');
			}
			});
			//$('#userRoleEdit option[value=agent]').attr('selected','selected');
         //  $('#userRoleEdit option[value=admin]').attr('selected','selected');
            $("#userId").val(userId);
            $("#userNameEdit").val(userNameEdit);
            $("#userEmailEdit").val(userEmailEdit);
        });

        $('#deleteModal').on('show.bs.modal', function(e) {
            $("#userIdDelete").val($(e.relatedTarget).data('id'));
        });

        $('#userdelete').on('submit', function(e) {
            e.preventDefault();
            var userIdDelete = $('#userIdDelete').val();
            $.ajax({
                type: "POST",
                url: './deleteuser',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "userIdDelete": userIdDelete
                },
                success: function(msg) {
					
					var obj = JSON.parse(msg);
					
                    if (obj.status == 'fail') {
                        alert(JSON.stringify(obj.message, null, 1));
                    } else {
                        alert('User deleted ' + obj.status);
                        $('#deleteModal').modal('toggle');
                        $('.kt-userdatatable').KTDatatable().load();
                    }          
					
                    
                }
            });
        });

        /*
 $("#btnConfirm").on("click", function(){  	
   alert('code to delete user');
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