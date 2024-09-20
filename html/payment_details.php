<?php
$ticketId = $_GET['ticketId'];
$payment_desc = select_query("payment_master",array("p_id","file_name", "status", "transaction_id", "date_added", "accounts_approval_date", "amount_received"),array("ticket_id" => "$ticketId"));
$bank_list = select_query("bank_details",array("ID","account_holder_name", "bank_name"),array());
$get_currency = select_query("country_cost_master",array('currency'), array());
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
                                <h3 class="nk-block-title page-title">Payment Details #<?php print_r("$ticketId")?></h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->  
                    <div class="card card-inner">                 
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Transaction ID</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Transaction Date</th>
                                    <th scope="col">Status</th>
                                    <?php if($_SESSION['emp_role'] == "Admin" || $_SESSION['emp_role'] == "Accounts"){
                                    ?><th scope="col">Action</th>
                                    <?php } ?>
                                    <?php if(($_SESSION['emp_role'] == "Admin") && (in_array($payment_desc[0]['status'], $ticket_advance_edit_applicable))){
                                    ?><th scope="col">Edit</th>
                                    <?php
                                }
                                ?>
                                </tr>
                            </thead>
                            <?php
                            foreach($payment_desc as $key => $val){ 
                            ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $val['transaction_id'];?></td>
                                    <td><?php echo $val['amount_received'];?></td>
                                    <td><?php echo $val['date_added'];?></td>
                                    <?php if($val['status'] == "Pending")
                                    {
                                        ?>
                                        <td><span class="badge badge-sm badge-dim bg-outline-danger d-none d-md-inline-flex"><?php echo $val['status']?></span></td>     
                                    <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <td><span class="badge badge-sm badge-dim bg-outline-info d-none d-md-inline-flex"><?php echo $val['status']?></span></td>
                                    <?php
                                    }
                                    ?>
                                    <?php 
                                    if($val['status'] == "Pending" && (($_SESSION['emp_role'] == "Admin") ||($_SESSION['emp_role'] == "Accounts"))){
                                    ?>
                                        <td>
                                        <a onclick="ticketAdvanced(this);" id="advance-payment" data-id= "<?php echo($val['p_id'])?>" class="btn btn-sm btn-outline-primary mt-3"><em class="icon ni ni-sign-inr"></em><span>Add Payment</span></a>
                                    </td>
                                    <?php
                                    }
                                    elseif(($_SESSION['emp_role'] == "Admin") ||($_SESSION['emp_role'] == "Accounts")){
                                        ?>
                                        <td><span class="badge badge-sm badge-dim bg-outline-success d-none d-md-inline-flex">Payment Completed</span></td>
                                    <?php
                                    }
                                    if(($_SESSION['emp_role'] == "Admin") && (in_array($payment_desc[0]['status'], $ticket_advance_edit_applicable))){
                                    ?>
                                    <td>
                                        <a onclick="edit_advance(this);" id="edit-payment" data-id= "<?php echo($val['p_id'])?>" class="btn btn-sm btn-outline-primary mt-3"><em class="icon ni ni-edit-alt-fill"></em><span>Edit Payment</span></a>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- New Modal For Payment Advance Modal-->
    <div class="modal fade" tabindex="-1" id="PaymentAdvance" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Add Advance</h4>
                    <ul class="nk-nav nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="tab" href="#tabItem1" aria-selected="false" role="tab" tabindex="-1">Add Amount</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#tabItem2" aria-selected="true" role="tab">Transaction Details</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#tabItem3" aria-selected="true" role="tab">Show Attachment</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#tabItem7" aria-selected="true" role="tab">Get Remarks</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tabItem1" role="tabpanel">
                            <div class=" row">
                            <div class="col-6 form-group">
                                <form action="" id="PaymentAdvanceForm" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="" id="advance_action">
                                    <input type="hidden" class="form-control" id="advance_ticket_id" name="advance_ticket_id">
                                    <input type="hidden" class="form-control" id="advance_payment_id" name="advance_payment_id">
                                    <div class="col-12 d-none">
                                        <div class="form-group">
                                            <label class="form-label" for="TicketName">Invoice Number</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="invoice_number" name="invoice_number" placeholder="Invoice Number" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="Ticketvalue">Ticket Value</label>
                                            <div class="form-control-wrap">
                                                <div class="form-text-hint get_country"><span class="overline-title"></span></div>
                                                    <input  type="text" class="form-control" id="ticket_value"  name="ticket_value" placeholder="Ticket Value" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="Ticketvalue">Advance</label>
                                            <div class="form-control-wrap">
                                                <div class="form-text-hint get_country"><span class="overline-title"></span></div>
                                                    <input type="text" class="form-control" id="ticket_advance" onblur="payment_value(this)" name="ticket_advance" placeholder="Enter Advance Amount">
                                                    <span id="amount_alert"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="TicketName">Payment Uploaded Date</label>
                                                <div class="form-control-wrap">
                                                    <input type="float" class="form-control" id="date_payment" name="date_payment" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Ticketvalue">Account Approval Date</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" id="accounts_approval_date" name="accounts_approval_date" class="form-control date-picker" data-date-format="yyyy-mm-dd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Ticketvalue">Transation Date</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" id="transaction_date" name="transaction_date" class="form-control date-picker" data-date-format="yyyy-mm-dd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="TicketName">Current Rate</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-text-hint"><span class="overline-title"><a  onclick="get_rate(this);" data-id="<?php echo $ticketId;?>" id="get_rate_for_id" class="btn btn-icon btn-sm btn-primary"><em class="icon ni ni-reload-alt"></em></a></span></div>
                                                    <input type="float" class="form-control rate_current" id="rate_current" name="rate_current" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Ticketvalue">Trasction ID</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="advance_transction_id" name="advance_transction_id" placeholder="Enter Tranction ID">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row form-group">
                                            <div class="form-group">
                                                <label class="form-label" for="Bank">Choose Bank</label>
                                                <br>
                                                <select class="form-select bank" name="bank" id="bank">
                                                    <option value="">Choose...</option>
                                                    <?php foreach($bank_list as $key => $val){ ?>
                                                        <option value="<?php echo $val['ID'];?>"><?php echo $val['account_holder_name'] ;?>(<?php echo $val['bank_name'] ;?>)</option>
                                                    <?php }?>    
                                                </select>
                                            </div>
                                        </div>
                                                
                                        <div class="col-12 mt-4" id="button-add">
                                            <button type="submit" id="button-add-patment" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add</span></button>
                                        </div>
                                </form>
                            </div>
                                <div class="col-6 form-group">
                                    <img src="" id="payment_upload_img">
                                </div>
                            </div>
                            
                    
                        </div>
                        <div class="tab-pane" id="tabItem2" role="tabpanel">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="data_payment_listing">

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tabItem3" role="tabpanel">
                            <!--  Modal body with image -->
                            <div class="modal-body">
                                <img id="img_id" src="" />
                                <iframe width="560" height="315" src="" id="get_img_id" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class = "img_id"></iframe>
                            
                            </div>
                        </div>
                        <div class="tab-pane" id="tabItem7" role="tabpanel">
                            
                            <div class="modal-body" style="padding: 50px">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">
                                            <p id="get_remarks" style="position: relative;bottom: 43px;"></p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Modal for Advance Table Ends -->

       <!-- Edit Modal For Payment Advance Modal-->
    <div class="modal fade" tabindex="-1" id="EditPaymentAdvance" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Edit Ticket Advance</h4>
                    <ul class="nk-nav nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="tab" href="#tabItem4" aria-selected="false" role="tab" tabindex="-1">Edit Amount</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#tabItem5" aria-selected="true" role="tab">Transaction Details</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#tabItem6" aria-selected="true" role="tab">Show Attachment</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#tabItem8" aria-selected="true" role="tab">Get Remarks</a></li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active show" id="tabItem4" role="tabpanel">
                            <div class=" row">
                                <div class="col-6 form-group">
                                    <form action="" id="EditPaymentAdvanceForm" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="action" value="" id="advance_action_edit">
                                        <input type="hidden" class="form-control" id="advance_ticket_id_edit" name="advance_ticket_id">
                                        <input type="hidden" class="form-control" id="advance_payment_id_edit" name="advance_payment_id">
                                        <div class="col-12 d-none">
                                            <div class="form-group">
                                                <label class="form-label" for="TicketName">Invoice Number</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="invoice_number" name="invoice_number" placeholder="Invoice Number" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Ticketvalue">Ticket Value</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-text-hint get_country"><span class="overline-title"></span></div>
                                                        <input  type="text" class="form-control" id="ticket_value_edit"  name="ticket_value" placeholder="Ticket Value" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Ticketvalue">Advance</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-text-hint get_country"><span class="overline-title"></span></div>
                                                    <input type="text" class="form-control" id="ticket_advance_edit" onblur="payment_value(this)" name="ticket_advance" placeholder="Enter Advance Amount" value="">
                                                    <span id="amount_alert"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="TicketName">Payment Uploaded Date</label>
                                                <div class="form-control-wrap">
                                                    <input type="float" class="form-control" id="date_payment_edit" name="date_payment" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Ticketvalue">Account Approval Date</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" id="accounts_approval_date_edit" name="accounts_approval_date" class="form-control date-picker" data-date-format="yyyy-mm-dd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Ticketvalue">Transation Date</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" id="transaction_date_edit" name="transaction_date" class="form-control date-picker" data-date-format="yyyy-mm-dd">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="TicketName">Current Rate</label>
                                                <div class="form-control-wrap">
                                                    <div class="form-text-hint"><span class="overline-title"><a  onclick="get_rate(this);" data-id="<?php echo $ticketId;?>" id="get_rate_for_id" class="btn btn-icon btn-sm btn-primary"><em class="icon ni ni-reload-alt"></em></a></span></div>
                                                    <input type="float" class="form-control rate_current" id="rate_current_edit" name="rate_current" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Ticketvalue">Trasction ID</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" id="advance_transction_id_edit" name="advance_transction_id" placeholder="Enter Tranction ID">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 row form-group">
                                            <div class="form-group">
                                                <label class="form-label" for="Bank">Choose Bank</label>
                                                <br>
                                                <select class="form-select bank" name="bank" id="bank_edit">
                                                    <option value="">Choose...</option>
                                                    <?php foreach($bank_list as $key => $val){ ?>
                                                        <option value="<?php echo $val['ID'];?>"><?php echo $val['account_holder_name'] ;?>(<?php echo $val['bank_name'] ;?>)</option>
                                                    <?php }?>    
                                                </select>
                                            </div>
                                        </div>
                                                    
                                        <div class="col-12 mt-4" id="button-edit">
                                            <button type="submit" id="button-edit-patment" class="btn btn-primary"><em class="icon ni ni-pen"></em><span>Edit</span></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-6 form-group">
                                    <img src="" id="payment_upload_img_edit">
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane" id="tabItem5" role="tabpanel">
                            <table class="table">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Transaction ID</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="data_payment_listing_edit">

                                </tbody>
                            </table>
                        </div>
                            <div class="tab-pane" id="tabItem6" role="tabpanel">
                                         <!--  Modal body with image -->
                                            <div class="modal-body">
                                                <img id="img_id" src="" />
                                                <iframe width="560" height="315" src="" id="get_img_id_edit" title="Payment Attachment View" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class = "img_id"></iframe>
                                            
                                            </div>
                            </div>
                            <div class="tab-pane" id="tabItem8" role="tabpanel">
                            
                            <div class="modal-body" style="padding: 50px">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">
                                            <p id="get_remarks_edit" style="position: relative;bottom: 43px;"></p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Modal for Advance Table Ends -->

        <!-- Modal for Add Exchange Data -->
        <div class="modal fade" tabindex="-1" role="dialog" id="exchangeModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Add Exchange Data</h4>
                    <hr>
                    <div class="row g-3">
                        <form  id="exchangeModalForm" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="addRecord" id="action">
                            <input type="hidden" class="form-control" id="exchange_id" name="exchange_id">
                            <?php foreach($get_currency as $key => $val){ ?>
                            
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="dissertion"><?php echo($val['currency'])?></label>
                                        <div class="form-control-wrap">
                                            <input type="text" id="rate_dissertion" name="<?php echo($val['currency'])?>" /> <br />
                                        </div>
                                    </div>
                                </div>
                            <?php }?>
                            <div class="col-12 mt-4" id="button-exchange">
                                <button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add Currency Exchange</span></button>
                            </div>
                        </form>            
                    </div>
                </div>
            </div>
        </div>
<!-- Modal for Add Exchange Data Ends -->
<script>  
        function ticketAdvanced(e){
            var id = $(e).data("id");
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{payment_id:id, action:'getAdvanceDetailsById'},
                dataType:"JSON",
                success:function(data){ 
                    if(data.data == "No Data Found")
                    {
                        $('#exchangeModal').modal('show');
                        $('#action').val('addExchangeValue');
                    }
                    else{
                    var amount = data.data1[0]['invoice_amount']-data.data1[0]['Total_paid'];
                    $('#PaymentAdvanceForm')[0].reset();
                    $('#PaymentAdvance').modal('show'); 
                    $('#ticket_value').val(amount);
                    $('.get_country').html(data.data1[0]['amount_received']); 
                    $('#rate_current').val(data.data1[0]['exchange']); 
                    $('#data_payment_listing').html(data.data1[0]['html']);
                    $('#date_payment').val(data.data1[0]['attachment']);
                    $("#payment_upload_img").attr("src","upload/payment_receive/"+data.data1[0]['file_name']);
                    if (amount == 0 )
                    {
                        $('#button-add-patment').attr('disabled','disabled');
                    }
                    var now = new Date();
                    var day = ("0" + now.getDate()).slice(-2);
                    var month = ("0" + (now.getMonth() + 1)).slice(-2);
                    var today = now.getFullYear() + "-" + (month) + "-" + (day);
                    
                    $('#accounts_approval_date').val(today);
                    $('#transaction_date').val(today);
                    $('#advance_action').val('addAdvancePayment');
                    $('#advance_payment_id').val(id);
                    $("#get_img_id").attr("src","upload/payment_receive/"+data.data2);
                    $('#get_remarks').html(data.data1[0]['get_remarks']);
                    }
                    
                }
            })
        }
        function payment_value(e){
            var ticket_val = $('#ticket_value').val();
            var current_val = $(e).val();
            if(current_val > ticket_val){
                $("#amount_alert").html("Amount is Greater than Ticket Value").css("color", "red");
                // $('input[name=ticket_advance').val('');
            }
            else if(current_val <= 0){
                $("#amount_alert").html("Amount Can't be Less than 1").css("color", "red");
                $('input[name=ticket_advance').val('');
            }
            else{
                $("#amount_alert").text("");
            }
           
        }
        $("#exchangeModal").on('submit','#exchangeModalForm', function(event){ 
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
                    $("#button-exchange").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                    $("#button-exchange").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add Cuurency Exchange</span></button>');
                    $('#exchangeModal').modal('toggle');
                    ticketAdvanced();
                }
            })
        });
        function get_rate(e){
            var id = $(e).data("id");
            var date = $('#transaction_date').val();
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{ticket_id:id, date:date, action:'get_rate'},
                dataType:"JSON",
                success:function(data){ 
                    $('.rate_current').val(data.data);
                }
            })
        }
         // Add Advance Submit Button
         $("#PaymentAdvance").on('submit','#PaymentAdvanceForm', function(event){ 
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

                    location.reload();
                  
                }
            })
        });
            // Get Ticket Advance Table Edit Modal
            function edit_advance(e){
            var id = $(e).data("id");
            // alert(id);
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{action:"get_adv_data", get_p_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                    $('#EditPaymentAdvance').modal('show'); 
                    console.log(data.data[0]['html']);
                    var amount = data.data[0]['invoice_amount']-data.data[0]['amount'];
                    $('#ticket_value_edit').val(amount);
                    $('#ticket_advance_edit').val(data.data[0]['amount_received']);
                    $('#date_payment_edit').val(data.data[0]['attachment']);
                    $('#accounts_approval_date_edit').val(data.data[0]['accounts_approval_date']);
                    $('#transaction_date_edit').val(data.data[0]['transaction_date']);
                    $('.rate_current').val(data.data[0]['inr_rate']);
                    $('#data_payment_listing_edit').html(data.data[0]['html']);
                    $('#advance_transction_id_edit').val(data.data[0]['transaction_id']);
                    $('#bank_edit').val(data.data[0]['bank_details_id']);
                    $('#advance_action_edit').val('addAdvancePayment');
                    $('#advance_payment_id_edit').val(id);
                    $("#payment_upload_img_edit").attr("src","upload/payment_receive/"+data.data[0]['file_name']);
                    $("#get_img_id_edit").attr("src","upload/payment_receive/"+data.data2);
                    $('#get_remarks_edit').html(data.data[0]['get_comments']);
                }
            })
        }
        // Edit Ticket Submit Modal
        $("#EditPaymentAdvance").on('submit','#EditPaymentAdvanceForm', function(event){ 
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
                    $("#button-edit-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                $("#button-edit-patment").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-list-check"></em><span>Save</span></button>');
                $('#EditPaymentAdvance').modal('toggle');
               }
            })
        });
    </script>