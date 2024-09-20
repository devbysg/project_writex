<?php
include_once('../html/constant.php');
$all_smes = "'" .implode("','",$get_sme_role_applicable). "'";
$get_sme_list = execute_query("SELECT emp_id,emp_name,emp_email FROM employees_master WHERE emp_role IN($all_smes)");
$emp_list_tm = select_query("employees_master",array("emp_id","emp_name","emp_email"),array('emp_role' => 'Team_Manager'));
$emp_list_tl = select_query("employees_master",array("emp_id","emp_name","emp_email"),array('emp_role' => 'Team_Leader'));
$emp_list_ql = select_query("employees_master",array("emp_id","emp_name","emp_email"),array('emp_role' => 'Quality_Tester'));
?>
    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner" style="width: 1317px;">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Assign Team</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- Div Nav Start -->
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3" role="tablist">
                                <li class="nav-item" role="presentation" onclick="team_unassign(this)">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem6" aria-selected="true" role="tab"><em class=""></em><span>Unassigned</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="assigned_team(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem4" aria-selected="true" role="tab"><em class=""></em><span>Assigned</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="all_teams(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem5" aria-selected="false" role="tab" tabindex="-1"><em class=""></em><span>All</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                            <div class="tab-pane active show" id="tabItem6" role="tabpanel">
                                    <!-- New Tickets Table Start -->
                                    <table class="nk-tb-list nk-tb-ulist  nowrap table" id="get_assign" data-auto-responsive="false">
                                        <thead>
                                            <th>Ticket</th>
                                            <th>Deadline</th>
                                            <th>Date Added </th>
                                            <th>Ticket Status</th>
                                            <th>Assigned Team</th>
                                            <th>Action</th>
                                        </thead>
                                    </table>
                                    <!-- New Tickets Table Ends -->
                                </div>
                            <div class="tab-pane" id="tabItem4" role="tabpanel">
                                    <!-- New Tickets Table Start -->
                                    <table class="nk-tb-list nk-tb-ulist  nowrap table" id="assign_team" data-auto-responsive="false">
                                        <thead>
                                            <tr>
                                                <th>Ticket</th>
                                                <th>Deadline</th>
                                                <th>Date Added </th>
                                                <th>Assigned Team</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <!-- New Tickets Table Ends -->
                                </div>
                                <div class="tab-pane" id="tabItem5" role="tabpanel">
                                    <!-- table content starts -->
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="all_assign_project" data-auto-responsive="false">
                                                    <thead>
                                                        <tr>
                                                            <th>Ticket</th>
                                                            <th>Deadline</th>
                                                            <th>Date Added </th>
                                                            <th>Ticket Status</th>
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
    
    <div class="modal fade" tabindex="-1" role="dialog" id="Assigned">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Assigned</h4>
                    <form action="" id="AssignedTeamsForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="addAssignTeams" id="get_assign_team" class="get_assign_team">
                        <input type="hidden" class="form-control" value="" id="ticket_id_assign" name="ticket_id_assign">
                        <input type="hidden" class="form-control" value="<?php echo $_SESSION['emp_id']?>" id="update_by" name="update_by">
                        <input type="hidden" class="form-control" value="<?php echo $_SESSION['emp_role']?>" id="update_by" name="update_role">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Assign Team</label>
                                <div class="form-control-wrap">
                                    <select class="form-select mySelects assign_team" id="assign_team" multiple="multiple" name="assign[]">
                                            <?php
                                            if($_SESSION['emp_role'] == 'project_manager'){ 
                                                foreach($emp_list_tm as $key => $val){ ?>
                                                <option value="<?=$val['emp_id']?>"><?=$val['emp_name']?>(<?=$val['emp_email']?>)</option>
                                            <?php }}else if($_SESSION['emp_role'] == 'Team_Manager'){?>
                                                <?php
                                                foreach($emp_list_tl as $key => $val)
                                                { ?>
                                                    <option value="<?=$val['emp_id']?>"><?=$val['emp_name']?>(<?=$val['emp_email']?>)</option> 
                                                  <?php }  }?>
                                    </select> 
                                    <textarea class="form-control no-resize my-3" rows = "5" name="prod_remarks" id="get_prod_remarks" placeholder="Write Comments Here..."></textarea>    
                                </div>
                            </div>
                        </div>
                        <?php
                        //  if($_SESSION['emp_role'] == 'project_manager'){ 
                            ?>
                        <div class="col-12">
                            <div class="form-group">
                            <label class="form-label">Assign Quality</label>
                                <div class="form-control-wrap">
                                    <select class="form-select mySelects assign_team" name="assign_quality[]" id="assign_quality" multiple="multiple">
                                            <?php
                                            // if($_SESSION['emp_role'] == 'project_manager'){ 
                                                foreach($emp_list_ql as $key => $val){ 
                                                    ?>
                                                <option value="<?=$val['emp_id']?>"><?=$val['emp_name']?>(<?=$val['emp_email']?>)</option>
                                            <?php }
                                        // }
                                        ?>
                                    </select> 
                                    <textarea class="form-control no-resize my-4" rows = "5" name="link_share" id="get_link_share" placeholder="Share docs link..."></textarea>    
                                </div>
                            </div>
                        </div>
                        <?php  
                    // }
                     ?>
                        <div class="col-12 mt-4" id="button-add">
                            <button id="button-add-assigned-teams" type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add</span></button>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="uploadAttachment">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Upload Attachments</h4>
                    <hr>
                    <form action="" id="uploadform" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="" class="uploadaction" id="uploadaction">
                            <input type="hidden" class="form-control" id="uploadticket_id" name="uploadticket_id">
                            <input type='file' class="form-control" multiple id="uploadsmeattachment" name="uploadsmeattachment[]" accept="image/*" onchange="readURL(this);" required/>
                            <br>
                            <img id="preview_image" src="" alt="Select File to upload:" />          
                            <div class="col-12 mt-4" >
                                <button id="button-upload" type="submit" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload</span></button>
                            </div>
                    </form>
                        
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
                </div>

                    <form action="" id="addCommentsForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="" id="addTeamLeadComment">
                        <input type="hidden" class="form-control" value="" id="ticket_id_TeamLead_Comment" name="ticket_id_TeamLead_Comment">
                        <div class="col-12">
                            <div class="form-group">
                                    <textarea class="form-control no-resize" placeholder="Add Comment" rows = "5" name="add_TLremarks" id="get_add_remarks"></textarea>
                            </div>
                        </div>
                        <input type='file' class="form-control" id="UploadAttachment" name="UploadAttachment[]" accept="image/*" onchange="readURL(this);"/>
                            <br>
                            <img id="view_image" src="" alt="Insert screenshot" />
                        <div class="col-12 mt-4" id="button-add">
                            <button id="button-add-comments" type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Tm Files -->
    <div class="modal fade" tabindex="-1" role="dialog" id="uploadtmattachment">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Upload Attachments</h4>
                    <hr>
                    <form action="" id="uploadtmform" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="" class="uploadtmaction" id="uploadtmaction">
                            <input type="hidden" class="form-control" id="uploadtmticket_id" name="uploadtmticket_id">
                            <input type='file' class="form-control" multiple id="uploadtmattachment" name="uploadtmattachment[]" accept="image/*" onchange="readURL(this);" required/>
                            <br>
                            <img id="tm_preview_image" src="" alt="Select File to upload:" />          
                        
                            <div class="col-md-12 mt-2">
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="tm_complete_check" id="customCheck"><label class="custom-control-label" for="customCheck">Apply For Team Manager Check</label></div>
                            </div>

                        <div class="col-12 mt-4" >
                            <button type="submit" id="button-uploadtm" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload</span></button>
                        </div>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
        <!-- Upload Pm Files -->
    <div class="modal fade" tabindex="-1" role="dialog" id="uploadpmattachment">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Upload Attachments</h4>
                    <hr>
                    <form action="" id="uploadpmform" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="" class="uploadpmaction" id="uploadpmaction">
                            <input type="hidden" class="form-control" id="uploadpmticket_id" name="uploadpmticket_id">
                            <input type='file' class="form-control" multiple id="uploadpmattachment" name="uploadpmattachment[]" accept="image/*" onchange="readURL(this);" required/>
                            <br>
                            <img id="pm_preview_image" src="" alt="Select File to upload:" />          
                        
                            <div class="col-md-12 mt-2">
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="pm_complete_check" id="customCheck2"><label class="custom-control-label" for="customCheck2">Apply For Project Manager Check</label></div>
                            </div>

                        <div class="col-12 mt-4" >
                            <button type="submit" id="button-uploadpm" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload</span></button>
                        </div>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
        <!-- Attachment Data Modal Start -->
        <div class="modal fade" tabindex="-1" role="dialog" id="get_modalAttachment_tm">
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
                    <label for="tlupload">Tm upload Documents</label>
                    <div id = "attachmen_div_tm" ></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Attachment Data Modal End -->
            <!-- Attachment Data Modal Start -->
            <div class="modal fade" tabindex="-1" role="dialog" id="get_modalAttachment_pm">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Attachments</h4>
                    <hr>
                    <label for="input">Input Documents</label>
                    <div id = "attachmen_div_input_pm" ></div>
                    <hr>
                    <label for="output">Output Documents</label>
                    <div id = "attachmen_div_output_pm" ></div>
                    <hr>
                    <label for="tlupload">Pm upload Documents</label>
                    <div id = "attachmen_div_pm" ></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Attachment Data Modal End -->
<
<script>
$(document).ready(function () {
    team_unassign();
});
function team_unassign(){ 

        if ( $.fn.DataTable.isDataTable('#get_assign') ) {
            $('#get_assign').DataTable().destroy();
            }

        $('#get_assign tbody').empty();

        var dataRecords = $('#get_assign').DataTable({
            "lengthChange": true,
            "processing": true,
            "order":[],
            "ajax":{
                url:"ajax/ajax_action.php",
                type:"POST",
                data:{action:'get_project_record'},
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
function assigned_team(){ 

    if ( $.fn.DataTable.isDataTable('#assign_team') ) {
        $('#assign_team').DataTable().destroy();
        }

    $('#assign_team tbody').empty();

    var dataRecords = $('#assign_team').DataTable({
        "lengthChange": true,
        "processing": true,
        "order":[],
        "ajax":{
            url:"ajax/ajax_action.php",
            type:"POST",
            data:{action:'team_assign'},
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
function all_teams(){ 

        if ( $.fn.DataTable.isDataTable('#all_assign_project') ) {
            $('#all_assign_project').DataTable().destroy();
            }

        $('#all_assign_project tbody').empty();

        var dataRecords = $('#all_assign_project').DataTable({
            "lengthChange": true,
            "processing": true,
            "order":[],
            "ajax":{
                url:"ajax/ajax_action.php",
                type:"POST",
                data:{action:'assign_all'},
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
function assign(e){
    var id = $(e).data("id");
    // alert(id);
    $.ajax({
        url:"ajax/ajax_action.php",
        method:"POST",
        data:{ticket_id:id, action:'getAssignDetails'},
        dataType:"JSON",
        success:function(data){ 
           console.log(data);
                $('#ticket_id_assign').val(id);
                if($(data.data3).length){
                    $('#get_link_share').val(data.data3[0]['add_link']);
                }
                var placeholder = "Assign Team Member/Members";
                        $(".assign_team").select2({
                            placeholder: placeholder,
                            allowClear: false,
                            
                        });
                        // $("#assign_quality").select2({
                        //     placeholder: placeholder,
                        //     allowClear: false,
                            
                        // });
                $('#assign_team').val(null).trigger('change');
                $('#assign_quality').val(null).trigger('change');
                $("#Assigned").trigger( "reset" );               
                    $('#Assigned').modal('show'); 
                        if($(data.data1).length){
                        // var values1 = data.data1[0]['emp_id'];
                        // var emp_array1 = [];
                        // $.each(data.data1, function (i) {
                        //     $.each(data.data1[i], function (key, val) {
                        //         emp_array1.push(val);
                        //     });
                        // });
                        // alert(emp_array1);
                        // console.log(emp_array1);
                        // $('#ticket_id_assign').val(id);
                        // $(".assign_team").val(emp_array1).trigger('change');
                        // $("#strings_assign_option").val(emp_array1).trigger('change');
                        // var values2 = data.data2[0]['emp_id'];
                        // var emp_array2 = [];
                        // $.each(data.data2, function (i) {
                        //     $.each(data.data2[i], function (key, val) {
                        //         emp_array2.push(val);
                        //     });
                        // });
                        // alert(emp_array2);
                        // console.log(empty_array2);
                        // $('#ticket_id_assign').val(id);
                        // $("#assign_quality").val(emp_array2).trigger('change');
                        // // $(".assign_quality").val(emp_array2).trigger('change');
                        // $("#strings_assign_option").val(emp_array2).trigger('change');
                        var values1 = data.data1[0]['emp_id'];
                        var emp_array1 = [];
                        $.each(data.data1, function (i) {
                            $.each(data.data1[i], function (key, val) {
                                emp_array1.push(val);
                            });
                        });
                        // alert(emp_array1);
                        // console.log(emp_array1);
                        $('#ticket_id_assign').val(id);
                        $(".assign_team").val(emp_array1).trigger('change');
                        $("#strings_assign_option").val(emp_array1).trigger('change');
                        var values2 = data.data2[0]['emp_id'];
                        var emp_array2 = [];
                        $.each(data.data2, function (i) {
                            $.each(data.data2[i], function (key, val) {
                                emp_array2.push(val);
                            });
                        });
                        // alert(emp_array2);
                        // console.log(empty_array2);
                        $('#ticket_id_assign').val(id);
                        $("#assign_quality").val(emp_array2).trigger('change');
                        // $(".assign_quality").val(emp_array2).trigger('change');
                        $("#strings_assign_option").val(emp_array2).trigger('change');
                    }
                    else{
                        // var values1 = data.data1[0]['emp_id'];
                        // var emp_array1 = [];
                        // $.each(data.data1, function (i) {
                        //     $.each(data.data1[i], function (key, val) {
                        //         emp_array1.push(val);
                        //     });
                        // });
                        // // console.log(emp_array1);
                        // $(".assign_team").val(emp_array1).trigger('change');
                        // $("#strings_assign_option").val(emp_array1).trigger('change');
                        // var values1 = data.data1[0]['emp_id'];
                        // var emp_array1 = [];
                        // $.each(data.data1, function (i) {
                        //     $.each(data.data1[i], function (key, val) {
                        //         emp_array1.push(val);
                        //     });
                        // });
                        // alert(emp_array1);
                        // console.log(emp_array1);
                        // $('#ticket_id_assign').val(id);
                        // $(".assign_team").val(emp_array1).trigger('change');
                        // $("#strings_assign_option").val(emp_array1).trigger('change');
                        var values2 = data.data2[0]['emp_id'];
                        var emp_array2 = [];
                        $.each(data.data2, function (i) {
                            $.each(data.data2[i], function (key, val) {
                                emp_array2.push(val);
                            });
                        });
                        // alert(emp_array2);
                        // console.log(emp_array2);
                        $('#ticket_id_assign').val(id);
                        $("#assign_quality").val(emp_array2).trigger('change');
                        // $(".assign_quality").val(emp_array2).trigger('change');
                        $("#strings_assign_option").val(emp_array2).trigger('change');
                    }
        }
    })  
}

$("#Assigned").on('submit','#AssignedTeamsForm', function(event){ 
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
                     $("#button-add-assigned-teams").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                    $("#button-add-assigned-teams").html(' <button id=button-add-assigned-teams" type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add</span></button>');
                    $('#Assigned').modal('toggle');
                    $("#AssignedTeamsForm").trigger( "reset" );                            
                    // $('#get_assign').DataTable();
                    // location.reload();
                    team_unassign();
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
                        var extension5 = item.file_name.split('.').pop();
                        // alert(extension);
                        if(extension5 == "jpg" || extension5 == "jpeg"|| extension5 == "jfif")
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
        function myFunction() {
            var x = document.getElementById("uploadsmeattachment").required;
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
                $("#addCommentsForm").trigger( "reset" );  
                $('#addComments').modal('show'); 
                $('#view_image').attr('src', null);                        
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
                assigned_team();  
                }
            })
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#view_image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        // View Attachments
        function view_tl_attachment(e){
        var id = $(e).data("id");
        $.ajax({
            url:"ajax/ajax_action.php",
            method:"POST",
            data:{action:"get_product_attachment_by_tl",ticket_id: id},
            dataType:"JSON",
            beforeSend: function() {
                $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
            },
            success:function(data){
                $('#get_modalAttachment_tm').modal('show'); 
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
                        if(extension == "jpg" || extension == "jpeg"|| extension == "jfif")
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
                            // html2 += '<span class="form-label Title"> <a href="html/download_tl.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                            var extension2 = item.file_name.split('.').pop();
                            // alert(extension);
                            if(extension2 == "jpg" || extension2 == "jpeg"|| extension2 == "jfif")
                            {
                                html2 += '<span class="form-label Title"> <img onclick= "image(this);" src="http://13.233.32.132/upload/tl_upload/'+ item.file_name+'" class="btn btn-dim btn-primary mt-1 mx-2" style="height: 45px;width: 150px;"/></span>';
                            }
                            else{
                                html2 += '<span class="form-label Title"> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/tl_upload/'+ item.file_name+'&embedded=true" class="btn btn-dim btn-primary mt-1" target="_blank"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
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
                            // html3 += '<span class="form-label Title"> <a href="html/download_tm.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                            var extension3 = item.file_name.split('.').pop();
                            // alert(extension);
                            if(extension3 == "jpg" || extension3 == "jpeg"|| extension3 == "jfif")
                            {
                                html3 += '<span class="form-label Title"> <img onclick= "image(this);" src="http://13.233.32.132/upload/tm_upload/'+ item.file_name+'" class="btn btn-dim btn-primary mt-1 mx-2" style="height: 45px;width: 150px;"/></span>';
                            }
                            else{
                                html3 += '<span class="form-label Title"> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/tm_upload/'+ item.file_name+'&embedded=true" class="btn btn-dim btn-primary mt-1" target="_blank"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                            }
                        });
                    }
                $('#attachmen_div_input').html(html1); 
                $('#attachmen_div_output').html(html2); 
                $('#attachmen_div_tm').html(html3); 
            }
        })

    } 
        // View Attachments
        function view_tm_attachment(e){
        var id = $(e).data("id");
        $.ajax({
            url:"ajax/ajax_action.php",
            method:"POST",
            data:{action:"get_product_attachment_by_tm",ticket_id: id},
            dataType:"JSON",
            beforeSend: function() {
                $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
            },
            success:function(data){
                console.log(data);
                $('#get_modalAttachment_pm').modal('show'); 
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
                        if(extension == "jpg" || extension == "jpeg"|| extension == "jfif")
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
                            // html2 += '<span class="form-label Title"> <a href="html/download_tm.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                                var extension2 = item.file_name.split('.').pop();
                            // alert(extension);
                            if(extension2 == "jpg" || extension2 == "jpeg"|| extension2 == "jfif")
                            {
                                html2 += '<span class="form-label Title"> <img onclick= "image(this);" src="http://13.233.32.132/upload/tm_upload/'+ item.file_name+'" class="btn btn-dim btn-primary mt-1 mx-2" style="height: 45px;width: 150px;"/></span>';
                            }
                            else{
                                html2 += '<span class="form-label Title"> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/tm_upload/'+ item.file_name+'&embedded=true" class="btn btn-dim btn-primary mt-1" target="_blank"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
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
                            // html3 += '<span class="form-label Title"> <a href="html/download_pm.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                            var extension3 = item.file_name.split('.').pop();
                            // alert(extension);
                            if(extension3 == "jpg" || extension3 == "jpeg" || extension3 == "jfif")
                            {
                                html3 += '<span class="form-label Title"> <img onclick= "image(this);" src="http://13.233.32.132/upload/pm_upload/'+ item.file_name+'" class="btn btn-dim btn-primary mt-1 mx-2" style="height: 45px;width: 150px;"/></span>';
                            }
                            else{
                                html3 += '<span class="form-label Title"> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/pm_upload/'+ item.file_name+'&embedded=true" class="btn btn-dim btn-primary mt-1" target="_blank"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                            }
                        });
                    }
                $('#attachmen_div_input_pm').html(html1); 
                $('#attachmen_div_output_pm').html(html2); 
                $('#attachmen_div_pm').html(html3); 
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
            // Upload Tm Files
            function modaluploadtmattachment(e){
            var id = $(e).data("id");
            document.getElementById("uploadtmform").reset();
            $('#uploadtmattachment').modal('show');
            $("#uploadtmform").trigger( "reset" );                            
            $('#tm_preview_image').attr('src', null);                        
            $('#uploadtmaction').val('uploadtmfiles');
            $('#uploadtmticket_id').val(id);
        }
        $('#uploadtmbutton').click(function(){
        $('#ticket_modal_header').html("<i class='fa fa-plus'></i> Upload");
            $('.uploadtmaction').val('uploadtmfiles');
        });
        $("#uploadtmattachment").on('submit','#uploadtmform', function(event){ 
             event.preventDefault();
             $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                   $("#button-uploadtm").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
                    //  location.reload();
                    $("#button-uploadtm").html('<button type="submit" id="button-uploadtm" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload</span></button>');		
                    $('#uploadtmattachment').modal('toggle');
                    assigned_team();
                }
            })
    });
            // Upload Pm Files
            function modaluploadpmattachment(e){
            var id = $(e).data("id");
            document.getElementById("uploadpmform").reset();
            $('#uploadpmattachment').modal('show');
            $("#uploadpmform").trigger( "reset" );                            
            $('#pm_preview_image').attr('src', null);                        
            $('#uploadpmaction').val('uploadpmfiles');
            $('#uploadpmticket_id').val(id);
        }
        $('#uploadpmbutton').click(function(){
        $('#ticket_modal_header').html("<i class='fa fa-plus'></i> Upload");
            $('.uploadpmaction').val('uploadpmfiles');
        });
        $("#uploadpmattachment").on('submit','#uploadpmform', function(event){ 
             event.preventDefault();
             $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                   $("#button-uploadpm").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
                    //  location.reload();
                    $("#button-uploadpm").html('<button type="submit" id="button-uploadpm" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload</span></button>');		
                    $('#uploadpmattachment').modal('toggle');
                    assigned_team();
                }
            })
    });
    function myFunction() {
            var x = document.getElementById("uploadtmattachment").required;
            document.getElementById("demo").innerHTML = x;
        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#tm_preview_image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        function myFunction() {
            var x = document.getElementById("uploadpmattachment").required;
            document.getElementById("demo").innerHTML = x;
        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#pm_preview_image')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>