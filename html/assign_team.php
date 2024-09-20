<?php 
include_once('../html/constant.php');
$get_status_applicable = "'" .implode("', '",$ticket_before_project_created). "'";
if($_SESSION['emp_role'] == "project_manager"){
    $sql = "select tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, GROUP_CONCAT( am.assign_id) as assign_id, (select emp_name from employees_master where emp_id = tm.created_by)as created_by, (select emp_name from employees_master where emp_id = am.assign_id)as get_name_emp, (select emp_email from employees_master where emp_id = am.assign_id)as get_email_emp, (select emp_role from employees_master where emp_id = am.assign_id)as get_role_emp from ticket_master as tm LEFT join assign_master as am on tm.ticket_id = am.ticket_id where tm.status NOT IN ($get_status_applicable) GROUP BY tm.ticket_id";

    $getAllData = execute_query($sql);
}
if($_SESSION['emp_role'] == "Team_Manager"){
    $sql="select tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, GROUP_CONCAT( am.assign_id) as assign_id, (select emp_name from employees_master where emp_id = tm.created_by)as created_by, (select emp_name from employees_master where emp_id = am.assign_id)as get_name_emp, (select emp_email from employees_master where emp_id = am.assign_id)as get_email_emp, (select emp_role from employees_master where emp_id = am.assign_id)as get_role_emp from ticket_master as tm join assign_master as am on tm.ticket_id = am.ticket_id JOIN employees_master as em on am.assign_id = em.emp_id where am.assign_id = ".$_SESSION['emp_id']." and am.status = 1 GROUP BY tm.ticket_id";
	$getAllData = execute_query($sql);
}

$emp_list_tm = select_query("employees_master",array("emp_id","emp_name","emp_email"),array('emp_role' => 'Team_Manager'));
$emp_list_tl = select_query("employees_master",array("emp_id","emp_name","emp_email"),array('emp_role' => 'Team_Leader'));
$emp_list_ql = select_query("employees_master",array("emp_id","emp_name","emp_email"),array('emp_role' => 'Quality_Tester'));

?>
<div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Assign Team</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- Data Table -->
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                            <table id="get_assign" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Ticket</th>
                                        <th>Deadline</th>
                                        <th>Date Added </th>
                                        <th>Assigned Team</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($getAllData))
                                {
                                    foreach($getAllData as $details)
                                    {
                                        $html_sme='';
                                        $html_sme .= '<ul class="preview-list g-1">';
                                        if($_SESSION['emp_role'] == "Team_Manager")
                                        {
                                            $sql2 = "SELECT GROUP_CONCAT(assign_id) from assign_master where assign_by = " .$_SESSION['emp_id']." and ticket_id = ".$details['ticket_id']." and `status` = 1 Group by ticket_id";
                                            $get_assign_data = execute_query($sql2);
                                            if(!empty($get_assign_data[0]['GROUP_CONCAT(assign_id)'])){
                                                    $emp_id_array = explode(",",$get_assign_data[0]['GROUP_CONCAT(assign_id)']);
                                                    foreach($emp_id_array as $key1)
                                                    {
                                                        $get_emp_details = select_query("employees_master",array("emp_name","emp_email","emp_role"),array('emp_id' => $key1));
                                                        $name_intial = printInitials($get_emp_details[0]['emp_name']);
                                                        $get_name = $get_emp_details[0]['emp_name'];
                                                        $get_email =$get_emp_details[0]['emp_email'];
                                                        $html_sme .='<li class="preview-item"><div class="user-avatar"><spandata-bs-toggle="tooltip" data-bs-placement="top" title="'.$get_name.'('.$get_email.')'.'Role:'.($get_emp_details[0]['emp_role']).'" style="cursor:pointer;">'.$name_intial.'</span></div></li>';
                                                }
                                                $html_sme .= '</ul>';
                                            }
                                            else{
                                                $html_sme = 'n/a';
                                            } 
                                        }
                                        else{
                                                $get_sql = "SELECT GROUP_CONCAT(assign_id) from assign_master where assign_by = " .$_SESSION['emp_id']." and ticket_id = ".$details['ticket_id']." and `status` = 1 Group by ticket_id";
                                                $get_assign_data = execute_query($get_sql);
                                                if(!empty($get_assign_data[0]['GROUP_CONCAT(assign_id)'])){
                                                    $emp_id_array = explode(",",$get_assign_data[0]['GROUP_CONCAT(assign_id)']);
                                                    foreach($emp_id_array as $key1)
                                                    {
                                                        $get_emp_details = select_query("employees_master",array("emp_name","emp_email","emp_role"),array('emp_id' => $key1));
                                                        $name_intial = printInitials($get_emp_details[0]['emp_name']);
                                                        $get_name = $get_emp_details[0]['emp_name'];
                                                        $get_email =$get_emp_details[0]['emp_email'];
                                                        $html_sme .='<li class="preview-item"><div class="user-avatar"><spandata-bs-toggle="tooltip" data-bs-placement="top" title="'.$get_name.'('.$get_email.')'.'Role:'.($get_emp_details[0]['emp_role']).'" style="cursor:pointer;">'.$name_intial.'</span></div></li>';
                                                    }
                                                        $html_sme .= '</ul>';
                                                }
                                            else{
                                                $html_sme = 'n/a';
                                            } 
                                        }
                                    ?>
                                    <tr>
                                        <td><?php echo "id:&nbsp;".$details['ticket_id']."<br>wordcount:&nbsp;".$details['wordcount']."<br>Created By:&nbsp;".$details['created_by'] ;?></td>
                                        <td><?php echo $details['assigned_deadline'];?></td>
                                        <td><?php echo $details['date_added'];?></td>
                                        <td><?php echo $html_sme;?></td>
                                        <td><?php if($_SESSION['emp_role'] == "Admin" || $_SESSION['emp_role'] == "project_manager" || $_SESSION['emp_role'] == "Team_Manager"){?><div class="btn-group" aria-label="Basic example"> <button type="button" id="add-assign-tm" data-id="<?= $details['ticket_id']?>" class="btn btn-sm btn-outline-primary mt-3" onclick="assign(this);" title="Assign Team Maneger"><em class="icon ni ni-plus-round-fill"></em></button>&nbsp;&nbsp;<button type="button" data-id="<?= $details['ticket_id']?>" class="btn btn-sm btn-outline-warning mt-3" onclick="view_attchment(this);" title="view"><em class="icon ni ni-eye-alt-fill"></em></button>&nbsp;&nbsp;<button type="button" id="uploadbutton" data-id="<?=$details['ticket_id']?>" class="btn btn-sm btn-dim btn-outline-info mt-3" data-bs-target="#uploadAttachment"onclick="upload_attchment(this);" title="Upload"><em class="icon ni ni-upload"></em></button></div><?php }?></td>
                                    </tr>
                                    <?php
                                    }
                                }
                                ?>
                                    
                                    
                                </tbody>
                            </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div>
                </div><!-- .nk-block -->
            </div>
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
                        <?php if($_SESSION['emp_role'] == 'Team_Manager'){ ?>
                        <div class="col-12">
                            <div class="form-group">
                            <label class="form-label">Assign Quality</label>
                                <div class="form-control-wrap">
                                    <select class="form-select mySelects assign_team" name="assign_quality[]" id="assign_quality" multiple="multiple">
                                            <?php
                                            if($_SESSION['emp_role'] == 'Team_Manager'){ 
                                                foreach($emp_list_ql as $key => $val){ ?>
                                                <option value="<?=$val['emp_id']?>"><?=$val['emp_name']?>(<?=$val['emp_email']?>)</option>
                                            <?php }}?>
                                    </select> 
                                    <!-- <textarea class="form-control no-resize my-4" rows = "5" name="prod_remarks" id="get_prod_remarks" placeholder="Write Comments Here..."></textarea>     -->
                                </div>
                            </div>
                        </div>
                        <?php  } ?>
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
                            <!-- <div class="col-md-12 mt-2">
                                <label class="form-label" for="file">Select File to upload:</label>
                                <input type="file" class="form-control" multiple id="uploadattachment" name="uploadattachment[]" >
                            </div> -->
                            <div class="col-12 mt-4" >
                                <button id="button-upload" type="submit" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload</span></button>
                            </div>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function () {
    $('#get_assign').DataTable();
});
function assign(e){
    var id = $(e).data("id");
    // alert(id);
    $.ajax({
        url:"ajax/ajax_action.php",
        method:"POST",
        data:{ticket_id:id, action:'getAssignDetails'},
        dataType:"JSON",
        success:function(data){ 
        //    console.log(data);
                $('#ticket_id_assign').val(id);
                var placeholder = "Assign Team Member/Members";
                        $(".assign_team").select2({
                            placeholder: placeholder,
                            allowClear: false,
                            
                        });
                // $("#assign_team").select2("val", "");
                $('.assign_team').val(null).trigger('change');
                $("#Assigned").trigger( "reset" );               
                    $('#Assigned').modal('show'); 
                    // if(typeof(data.data2) != "undefined" && data.data2[0]['emp_id'] != null){
                        if($(data.data2).length){
                        var values1 = data.data1[0]['emp_id'];
                        var emp_array1 = [];
                        $.each(data.data1, function (i) {
                            $.each(data.data1[i], function (key, val) {
                                emp_array1.push(val);
                            });
                        });
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
                        $("#assign_quality").val(emp_array2).trigger('change');
                        $("#strings_assign_option").val(emp_array2).trigger('change');
                    }
                    else{
                        var values1 = data.data1[0]['emp_id'];
                        var emp_array1 = [];
                        $.each(data.data1, function (i) {
                            $.each(data.data1[i], function (key, val) {
                                emp_array1.push(val);
                            });
                        });
                        // console.log(emp_array1);
                        $(".assign_team").val(emp_array1).trigger('change');
                        $("#strings_assign_option").val(emp_array1).trigger('change');
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
                    location.reload();
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
                        html += '<span class="form-label Title"> <a href="html/download.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                    
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
        
</script>
