<?php
$university_list = select_query("university",array("university_id","university_name"),array());

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
                                <h3 class="nk-block-title page-title">Ticket Template</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            
                                            <li class="nk-block-tools-opt">
                                                <a  data-target="" onclick="addnewtemp(this);" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                <a  data-target="" onclick="addnewtemp(this);" id="addRecords" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Ticket Template</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->                   
                    <!-- Data Table -->
                                    <div class="nk-block nk-block-lg">
                                        
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="temp_data" data-auto-responsive="false">
                                                <thead>
                                                        <tr>
                                                            <th>Template ID</th>
                                                            <th>Template Name</th>
                                                            <th>View Template Text</th>			
                                                            <!-- <th>Action</th> -->
                                                        </tr>
                                                    </thead>
                                                    
                                                </table>
                                            </div>
                                        </div><!-- .card-preview -->
                                    </div>
                    <!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
        <!-- Add Template Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="recordTempModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h4 class="title">Add New Template</h4>
                        <hr>
                        <div class="row g-3">
                            <form  id="recordUnivForm" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="addRecord" id="action">
                                <input type="hidden" class="form-control" id="data_template" name="data_template">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="TicketName">Template Name</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="template_name" name="template_name" placeholder="Template Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="regular-price">Template Text</label>
                                        <div class="form-control-wrap">
                                            <textarea id="summernote" name="temp_body"></textarea>
                                            <!-- <input type="text" class="form-control" name="temp_body" id="regular-price"> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="University">Choose University</label>
                                        <br>
                                        <select class="form-select university" name="university" id="university">
                                            <option value="">Choose...</option>
                                            <?php foreach($university_list as $key => $val){ ?>
                                                <option value="<?php echo $val['university_id'];?>"><?php echo $val['university_name'] ;?></option>
                                            <?php }?>    
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mt-4" id="button-add">
                                    <button type="button" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                                </div>
                            </form>            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Add Ticket Modal Ends-->
    <!-- Edit University Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="UnivUpdate">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md text-center3">
                    <h4 class="title ">Edit University</h4>
                    <hr>
                    <form action="" id="UnivUpdateForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="" class="modaction" id="edit_payment">
                        <input type="hidden" class="form-control" id="edit_payement_id" name="edit_payement_id">
                        <div class="form-group row col-md-12">
                            <div class=" col-md-6 ">
                                <label class="form-label " for="Asigned">Edit Name</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class=""></em>
                                    </div> 
                                    <input type="text" class="form-control date-picker modleft" name="name_univ" id="get_univ_name" >
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <label class="form-label" for="Bank">Choose University</label>
                                <br>
                                <select class="form-select bank" name="bank" id="bank">
                                    <option value="">Choose...</option>
                                    <?php foreach($university_list as $key => $val){ ?>
                                        <option value="<?php echo $val['university_id'];?>"><?php echo $val['university_name'] ;?>)</option>
                                    <?php }?>    
                                </select>
                            </div>
                            
                            <!-- <div class=" col-md-6 ">
                                <label class="form-label " for="Asigned">Edit Transaction Date</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-calendar"></em>
                                    </div> 
                                    <input type="text" class="form-control date-picker mod" data-date-format="yyyy-mm-dd" name="moddeadline" id="moddeadline" >
                                    
                                </div>
                            </div>  -->
                         <!-- </div>
                         <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="Ticketvalue">Update Trasction ID</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="advance_transction_id" name="advance_transction_id" placeholder="Enter Tranction ID">
                                </div>
                            </div>-->
                        </div> 
                        <!-- <div class="col-md-12 mt-2">
                            <label class="form-label" for="file">Payment Receive:</label>
                            <input type="file" class="form-control" id="receivepayment" name="receive_payment[]" multiple>
                        </div> -->
                        <div class="col-md-12 mt-3 " id="button-edit">
                            <button type="submit" class="btn btn-primary"><em class="icon ni ni-pen-alt-fill"></em><span>Edit</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Payment Modal Ends -->
    <!--View Template Text Modal Start-->
    <div class="modal fade" tabindex="-1" role="dialog" id="get_tempText">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <div class="col-md-12 mt-2">
                        <span id="id_temp" style="color: blue;font-size: 24px;"></span> &nbsp;&nbsp;&nbsp;&nbsp;
                        <span id="name_temp" style="color: blue;font-size: 24px;"></span>
                    </div>
                    <hr>
                    <div id="text_temp"></div>
                </div>
            </div>
        </div>
    </div>
    <!--View Template Text Modal Ends-->
<script>
    function addnewtemp(e){
            // alert("ho");
            $("#recordTempModal").trigger("reset");               
            $('#recordTempModal').modal('show');
        }
        $('#addRecords').click(function(){
            $('#univ_modal_header').html("<i class='fa fa-plus'></i> New Ticket");
            $('#action').val('data_template');
	    });
        $("#recordTempModal").on('submit','#recordUnivForm', function(event){ 
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
                    // $("#button-add").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
                //    location.reload();
                $("#button-add").html('<button type="button" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>');
                $('#recordTempModal').modal('toggle');
                datatable();   
                }
            })
        });

        $(document).ready(function(){	
            datatable();
            $('#summernote').summernote({placeholder: 'Enter Template Body',
                    tabsize: 2,
                    height: 100});

        });  
        function datatable(){ 
            // alert("nnn");
            var dataRecords = $('#temp_data').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    // data:{action:'data_role'},
                    data:{action:'listTempTicket'},
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
        // Payment Table Edit Modal
        // function payment(e){
        //     var id = $(e).data("id");
        //     // alert(id);
        //     $.ajax({
        //         url:"ajax/ajax_action.php",
        //         method:"POST",
        //         data:{action:"get_payment_desc",ticket_id: id},
        //         dataType:"JSON",
        //         beforeSend: function() {
        //             $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
        //         },
        //         success:function(data){
        //             // $('#modalPaymentdata').modal('show'); 
        //             $('#UnivUpdate').modal('show'); 
        //             console.log(data);
        //             console.log(data.data);
        //             console.log(data.data[0]['accounts_approval_date']);
        //             console.log(data.data[0]['transaction_date']);
        //             console.log(data.data[0]['transaction_id']);
        //             $('#modassigned_for').val(data.data[0]['accounts_approval_date']);
        //             $('#moddeadline').val(data.data[0]['transaction_date']);
        //             $('#advance_transction_id').val(data.data[0]['transaction_id']);
        //             $('#edit_payment').val('editPaymentData');
        //             $('#edit_payement_id').val(id);
        //         }
        //     })
        // }
         // Add Advance Submit Button
        //  $("#UnivUpdate").on('submit','#UnivUpdateForm', function(event){ 
        //     event.preventDefault();
        //     $('#save').attr('disabled','disabled');
        //     $.ajax({
        //         url:"ajax/ajax_action.php",
        //         method:"POST",
        //         data:new FormData(this),
        //         contentType: false,
        //         cache: false,
        //         processData:false,
        //         dataType:"JSON",
        //         beforeSend: function() {
        //             $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
        //         },
        //         success:function(data){	
        //             location.reload();                  
        //         }
        //     })
        // });
            // View Payment Attachment
    function viewTemplate(e){
            var id = $(e).data("id");
            // alert(id);
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{action:"get_template_body",temp_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                    $('#get_tempText').modal('show'); 
                    console.log(data);
                    console.log(data.data[0]['template_text']);
                    $('#id_temp').html(data.data[0]['template_id']);      
                    $('#name_temp').html(data.data[0]['template_name']);        
                    $('#text_temp').html(data.data[0]['template_text']);          
                }
            })
            
        } 
    </script>