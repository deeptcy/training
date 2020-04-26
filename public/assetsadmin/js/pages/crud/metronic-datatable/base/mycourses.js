"use strict";
// Class definition

var KTDatatableRemoteAjaxCourse = function() {
	// Private functions


	// basic demo
	var demo = function() {

		var datatable = $('.kt-coursedatatable').KTDatatable({ 
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						url: 'ajaxmycourseslist',
						method: 'GET',
						
						// sample custom headers
						headers: {'x-my-custokt-header': 'some value', 'x-test-header': 'the value'},
						map: function(raw) {
							// sample data mapping
							var dataSet = raw;
							if (typeof raw.data !== 'undefined') {
								dataSet = raw.data;
							}
							return dataSet;
						},
					},
				},
				pageSize: 10,
				serverPaging: true,
				serverFiltering: true,
				serverSorting: true,
			},

			// layout definition
			layout: {
				scroll: false,
				footer: false,
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				//input: $('#generalSearch'),
			},
				
			// columns definition
			columns: [
				/*{
					field: 'id',
					title: 'CourseId',
					sortable: 'asc',
					width: 75,
					type: 'number',
					selector: false,
					textAlign: 'center',
					template: function(row) {
						return '<a href="javascript:;" onclick=userdetails('+row.id+')>'+row.id+'</a>';
					}
				}, */
				
				{
					field: 'name',
					title: 'Course',
				}, {
					field: 'description',
					title: 'Description',	
					width: 110,
					overflow: 'visible',
					autoHide: false,					
				}
				
				],

		});
/*
    $('#kt_form_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'caseStatus');
    });

    $('#kt_form_type').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'caseStage');
    });

    $('#kt_form_status,#kt_form_type').selectpicker();*/

	$('#coursegeneralSearch').on('keyup', function() {
		if(($(this).val().length)>=3 || $(this).val().length==0) {
			datatable.search($(this).val(), 'coursegeneralSearch');
		}
	});
	
	
	};

	return {
		// public functions
		init: function() {
			demo();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableRemoteAjaxCourse.init();
	
	 
  
});