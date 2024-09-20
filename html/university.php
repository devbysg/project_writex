<?php
// $country_desc = select_all("country_cost_master");
// $cat_desc = select_query("category_master",array("category_id","category_name"),array());

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
                                <h3 class="nk-block-title page-title">University</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <a  data-target="" onclick="addnewuniv(this);" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                <a  data-target="" onclick="addnewuniv(this);" id="addUnivRecords" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add University</span></a>
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
                                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="university_data" data-auto-responsive="false">
                                                <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Name</th>			
                                                            <th>Action</th>
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
        <div class="modal fade" tabindex="-1" role="dialog" id="recordUnivModal">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                        <div class="modal-body modal-body-md">
                            <h4 class="title">Add New University</h4>
                            <hr>
                            <div class="row g-3">
                                        <form  id="recordUnivForm" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="action" value="addUnivRecord" id="action">
                                            <input type="hidden" class="form-control" id="university_id" name="university_id">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="UniversityName">University Name</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="university_name" name="university_name" placeholder="University Name">
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
    <!-- Edit University Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="UnivUpdate">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md text-center3">
                    <h4 class="title ">Edit University</h4>
                    <hr>
                    <form action="" id="UnivUpdateForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="" class="modaction" id="edit_univ_data">
                        <input type="hidden" class="form-control" id="edit_univ_id" name="edit_univ_id">
                        <div class="form-group row col-md-12">
                            <div class=" col-md-6 ">
                                <label class="form-label " for="Asigned">Edit Name</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class=""></em>
                                    </div> 
                                    <input type="text" class="form-control" name="name_univ" id="get_univ_name" >
                                </div>
                            </div>
                        <div class="col-md-12 mt-3 ">
                            <button type="submit" id="button-edit-university" class="btn btn-primary"><em class="icon ni ni-pen-alt-fill"></em><span>Edit</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Payment Modal Ends -->
<script>
    function addnewuniv(e){
            $("#recordUnivModal").trigger( "reset" );               
            $('#recordUnivModal').modal('show');
        }
        $('#addUnivRecords').click(function(){
            $('#univ_modal_header').html("<i class='fa fa-plus'></i> New Ticket");
            $('#action').val('addUnivRecord');
	    });
        $("#recordUnivModal").on('submit','#recordUnivForm', function(event){ 
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
                $("#button-add").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>');
                $('#recordTargetModal').modal('toggle');
                datatable(); 
                   
                }
            })
        });

        $(document).ready(function(){	
            datatable();
        });  
        function datatable(){ 
            if ( $.fn.DataTable.isDataTable('#university_data') ) {
                $('#university_data').DataTable().destroy();
                }

                $('#university_data tbody').empty();
            var dataRecords = $('#university_data').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    // data:{action:'data_role'},
                    data:{action:'data_university'},
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
        // University Table Edit Modal
        function edit_univ(e){
            var id = $(e).data("id");
            // alert(id);
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{action:"get_univ_desc",univ_id: id},
                dataType:"JSON",
                beforeSend: function() {
                    $("#button-add-patment").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){
                    $("#UnivUpdate").trigger( "reset" );               
                    $('#UnivUpdate').modal('show'); 
                    $('#get_univ_name').val(data.data[0]['university_name']);
                    $('#edit_univ_data').val('updateUniversity');
                    $('#edit_univ_id').val(id);
                }
            })
        }
    // University Name Update Submit Button
    $("#UnivUpdate").on('submit','#UnivUpdateForm', function(event){ 
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
            $("#button-edit-university").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
        },
        success:function(data){	
            $("#button-edit-university").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-pen-alt-fill"></em><span>Edit</span></button>');
            $('#UnivUpdate').modal('toggle');
            datatable();
        }
    })
});
    </script>