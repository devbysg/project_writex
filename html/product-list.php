<?php
header("Location:list_product.php");
include('layout/header2.php');
$emp_list = select_query("employees_master",array("emp_id","emp_name","emp_email"),array());
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
                    <!-- Data Table -->
                    <div class="nk-block nk-block-lg">
                                        
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="data_project" data-auto-responsive="false">
                                                <thead>
                                                        <tr>
                                                            <!-- <th><input type="checkbox" class="custom-control-input" id="emp_data"></th> -->
                                                            <th>Ticket</th>
                                                            <th>Assigned Smes</th>	
                                                            <th>Assigned Quality Analyst</th>		
                                                            <th>Status</th>
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
                                    <!-- <select class="form-select mySelect" multiple="multiple" name="empid[]" id ="strings_option"> -->
                                    <select class="form-select mySelect" multiple="multiple" name="assign_sme[]" id ="strings_option">
                                            <?php foreach($emp_list as $key => $val){ ?>
                                                <option value="<?=$val['emp_id']?>"><?=$val['emp_name']?>(<?=$val['emp_email']?>)</option>
                                            <?php }?>
                                    </select> 
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Assign Quality</label>
                                <div class="form-control-wrap">
                                    <!-- <select class="form-select mySelect" multiple="multiple" name="emp_assign_id[]" id ="strings_assign_option"> -->
                                    <select class="form-select mySelect" multiple="multiple" name="assign_quality[]" id ="strings_assign_option">
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
                    <h4 class="title">Upload Output Attachments</h4>
                    <hr>
                    <form action="" id="uploadform" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="" class="uploadaction" id="uploadaction">
                            <input type="hidden" class="form-control" id="uploadticket_id" name="uploadticket_id">
                                        
                            <div class="col-md-12 mt-2">
                                <label class="form-label" for="file">Select File to upload:</label>
                                <input type="file" class="form-control" multiple id="uploadattachment" name="uploadattachment[]" >
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="task_completed_check" id="customCheck1"><label class="custom-control-label" for="customCheck1">Task Completed</label></div>
                            </div>
                            <div class="col-12 mt-4" >
                                <button id="button-upload" type="submit" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload</span></button>
                            </div>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
<script>
        $(document).ready(function(){	
            datatable();
           
            //var placeholder = "select SME's";
            // $(".mySelect").select2({
            //     placeholder: placeholder,
            //     allowClear: false,
                
            // });
        }); 
        // Listing 
        function datatable(){ 
            // alert("nnn");
            var dataRecords = $('#data_project').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action3.php",
                    type:"POST",
                    // data:{action:'data_role'},
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
        // Assigned Smes Modal Settings
        function assignedSmes(e){
            var id = $(e).data("id");
            // alert(id);
            $.ajax({
                url:"ajax/ajax_action3.php",
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
                   // $("#d")[0].reset()
                  // console.log(data);
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
                url:"ajax/ajax_action3.php",
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
                   // window.location.replace("https://achievexsolutions.in/Writexdemo/html/payment.php");
                 //  console.log(data);
                   location.reload();
                }
            })
        });
        function view_attchment(e){
            var id = $(e).data("id");
            $.ajax({
                url:"ajax/ajax_action3.php",
                method:"POST",
                data:{action:"get_attachment_by_id",ticket_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                    $('#modalAttachment').modal('show'); 
                   var html = '';
                    $.each(data.data, function(i, item) {
                        //console.log(i);console.log(item);
                      //  var filename = "../upload/"+item.file_name;
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
            // alert(id);
            $('#uploadAttachment').modal('show');
            $('#uploadaction').val('uploadfiles');
            // $('.modaction').val('upload');
            $('#uploadticket_id').val(id);
        }
        $("#uploadAttachment").on('submit','#uploadform', function(event){ 
             event.preventDefault();
            //  $('#save').attr('disabled','disabled');
             $.ajax({
                url:"ajax/ajax_action3.php",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    // alert("xxx");		
                    //  $("#button-upload").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
                    //  location.reload();
                //    $('#save').attr('disabled', false);
                //    datatable();
                }
            })
            // alert("TEST");
        });

        // Archieve Ticket
        function archieve_ticket(e){
            var id = $(e).data("id");
            //alert(id);
            $.ajax({
                url:"ajax/ajax_action3.php",
                method:"POST",
                data:{ticket_id:id, action:'getTicketStatusById'},
                dataType:"JSON",
                success:function(data){ 
                    location.reload();
                    // $('#AssignedSme').modal('show'); 
                    // $('#assigned_sme_action').val('addAssignedSme');
                    // $('#ticket_name_sme_assigned').val(data.data[0]['ticket_name']);
                    // $('#ticket_desc_sme_assigned').val(data.data[0]['ticket_desc']);
                    // $('#ticket_id_sme_assign').val(id);
                }
            })
        }
    </script>
<?php
include('layout/footer.php');
?>