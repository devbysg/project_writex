<?php
$country_desc = select_all("country_cost_master");
$cat_desc = select_query("category_master",array("category_id","category_name"),array());
$emp_list = select_query("employees_master",array("emp_id","emp_name","emp_email"),array());
$bank_list = select_query("bank_details",array("ID","account_holder_name", "bank_name"),array());
$university_list = select_query("university",array("university_id","university_name"),array());
$temp_list = select_query("template_ticket",array("template_id","template_name"),array());
?>

    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner" style="width: 1378px;">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Tickets</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                      <?php if($_SESSION['emp_role'] == 'Admin' || $_SESSION['emp_role'] == 'Sales' || $_SESSION['emp_role'] == 'team_leader_sales' || $_SESSION['emp_role'] == 'sales_lead'){?>  
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
                                <li class="nav-item" role="presentation" onclick="ticket_datatables(this)">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem6" aria-selected="true" role="tab"><em class=""></em><span>Ticket</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="new_ticket(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem4" aria-selected="true" role="tab"><em class=""></em><span>Newly Created</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabItem6" role="tabpanel">
                                        <!-- New Tickets Table Start -->
                                        <table class="nk-tb-list nk-tb-ulist  nowrap table" id="recordListing" data-auto-responsive="false">
                                            <thead>
                                                <tr>
                                                    <th>Ticket</th>				
                                                    <th>Cutomer Details</th>
                                                    <th>Assigned Date</th>	
                                                    <th>Deadline</th>	
                                                    <th>Remaining Date</th>	
                                                    <th>Ticket Status</th>
                                                    <!-- <th>Payment Status</th> -->
                                                    <th>Action</th>	
                                                </tr>
                                            </thead>
                                        </table>
                                        <!-- New Tickets Table Ends -->
                                </div>
                                <div class="tab-pane" id="tabItem4" role="tabpanel">
                                        <!-- New Tickets Table Start -->
                                        <table class="nk-tb-list nk-tb-ulist  nowrap table" id="get_new_ticket" data-auto-responsive="false">
                                            <thead>
                                                <tr>
                                                    <th>Ticket</th>				
                                                    <th>Cutomer Details</th>
                                                    <th>Assigned Date</th>	
                                                    <th>Deadline</th>	
                                                    <th>Remaining Date</th>	
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
                    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                        
                           
                                <h5>New Ticket</h5>
                           
                        
                        <!-- Modal -->
                        
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalAttachment">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Attachments</h4>
                    <hr>
                    <label for="input">Input Documents</label>
                    <div id = "attachmen_div_input" ></div>
                    <hr>
                    <label for="output">Output Documents</label>
                    <div id = "attachmen_div_output" ></div>
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
                                        <input type="text" class="form-control" name="client_name" id="client_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="email">Client Email</label>
                                    <div class="form-control-wrap">
                                        <input type="email" class="form-control" name="client_email" id="client_email" id="SKU" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="phone">Client phone number</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control"  name="client_phone" id="client_phone" required>
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
                            <div class="col-12 mt-4" id="button-add-new">
                                <button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                            </div>
                        </form>            
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Ticket Modal Ends-->
    <!-- New Modal for Advance Table -->
        <!-- New Modal -->
        <div class="modal fade" tabindex="-1" id="PaymentAdvance" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Add Advance</h4>
                    <ul class="nk-nav nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" data-bs-toggle="tab" href="#tabItem1" aria-selected="false" role="tab" tabindex="-1">Add Amount</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-bs-toggle="tab" href="#tabItem2" aria-selected="true" role="tab">Transaction Details</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tabItem1" role="tabpanel">
                        <form action="" id="PaymentAdvanceForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="" id="advance_action">
                        <input type="hidden" class="form-control" id="advance_ticket_id" name="advance_ticket_id">
                        <div class="col-12">
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
                                    <input  type="text" class="form-control" id="ticket_value"  name="ticket_value" placeholder="Ticket Value" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="Ticketvalue">Advance</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="ticket_advance" onkeyup="payment_value(this)" name="ticket_advance" placeholder="Enter Advance Amount">
                                    <span id="amount_alert"></span>
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
                                <label class="form-label" for="Ticketvalue">Trasction ID</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="advance_transction_id" name="advance_transction_id" placeholder="Enter Tranction ID">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Modal for Advance Table Ends -->
    <div class="modal fade" tabindex="-1" role="dialog" id="AssignedSme">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Assigned SME's</h4>
                    <form action="" id="AssignedSmeForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="" id="assigned_sme_action">
                        <input type="hidden" class="form-control" value="" id="ticket_id_sme_assign" name="ticket_id_sme_assign">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="TicketName">Ticket Name</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="ticket_name_sme_assigned" name="ticket_name_sme_assigned" placeholder="Invoice Number" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="Ticketvalue">Ticket Desc</label>
                                <div class="form-control-wrap">
                                    <input  type="text" class="form-control" id="ticket_desc_sme_assigned"  name="ticket_desc_sme_assigned" placeholder="Ticket Value" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Assign SME's</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2 select2-hidden-accessible" multiple="" name="empid[]" data-placeholder="Select Multiple options" data-select2-id="9" tabindex="-1" aria-hidden="true">
                                            <?php foreach($emp_list as $key => $val){ ?>
                                                <option value="<?=$val['emp_id']?>"><?=$val['emp_name']?>(<?=$val['emp_email']?>)</option>
                                            <?php }?>
                                    </select>
                                    
                                </div>
                            </div>
                        </div>
                       
                                    
                        <div class="col-12 mt-4" id="button-add">
                            <button id="button-add-assigned-sme" type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="updatemodal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md text-center3">
                    <h4 class="title ">Task Allocation For SE</h4>
                    <hr>
                    <form action="" id="ticketform" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="" class="modaction" id="modaction">
                        <label class="form-label" for="Template">Ticket ID</label>
                        <br>
                        <input type="text" class="form-control" id="modticket_id" name="modticket_id" readonly>
                        <div class="form-group row col-md-12">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label" for="University">Choose University</label>
                                                <br>
                                                <select class="form-select university" name="university" id="university">
                                                    <option value="">Choose...</option>
                                                    <?php foreach($university_list as $key => $val){ 
                                                        ?>
                                                        <option value="<?php echo $val['university_id'];?>"><?php echo $val['university_name'] ;
                                                        ?></option>
                                                    <?php }
                                                 ?>    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label" for="Template">Choose Template</label>
                                                <br>
                                                <select class="form-select template" name="template" id="template">
                                                    <option value="">Choose...</option>
                                                    <?php foreach($temp_list as $key => $val){ 
                                                        ?>
                                                        <option value="<?php echo $val['template_id'];?>"><?php echo $val['template_name'] ;
                                                        ?></option>
                                                    <?php }
                                                 ?>    
                                                </select>
                                            </div>
                                        </div>
                        </div>

                        <div class="col-md-12 mt-2">
                            <div class="form-group">
                                <label class="form-label" for="Ticket">Ticket Description</label>
                                <div class="form-control-wrap">
                                    
                                    <textarea class="form-control no-resize" rows = "5" name="modticket_desc" id="modticket_desc"></textarea>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class=" col-md-4 ">
                                <label class="form-label" for="TicketName">Module Code</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="modticket_name" name="code_module" placeholder="Enter Module Code">
                                </div>
                            </div>
                            <div class=" col-md-4 ">
                                <label class="form-label " for="Asigned">Assigned For</label>
                                <div class="form-control-wrap">
                        
                                     <input type="datetime-local" class="form-control modleft" name="modassigned_for" data-date-format="yyyy-mm-dd" id="modassigned_for" placeholder="Select DateTime" >
                                </div>

                               
                            </div>
                            
                            <div class=" col-md-4 ">
                                <label class="form-label " for="Asigned">Deadline</label>
                                <div class="form-control-wrap">
                                    <input type="datetime-local" class="form-control modleft" name="moddeadline_for" data-date-format="yyyy-mm-dd" id="moddeadline_for" placeholder="Select DateTime" >
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-12 mt-2">
                            <label class="form-label" for="file">Select Image to upload:</label>
                            <input type="file" class="form-control" id="modticketimage" name="modticket_image[]" multiple>
                        </div>
                        <div class="col-md-12 mt-3 " id="button-edit">
                            <button type="submit" class="btn btn-primary"><em class="icon ni ni-list-check"></em><span>Save</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="sendOutputModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md text-center3">
                    <h3 class="title ">Send Output</h3>
                    <hr>
                    <form id="sendOutputform" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="" class="modaction_send_output" id="modaction_send_output">
                        <input type="hidden" class="form-control" value="" id="modid_send_output" name="ticket_id">
                        <div class="col-12">
                            <div class="form-group">
                                <h3 id="ticket_id_output"></h3>
                                <label class="form-label" for="file">Are You Sure Want To Send Output To The Mail ?</label>
                                <input type="text" class="form-control" id="client_email_output" name="client_email_output" placeholder="Optional Extra Email ID(Ex: abc@email.com,xyz@email.com)">
                            </div>
                        </div>
                        
                        <div class="col-md-12 mt-3 " id="button-edit">
                            <button type="submit" id="send_output_final" class="btn btn-primary"><em class=""></em><span>Send</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="sendInvoiceModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md text-center3">
                    <h4 class="title ">Send Invoice</h4>
                    <hr>
                    <form id="sendInvoiceform" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="" class="modaction_send_invoice" id="modaction_send_invoice">
                        <input type="hidden" class="form-control" value="" id="modid_send_invoice" name="ticket_id">
                        <div class="col-12">
                            <div class="form-group">
                                <h3 id="ticket_id_invoice"></h3>
                                <label class="form-label" for="file">Are You Sure Want To Send Final Invoice To The Mail ?</label>
                                <input type="text" class="form-control" id="client_email_output" name="client_email_output" placeholder="Optional Extra Email ID(Ex: abc@email.com,xyz@email.com)">
                            </div>
                        </div>
                        
                        <div class="col-md-12 mt-3 " id="button-edit">
                            <button type="submit" id="send_invoice_final" class="btn btn-primary"><em class=""></em><span>Send</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Ticket Data Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalTicketdata">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <div class="col-md-12 mt-2">
                        <span id="ticket_data_id" style="color: blue;font-size: 24px;"></span> &nbsp;&nbsp;&nbsp;&nbsp;
                        <span id="ticket_data_name" style="color: blue;font-size: 24px;"></span>
                    </div>
                    <hr>
                    <div id="ticket_data_desc"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ticket Data Modal Ends -->
    <!-- Upload Payment Files Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="uploadPaymentattachment">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Upload Payment Attachments</h4>
                    <hr>
                    <form action="" id="uploadpaymentform" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="" class="uploadpaymentaction" id="uploadpaymentaction">
                            <input type="hidden" class="form-control" id="uploadpaymentticket_id" name="uploadpaymentticket_id">
                            <input type='file' class="form-control" multiple id="uploadpaymentattachment" name="uploadpaymentattachment[]" accept="image/*" onchange="readURL(this);" required/>
                            <br>
                            <img id="preview_image" src="" alt="Insert Payment screenshot" />
                        <div class="col-12 mt-4" >
                        <div class="form-group">
                                    <textarea class="form-control no-resize" placeholder="Add Comment" rows = "5" name="add_bdecomments" id="get_add_remarks"></textarea>
                            </div>
                            <button type="submit" id="button-uploadsme" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload Payment Files</span></button>
                        </div>
                    </form>
                    <p id="demo"></p>
                        
                </div>
            </div>
        </div>
    </div>
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

    <!-- Add Comments -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addComments">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                <div class="col-md-12 mt-2">
                        <span id="get_assign_id" style="color: blue;font-size: 24px; font-weight: 600"></span>
                            <!-- <span id="get_name" style="color: blue;font-size: 24px;"></span> -->
                    </div>

                    <form action="" id="addCommentsForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="" id="addTeamLeadComment">
                        <input type="hidden" class="form-control" value="" id="ticket_id_TeamLead_Comment" name="ticket_id_TeamLead_Comment">
                        <div class="col-12">
                            <div class="form-group">
                                <!-- <div class="form-control-wrap">
                                <label for="input">Input Documents</label>
                    <div id = "attachmen_div_input" ></div>
                    <hr> -->
                                    <textarea class="form-control no-resize" placeholder="Add Comment" rows = "5" name="add_TLremarks" id="get_add_remarks"></textarea>
                                <!-- </div> -->
                            </div>
                        </div>
                        <div class="col-12 mt-4" id="button-add">
                            <button id="button-add-comments" type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            ticket_datatables();
            $('#modassigned_for').datetimepicker({
                // format:'Y-m-d H:i',
                inline:true
            });
            $('#moddeadline_for').datetimepicker({
                // format:'Y-m-d H:i',
                inline:true
            });
          
        });  
        function myFunction() {
            var x = document.getElementById("uploadpaymentattachment").required;
            document.getElementById("demo").innerHTML = x;
        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview_image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        function ticket_datatables(){
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
                    data:{action:'listRecords'},
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
        // Order By Id
        function new_ticket(){
            // dataRecordsNew.destroy();
            if ( $.fn.DataTable.isDataTable('#get_new_ticket') ) {
                $('#get_new_ticket').DataTable().destroy();
                }

                $('#get_new_ticket tbody').empty();
            var dataRecordsNew = $('#get_new_ticket').DataTable({
                "lengthChange": true,
                "processing": true,
                "retrieve": true,
                "serverMethod": 'post',
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'listIdRecords'},
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
                  
                        if($("#rate_dissertion").prop('checked') == true)
                        {
                            var bill_value = (parseFloat(data.data[0]['dissertation_rate']) / data.data[0]['word_limit'])* word_count;
                            $('#std_rate').val(data.data[0]['dissertation_rate']);
                        }
                        else{
                            var bill_value = (parseFloat(data.data[0]['rate']) / data.data[0]['word_limit'])* word_count;
                            $('#std_rate').val(data.data[0]['rate']);
                        }
                         if(amount_val != ''){
                            
                         var bill_value = bill_value + parseFloat(amount_val);
                         } 
                         
                         
                         $("#bill_value").html("Your Biil is:"+parseFloat(bill_value).toFixed(2)+' '+ data.data[0]['currency']);
                         $('#bill_value').css("color", "red");
                       
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
                    $("#button-add-new").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                    console.log(data['status']);
                    if(data['status'] == 'success')	 
                    {
                        alert("Ticket Created And Proforma Invoice Send To Mail ID"); 
                    // $("#button-add-new").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>');	
                    // $("#button-add-new").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>');	
                   location.reload();
                //    $('#recordModal').modal('toggle');
                //    ticket_datatables();
                    }
                   else if(data['status'] == 'Failed'){
                    // window.location.replace("http://13.233.32.132/html/login.php");
                    // window.location.replace("http://13.233.32.132/html/payment.php");
                        window.location.replace("http://13.233.32.132/html/login.php");
                    }
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
                            $('#std_rate').val(data.data[0]['dissertation_rate']);
                        }else{
                            var bill_value = (data.data[0]['rate'] / data.data[0]['word_limit']) * word_count;
                            $('#std_rate').val(data.data[0]['rate']);
                        }
                       
                                               
                         $("#bill_value").html("Your Biil is:"+parseFloat(bill_value).toFixed(2)+ " "+data.data[0]['currency']);
                         $('#bill_value').css("color", "red");
                       
                         $('#currency').val(data.data[0]['currency']);
                         $('#bill_value_amount').val(parseFloat(bill_value).toFixed(2));
                         
                    }
                }
            })
        }); 
        function ticketAdvanced(e){
            var id = $(e).data("id");
            //alert(id);
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{ticket_id:id, action:'getAdvanceDetailsById'},
                dataType:"JSON",
                success:function(data){
                    var amount = data.data[0]['invoice_amount']-data.data[0]['Total_paid'];
                    $('#PaymentAdvanceForm')[0].reset();
                    $('#PaymentAdvance').modal('show'); 
                    $('#invoice_number').val(data.data[0]['invoice_number']);
                    $('#ticket_value').val(amount);
                    $('#data_payment_listing').html(data.data[0]['html']);

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
                    $('#advance_ticket_id').val(id);
                }
            })
        }
        function payment_value(el){
            var ticket_val = $('#ticket_value').val();
            var current_val = $(el).val();
            if(current_val > ticket_val){
                $("#amount_alert").html("Amount is Greater than Ticket Value").css("color", "red");
                $('input[name=ticket_advance').val('');
            }else{
                $("#amount_alert").text("");
            }
           
        }
        function assignedSmes(e){
            var id = $(e).data("id");
            //alert(id);
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{ticket_id:id, action:'getTicketDetailsById'},
                dataType:"JSON",
                success:function(data){ console.log(data);
                    $('#AssignedSme').modal('show'); 
                    $('#assigned_sme_action').val('addAssignedSme');
                    $('#ticket_name_sme_assigned').val(data.data[0]['ticket_name']);
                    $('#ticket_desc_sme_assigned').val(data.data[0]['ticket_desc']);
                    $('#ticket_id_sme_assign').val(id);
                }
            })
        }
        function addnewticket(e){
            // alert("ho");
           // $("#recordModal").trigger( "reset" );  
           document.getElementById("recordForm").reset();
           $("#recordForm").trigger( "reset" );                            
            $('#recordModal').modal('show');
            $('#bill_value').html('');
            
           // bill_value
        }
        // Edit Ticket modal get data
        function edit_ticket(e){
            var id=$(e).data("id");
            $.ajax({
                url: "ajax/ajax_action.php",
                method: "POST",
                data:{action: 'get_ticketdetails',
                    data_id: id},
                dataType: "json",
                success: function(data){

                    $("#updatemodal").trigger( "reset" );               
                   $('#updatemodal').modal('show');
                    $('#modticket_desc').val(data.data[0]['ticket_desc']);
                    $('#modticket_desc').summernote({
                        placeholder: 'Enter Template Descriptions',
                        tabsize: 2,
                        height: 200,
                        code: data.data[0]['ticket_desc']
                    });
                    var markupStr = data.data[0]['template_body'];
                    
                     $('#modticket_desc').summernote('code', markupStr);
                    $('#modword_countticket').val(data.data[0]['wordcount']);
                    $('#modcountry').val(data.data[0]['country_id']);
                    $('#modcategory').val(data.data[0]['category_id']);
                    $('#moddeadline').val(data.data[0]['assigned_deadline']);
                    $('.modaction').val('updateticket');
                    $('#modclient_name').val(data.data[0]['customer_name']);
                    $('#modclient_email').val(data.data[0]['customer_email']);
                    $('#modclient_phone').val(data.data[0]['phone_number']);
                    $('#modticket_id').val(id);

                }
                
            });
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
                        var extension = item.file_name.split('.').pop();
                        // alert(extension);
                        if(extension == "jpg" || extension == "jpeg" || extension == "jfif")
                        {
                            html1 += '<span class="form-label Title"> <img onclick= "image(this);" src="http://13.233.32.132/upload/'+ item.file_name+'" class="btn btn-dim btn-primary mt-1 mx-2" style="height: 45px;width: 150px;"/></span>';
                        }
                        else{
                            html1 += '<span class="form-label Title"> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/'+ item.file_name+'&embedded=true" class="btn btn-dim btn-primary mt-1" target="_blank"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                }
                    });
                    var html2 = '';
                    if((data.data2.length == 0))
                    {
                        html2 += '<span class="form-label Title">Sorry, No data found for output file</span>';
                    }
                    else{
                        $.each(data.data2, function(i, item) {
                            // html2 += '<span class="form-label Title"> <a href="html/download_output.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                            var extension2 = item.file_name.split('.').pop();
                        // alert(extension);
                        if(extension2 == "jpg" || extension2 == "jpeg" || extension2 == "jfif")
                        {
                            html2 += '<span class="form-label Title"> <img onclick= "image(this);" src="http://13.233.32.132/upload/pm_upload/'+ item.file_name+'" class="btn btn-dim btn-primary mt-1 mx-2" style="height: 45px;width: 150px;"/></span>';
                        }
                        else{
                            html2 += '<span class="form-label Title"> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/pm_upload/'+ item.file_name+'&embedded=true" class="btn btn-dim btn-primary mt-1" target="_blank"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                        }
                        
                        });
                    }
                    $('#attachmen_div_input').html(html1); 
                    $('#attachmen_div_output').html(html2); 
                }
            })
            
        } 
        function image(img){
            var name = img.src;
                $('<div>').css({
                background: 'RGBA(0,0,0,.5) url('+name+') no-repeat center',
                backgroundSize: 'contain',
                width:'100%', height:'100%',
                position:'fixed',
                zIndex:'10000',
                top:'0', left:'0',
                cursor: 'zoom-out'
            }).click(function(){
                $(this).remove();
            }).appendTo('body');
        }
        
        function send_output(e){
           var id = $(e).data("id");
           $("#sendOutputModal").trigger( "reset" );               
            $('#sendOutputModal').modal('show');
            $("#sendOutputform")[0].reset();
            $('#ticket_id_output').html("#"+id); 
            $('#modid_send_output').val(id);
            $('#modaction_send_output').val("send_output_via_mail");
        } 
        function downloadFile(file_name) {
            var filename = "../upload/"+file_name;
             window.location.href = filename;
        }  
        function send_final_invoice(e){
            
            var id = $(e).data("id");
            // alert(id);
            $("#sendInvoiceModal").trigger( "reset" );               
            $('#sendInvoiceModal').modal('show');
            $("#sendInvoiceform")[0].reset();
            $('#ticket_id_invoice').html("#"+id); 
            $('#modid_send_invoice').val(id);
            $('#modaction_send_invoice').val("send_invoice_via_mail");
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

                    // window.location.replace("https://achievexsolutions.in/writexdemonew/html/payment.php");
                    window.location.replace("http://13.233.32.132/html/payment.php");
                  
                }
            })
        });
        $("#AssignedSme").on('submit','#AssignedSmeForm', function(event){ 
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
                    $("#button-add-assigned-sme").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                //    window.location.replace("https://achievexsolutions.in/writexdemonew/html/payment.php");
                window.location.replace("http://13.233.32.132/html/payment.php");
                //    location.reload();
                }
            })
        });
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
                    if(data['status'] == 'success')	
                    {
                        //    location.reload();
                        $("#button-add").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-list-check"></em><span>Save</span></button>');
                        $('#updatemodal').modal('toggle');
                        ticket_datatables();
                    } 
                    else if(data['status'] == 'Failed'){
                        window.location.replace("http://13.233.32.132/html/login.php");
                    }
               }
            })
        });
        $("#sendOutputModal").on('submit','#sendOutputform', function(event){ 
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
                    $("#send_output_final").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                //    location.reload();
                $("#button-add").html('<button type="submit" id="send_output_final" class="btn btn-primary"><em class=""></em><span>Send</span></button>');
                $('#sendOutputModal').modal('toggle');
                ticket_datatables();
               }
            })
        });
        $("#sendInvoiceModal").on('submit','#sendInvoiceform', function(event){ 
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
                    $("#send_invoice_final").html('<button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span>Loading...</span></button>');
                },
                success:function(data){	
                //    location.reload();
                $("#button-add").html('<button type="submit" id="send_invoice_final" class="btn btn-primary"><em class=""></em><span>Send</span></button>');
                $('#sendInvoiceModal').modal('toggle');
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
        // Upload Sme Files
        function uploadDocumnets(e){
            var id = $(e).data("id");
            $('#uploadPaymentattachment').modal('show');
            $('#uploadpaymentform')[0].reset();  
            $('#preview_image').attr('src', null);                        
            $('#uploadpaymentaction').val('upload_attachment');
            $('#uploadpaymentticket_id').val(id);
        }
        $('#uploadsmebutton').click(function(){
        $('#ticket_modal_header').html("<i class='fa fa-plus'></i> Upload");
            $('.uploadpaymentaction').val('upload_attachment');
        });
        $("#uploadPaymentattachment").on('submit','#uploadpaymentform', function(event){ 
             event.preventDefault();
             $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                   $("#button-uploadsme").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                    var data = JSON.parse(data);
                    if(data['status'] == "success")
                    if(data['status'] == 'success'){ 
                    $("#button-uploadsme").html('<button type="submit" id="button-uploadsme" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload Payment Files</span></button>');		
                    alert("Payment Attached Successfully");
                    $('#uploadPaymentattachment').modal('toggle');
                    ticket_datatables();
                    }
                    else if(data['status'] == 'Failed'){
                        window.location.replace("http://13.233.32.132/html/login.php");
                    }
                    else{
                        location.reload();
                    }
                }
            })
    });
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
        // Ticket Template on change
        $('#template').on('change', function() {
           // alert(  );
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{"template": this.value,"action": "assigned_temp_list"},
                dataType:"JSON",
                beforeSend: function() {
                   $("#button-add-employee").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                    console.log(data);
                    console.log(data.data[0]['template_text']);
                    // $('#desc_ticket').val(data.data[0]['template_text']);
                    var markupStr = data.data[0]['template_text'];
                    $('#modticket_desc').summernote('code', markupStr);
                   
                }
            })
        });
    // Add Remarks
    function modalAddRemarks(e){
        var id = $(e).data("id");
        // alert(id);
        $.ajax({
            url:"ajax/ajax_action.php",
            method:"POST",
            data:{action:"get_assign_smes",ticket_id: id},
            dataType:"JSON",
            success:function(data){
                // console.log(data);
                $("#addCommentsForm").trigger( "reset" );                            
                $('#addComments').modal('show'); 
                $('#get_assign_id').html("#"+(data.data[0]['ticket_id']));  
                $('#addTeamLeadComment').val('addTLRemarks');
                $('#ticket_id_TeamLead_Comment').val(id);           
            }
        })
    }
    $("#addComments").on('submit','#addCommentsForm', function(event){ 
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
                     $("#button-add-comments").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                //    location.reload();
                $("#button-add-comments").html(' <button id="button-add-assigned-sme" type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add</span></button>');
                $('#addComments').modal('toggle');
                new_ticket();  
                }
            })
        });
        config =     {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        altInput: true,
        altFormat: "F j, Y (h:S K)"
    }
    flatpickr("input[type=datetime-local]", config);
    </script>
	
<script type="text/javascript">
 
$(function () {
 

 
});
 
</script>