<?php
// $emp_list = select_query("employees_master",array("emp_id","emp_name","emp_email"),array());
$all_smes = "'" .implode("','",$get_sme_role_applicable). "'";
$get_sme_list = execute_query("SELECT emp_id,emp_name,emp_email FROM employees_master WHERE emp_role IN($all_smes)");
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
                                <h3 class="nk-block-title page-title">Project Listing</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- Div Nav Start -->
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3" role="tablist">
                                <li class="nav-item" role="presentation" onclick="new_ticket(this)">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem6" aria-selected="true" role="tab"><em class=""></em><span>Unassigned</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="get_assigned(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem4" aria-selected="true" role="tab"><em class=""></em><span>Assigned</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="all_tickets(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem5" aria-selected="false" role="tab" tabindex="-1"><em class=""></em><span>All</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                            <div class="tab-pane active show" id="tabItem6" role="tabpanel">
                                    <!-- New Tickets Table Start -->
                                    <table class="nk-tb-list nk-tb-ulist  nowrap table" id="data_new_tickets" data-auto-responsive="false">
                                        <thead>
                                            <tr>
                                            <th>Ticket</th>	
                                            <th>Remaining Days</th>
                                            <th>Status</th>
                                            <th>Action</th>			
                                            </tr>
                                        </thead>
                                    </table>
                                    <!-- New Tickets Table Ends -->
                                </div>
                            <div class="tab-pane" id="tabItem4" role="tabpanel">
                                    <!-- New Tickets Table Start -->
                                    <table class="nk-tb-list nk-tb-ulist  nowrap table" id="data_assigned" data-auto-responsive="false">
                                        <thead>
                                            <tr>
                                                <th>Ticket</th>
                                                <th>Assigned Smes</th>	
                                                <th>Remaining Days</th>	
                                                <th>Status</th>
                                                <th>Remarks</th>	
                                            </tr>
                                        </thead>
                                    </table>
                                    <!-- New Tickets Table Ends -->
                                </div>
                                <div class="tab-pane" id="tabItem5" role="tabpanel">
                                    <!-- table content starts -->
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="all_data_project" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>Ticket</th>
                                                            <th>Remaining Days</th>	
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                    <!-- table content ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Div Nav Ends -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="AssignedSme">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Assigned</h4>
                    <form action="" id="AssignedSmeForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="" id="assigned_sme_action">
                        <input type="hidden" class="form-control" value="" id="ticket_id_sme_assign" name="ticket_id_sme_assign">
                        <input type="hidden" class="form-control" value="<?php echo $_SESSION['emp_id']?>" id="update_by" name="update_by">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Assign SME's</label>
                                <div class="form-control-wrap">
                                    <select class="form-select mySelect" multiple="multiple" name="assign_sme[]" id ="strings_option">
                                            <?php foreach($get_sme_list as $key => $val){ ?>
                                                <option value="<?=$val['emp_id']?>"><?=$val['emp_name']?>(<?=$val['emp_email']?>)</option>
                                            <?php }?>
                                    </select> 
                                    <label for="myCheck">Check for entire outside sme:</label> 
                                    <input type="checkbox" id="myCheck" onclick="myFunction()" name="check_box">
                                    <!-- <label class="form-label" for="file">Add Email ids:</label> -->
                                    <input type="text" class="form-control" style="display:none" id="email_output" name="client_email_output_data" placeholder="Enter outsider Email IDs(Ex: abc@email.com,xyz@email.com)">
                                    <textarea class="form-control no-resize my-2" rows = "5" name="prod_remarks" id="get_prod_remarks"></textarea>
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
    <!-- Assign Quality Analyst -->
    <div class="modal fade" tabindex="-1" role="dialog" id="AssignedQuality">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Assigned</h4>
                    <form action="" id="AssignedQualityForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="" id="assigned_quality_action">
                        <input type="hidden" class="form-control" value="" id="ticket_id_quality_assign" name="ticket_id_quality_assign">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Assign Quality Analyst</label>
                                <div class="form-control-wrap">
                                    <select class="form-select mySelect" multiple="multiple" name="assign_quality[]" id ="strings_option_quality">
                                            <?php foreach($emp_list as $key => $val){ ?>
                                                <option value="<?=$val['emp_id']?>"><?=$val['emp_name']?>(<?=$val['emp_email']?>)</option>
                                            <?php }?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4" id="button-add">
                            <button id="button-add-assigned-quality" type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Attachment Data Modal Start -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalAttachment">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Attachments</h4>
                    <hr>
                    <div id="attachmen_div"> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Attachment Data Modal End -->
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
<!-- Show Remarks Modal Start -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalQualityRemarks">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <div class="col-md-12 mt-2">
                        <span id="get_id" style="color: blue;font-size: 24px; font-weight: 600"></span>
                            <!-- <span id="get_name" style="color: blue;font-size: 24px;"></span> -->
                    </div>
                    <!-- <span id="ticket_data_name"></span> -->
                    <!-- <div><span id="ticket_data_id"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="ticket_data_name"></span></div> -->
                    <hr>
                    <div id="rem_prod" style="color: red;font-size: 24px;"></div>
                </div>
            </div>
        </div>
</div>
<!-- Remarks Modal Ends -->
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
    <!-- Upload Tl Files -->
    <div class="modal fade" tabindex="-1" role="dialog" id="uploadtlattachment">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Upload Attachments</h4>
                    <hr>
                    <form action="" id="uploadtlform" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="" class="uploadtlaction" id="uploadtlaction">
                            <input type="hidden" class="form-control" id="uploadtlticket_id" name="uploadtlticket_id">
                            <input type='file' class="form-control" multiple id="uploadtlattachment" name="uploadtlattachment[]" accept="image/*" onchange="readURL(this);" required/>
                            <br>
                            <img id="tl_preview_image" src="" alt="Select File to upload:" />          
                        
                            <div class="col-md-12 mt-2">
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="tl_complete_check" id="customCheck"><label class="custom-control-label" for="customCheck">Apply For Team Manager Check</label></div>
                            </div>

                        <div class="col-12 mt-4" >
                            <button type="submit" id="button-uploadtl" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload</span></button>
                        </div>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
    <!-- View sme uploaded files modal -->
    <!-- Attachment Data Modal Start -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalAttachment_sme">
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
                    <hr>
                    <label for="tlupload">Tl upload Documents</label>
                    <div id = "attachmen_div_tl" ></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Attachment Data Modal End -->
<script>
        $(document).ready(function(){	
            new_ticket();
        }); 
        // Listing 
        function get_assigned(){ 

            if ( $.fn.DataTable.isDataTable('#data_assigned') ) {
                $('#data_assigned').DataTable().destroy();
                }

            $('#data_assigned tbody').empty();

            var dataRecords = $('#data_assigned').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'project_listing'},
                    dataType:"json"
                },
                "columnDefs":[
                    {
                        "targets":[0, 1, 2],
                        "orderable":true,
                    },
                    { "width": "2%", "targets": 0 }
                ],
                "pageLength": 10
            });	
        }
        function all_tickets(){ 

            if ( $.fn.DataTable.isDataTable('#all_data_project') ) {
                $('#all_data_project').DataTable().destroy();
                }

            $('#all_data_project tbody').empty();

            var dataRecords = $('#all_data_project').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'project_all'},
                    dataType:"json"
                },
                "columnDefs":[
                    {
                        "targets":[0, 1, 2],
                        "orderable":true,
                    },
                    { "width": "2%", "targets": 0 }
                ],
                "pageLength": 10
            });	
        }
        function new_ticket(){ 

            if ( $.fn.DataTable.isDataTable('#data_new_tickets') ) {
                $('#data_new_tickets').DataTable().destroy();
                }

            $('#data_new_tickets tbody').empty();

            var dataRecords = $('#data_new_tickets').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'record_new_ticket'},
                    dataType:"json"
                },
                "columnDefs":[
                    {
                        "targets":[0, 1],
                        "orderable":true,
                    },
                    { "width": "2%", "targets": 0 }
                ],
                "pageLength": 10
            });	
        }
        // Assigned Smes Modal Settings
        function assignedSmes(e){
            var id = $(e).data("id");
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{ticket_id:id, action:'getTicketDetailsById'},
                dataType:"JSON",
                success:function(data){ 
                    $("#AssignedSmeForm")[0].reset();
                    var placeholder = "select SME's";
                        $(".mySelect").select2({
                            placeholder: placeholder,
                            allowClear: false,
                            
                        });
                    $("#AssignedSme").trigger( "reset" );               
                    $('#AssignedSme').modal('show'); 
                    if(data.data[0]['assigned_ids'] != null){
                        var values = data.data[0]['assigned_ids'];
                        var emp_array = [];
                        $.each(values.split(","), function(i,e){
                            emp_array.push(e);
                        });
                        $("#strings_option").val(emp_array).trigger('change');
                        $("#strings_assign_option").val(emp_array).trigger('change');
                    }
                    
                    $('#assigned_sme_action').val('addAssignedSme');
                    $('#ticket_name_sme_assigned').val(data.data[0]['ticket_name']);
                    $('#ticket_desc_sme_assigned').val(data.data[0]['ticket_desc']);
                    $('#ticket_id_sme_assign').val(id);
                }
            })
        }
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
                //    location.reload();
                $("#button-add-assigned-sme").html(' <button id="button-add-assigned-sme" type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add</span></button>');
                $('#AssignedSme').modal('toggle');
                new_ticket();  
                }
            })
        });
        // Assigned Quality Analyst Settings
        function assignedQualityAnalyst(e){
        var id = $(e).data("id");
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{ticket_id:id, action:'getQualityDetailsById'},
                dataType:"JSON",
                success:function(data){ 
                    $("#AssignedQualityForm")[0].reset();
                    var placeholder = "Assign Quality Analyst";
                        $(".mySelect").select2({
                            placeholder: placeholder,
                            allowClear: false,
                            
                        });
                    $("#AssignedQuality").trigger( "reset" );               
                    $('#AssignedQuality').modal('show'); 
                    if(data.data[0]['assigned_quality'] != null){
                        var values = data.data[0]['assigned_quality'];
                        var emp_array = [];
                        $.each(values.split(","), function(i,e){
                            emp_array.push(e);
                        });
                        $("#strings_option_quality").val(emp_array).trigger('change');
                        $("#strings_assign_option").val(emp_array).trigger('change');
                    }
                    
                    $('#assigned_quality_action').val('addAssignedQuality');
                    $('#ticket_name_quality_assigned').val(data.data[0]['ticket_name']);
                    $('#ticket_desc_quality_assigned').val(data.data[0]['ticket_desc']);
                    $('#ticket_id_quality_assign').val(id);
                }
            })
        }
        $("#AssignedQuality").on('submit','#AssignedQualityForm', function(event){ 
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
                     $("#button-add-assigned-quality").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                //    location.reload();
                $("#button-add-assigned-quality").html('<button id="button-add-assigned-quality" type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add</span></button>');
                $('#AssignedQuality').modal('toggle');
                new_ticket(); 
                }
            })
        });
        // View Attachments
        function view_attchment(e){
            var id = $(e).data("id");
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{action:"get_product_attachment_by_id",ticket_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                    $('#modalAttachment').modal('show'); 
                   var html = '';
                    $.each(data.data, function(i, item) {
                        // html += '<span class="form-label Title"> <a href="html/download.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                        var extension = item.file_name.split('.').pop();
                            // alert(extension);
                            if(extension == "jpg" || extension == "jpeg"|| extension == "jfif")
                            {
                                html += '<span class="form-label Title"> <img onclick= "image(this);" src="http://13.233.32.132/upload/'+ item.file_name+'" class="btn btn-dim btn-primary mt-1 mx-2" style="height: 45px;width: 150px;"/></span>';
                            }
                            else{
                                 html += '<span class="form-label Title"> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/'+ item.file_name+'&embedded=true" class="btn btn-dim btn-primary mt-1" target="_blank"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                            }
                    });
                    $('#attachmen_div').html(html); 
                }
            })
            
        } 
        function downloadFile(file_name) {
            var filename = "../upload/"+file_name;
             window.location.href = filename;
        }
        $('#uploadbutton').click(function(){
            $('#ticket_modal_header').html("<i class='fa fa-plus'></i> Upload");
            $('.uploadaction').val('uploadfiles');
        });
        function upload_attchment(e){
            var id = $(e).data("id");
            $("#uploadAttachment").trigger( "reset" );               
            $('#uploadAttachment').modal('show');
            $('#uploadaction').val('uploadfiles');
            $('#uploadticket_id').val(id);
        }
        $("#uploadAttachment").on('submit','#uploadform', function(event){ 
             event.preventDefault();
             $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                     $("#button-upload").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
                    //  location.reload();
                    $("#button-upload").html('<button id="button-upload" type="submit" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload</span></button>');
                    $('#uploadAttachment').modal('toggle');
                    new_ticket(); 
                }
            })
        });

        // Archieve Ticket
        function archieve_ticket(e){
            var id = $(e).data("id");
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{ticket_id:id, action:'getTicketStatusById'},
                dataType:"JSON",
                success:function(data){ 
                    location.reload();
                }
            })
        }
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
                    // console.log(data);
                    // console.log(data.data);
                    // console.log(data.data[0]['ticket_id']);
                    // console.log(data.data[0]['ticket_name']);
                    // console.log(data.data[0]['ticket_desc']);
                    $('#ticket_data_id').html(data.data[0]['ticket_id']);
                    $('#ticket_data_name').html(data.data[0]['ticket_name']);
                    $('#ticket_data_desc').html(data.data[0]['ticket_desc']);
                }
            })
        }

        function myFunction() {
            var checkBox = document.getElementById("myCheck");
            var text = document.getElementById("email_output");
            if (checkBox.checked == true){
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        }
        // function myFunction2() {
        //     var checkBox = document.getElementById("myCheck2");
        //     var text = document.getElementById("email_output2");
        //     if (checkBox.checked == true){
        //         text.style.display = "block";
        //     } else {
        //         text.style.display = "none";
        //     }
        // }
    // Get Remarks
    function modalGetRemarks(e){
        var id = $(e).data("id");
        // alert(id);
        $.ajax({
            url:"ajax/ajax_action.php",
            method:"POST",
            data:{action:"get_quality_rem",ticket_id: id},
            dataType:"JSON",
            beforeSend: function() {
                $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
            },
            success:function(data){
                $('#modalQualityRemarks').modal('show'); 
                // console.log(data);
                // console.log(data.data);
                // console.log(data.data[0]['remarks_qa']);
                $('#get_id').html("#"+(data.data[0]['ticket_id']));
                // $('#get_name').html(data.data[0]['ticket_name']);
                $('#rem_prod').html(data.data[0]['remarks_qa']);
            }
        })
    }
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
                // var html = '';
                // $.each(data.data, function(i, item) {
                //            // console.log(i);console.log(item);
                //             // html += '<span class="form-label Title"> <a href="html/download_output.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                //             html += '<span class="form-label Title">item.assigned_ids</span>';
                //         });        
                // $('#attachmen_div_input').html(html);         
                // $('#rem_prod').html(data.data[0]['remarks_qa']);
                // $("#AssignedQuality").trigger( "reset" );    
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
        // Upload Sme Files
        function modaluploadtlattachment(e){
            var id = $(e).data("id");
            document.getElementById("uploadtlform").reset();
            $('#uploadtlattachment').modal('show');
            $("#uploadtlform").trigger( "reset" );                            
            $('#tl_preview_image').attr('src', null);                        
            $('#uploadtlaction').val('uploadtlfiles');
            $('#uploadtlticket_id').val(id);
        }
        $('#uploadtlbutton').click(function(){
        $('#ticket_modal_header').html("<i class='fa fa-plus'></i> Upload");
            $('.uploadtlaction').val('uploadtlfiles');
        });
        $("#uploadtlattachment").on('submit','#uploadtlform', function(event){ 
             event.preventDefault();
             $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                   $("#button-uploadtl").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
                    //  location.reload();
                    $("#button-uploadtl").html('<button type="submit" id="button-uploadtl" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload</span></button>');		
                    $('#uploadtlattachment').modal('toggle');
                    assign_project();
                }
            })
    });
        // View Attachments
        function view_all_attachment(e){
        var id = $(e).data("id");
        $.ajax({
            url:"ajax/ajax_action.php",
            method:"POST",
            data:{action:"get_product_attachment_by_sme",ticket_id: id},
            dataType:"JSON",
            beforeSend: function() {
                $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
            },
            success:function(data){
                $('#modalAttachment_sme').modal('show'); 
                // var html = '';
                // $.each(data.data, function(i, item) {
                //     html += '<span class="form-label Title"> <a href="html/download.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                
                // });
                var html1 = '';
                   if((data.data1.length == 0))
                    {
                        html1 += '<span class="form-label Title">Sorry, No data found for Input file</span>';
                    }
                    $.each(data.data1, function(i, item) {
                        // console.log(i);console.log(item);
                        // html1 += '<span class="form-label Title"> <a href="html/download.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
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
                           // console.log(i);console.log(item);
                            // html2 += '<span class="form-label Title"> <a href="html/download_output.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                            var extension2 = item.file_name.split('.').pop();
                            // alert(extension);
                            if(extension2 == "jpg" || extension2 == "jpeg" || extension2 == "jfif")
                            {
                                html2 += '<span class="form-label Title"> <img onclick= "image(this);" src="http://13.233.32.132/upload/sme_upload/'+ item.file_name+'" class="btn btn-dim btn-primary mt-1 mx-2" style="height: 45px;width: 150px;"/></span>';
                            }
                            else{
                                html2 += '<span class="form-label Title"> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/sme_upload/'+ item.file_name+'&embedded=true" class="btn btn-dim btn-primary mt-1" target="_blank"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                            }
                        });
                    }
                    var html3 = '';
                    if((data.data3.length == 0))
                    {
                        html3 += '<span class="form-label Title">Sorry, No data found for Tl file</span>';
                    }
                    else{
                        $.each(data.data3, function(i, item) {
                           // console.log(i);console.log(item);
                            // html3 += '<span class="form-label Title"> <a href="html/download_tl.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                            var extension3 = item.file_name.split('.').pop();
                            // alert(extension);
                            if(extension3 == "jpg" || extension3 == "jpeg" || extension3 == "jfif")
                            {
                                html3 += '<span class="form-label Title"> <img onclick= "image(this);" src="http://13.233.32.132/upload/tl_upload/'+ item.file_name+'" class="btn btn-dim btn-primary mt-1 mx-2" style="height: 45px;width: 150px;"/></span>';
                            }
                            else{
                                html3 += '<span class="form-label Title"> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/tl_upload/'+ item.file_name+'&embedded=true" class="btn btn-dim btn-primary mt-1" target="_blank"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                            }
                        });
                    }
                $('#attachmen_div_input').html(html1); 
                $('#attachmen_div_output').html(html2); 
                $('#attachmen_div_tl').html(html3); 
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
    function myFunction() {
            var x = document.getElementById("uploadtlattachment").required;
            document.getElementById("demo").innerHTML = x;
        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#tl_preview_image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>