
<script>
    $(document).ready(function(){	
        var dataRecords = $('#invoice_data').DataTable({
                 "processing": "<span class='fa-stack fa-lg'>\n\
                            <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
                       </span>&emsp;Processing ...",
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    // data:{action:'data_role'},
                    data:{action:'datainvoice'},
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
    }); 
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
</script>
    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Invoice Details</h3>
                                <a href="html/?action=record_invoice" class="btn btn-primary"><em class="icon ni ni-file-download"></em>Download all invoice</a>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <!-- Data Table -->
                    <div class="nk-block nk-block-lg">  
                    
                            <div class="card card-bordered card-preview">
                                <div class="card-inner">
                                    <table class="nk-tb-list nk-tb-ulist  nowrap table" id="invoice_data" data-auto-responsive="false">
                                    <thead>
                                            <tr>
                                                <th><input type="checkbox" class="custom-control-input" id="customCheck1"></th>
                                                <th>Ticket</th>
                                                <!-- <th>Ticket Description</th>					
                                                <th>Word Count</th>
                                                <th>Total Amount</th>					 -->
                                                <th>Date</th>
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