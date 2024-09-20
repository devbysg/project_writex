<?php

$ticketId = $_GET['ticketId'];
$temp_list = select_query("template_ticket",array("template_id","template_name"),array());
$temp_desc = execute_query("SELECT `ticket_id`, `ticket_desc`, `created_at`, `role`, `desc_file`, (SELECT emp_name FROM employees_master where emp_id = ticket_desc.created_by) as `emp` FROM `ticket_desc` where `ticket_id` = '$ticketId'");


?>

<div class="nk-chat-body chatbody">
    <div class="nk-chat-head">
        <ul class="nk-chat-head-info">
            <li class="nk-chat-body-close"><a href="#" class="btn btn-icon btn-trigger nk-chat-hide ms-n1"><em class="icon ni ni-arrow-left"></em></a></li>
            <li class="nk-chat-head-user">
                <div class="user-card">
                    <div class="user-info">
                        <div class="lead-text">
                            <p>Template Details</p>
                        </div>
                        <a onclick="get_project_details(this);" id="get_project_details" data-id ="<?=$ticketId?>" class="toggle btn btn-primary d-none d-md-inline-flex"style="margin-left: 805px;"><em class="icon ni ni-eye"></em><span>View Project Details</span></a>
                        <a class="btn btn-sm btn-outline-primary mt-3" onclick="get_ticket_desc_details(this);" id="get_project_details" data-id ="<?=$ticketId?>" class="toggle btn btn-primary d-none d-md-inline-flex"style="margin-left: 369px;/*! margin-bottom: 103px; */position: relative;bottom: 41px;"><em class="icon ni ni-eye"></em><span></span></a>
                    </div>
                </div>
            </li>
        </ul>
        
        <div class="nk-chat-head-search">
            <div class="form-group">
                <div class="form-control-wrap">
                    <div class="form-icon form-icon-left"><em class="icon ni ni-search"></em></div><input type="text" class="form-control form-round" id="chat-search" placeholder="Search in Conversation">
                </div>
            </div>
        </div>
    </div>
    <div data-simplebar="init">

        <div class="nk-reply-item" >
            <?php 
                $text = '';
                $i = 0;
                foreach ($temp_desc as $value){
                    ?><?php if(in_array($_SESSION['emp_role'], $desc_role_applicable)){
                        $get_name_intial = printInitials($value['emp'])?>
                    <div class="chat avatar" style="margin-top: 9px;"><div class="user-avatar2"style="background-color: #8e9e9e;"><span><?php echo $get_name_intial ?></span></div><?php
                        } else{?>
                    <div class="chat avatar"><div class="user-avatar2"style="background-color: #8e9e9e;"><span><em class="icon ni ni-user-alt"></em></span></div><?php
                        }?>
                    <?php
                    $length = 50; // number of characters to show before "read more"
                    if (strlen($value['ticket_desc']) > $length) {
                        $truncated_text = substr(strip_tags($value['ticket_desc']), 0, $length) . "...";
                    }
                    else {
                        $truncated_text =  $value['ticket_desc'];
                    }
                ?>

                <p><div class="chat-msg mx-2" style="border-radius: 34px;background-color: #e3d9d8;padding: 10px; margin-bottom: 12px;margin-top:16px;"><?php echo $truncated_text;?> <span id="dots_<?php echo $i?>"></span><div style="display:none" id="more_<?php echo $i?>"><?php echo $value['ticket_desc'];?> </div></div></p>
                </div>
                    <?php if(in_array($_SESSION['emp_role'], $desc_role_applicable)){?>
                        <div style="margin-left: 122px; margin-top: -29px;">
                             <p><ul class="chat-meta"><li><?php echo $value['emp']?></li><li><?php echo $value['role']?></li><li><?php echo $value['created_at']?></li></ul></p>
                             <?php if(isset($value['desc_file'])){$get_exten = explode(".", strtolower($value['desc_file']));}?>
                             <span><?php if(isset($value['desc_file'])){if($get_exten[1] == "jpg" || $get_exten[1] == "jpeg" || $get_exten[1] == "jfif"){?><a href="http://13.233.32.132/upload/get_desc_ticket/<?php echo $value['desc_file'] ?>" target="_blank"><?php echo $value['desc_file'] ?></a><?php } else{?> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/get_desc_ticket/<?php echo $value['desc_file']?>" target="_blank"><?php echo $value['desc_file'] ?></a><?php }}?></span>
                        </div>
                        <?php
                        } else{?>
                        <div style="margin-left: 122px; margin-top: -3px;">
                            <!-- <p><ul class="chat-meta"><li><?php 
                            // echo $value['role']
                            ?></li></ul></p> -->
                        <?php if(isset($value['desc_file'])){$get_exten = explode(".", strtolower($value['desc_file']));}?>
                             <span><?php if(isset($value['desc_file'])){if($get_exten[1] == "jpg" || $get_exten[1] == "jpeg" || $get_exten[1] == "jfif"){?><a href="http://13.233.32.132/upload/get_desc_ticket/<?php echo $value['desc_file'] ?>" target="_blank"><?php echo $value['desc_file'] ?></a><?php } else{?> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/get_desc_ticket/<?php echo $value['desc_file']?>" target="_blank"><?php echo $value['desc_file'] ?></a><?php }}?></span>
                        </div>
                        <?php }?>
                
                <?php if (strlen($value['ticket_desc']) > $length){?>
                <div class="chat-msg" style="margin-left: 105px;">
                <button onclick="myFunction(<?=$i?>)" id="myBtn_<?php echo $i?>">Read more</button></div>
                <?php     
                }$i++;
                }

        
            ?>
        </div>
        <div class="nk-reply-item" >
            <button class="btn btn-primary" id=newTicketAdd>Add Ticket Descriptions</button>
        </div>
    </div>
    <div class="nk-chat-editor">
        <div class="from-group" id="showTemplate" style="margin-left:2%">
            <div class="col-12">
                <div class="form-group"  style="margin-buttom:10%; !important;">
                    <label class="form-label" for="Template">Choose Template</label>
                    <br>
                    <select class="form-select template" name="template" id="template" style="width: 998px;margin-bottom: 1%;">
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
            <div class="nk-chat-editor-form row" id="newTicketAddTextArea">
            
            </div>
            <div class="col-md-12" id="addNewTicketButton">
                <button class="btn btn-primary" id="createNewTicket">Submit</button>
            </div>
        </div>
    </div>
</div>
<!-- Attachment Data Modal Start -->
<div class="modal fade" tabindex="-1" role="dialog" id="get_modalAttachment">
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
<!-- Attachment Data Modal Start -->
<div class="modal fade" tabindex="-1" role="dialog" id="get_ticketdescAttachment">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-md">
                <h4 class="title"></h4>
                <hr>
                <div id="attachmen_desc_div"> </div>
            </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function(){
        $("#modalDefault").appendTo("body");
        $("#showTemplate").hide();
            $("#newTicketAdd").click(function(){
                $("#showTemplate").toggle();
            });
        });
        $('#template').on('change', function() {
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{"template": this.value,"action": "assigned_temp_list"},
                dataType:"JSON",
                beforeSend: function() {
                   $("#button-add-employee").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                    var markupStr = data.data[0]['template_text'];
                    $('#newTicketAddTextArea').summernote('code', markupStr);
                   
                }
            })
        });

        $('#createNewTicket').on('click', function() {
        var summernoteValue = $('#newTicketAddTextArea').summernote('code');
        let params = new URLSearchParams(document.location.search);
        let t_id = params.get("ticketId");

           $.ajax({
                    type: "POST",       
                    url: 'ajax/ajax_action.php',
                    data:{"data":summernoteValue, "t_id": t_id, "action": "createNewTicketFromTicketDescription"},
                    success: function(result) {
                        location.reload();
                    }
            });
        });
        function myFunction(i) {
            var dots = document.getElementById("dots_"+i);
            var moreText = document.getElementById("more_"+i);
            var btnText = document.getElementById("myBtn_"+i);

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more"; 
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less"; 
                moreText.style.display = "inline";
            }
        }
        function get_project_details(e){
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
                    // console.log(data);
                    // console.log(data.data);
                    $('#get_modalAttachment').modal('show'); 
                   var html = '';
                    $.each(data.data, function(i, item) {
                        // html += '<span class="form-label Title"> <a href="html/download.php?file='+ item.file_name+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.file_name+'<span></span></a></span>';
                    var extension = item.file_name.split('.').pop();
                        // alert(extension);
                        if(extension == "jpg" || extension == "jpeg" || extension == "jfif")
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
        function get_ticket_desc_details(e){
            var id = $(e).data("id");
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{action:"get_ticket_desc_by_id",ticket_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                    $('#get_ticketdescAttachment').modal('show'); 
                   var html2 = '';
                   
                    $.each(data.data, function(i, item) {
                        console.log(item.desc_file);
                        if(item.desc_file != null){
                            // html += '<span class="form-label Title"> <a href="html/download_desc.php?file='+ item.desc_file+'" class="btn btn-dim btn-primary mt-1"><em class="icon ni ni-download"></em>'+ item.desc_file+'<span></span></a></span>';
                            var extension2 = item.desc_file.split('.').pop();
                            // alert(extension);
                            if(extension2 == "jpg" || extension2 == "jpeg" || extension2 == "jfif")
                            {
                                html2 += '<span class="form-label Title"> <img onclick= "image(this);" src="http://13.233.32.132/upload/get_desc_ticket/'+ item.desc_file+'" class="btn btn-dim btn-primary mt-1 mx-2" style="height: 45px;width: 150px;/><em class="icon ni ni-download"></em>'+ item.desc_file+'<span></span></span>';
                            }
                            else{
                                html2 += '<span class="form-label Title"> <a href="https://docs.google.com/gview?url=http://13.233.32.132/upload/get_desc_ticket/'+ item.desc_file+'&embedded=true" class="btn btn-dim btn-primary mt-1" target="_blank"><em class="icon ni ni-download"></em>'+ item.desc_file+'<span></span></a></span>';
                            }
                        }
                    });
                    $('#attachmen_desc_div').html(html2); 
                }
            })
        }
        function downloadFile(file_name) {
            var filename = "../upload/"+file_name;
             window.location.href = filename;
        }
</script>


