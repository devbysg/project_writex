<?php
$country_desc = select_all("country_cost_master");
$cat_desc = select_query("category_master",array("category_id","category_name"),array());

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
                                <h3 class="nk-block-title page-title">SME</h3>
                            </div><!-- .nk-block-head-content -->
                            
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- Div Nav Start -->
                    <div class="card card-bordered card-preview">
                        <div class="card-inner">
                            <ul class="nav nav-tabs mt-n3" role="tablist">
                                <li class="nav-item" role="presentation" onclick="assign_project(this)">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem4" aria-selected="true" role="tab"><em class=""></em><span>New Assigned</span></a>
                                </li>
                                <li class="nav-item" role="presentation" onclick="all_projects(this)">
                                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem6" aria-selected="true" role="tab"><em class=""></em><span>All</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                            <div class="tab-pane active show" id="tabItem4" role="tabpanel">
                                    <!-- New Tickets Table Start -->
                                    <table class="nk-tb-list nk-tb-ulist  nowrap table" id="smelisting_assign" data-auto-responsive="false">
                                        <thead>
                                            <tr>
                                                <th>Ticket</th>
                                                <th>Assigned Date</th>	
                                                <th>Deadline</th>	
                                                <th>Remaining Days</th>	
                                                <th>Action</th>	
                                            </tr>
                                        </thead>
                                    </table>
                                    <!-- New Tickets Table Ends -->
                                </div>
                                <div class="tab-pane" id="tabItem6" role="tabpanel">
                                    <!-- New Tickets Table Start -->
                                    <table class="nk-tb-list nk-tb-ulist  nowrap table" id="all_smelisting" data-auto-responsive="false">
                                        <thead>
                                            <tr>
                                                <th>Ticket</th>
                                                <th>Assigned Date</th>	
                                                <th>Deadline</th>	
                                                <th>Submit Date</th>
                                                <th>Remaining Days</th>	
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
    <div class="modal fade" tabindex="-1" role="dialog" id="uploadsmeattachment">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Upload Attachments</h4>
                    <hr>
                    <form action="" id="uploadsmeform" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="" class="uploadsmeaction" id="uploadsmeaction">
                            <input type="hidden" class="form-control" id="uploadsmeticket_id" name="uploadsmeticket_id">
                            <input type='file' class="form-control" multiple id="uploadsmeattachment" name="uploadsmeattachment[]" accept="image/*" onchange="readURL(this);" required/>
                            <br>
                            <img id="preview_image" src="" alt="Select File to upload:" />          
                            <!-- <div class="col-md-12 mt-2">
                                <label class="form-label" for="file">Select File to upload:</label>
                                <input type="file" class="form-control" multiple id="uploadsmeattachment" name="uploadsmeattachment[]" >
                            </div> -->
                            <div class="col-md-12 mt-2">
                                <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="quality_completed_check" id="customCheck1"><label class="custom-control-label" for="customCheck1">Apply For Quality Check</label></div>
                            </div>
                        
                        <div class="col-12 mt-4" >
                            <button type="submit" id="button-uploadsme" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload</span></button>
                        </div>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
    <!-- Attachment Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="get_uploadFiles">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Uploaded Attachments</h4>
                    <label for="input">Input Documents</label>
                    <div id="input_attachment_files"> </div>
                    <label for="output">Output Documents</label>
                    <div id="output_attachment_files"> </div>
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
                        <span id="ticket_data_id" style="color: blue;font-size: 24px;"></span>
                        <!-- <span id="ticket_data_name" style="color: blue;font-size: 24px;"></span> -->
                    </div>
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
    <!-- Remarks Modal Start -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalRemarksData">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <div id="get_id" style="color: blue;font-size: 24px; font-weight: 600"></div>
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
    
    <script>
        $(document).ready(function(){	
            assign_project();
        });  
        function all_projects(){

            if ( $.fn.DataTable.isDataTable('#all_smelisting') ) {
                $('#all_smelisting').DataTable().destroy();
                }

            $('#all_smelisting tbody').empty();

            var dataRecords = $('#all_smelisting').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'all_smerecords'},
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
        function assign_project(){
            if ( $.fn.DataTable.isDataTable('#smelisting_assign') ) {
                $('#smelisting_assign').DataTable().destroy();
                }

                $('#smelisting_assign tbody').empty();

            var dataRecords = $('#smelisting_assign').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'new_assigned'},
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
        function downloadFile(file_name) {
            var filename = "../upload/"+file_name;
             window.location.href = filename;
        } 
        // Upload Sme Files
        function modaluploadsmeattachment(e){
            var id = $(e).data("id");
            document.getElementById("uploadsmeform").reset();
            $('#uploadsmeattachment').modal('show');
            $("#uploadsmeform").trigger( "reset" );                            
            $('#preview_image').attr('src', null);                        
            $('#uploadsmeaction').val('uploadsmefiles');
            $('#uploadsmeticket_id').val(id);
        }
        $('#uploadsmebutton').click(function(){
        $('#ticket_modal_header').html("<i class='fa fa-plus'></i> Upload");
            $('.uploadsmeaction').val('uploadsmefiles');
        });
        $("#uploadsmeattachment").on('submit','#uploadsmeform', function(event){ 
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
                    //  location.reload();
                    $("#button-uploadsme").html('<button type="submit" id="button-uploadsme" class="btn btn-primary"><em class="icon ni ni-upload"></em><span>Upload</span></button>');		
                    $('#uploadsmeattachment').modal('toggle');
                    assign_project();
                }
            })
    });
    // Attachments Modal Ajax
    function modalopensmeattachment(e){
            var id = $(e).data("id");
            // alert(id);
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{action:"get_uploaded_files",ticket_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                    $('#get_uploadFiles').modal('show'); 
                    console.log(data);
                    var html1 = '';
                    if((data.data2.length == 0))
                    {
                        html1 += '<span class="form-label Title">Sorry, No data found for Input file</span>';
                    }
                    $.each(data.data2, function(i, item) {
                        console.log(i);console.log(item);
                        html1 += '<span class="form-label Title"> <a href="html/download.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                    
                    });
                    var html2 = '';
                    if((data.data1.length == 0))
                    {
                        html2 += '<span class="form-label Title">Sorry, No data found for Output file</span>';
                    }
                    $.each(data.data1, function(i, item) {
                        console.log(i);console.log(item);
                        html2 += '<span class="form-label Title"> <a href="html/download_output.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                    
                    });
                    $('#input_attachment_files').html(html1);        
                    $('#output_attachment_files').html(html2);        
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
    // Get Remarks
    function modalOpenRemarks(e){
        var id = $(e).data("id");
        // alert(id);
        $.ajax({
            url:"ajax/ajax_action.php",
            method:"POST",
            data:{action:"get_ticket_rem",ticket_id: id},
            dataType:"JSON",
            beforeSend: function() {
                $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
            },
            success:function(data){
                $('#modalRemarksData').modal('show'); 
                console.log(data);
                console.log(data.data);
                // console.log(data.data[0]['remarks_qa']);
                $('#get_id').html("#"+(data.data[0]['ticket_id']));
                // $('#get_name').html(data.data[0]['ticket_name']);
                $('#rem_prod').html(data.data[0]['remarks_qa']);
            }
        })
    }
    // 
     function modalopensmeattachment(e){
            var id = $(e).data("id");
            // alert(id);
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{action:"get_uploaded_files",ticket_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                    $('#get_uploadFiles').modal('show'); 
                    console.log(data);
                    var html1 = '';
                    if((data.data2.length == 0))
                    {
                        html1 += '<span class="form-label Title">Sorry, No data found for Input file</span>';
                    }
                    $.each(data.data2, function(i, item) {
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
                    if((data.data1.length == 0))
                    {
                        html2 += '<span class="form-label Title">Sorry, No data found for Output file</span>';
                    }
                    $.each(data.data1, function(i, item) {
                        // console.log(i);console.log(item);
                        // html2 += '<span class="form-label Title"> <a href="html/download_output.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                        var extension2 = item.file_name.split('.').pop();
                            // alert(extension);
                            if(extension2 == "jpg" || extension2 == "jpeg"|| extension2 == "jfif")
                            {
                                html2 += '<span class="form-label Title"> <img onclick= "image(this);" src="http://13.233.32.132/upload/sme_upload/'+ item.file_name+'" class="btn btn-dim btn-primary mt-1 mx-2" style="height: 45px;width: 150px;"/></span>';
                            }
                            else{
                                html2 += '<span class="form-label Title"> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/sme_upload/'+ item.file_name+'&embedded=true" class="btn btn-dim btn-primary mt-1" target="_blank"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                            }
                    });
                    $('#input_attachment_files').html(html1);        
                    $('#output_attachment_files').html(html2);        
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