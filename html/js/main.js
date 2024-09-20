$(document).ready(function(){	
	// alert("hey");
	//datatable();
	
	// var dataRecords = $('#recordListing').DataTable({
	// 	"lengthChange": false,
	// 	"processing":true,
	// 	"serverSide":true,
	// 	'processing': true,
	// 	'serverSide': true,
	// 	'serverMethod': 'post',		
	// 	"order":[],
	// 	"ajax":{
	// 		// url:"../../ajax/ajax_action.php",
	// 		url:"ajax/ajax_action.php",
	// 		type:"POST",
	// 		data:{action:'listRecords'},
	// 		dataType:"json"
	// 	},
	// 	"columnDefs":[
	// 		{
	// 			"targets":[0, 1, 2],
	// 			"orderable":true,
	// 		},
	// 	],
	// 	"pageLength": 10
	// });	
	
			
	$("#recordListing").on('click', '.update', function(){
		var id = $(this).attr("id");
		var action = 'getRecord';
		//alert("jfghfhg");
		$.ajax({
			url:'ajax/ajax_action.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data){
				$('#recordModal').modal('show');
				$('#ticket_id').val(data.data.ticket_id);
				$('#ticket_name').val(data.data.ticket_name);
				$('#ticket_text').val(data.data.ticket_desc);
				// $('#skills').val(data.skills);				
				// $('#address').val(data.address);
				// $('#designation').val(data.designation);	
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Records");
				$('#action').val('updateRecord');
				$('#save').val('Save');
			}
		})
	});
			
	$("#recordListing").on('click', '.delete', function(){
		var id = $(this).attr("id");		
		var action = "deleteRecord";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				// url:"../../ajax/ajax_action.php",
				url:"ajax/ajax_action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data) {					
					dataRecords.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
	$("#recordListing").on('click', '.show_doc', function(){
		var id = $(this).attr("id");		
		var action = "show_doc";
		$.ajax({
			// url:"../../ajax/ajax_action.php",
			url:"ajax/ajax_action.php",
			method:"POST",
			data:{id:id, action:action},
			success:function(data) {	 console.log(data);console.log(data['status']);				
				 $('#documentModal').modal('show');
				 $('#ticket_id').val(id);
				 
				// $('#ticket_name').val(data.data.ticket_name);
				// $('#ticket_text').val(data.data.ticket_desc);
				// // $('#skills').val(data.skills);				
				// // $('#address').val(data.address);
				// // $('#designation').val(data.designation);	
				// $('.modal-title').html("<i class='fa fa-plus'></i> Edit Records");
				// $('#action').val('updateRecord');
				// $('#save').val('Save');
			}
		})
	});
});
function datatabless(){
	var dataRecords = $('#recordListing').DataTable({
	"lengthChange": true,
	"processing": true,
	"order":[],
	"ajax":{
		// url:"../../ajax/ajax_action.php",
		url:"ajax/ajax_action.php",
		type:"POST",
		data:{action:'listRecords'},
		dataType:"json"
	},
	"columnDefs":[
		{
			"targets":[0, 1, 2],
			"orderable":true,
		},
	],
	"pageLength": 10
});	
}