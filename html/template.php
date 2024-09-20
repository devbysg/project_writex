<div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Templates</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" "><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <button type="button" class="btn btn-lg btn-primary" id="add_template"><em class="icon ni ni-plus"></em>Add Template</button>
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
                                <table class=" nk-tb-list nk-tb-ulist nowrap table" id="temp_value" data-auto-responsive="false">
                                <thead>
                                        <tr>
                                            <th>Template Type</th>
                                            <th>Subject</th>
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
<!-- New Add Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md text-center3">
                    <h4 class="title ">New Template</h4>
                    <hr>
                    <div class="nk-block" id="template">
                        <form action="" id="insert_temp" method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <input type="hidden" name="action" value="addTemp" id="action">
                                <input type="hidden" class="form-control" id="temp_id" name="temp_id">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="product-title">Template Type</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="temp_type" id="product-title">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="sale-price">Template Subject</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="temp_sub" id="sale-price">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="regular-price">Template Body</label>
                                        <div class="form-control-wrap">
                                            <textarea id="summernote" name="temp_body"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit" name="button"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- New Add Modal Ends -->
    <div class="modal fade" tabindex="-1" role="dialog" id="updatetemplate">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Update Template</h4>
                    <hr>
                    <form action="" id="update_tempform" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <input type="hidden" name="action" value="" class="modaction" id="modaction">
                            <input type="hidden" class="form-control" id="modtemp_id" name="modtemp_id">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="product-title">Template Type</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="modtemp_type" id="modtemp_type">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="sale-price">Template Subject</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="modtemp_sub" id="modtemp_sub">
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="regular-price">Template Body</label>
                                    <div class="form-control-wrap">
                                        <textarea  class="form-control" id="modtemp_body" name="modtemp_body"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" id="button-edit">
                                <button class="btn btn-primary" name="submit"><em class="icon ni ni-plus"></em><span>Edit</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Send Email Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="sendTemplateModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md text-center3">
                    <h4 class="title ">Send Template</h4>
                    <hr>
                    <form id="sendTemplateform" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="send_template_via_mail" class="modaction_send_template" id="modaction_send_template">
                        <input type="hidden" class="form-control" value="" id="modid_send_template" name="template_id">
                        <div class="col-12">
                            <div class="form-group">
                                <h3 id="template_id_invoice"></h3>
                                <label class="form-label" for="file">Are You Sure Want To Send The Mail For Checking?</label>
                                <input type="text" class="form-control" id="email_output" name="client_email_output" placeholder="Optional Extra Email ID(Ex: abc@email.com,xyz@email.com)">
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 " id="button-edit">
                            <button type="submit" id="send_template_final" class="btn btn-primary"><em class=""></em><span>Send</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Send Email Modal Ends -->
    <!-- Show Template Body Start -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalTemplateDiv">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Template Body</h4>
                    <hr>
                    <div id="get_template_div"> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Show Template Body End -->
    <script>
        $(document).ready(function(){
            datatable();
            $('#summernote').summernote({placeholder: 'Enter Template Body',
                    tabsize: 2,
                    height: 100});

            $("#add_template").click(function(){
            $("#myModal").trigger("reset");               
            $("#myModal").modal('show');
            $('#insert_temp')[0].reset();
        });
        });
        function add_template(){
            $('#addtemplate').modal('show'); 
        }
        function datatable(){
            if ( $.fn.DataTable.isDataTable('#temp_value') ) {
                $('#temp_value').DataTable().destroy();
                }

                $('#temp_value tbody').empty();
            var dataRecords=$('#temp_value').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'listTemp'},
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
    
    $('#temp').click(function(){
        $('#temp_modal_header').html("<i class='fa fa-plus'></i> New Task");
            $('#action').val('addTemp');
    });
    $("#template").on('submit','#insert_temp', function(event){ 
             event.preventDefault();
             $('#save').attr('disabled','disabled');
             $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    $("#button-add").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
                    $("#button-add").html('<button class="btn btn-primary" type="submit" name="button"><em class="icon ni ni-plus"></em><span>Add New</span></button>');
                    $('#myModal').modal('toggle');
                    datatable(); 
                }
            })
        });
        function temp(e){
            var id=$(e).data("id");
        $.ajax({
            url: "ajax/ajax_action.php",
            method: "POST",
            data:{action: 'edit_template',
         data_id: id},
                dataType: "json",
                success: function(data){
                $('#updatetemplate').modal('show'); 
                $('#modtemp_body').summernote({
                    placeholder: 'Enter Template Body',
                    tabsize: 2,
                    height: 100,
                    code: data.data[0]['template_body']
                });
                var markupStr = data.data[0]['template_body'];
                $('#modtemp_body').summernote('code', markupStr);
                $('#modtemp_type').val(data.data[0]['template_type']);
                $('#modtemp_sub').val(data.data[0]['template_subject']);
                $('.modaction').val('update_temp');
                $('#modtemp_id').val(id);
                }

        });

        }
        $('#edit_temp').click(function(){
            $('#ticket_modal_header').html("<i class='fa fa-plus'></i> Edit");
            $('#modaction').val('update_temp');
        })
        $("#updatetemplate").on('submit','#update_tempform', function(event){ 
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
                 location.reload();
                }
            })
        });

        // Send Template Format
        function send_template(e){
            var type = $(e).data("type");
            $('#sendTemplateModal').modal('show');
            $("#sendTemplateform")[0].reset();
            $('#template_id_invoice').html(type); 
            $('#modid_send_template').val(type);
        }
        $("#sendTemplateModal").on('submit','#sendTemplateform', function(event){ 
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
                    $("#send_template_final").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                    console.log(data);
                   location.reload();
               }
            })
        });
        // Template Body Modal
        function view_template_body(e){
            var id = $(e).data("id");
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{action:"get_template_body_by_id",template_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                    console.log(data.data);
                    $('#modalTemplateDiv').modal('show'); 
                    $('#get_template_div').html(data.data); 
                    
                }
            })
            
        }
    </script>