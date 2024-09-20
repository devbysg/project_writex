
    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Quality Testing</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3" role="tablist">
                                <li class="nav-item" role="presentation" onclick="datatable(this)">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem4" aria-selected="true" role="tab"><em class=""></em><span>New Assigned</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="checked_quality(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem6" aria-selected="true" role="tab"><em class=""></em><span>Checked Quality</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                            <div class="tab-pane active show" id="tabItem4" role="tabpanel">
                                    <!-- New Tickets Table Start -->
                                    <table class="nk-tb-list nk-tb-ulist  nowrap table" id="check_quality" data-auto-responsive="false">
                                        <thead>
                                            <tr>
                                                <th>Ticket</th>
                                                <th>Status</th>	
                                                <th>Action</th>	
                                            </tr>
                                        </thead>
                                    </table>
                                    <!-- New Tickets Table Ends -->
                                </div>
                                <div class="tab-pane" id="tabItem6" role="tabpanel">
                                    <!-- New Tickets Table Start -->
                                    <table class="nk-tb-list nk-tb-ulist  nowrap table" id="check_quality_done" data-auto-responsive="false">
                                        <thead>
                                            <tr>
                                                <th>Ticket</th>
                                                <th>Status</th>	
                                                <th>Action</th>	
                                            </tr>
                                        </thead>
                                    </table>
                                    <!-- New Tickets Table Ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quality Check Modal Confirmation -->
    <div class="modal fade" tabindex="-1" role="dialog" id="uploadQualityDocument">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Quality Checking Confirmation</h4>
                    <hr>
                    <form action="" id="uploadqualitydocumentform" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="" class="uploadaction_pass" id="uploadaction_check">
                            <input type="hidden" class="form-control" id="uploadticket_id" name="uploadticket_id">
                            <div class="col-md-12 mt-2">
                            <h3 id="ticket_id_data"></h3>
                                <label class="form-label" for="file">Do You Want To Checked?</label>
                                <textarea class="form-control no-resize" rows = "5" name="remarks" id="get_remarks"></textarea>
                            </div>
                            <div class="col-12 mt-4" >
                                <button id="button-upload-document-check" type="submit" class="btn btn-primary">Quality Okay</button>
                            </div>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
    <!-- Quality Failed Modal Confirmation -->
    <div class="modal fade" tabindex="-1" role="dialog" id="archieve_failed_Document">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title" style="color:red">Quality Revert Confirmation</h4>
                    <hr>
                    <form action="" id="archievefailedDocumentform" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="" class="uploadfailedaction" id="uploadaction_revert">
                            <input type="hidden" class="form-control" id="uploadfailedticket_id" name="ticket_id">
                            <div class="col-md-12 mt-2">
                            <h3 id="ticket_get_data" style="color:red"></h3>
                                <label class="form-label" for="file">Do You Want Revert the content?</label>
                                <textarea class="form-control no-resize" rows = "5" name="remarks" id="get_remarks"></textarea>
                            </div>
                            <div class="col-12 mt-4" >
                                <button id="button-upload-document" type="submit" class="btn btn-danger">Yes, Quality Failed</button>
                            </div>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
    <!-- Attachment Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalAttachment">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Check Attachments</h4>
                    <hr>
                    <label for="input_div">Input Attachments</label>
                    <div id = "input_div_attachment" ></div>
                    <hr>
                    <div id="attachmen_div_quality"> </div>
                    <label for="output_div">Output Documents</label>
                    <div id = "output_div_attachment" ></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Attachment Modal Ends -->
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
                    <!-- <span id="ticket_data_name"></span> -->
                    <!-- <div><span id="ticket_data_id"></span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="ticket_data_name"></span></div> -->
                    <hr>
                    <div id="ticket_data_desc"></div>
                    <!-- <label for="input">Input Documents</label> -->
                    <!-- <div id="ticket_data"></div> -->
                    <!-- <label for="input">Input Documents</label> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Ticket Data Modal Ends -->
<script>
        $(document).ready(function(){	
            datatable();
        });  
        function datatable(){ 
            // alert("nnn");
            if ( $.fn.DataTable.isDataTable('#check_quality') ) {
                $('#check_quality').DataTable().destroy();
                }

            $('#check_quality tbody').empty();

            var dataRecords = $('#check_quality').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    // data:{action:'data_role'},
                    data:{action:'data_quality'},
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
        // Checked Documents
        function checked_quality(){ 
            // alert("nnn");
            if ( $.fn.DataTable.isDataTable('#check_quality_done') ) {
                $('#check_quality_done').DataTable().destroy();
                }

            $('#check_quality_done tbody').empty();

            var dataRecords = $('#check_quality_done').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    // data:{action:'data_role'},
                    data:{action:'data_quality_done'},
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
        // View Attachments
        function downloadFile(file_name) {
            var filename = "../upload/"+file_name;
             window.location.href = filename;
        }

        function view_check_attachment(e){
            var id = $(e).data("id");
            // alert(id);
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{action:"get_quality_documents_by_id",ticket_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                    $('#modalAttachment').modal('show'); 
                   var html1 = '';
                    $.each(data.data1, function(i, item) {
                    //     console.log(i);console.log(item);
                    //   //  var filename = "../upload/"+item.file_name;
                    //     html1 += '<span class="form-label Title"> <a href="html/download.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
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
                    html = '<hr>';
                    var html2 = '';
                    $.each(data.data2, function(i, item) {
                        // console.log(i);console.log(item);
                        // html2 += '<span class="form-label Title"> <a href="html/download_output.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                        var extension2 = item.file_name.split('.').pop();
                        // alert(extension);
                        if(extension2 == "jpg" || extension2 == "jpeg" || extension2 == "jfif")
                        {
                            html2 += '<span class="form-label Title"> <img onclick= "image(this);" src="http://13.233.32.132/upload/sme_upload/'+ item.file_name+'" class="btn btn-dim btn-primary mt-1 mx-2" style="height: 150px;width: 150px;" /></span>';
                        }
                        else{
                            html2 += '<span class="form-label Title"> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/sme_upload/'+ item.file_name+'&embedded=true" class="btn btn-dim btn-primary mt-1" target="_blank"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                        }
                    });
                    $('#input_div_attachment').html(html1); 
                    $('#attachmen_div_quality').html(html); 
                    $('#output_div_attachment').html(html2); 
                    
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
        // Quality check
        $('#uploaddatabutton').click(function(){
            $('#ticket_modal_header').html("<i class='fa fa-plus'></i> Upload");
            $('.uploadaction_pass').val('uploadfiles');
        });
        function upload_checked_attchment(e){
            var id = $(e).data("id");
            // alert(id);
            $('#uploadQualityDocument').modal('show');
            $("#uploadqualitydocumentform").trigger( "reset" );                            
            $('#ticket_id_data').html("#"+id); 
            $('#uploadaction_check').val('upload_documents_files');
            // $('.modaction').val('upload');
            $('#uploadticket_id').val(id);
        }
        $("#uploadQualityDocument").on('submit','#uploadqualitydocumentform', function(event){ 
             event.preventDefault();
            //  $('#save').attr('disabled','disabled');
             $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                    // alert("xxx");		
                     $("#button-upload-document-check").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
                    //  location.reload();
                //    $('#save').attr('disabled', false);
                //    datatable();
                alert("Quality Passed Successfully!");
                $("#button-upload-document-check").html('<button id="button-upload-document-check" type="submit" class="btn btn-primary">Quality Okay</button>');		
                $('#uploadQualityDocument').modal('toggle');
                datatable();
                }
            })
            // alert("TEST");
        });

        // Quality Failed
        $('#revert_quality').click(function(){
            $('#ticket_modal_header').html("<i class='fa fa-plus'></i> Upload");
            $('.uploadfailedaction').val('uploadfiles');
        });
        function attachment_revert(e){
            var id = $(e).data("id");
            // alert(id);
            $('#archieve_failed_Document').modal('show');
            $("#archievefailedDocumentform").trigger( "reset" );                            
            $('#ticket_get_data').html("#"+id); 
            $('#uploadaction_revert').val('failed_quality');
            // $('.modaction').val('upload');
            $('#uploadfailedticket_id').val(id);
        }
        $("#archieve_failed_Document").on('submit','#archievefailedDocumentform', function(event){ 
             event.preventDefault();
            //  $('#save').attr('disabled','disabled');
             $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function() {
                     $("#button-upload-document").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
                    //  location.reload();
                    alert("Quality Failed");
                    $("#button-upload-document").html('<button id="button-upload-document" type="submit" class="btn btn-danger">Yes, Quality Failed</button>');		
                    $('#archieve_failed_Document').modal('toggle');
                    datatable();
                }
            })
        });
        
        // Ticket Modal Data
        function get_id(e){
        var id = $(e).data("id");
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
                $('#ticket_data_id').html(data.data[0]['ticket_id']);
                $('#ticket_data_name').html(data.data[0]['ticket_name']);
                $('#ticket_data_desc').html(data.data[0]['ticket_desc']);
            }
        })
        }
    </script>