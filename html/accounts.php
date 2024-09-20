<?php
$country_desc = select_all("country_cost_master");
$cat_desc = select_query("category_master",array("category_id","category_name"),array());
$emp_list = select_query("employees_master",array("emp_id","emp_name","emp_email"),array());
$bank_list = select_query("bank_details",array("ID","account_holder_name", "bank_name"),array());
$university_list = select_query("university",array("university_id","university_name"),array());
$temp_list = select_query("template_ticket",array("template_id","template_name"),array());
$get_inr_data = select_query("currency_to_inr",array("currency"),array());
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
                                <h3 class="nk-block-title page-title">All Tickets For Accounts</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                      <?php if($_SESSION['emp_role'] == 'Admin' || $_SESSION['emp_role'] == 'Sales' ){?>  
                                        <ul class="nk-block-tools g-3">
                                            
                                            <li class="nk-block-tools-opt">
                                                <a onclick="addnewticket(this);" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                <a onclick="addnewticket(this);" id="addRecords" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Ticket</span></a>
                                            </li>
                                        </ul>
                                        <?php }?>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- Data Table -->
                    <!-- Div Nav Start -->
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3" role="tablist">
                                <li class="nav-item" role="presentation" onclick="get_records(this)">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1" aria-selected="true" role="tab"><em class=""></em><span>All Records</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_pending_records(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2" aria-selected="true" role="tab"><em class=""></em><span>Payment Pending Records</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabItem1" role="tabpanel">
                                        <!-- New Tickets Table Start -->
                                        <table class="nk-tb-list nk-tb-ulist  nowrap table" id="recordListing" data-auto-responsive="false">
                                            <thead>
                                                <tr>
                                                    <th>Ticket</th>				
                                                    <th>Cutomer Details</th>
                                                    <th>Ticket Status</th>
                                                    <th>Action</th>	
                                                </tr>
                                            </thead>
                                        </table>
                                        <!-- New Tickets Table Ends -->
                                </div>
                                <div class="tab-pane" id="tabItem2" role="tabpanel">
                                        <!-- New Tickets Table Start -->
                                        <table class="nk-tb-list nk-tb-ulist  nowrap table" id="recordListingPending" data-auto-responsive="false">
                                            <thead>
                                                <tr>
                                                    <th>Ticket</th>				
                                                    <th>Cutomer Details</th>
                                                    <th>Ticket Status</th>
                                                    <th>Action</th>	
                                                </tr>
                                            </thead>
                                        </table>
                                        <!-- New Tickets Table Ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Div Nav Ends -->
                </div>
            </div>
        </div>
    </div>
    <!-- Add Ticket Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="recordModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Add New Ticket</h4>
                    <hr>
                    <div class="row g-3">
                        <form  id="recordForm" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="addRecord" id="action">
                            <input type="hidden" class="form-control" id="ticket_id" name="ticket_id">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="dissertion">Apply Dissertion Rate</label>
                                        <div class="form-control-wrap">
                                            <input type="checkbox" id="rate_dissertion" name="check" value="yes"/> <br />
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Word">Word Count</label>
                                        <div class="form-control-wrap">
                                            <input type="number" class="form-control count" name="word_count" id="word_count">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Country">Country</label>
                                        <br>
                                        <select class="form-select country" name="Country" id="country">
                                            <option value="">Choose..</option>
                                            <?php foreach($country_desc as $key => $val){ ?>
                                                <option value="<?=$val['country_id']?>"><?=$val['country_name']?></option>
                                            <?php }?>
                                            <input type="hidden" class="form-control" id="currency" name="get_currency" value="">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <span id="bill_value"></span>
                            <div class="form-group row col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="extra">Extra Charges Apply</label>
                                        <div class="form-control-wrap">
                                            <input type="checkbox" id="extra_charges" /> <br />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-none" id="extra_amount_div">
                                    <div class="form-group">
                                        <label class="form-label" for="Amount">Enter Extra Amount</label>
                                        <br>
                                    
                                        <input type="text" onblur="extra_amount(this);"class="form-control" name="extra_amount" id="extra_amount" />
                                    </div>
                                </div>
                            </div>
                            
                            
                            <input type="hidden"  class="form-control" name="bill_value_amount" id="bill_value_amount">
                            <input type="hidden"  class="form-control" name="std_rate" id="std_rate">
                            <input type="hidden"  class="form-control" name="currency" id="currency">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="Name">Client Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="client_name" id="client_name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="email">Client Email</label>
                                    <div class="form-control-wrap">
                                        <input type="email" class="form-control" name="client_email" id="client_email" id="SKU">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="phone">Client phone number</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control"  name="client_phone" id="client_phone">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row col-md-12 d-none">
                                <div class=" col-md-6 ">
                                    <label class="form-label " for="Asigned">Assigned For</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-calendar"></em>
                                        </div> 
                                        <input type="text" class="form-control date-picker modleft" name="assigned_for" data-date-format="yyyy-mm-dd" id="assigned_for" >
                                        
                                    </div>
                                    </div>
                                
                                <div class=" col-md-6 d-none">
                                    <label class="form-label " for="Asigned">Deadline</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-calendar"></em>
                                        </div> 
                                        <input type="text" class="form-control date-picker mod" data-date-format="yyyy-mm-dd" name="deadline" id="deadline" >
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 d-none">
                                <div>
                                    <label class="form-label" for="category">Category</label>
                                </div>
                                    <select class="drop2 form-select" name="Category" id="category">
                                    <?php foreach($cat_desc as $key => $val){ ?>
                                        <option value="<?=$val['category_id']?>"><?=$val['category_name']?></option>
                                    <?php }?>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-12 mt-4" id="button-add">
                                <button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                            </div>
                        </form>            
                </div>
            </div>
        </div>
    </div>
    <!-- Add Ticket Modal Ends-->


        <!--Payment Attachment Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="get_paymentFiles">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Payment Attachments</h4>
                    <div id="payment_attachment_files"> </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            get_records();
            $('#modassigned_for').datetimepicker({
                // format:'Y-m-d H:i',
                inline:true
            });
            $('#moddeadline_for').datetimepicker({
                // format:'Y-m-d H:i',
                inline:true
            });
          
        });  
        
        function get_records(){
            // dataRecords.destroy();
            if ( $.fn.DataTable.isDataTable('#recordListing') ) {
                $('#recordListing').DataTable().destroy();
                }

                $('#recordListing tbody').empty();
            var dataRecords = $('#recordListing').DataTable({
                "lengthChange": true,
                "processing": true,
                "retrieve": true,
                "serverMethod": 'post',
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'get_account_records'},
                    dataType:"json"
                },
                "columnDefs":[
                    {
                        "targets":[0, 1, 2],
                        "orderable":true,
                    },
                    { "width": "2%", "targets": 0 }
                ],
                "pageLength": 50
            });	
        }
        function get_pending_records(){
            // dataRecords.destroy();
            if ( $.fn.DataTable.isDataTable('#recordListingPending') ) {
                $('#recordListingPending').DataTable().destroy();
                }

                $('#recordListingPending tbody').empty();
            var dataRecords = $('#recordListingPending').DataTable({
                "lengthChange": true,
                "processing": true,
                "retrieve": true,
                "serverMethod": 'post',
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'get_pending_records'},
                    dataType:"json"
                },
                "columnDefs":[
                    {
                        "targets":[0, 1, 2],
                        "orderable":true,
                    },
                    { "width": "2%", "targets": 0 }
                ],
                "pageLength": 50
            });	
        }
        //extra charges
        $('#extra_charges').change(function() {
            if($(this).is(":checked")) {
                $('#extra_amount_div').removeClass('d-none');
            }        
        });

        $("#extra_amount").blur(function(){

            var country = $('#country').val();
            var word_count = $('#word_count').val();
            var amount_val = $('#extra_amount').val();
           

            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{
                    data: country,
                    action: 'getRateByCountry'
                },
                dataType:"JSON",
                success:function(data){
                //console.log(data); 
                    if(data.status == 'success'){ 
                    $("#bill_value").html('');

                        var bill_value = (parseFloat(data.data[0]['rate']) / data.data[0]['word_limit'])* word_count;
                         if(amount_val != ''){
                            
                         var bill_value = bill_value + parseFloat(amount_val);
                         } 
                         
                         
                         $("#bill_value").html("Your Biil is:"+parseFloat(bill_value).toFixed(2)+' '+ data.data[0]['currency']);
                         $('#bill_value').css("color", "red");
                         $('#std_rate').val(data.data[0]['rate']);
                         $('#currency').val(data.data[0]['currency']);
                         $('#bill_value_amount').val(parseFloat(bill_value).toFixed(2));
                         $('#get_currency').val(data.data[0]['currency']);

                         
                    }
                }
            })

        });

        $('#addRecords').click(function(){
            $('#ticket_modal_header').html("<i class='fa fa-plus'></i> New Ticket");
            $('#action').val('addRecord');
	    });
        $("#recordModal").on('submit','#recordForm', function(event){ 
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
                    $("#button-add").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		 alert("Ticket Created And Proforma Invoice Send To Mail ID"); 
                    $("#button-add").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>');		
                //    location.reload();
                   $('#recordModal').modal('toggle');
                   ticket_datatables();

                }
            })
        });
        $("#country").change(function() {
           
            var selectedVal = $(this).find(':selected').val();
            var word_count = $('#word_count').val();
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{data: selectedVal,action: 'getRateByCountry'},
                dataType:"JSON",
                success:function(data){	
                    console.log(data);
                    if(data.status == 'success'){  
                        if($("#rate_dissertion").prop('checked') == true){
                            var bill_value = (data.data[0]['dissertation_rate'] / data.data[0]['word_limit']) * word_count;
                        }else{
                            var bill_value = (data.data[0]['rate'] / data.data[0]['word_limit']) * word_count;
                        }
                       
                                               
                         $("#bill_value").html("Your Biil is:"+parseFloat(bill_value).toFixed(2)+ " "+data.data[0]['currency']);
                         $('#bill_value').css("color", "red");
                         $('#std_rate').val(data.data[0]['rate']);
                         $('#currency').val(data.data[0]['currency']);
                         $('#bill_value_amount').val(parseFloat(bill_value).toFixed(2));
                         
                    }
                }
            })
        }); 
        function addnewticket(e){
            // alert("ho");
            $("#recordModal").trigger( "reset" );               
            $('#recordModal').modal('show');
        }
        function view_attchment(e){
            var id = $(e).data("id");
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{action:"get_attachment_by_id",ticket_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                     $('#modalAttachment').modal('show'); 
                   var html1 = '';
                   if((data.data1.length == 0))
                    {
                        html1 += '<span class="form-label Title">Sorry, No data found for Input file</span>';
                    }
                    $.each(data.data1, function(i, item) {
                        //console.log(i);console.log(item);
                        html1 += '<span class="form-label Title"> <a href="html/download.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                    
                    });
                    var html2 = '';
                    if((data.data2.length == 0))
                    {
                        html2 += '<span class="form-label Title">Sorry, No data found for output file</span>';
                    }
                    else{
                        $.each(data.data2, function(i, item) {
                           // console.log(i);console.log(item);
                            html2 += '<span class="form-label Title"> <a href="html/download_output.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                        
                        });
                    }
                    $('#attachmen_div_input').html(html1); 
                    $('#attachmen_div_output').html(html2); 
                }
            })
            
        } 
        function downloadFile(file_name) {
            var filename = "../upload/"+file_name;
             window.location.href = filename;
        }  

        // Edit Ticket Submit Modal
        $("#updatemodal").on('submit','#ticketform', function(event){ 
            event.preventDefault();
             $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-edit").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                //    location.reload();
                $("#button-add").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-list-check"></em><span>Save</span></button>');
                $('#updatemodal').modal('toggle');
                ticket_datatables();
               }
            })
        });
                // Ticket Modal Data
                function get_id(e){
            var id = $(e).data("id");
            // alert(id);
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{action:"get_ticket_desc",ticket_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                    $('#modalTicketdata').modal('show'); 
                    console.log(data);
                    console.log(data.data);
                    console.log(data.data[0]['ticket_id']);
                    console.log(data.data[0]['ticket_name']);
                    console.log(data.data[0]['ticket_desc']);
                    $('#ticket_data_id').html("#" + data.data[0]['ticket_id']);
                    $('#ticket_data_name').html(data.data[0]['ticket_name']);
                    $('#ticket_data_desc').html(data.data[0]['ticket_desc']);
                }
            })
        }

        // View Payment Attachment
        function downloadDocumnets(e){
            var id = $(e).data("id");
            // alert(id);
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{action:"get_payment_files",ticket_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                    $('#get_paymentFiles').modal('show'); 
                    console.log(data);
                    var html = '';
                    $.each(data.data, function(i, item) {
                        console.log(i);console.log(item);
                        html += '<span class="form-label Title"> <a href="html/download_payment.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                    
                    });
                    $('#payment_attachment_files').html(html);        
                }
            })
            
        } 
    flatpickr("input[type=datetime-local]", config);
    </script>
	
<script type="text/javascript">
 
$(function () {
 

 
});
 
</script>