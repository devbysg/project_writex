    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Category List</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <a href="#" data-target="addCategory" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                <a href="#" data-target="addCategory" id="addCategories" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Category</span></a>
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
                                                <table class="nk-tb-list nk-tb-ulist nowrap table" id="category_listing" data-auto-responsive="false">
                                                <thead>
                                                        <tr>
                                                            <!-- <th><input type="checkbox" class="custom-control-input" id="emp_data"></th> -->
                                                            <th>Catergory ID</th>
                                                            <th>Catergory Name</th>
                                                            <th>Catergory Description</th>										
                                                            <th>Action</th>	
                                                        </tr>
                                                    </thead>
                                                    
                                                </table>
                                            </div>
                                        </div><!-- .card-preview -->
                                    </div>
                    </div><!-- .nk-block -->
                    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addCategory" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                        <!-- Modal -->
                        <div class="nk-block" id="recordModal">
                            <div class="row g-3">
                                <!-- Category Table Form -->
                                <form action="" id="insert_category" method="POST">
                                    <div class="row g-3">
                                        <!-- Pass this hidden tag to prevent error form submit -->
                                        <input type="hidden" name="action" value="addCategory" class="modaction" id="modaction">
                                        <input type="hidden" class="form-control" id="category_id" name="category_id">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Name">Category Name</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="name" id="stock">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Ticket">Category Description</label>
                                                <div class="form-control-wrap">
                                                    <!-- <input type="text" class="form-control" id="product-title"> -->
                                                    
                                                    <textarea class="form-control no-resize" rows = "5" cols = "41" name = "description"></textarea>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- Modal End -->
                        </div><!-- .nk-block -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modcategory">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Update category</h4>
                    <form action="" id="updatecategory" method="POST">
                        <div class="row g-3">
                            <!-- Pass this hidden tag to prevent error form submit -->
                            <input type="hidden" name="action" value="" class="modaction" id="modaction">
                            <input type="hidden" class="form-control" id="modcategory_id" name="modcategory_id">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="Name">Category Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="modcategoryname" id="modcategoryname">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="Ticket">Category Description</label>
                                    <div class="form-control-wrap">
                                        <!-- <input type="text" class="form-control" id="product-title"> -->
                                        
                                        <textarea class="form-control no-resize" rows = "5" cols = "41" id="moddescription" name = "moddescription"></textarea>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" id="button-edit">
                                <button class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Edit</span></button>
                            </div>
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
            var dataRecords = $('#category_listing').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    // data:{action:'data_role'},
                    data:{action:'list_category'},
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
        $('#addCategories').click(function(){
            $('#ticket_modal_header').html("<i class='fa fa-plus'></i> New Employee");
            $('#action').val('addCategory');
	    });
        $("#recordModal").on('submit','#insert_category', function(event){ 
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
                    location.reload();
                }
            })
        }); 
        function category(e){
            var id=$(e).data("id");
           
            $.ajax({
                url: "ajax/ajax_action.php",
                method: "POST",
                data:{action: 'get_category',
                        data_id: id},
                    dataType: "json",
                    success: function(data){
                        $('#modcategory').modal('show'); 
                        $('#modcategoryname').val(data.data[0]['category_name']);
                        $('#moddescription').val(data.data[0]['category_description']);
                        $('.modaction').val('updatecategory');
                        $('#modcategory_id').val(id);
                    }
            });

        }
        $('#editcat').click(function(){
            $('#ticket_modal_header').html("<i class='fa fa-plus'></i> Edit");
            $('#modaction').val('updatecategory');
        })
        $("#modcategory").on('submit','#updatecategory', function(event){ 
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
    </script>