<?php
include('layout/header.php');
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
                                <h3 class="nk-block-title page-title">Role List</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <!-- <li>
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-search"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="default-04" placeholder="Quick search by id">
                                                </div>
                                            </li> -->
                                            <li>
                                                <!-- <div class="drodown">
                                                    <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-bs-toggle="dropdown">Status</a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>New Items</span></a></li>
                                                            <li><a href="#"><span>Featured</span></a></li>
                                                            <li><a href="#"><span>Out of Stock</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div> -->
                                            </li>
                                            <li class="nk-block-tools-opt">
                                                <a href="#" class="toggle btn btn-icon btn-primary d-md-none"><i class="icon ni ni-share" style="color:white"></i></a>
                                                <a href="#" class="toggle btn btn-primary d-none d-md-inline-flex"><i class="icon ni ni-share" style="color:white"></i></em></a>
                                            </li>
                                            <li class="nk-block-tools-opt">
                                                <a href="#" data-target="addRole" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                <a href="#" data-target="addRole" id="addRoles" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Role</span></a>
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
                                                <table class="datatable-init nk-tb-list nk-tb-ulist datatable-init-export nowrap table" id="role_data" data-auto-responsive="false">
                                                <thead>
                                                        <tr>
                                                            <th><input type="checkbox" class="custom-control-input" id="emp_data"></th>
                                                            <th>Role ID</th>
                                                            <th>Role Name</th>					
                                                            <th>Role Desc</th>
                                                            <th>Page Rights</th>					
                                                            <th>Action</th>	
                                                        </tr>
                                                    </thead>
                                                    
                                                </table>
                                            </div>
                                        </div><!-- .card-preview -->
                                    </div>
                    </div><!-- .nk-block -->
                    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addRole" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                        <!-- Modal -->
                        <div class="nk-block" id="recordModal">
                            <div class="row g-3">
                            <form action="" id="insert_role" method="POST" enctype="multipart/form-data">
                                            <div class="row g-3">
                                                <!-- Pass this hidden tag to prevent error form submit -->
                                            <input type="hidden" name="action" value="" id="action">
                                            <input type="hidden" class="form-control" id="role_id" name="role_id">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="product-title">Role Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" name="name" id="product-title">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="regular-price">Access</label>
                                                        
                                                    </div>
                                                    <div class="card card-bordered card-preview col-md-12">
                                                    <div class="card-inner">
                                                        <div id="drag-drop-tree" class="jstree jstree-4 jstree-default" role="tree" aria-multiselectable="true" tabindex="0" aria-activedescendant="j4_1" aria-busy="false">
                                                            <ul class="jstree-container-ul jstree-children" role="group">
                                                                <li name="ticket" role="none" id="j4_1" class="jstree-node jstree-open"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="1" aria-expanded="true" id="j4_1_anchor" style="touch-action: none;"><i class="jstree-icon jstree-themeicon" role="presentation"></i> Ticket </a>
                                                                    <ul
                                                                        role="group" class="jstree-children" style="">
                                                                        <li role="none" name="add" id="j4_2" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor jstree-clicked" href="#" tabindex="-1" role="treeitem" aria-selected="true" aria-level="2" id="j4_2_anchor"><i class="jstree-icon jstree-themeicon" role="presentation"></i> Add </a></li>
                                                                        <li
                                                                            role="none" name="edit" data-jstree="{ &quot;selected&quot; : true }" id="j4_3" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="2" id="j4_3_anchor"><i class="jstree-icon jstree-themeicon" role="presentation"></i> Edit </a></li>
                                                                
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                            <ul class="jstree-container-ul jstree-children" role="group">
                                                                <li name="ticket" role="none" id="j4_1" class="jstree-node jstree-open"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="1" aria-expanded="true" id="j4_1_anchor" style="touch-action: none;"><i class="jstree-icon jstree-themeicon" role="presentation"></i> Invoice </a>
                                                                    <ul
                                                                        role="group" class="jstree-children" style="">
                                                                        <li role="none" name="add" id="j4_2" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor jstree-clicked" href="#" tabindex="-1" role="treeitem" aria-selected="true" aria-level="2" id="j4_2_anchor"><i class="jstree-icon jstree-themeicon" role="presentation"></i> Add </a></li>
                                                                        <li
                                                                            role="none" name="edit" data-jstree="{ &quot;selected&quot; : true }" id="j4_3" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="2" id="j4_3_anchor"><i class="jstree-icon jstree-themeicon" role="presentation"></i> Edit </a></li>
                                                                
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                            <ul class="jstree-container-ul jstree-children" role="group">
                                                                <li name="ticket" role="none" id="j4_1" class="jstree-node jstree-open"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="1" aria-expanded="true" id="j4_1_anchor" style="touch-action: none;"><i class="jstree-icon jstree-themeicon" role="presentation"></i> Payment </a>
                                                                    <ul
                                                                        role="group" class="jstree-children" style="">
                                                                        <li role="none" name="add" id="j4_2" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor jstree-clicked" href="#" tabindex="-1" role="treeitem" aria-selected="true" aria-level="2" id="j4_2_anchor"><i class="jstree-icon jstree-themeicon" role="presentation"></i> Add </a></li>
                                                                        <li
                                                                            role="none" name="edit" data-jstree="{ &quot;selected&quot; : true }" id="j4_3" class="jstree-node  jstree-leaf"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="#" tabindex="-1" role="treeitem" aria-selected="false" aria-level="2" id="j4_3_anchor"><i class="jstree-icon jstree-themeicon" role="presentation"></i> Edit </a></li>
                                                                
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                            
                                                        </div>

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
    <div class="modal fade" tabindex="-1" role="dialog" id="modalTabs">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Update Profile</h4>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Tab Title</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Another Title</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabItem1">
                            <h6 class="title">Tab Title</h6>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro numquam distinctio ab cupiditate veniam a aperiam architecto perspiciatis quidem provident!</p>
                            <p><strong>Debitis ullam impedit</strong>, dolore architecto porro doloremque eum magni dolorum.</p>
                        </div>
                        <div class="tab-pane" id="tabItem2">
                            <h6 class="title">Another Title</h6>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro numquam distinctio ab cupiditate veniam a aperiam architecto perspiciatis quidem provident!</p>
                            <p><strong>Debitis ullam impedit</strong>, dolore architecto porro doloremque eum magni dolorum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
        $(document).ready(function(){	
            datatable();
        });  
        function datatable(){ 
            // alert("nnn");
            var dataRecords = $('#role_data').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    // data:{action:'data_role'},
                    data:{action:'datarole'},
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
        $('#addRoles').click(function(){
            $('#ticket_modal_header').html("<i class='fa fa-plus'></i> New Employee");
            $('#action').val('addRole');
	    });
        $("#recordModal").on('submit','#insert_role', function(event){ 
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
                    // alert("hii");
                    $("#button-add").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
                    // alert("There");		
                    $('#insert_emp')[0].reset();
                    $(".nk-add-product").removeClass("content-active");
                    $("body").removeClass("toggle-shown");
                    $("#button-add").html('<button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>');
                    location.reload();
                    $('#save').attr('disabled', false);
                   datatable();
                }
            })
            // alert("okay");
        }); 
    </script>
<?php
include('layout/footer.php');
?>