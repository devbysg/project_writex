    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Monthly Target</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <a  data-target="" onclick="addnewtarget(this);" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                <a  data-target="" onclick="addnewtarget(this);" id="addTargetRecords" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Target</span></a>
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
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="target_data" data-auto-responsive="false">
                                                <thead>
                                                        <tr>
                                                            <th>Year</th>
                                                            <th>Month</th>			
                                                            <th>Monthly</th>
                                                            <th>Daily</th>
                                                        </tr>
                                                </thead>
                                                    
                                                </table>
                                            </div>
                                        </div><!-- .card-preview -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
        <!-- Add University Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="recordTargetModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                        <div class="modal-body modal-body-md">
                            <h4 class="title">Add New Target</h4>
                            <hr>
                            <div class="row g-3">
                                <form  id="recordTargetForm" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="action" value="addTargetRecord" id="action">
                                    <input type="hidden" class="form-control" id="target_id" name="target_id">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="UniversityName">Year</label>
                                            <div class="form-control-wrap">
                                                <input type="number" class="form-control" id="year" name="year" placeholder="" value="<?php echo date("Y");?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Month">Select Month</label>
                                            <br>
                                            <select class="form-select university" name="monthly" id="monthly">
                                            <option value="">Select</option>
                                            <option value="Jan">January</option>
                                            <option value="Feb">February</option>
                                            <option value="Mar">March</option>
                                            <option value="Apr">April</option>
                                            <option value="May">May</option>
                                            <option value="Jun">Jun</option>
                                            <option value="Jul">July</option>
                                            <option value="Aug">August</option>
                                            <option value="Sep">September</option>
                                            <option value="Oct">October</option>
                                            <option value="Nov">November</option>
                                            <option value="Dec">December</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Monthly">Monthly</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="get_monthly" name="get_monthly" placeholder="Give Monthly Target">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Daily">Daily</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" id="get_daly" name="get_daly" placeholder="Give Daily Target">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-4" id="button-add">
                                        <button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                                    </div>
                                </form>            
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <!-- Add Ticket Modal Ends-->

<script>
    function addnewtarget(e){
            // alert("ho");
            $("#recordTargetModal").trigger( "reset" );               
            $('#recordTargetModal').modal('show');
        }
        $('#addTargetRecords').click(function(){
            $('#univ_modal_header').html("<i class='fa fa-plus'></i> New Ticket");
            $('#action').val('addTargetRecord');
	    });
        $("#recordTargetModal").on('submit','#recordTargetForm', function(event){ 
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
                    $("#button-add").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
                    $("#button-add").html('  <button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>');
                //    location.reload();
                $('#recordTargetModal').modal('toggle');
                datatable();                   
                }
            })
        });

        $(document).ready(function(){	
            datatable();
        });  
        function datatable(){ 
            // alert("nnn");
            if ( $.fn.DataTable.isDataTable('#target_data') ) {
                $('#target_data').DataTable().destroy();
                }

                $('#target_data tbody').empty();
            var dataRecords = $('#target_data').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    // data:{action:'data_role'},
                    data:{action:'data_target'},
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
    </script>