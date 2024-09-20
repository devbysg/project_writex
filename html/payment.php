<?php
// $country_desc = select_all("country_cost_master");
// $cat_desc = select_query("category_master",array("category_id","category_name"),array());
?>
    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Payment Listing</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- Data Table -->
                    <div class="nk-block nk-block-lg">
                                        
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">

                                                <table cellspacing="5" cellpadding="5" border="0">
                                                    <tbody><tr>
                                                        <td>Minimum date:</td>
                                                        <td><input type="text" id="min" name="min"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Maximum date:</td>
                                                        <td><input type="text" id="max" name="max"></td>
                                                    </tr>
                                                </tbody></table>

                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="payment_data" data-auto-responsive="false">
                                                <thead>
                                                        <tr>
                                                            <!-- <th><input type="checkbox" class="custom-control-input" id="emp_data"></th> -->
                                                            <th style="width:10%;">Ticket ID</th>
                                                            <!-- <th>Date</th>					 -->
                                                            <th>Invoice Number</th>
                                                            <th>Amount</th>		
                                                            <th>Amount in INR</th>			
                                                            <th>Total Amount</th>
                                                            <th>Date</th>
                                                            <!-- <th>Amount Received</th>
                                                            <th>Bank Details</th>	 -->
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    
                                                </table>
                                            </div>
                                        </div><!-- .card-preview -->
                                    </div>
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Payment Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="PaymentUpdate">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md text-center3">
                    <h4 class="title ">Edit Payment</h4>
                    <hr>
                    <form action="" id="PaymentUpdateForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="" class="modaction" id="edit_payment">
                        <input type="hidden" class="form-control" id="edit_payement_id" name="edit_payement_id">
                        <div class="form-group row col-md-12">
                            <div class=" col-md-6 ">
                                <label class="form-label " for="Asigned">Edit Assigned</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div> 
                                    <input type="text" class="form-control date-picker modleft" name="modassigned_for" data-date-format="yyyy-mm-dd" id="modassigned_for" >
                                </div>
                            </div>
                            
                            <div class=" col-md-6 ">
                                <label class="form-label " for="Asigned">Edit Transaction Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div> 
                                    <input type="text" class="form-control date-picker mod" data-date-format="yyyy-mm-dd" name="moddeadline" id="moddeadline" >
                                    
                                </div>
                            </div> 
                         </div>
                         <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="Ticketvalue">Update Trasction ID</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="advance_transction_id" name="advance_transction_id" placeholder="Enter Tranction ID">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label class="form-label" for="file">Payment Receive:</label>
                            <input type="file" class="form-control" id="receivepayment" name="receive_payment[]" multiple>
                        </div>
                        <div class="col-md-12 mt-3 " id="button-edit">
                            <button type="submit" class="btn btn-primary"><em class="icon ni ni-pen-alt-fill"></em><span>Edit</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Payment Modal Ends -->
<script>

// var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values

    $(document).ready(function(){	
        $.fn.dataTable.ext.search.push( 
        function( settings, data, dataIndex ) {
            // alert('dtest');
            var min = $('#min').datepicker("getDate");
            // alert(min);
            var max = $('#max').datepicker("getDate");
            var date = new Date( data[5] );

            if (
                ( min === null && max === null ) ||
                ( min === null && date <= max ) ||
                ( min <= date   && max === null ) ||
                ( min <= date   && date <= max )
            ) {
                return true;
            }
            return false;
        }

        
    );

    $('#min, #max').on('change', function () { 
        dataRecords.draw();
    });
    
    var dataRecords = $('#payment_data').DataTable({
        "lengthChange": true,
        "processing": true,
        "order":[],
        "ajax":{
            url:"ajax/ajax_action.php",
            type:"POST",
            // data:{action:'data_role'},
            data:{action:'payment_data'},
            dataType:"json"
        },
        // this dom will enable extension option
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "columnDefs":[
            {
                "targets":[0, 1, 2],
                "orderable":true,
            },
            { "width": "2%", "targets": 0 }
        ],
        "pageLength": 10
    });	
            
    

    });  
        
    function payment(e){
        var id = $(e).data("id");
        $.ajax({
            url:"ajax/ajax_action.php",
            method:"POST",
            data:{action:"get_payment_desc",ticket_id: id},
            dataType:"JSON",
            beforeSend: function() {
                $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
            },
            success:function(data){
                $('#PaymentUpdate').modal('show'); 
                $('#modassigned_for').val(data.data[0]['accounts_approval_date']);
                $('#moddeadline').val(data.data[0]['transaction_date']);
                $('#advance_transction_id').val(data.data[0]['transaction_id']);
                $('#edit_payment').val('editPaymentData');
                $('#edit_payement_id').val(id);
            }
        })
    }
    // Add Payment Update Submit Button
    $("#PaymentUpdate").on('submit','#PaymentUpdateForm', function(event){ 
    event.preventDefault();
    $('#save').attr('disabled','disabled');
    $.ajax({
        url:"ajax/ajax_action.php",
        method:"POST",
        data:new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType:"JSON",
        beforeSend: function() {
            $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
        },
        success:function(data){	
            // location.reload();    
            $("#button-add-patment").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-pen-alt-fill"></em><span>Edit</span></button>');
            $('#PaymentUpdate').modal('toggle');              
        }
    })
});
    </script>