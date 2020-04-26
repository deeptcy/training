"use strict";
// Class definition

var KTDatatableRemoteAjaxQuestion = function() {
	// Private functions


	// basic demo
	var demo = function() {

		var datatable = $('.kt-questiondatatable').KTDatatable({ 
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						url: 'ajaxquestionslist',
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
				{
					field: 'id',
					title: 'QuestionId',
					sortable: 'asc',
					width: 75,
					type: 'number',
					selector: false,
					textAlign: 'center',
					template: function(row) {
						return '<a href="javascript:;" onclick=userdetails('+row.id+')>'+row.id+'</a>';
					}
				}, {
					field: 'question',
					title: 'Question',
				}, {
					field: 'correct_option',
					title: 'Correct Option',					
				},{
					field: 'Actions',
					title: 'Actions',
					sortable: false,
					width: 110,
					overflow: 'visible',
					autoHide: false,
					template: function(row) {
						return '\
						<a href="javascript:;" data-id='+row.id+'   data-option_a="'+row.option_a+'"   data-option_b="'+row.option_b+'"   data-option_c="'+row.option_c+'"  data-option_d="'+row.option_d+'"   data-question="'+row.question+'"  data-correct_option="'+row.correct_option+'" data-toggle="modal" data-target="#questionedit_modal" class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Edit details">\
							<i class="flaticon2-paper"></i>\
						</a>\
						<a href="javascript:;"  data-id='+row.id+'  data-toggle="modal" data-target="#deleteModal"  class="btn btn-sm btn-clean btn-icon btn-icon-sm" title="Delete">\
							<i class="flaticon2-trash"></i>\
						</a>\
					';
					},
				}],

		});
/*
    $('#kt_form_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'caseStatus');
    });

    $('#kt_form_type').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'caseStage');
    });

    $('#kt_form_status,#kt_form_type').selectpicker();*/

	$('#questiongeneralSearch').on('keyup', function() {
		if(($(this).val().length)>=3 || $(this).val().length==0) {
			datatable.search($(this).val(), 'questiongeneralSearch');
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
	KTDatatableRemoteAjaxQuestion.init();
	
	 
  
});