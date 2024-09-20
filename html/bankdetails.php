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
                                <h3 class="nk-block-title page-title">Bank Details</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <a href="#" data-target="addProduct" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                <a href="#" data-target="addProduct" id="addbankdetails" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Bank Details</span></a>
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
                                <table class="nk-tb-list nk-tb-ulist nowrap table" id="bankinfo" data-auto-responsive="false">
                                <thead>
                                        <tr>
                                            <!-- <th><input type="checkbox" class="custom-control-input" id="customCheck1"></th> -->
                                            <th>ID</th>
                                            <th>Account Holder Name</th>					
                                            <th>Bank Details</th>
                                                                
                                            <th>Action</th>	
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div>
                    </div><!-- .nk-block -->
                    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                        <h5>Add Bank Details</h5>
                        <!-- Modal -->
                        <div class="nk-block" id="bankdetails">
                            <div class="row g-3">
                                <form action="" id="bankform" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="" id="action">
                                    <input type="hidden" class="form-control" id="account_id" name="account_id">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="accountholder">Account Holder Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="account_holder" name="account_holder" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="Word">Account Number</label>
                                            <div class="form-control-wrap">
                                                <input type="number" class="form-control" name="account_no" id="account_no">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Word">IFSC Code</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control assigned" name="ifsc_code" id="ifsc_code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Country">Account Type</label>
                                                <div class="form-control-wrap">
                                                <input type="text" class="form-control deadline" name="account_type" id="account_type">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="Name">Bank Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="bank_name" id="bank_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="email">UPI ID</label>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control assigned" name="upi_id" id="upi_id" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="phone">Swift Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control deadline"  name="swift_code" id="swift_code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4" id="button-add">
                                        <button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                                    </div>
                                </form>  
                            </div><!-- Modal End -->
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalTabs">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md text-center3">
                    <h4 class="title ">Attachments</h4>
                    <hr>
                    <span class="form-label Title">
                        <button type="download" class="btn btn-dim btn-primary"><em class="icon ni ni-download"></em><span>Excel</span></button>
                    </span>
                    <span class="form-label Title">
                        <button type="download" class="btn btn-dim btn-primary"><em class="icon ni ni-download"></em><span>Image</span></button>
                    </span>
                    <span class="form-label Title">
                        <button type="download" class="btn btn-dim btn-primary disabled"><em class="icon ni ni-download"></em><span>Video</span></button>
                    </span>
                    <span class="form-label Title">
                        <button type="download" class="btn btn-dim btn-primary disabled"><em class="icon ni ni-download"></em><span>Word</span></button>
                    </span>
                    <span class="form-label Title">
                        <button type="download" class="btn btn-dim btn-primary"><em class="icon ni ni-download"></em><span>PDF</span></button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1"  role="dialog" id="updatebankdetails">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md text-center3">
                    <h4 class="title ">Edit </h4>
                    <hr>
                    <form action="" id="updatebankform" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="" class="modaction" id="modaction">
                                    <input type="hidden" class="form-control" id="modaccount_id" name="modaccount_id">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="accountholder">Account Holder Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="modaccount_holder" name="modaccount_holder" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="Word">Account Number</label>
                                            <div class="form-control-wrap">
                                                <input type="number" class="form-control" name="modaccount_no" id="modaccount_no">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Word">IFSC Code</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control modleft" name="modifsc_code" id="modifsc_code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Country">Account Type</label>
                                                <div class="form-control-wrap">
                                                <input type="text" class="form-control mod" name="modaccount_type" id="modaccount_type">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="Name">Bank Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="modbank_name" id="modbank_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 form-group row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="email">UPI ID</label>
                                                <div class="form-control-wrap">
                                                    <input type="email" class="form-control modleft" name="modupi_id" id="modupi_id" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="phone">Swift Code</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control mod"  name="modswift_code" id="modswift_code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4" id="button-edit">
                                        <button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Edit</span></button>
                                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        
        
        $(document).ready(function(){
            datatable();
        });
        function datatable(){
            var dataRecords=$('#bankinfo').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'bankdetails'},
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
    $('#addbankdetails').click(function(){
        $('#ticket_modal_header').html("<i class='fa fa-plus'></i> New Employee");
            $('#action').val('addbankdetails');
    });
    $("#bankdetails").on('submit','#bankform', function(event){ 
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
                    $("#button-add").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
                    //  alert("mmmmm");
                // Modal close logic
                //     $('#recordForm')[0].reset();
                //    $('#recordModal').modal('hide');
                //     $(".nk-add-product").removeClass("content-active");
                //     $("body").removeClass("toggle-shown");
                //     $("#button-add").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>');
                    location.reload();
                //    $('#save').attr('disabled', false);
                //    datatable();
                }
            })
            // alert("TEST");
    }); 
    // Edit Modal
    function test(e){
        var id =$(e).data("id");
        // var id = e.getAttribute('data-id');
        // alert(id);
        // 
        //var dataId = $(this).attr("data-id");
        // alert("The data-id of clicked item is: " + dataId);
        // alert("The data-id of clicked item is: " + id);

        $.ajax({
            url: "ajax/ajax_action.php",
            method: "POST",
            data:{action: 'get_records',
         data_id: id},
            dataType: "json",
            success: function(data){
                console.log(data);
                console.log(data.data[0]);
                console.log(data.data[0]['account_number']);
                $('#updatebankdetails').modal('show');
                $('#modaccount_holder').val(data.data[0]['account_holder_name']);
                $('#modaccount_no').val(data.data[0]['account_number']);
                $('#modifsc_code').val(data.data[0]['IFSC_code']);
                $('#modaccount_type').val(data.data[0]['account_type']);
                $('#modbank_name').val(data.data[0]['bank_name']);
                $('#modupi_id').val(data.data[0]['upi_id']);
                $('#modswift_code').val(data.data[0]['swift_code']);
                $('.modaction').val('updatebank');

                $('#modaccount_id').val(id);

            }
            
        });

    }
    $('#edit').click(function(){
        $('#ticket_modal_header').html("<i class='fa fa-plus'></i> Edit");
            $('#modaction').val('updatebank');
    })
    $("#updatebankdetails").on('submit','#updatebankform', function(event){ 
        alert();
            event.preventDefault();
            // $('#save').attr('disabled','disabled');
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
                     //alert("hi");
                     	 
                //     $('#bankform')[0].reset();
                // //    $('#recordModal').modal('hide');
                // //     $(".nk-add-product").removeClass("content-active");
                // //     $("body").removeClass("toggle-shown");
                //      $("#button-edit").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Edit</span></button>');
                    location.reload();
                //    $('#save').attr('disabled', false);
                //    datatable();
                }
            })
        });
    //update modal
    function make_default(e){
        var id = e.getAttribute('data-id');
         $.ajax({
            url:"ajax/ajax_action.php",
            method:"POST",
            data:{
                action:'set_default',
                bank_details_id: id
            },
            dataType:"json",
            beforeSend: function() {
                    $("#button-make-default-"+id).html(' <button class="btn btn-sm btn-outline-warning mt-3" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
            success:function(data){	
                location.reload();                                                                        
            }
        })
    }

   
   </script>