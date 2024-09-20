
    <!-- main header @e -->
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Employee List</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">
                                                <a href="#" data-target="addEmp" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                <a href="#" data-target="addEmp" id="addEmps" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Employee</span></a>
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
                                <table class="nk-tb-list nk-tb-ulist  nowrap table" id="emp_check_val" data-auto-responsive="false">
                                <thead>
                                        <tr>
                                            <th>Employee Details</th>
                                            <th>Role</th>
                                            <th>Action</th>	
                                        </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div>
                    </div><!-- .nk-block -->
                    <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addEmp" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                        <!-- Modal -->
                        <div class="nk-block" id="recordModal">
                            <div class="row g-3">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">New employee</h5>
                                            <div class="nk-block-des">
                                                <p>Add information and add new employee.</p>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                    <form action="" id="insert_emp" method="POST" enctype="multipart/form-data">
                                            <div class="row g-3">
                                            <input type="hidden" name="action" value="" id="action">
                                            <input type="hidden" class="form-control" id="emp_id" name="emp_id">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="employee-name">Employee Name</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control" name="name" id="name_emp">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="email-id">Email ID</label>
                                                        <div class="form-control-wrap">
                                                            <input type="email" class="form-control" onblur ="check_dup()" name="email_emp" id="id_email">
                                                            <span id="dup_alert"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="phone-number">Phone Number</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" class="form-control" name="phone_number" id="regular-price">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Role">Employee Role</label>
                                                        <br>
                                                        
                                                        <select name="emp_role" class="form-control" id="role_emp_id">
                                                            <option value="">Choose...</option>
                                                            <?php foreach($Role as $key => $val){ ?>
                                                                <option value="<?php echo $key;?>"><?php echo $val;?></option>
                                                            <?php }?>    
                                                        </select>
                                                        <!-- </div> -->
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12">
                                                <div>
                                                    <label class="form-label" for="file">Select Image to upload:</label>
                                                    <input type="file" class="form-control" id="image" name="employee_image" >
                                                </div>
                                                 <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Role">Assign Manager</label>
                                                      
                                                        <br>
                                                        <select class="drop2" name="maneger_id" id="role_assign">
                                                            <option value="">Choose...</option>
                                                        </select>
                                                        <!-- </div> -->
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit" id="button-add-employee" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
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
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Content Code -->

        <!-- Edit Employee Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="EditUpdate">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md text-center3">
                        <h4 class="title ">Edit Employees Details</h4>
                        <hr>
                        <form action="" id="EditUpdateForm" method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <input type="hidden" name="action" value="" id="editModal">
                                <input type="hidden" class="form-control" id="edit_emp_id" name="emp_id">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="employee-name">Employee Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="name" id="name_emp_edit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="sale-price">Email ID</label>
                                            <div class="form-control-wrap">
                                                <input type="email" class="form-control" name="email" id="email_emp_edit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="regular-price">Phone Number</label>
                                            <div class="form-control-wrap">
                                                <input type="number" class="form-control" name="phone_number" id="phone_emp_edit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="Role">Employee Role</label>
                                            <br>
                                            <select name="emp_role" class="form-control" id="role_emp_edit_id">
                                                <option value="">Choose...</option>
                                                <?php foreach($Role as $key => $val){ ?>
                                                    <option value="<?php echo $key;?>"><?php echo $val;?></option>
                                                <?php }?>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label" for="manager-role">Manager Name</label>
                                            <br>
                                            <select name="emp_role_manager" class="form-control" id="role_manager_edit_id">
                                                <option value="">Choose...</option>   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12" id="button-edit-emp">
                                        <button type="submit" id="button-edit-employee" class="btn btn-primary"><em class="icon ni ni-edit"></em><span>Edit</span></button>
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
            if ( $.fn.DataTable.isDataTable('#emp_check_val') ) {
                $('#emp_check_val').DataTable().destroy();
                }

                $('#emp_check_val tbody').empty();
            var dataRecords = $('#emp_check_val').DataTable({
                "lengthChange": true,
                "processing": true,
                "order":[],
                "ajax":{
                    url:"ajax/ajax_action.php",
                    type:"POST",
                    data:{action:'listEmp'},
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
        $('#addEmps').click(function(){
            $('#ticket_modal_header').html("<i class='fa fa-plus'></i> New Employee");
            $('#action').val('addEmp');
	    });
        $("#recordModal").on('submit','#insert_emp', function(event){ 
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
                    $("#button-add-employee").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){		
               
                     location.reload();
                    // $("#button-add-employee").html('<button type="submit" id="button-add-employee" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>');
                    // $('#recordModal').modal('toggle');

                   
                }
            })
         
        }); 
        $('#role_emp_id').on('change', function() {
            $.ajax({
                url:"ajax/ajax_action.php",
                method:"POST",
                data:{"role": this.value,"action": "assigned_maneger_list"},
                dataType:"JSON",
                beforeSend: function() {
                  //  $("#button-add-employee").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                    var options_str = "";
                    $.each(data.data, function (key, val) {
                        options_str += '<option value="' + val.emp_id + '">' + val.emp_name + '</option>';
                    });
                    $('#role_assign').html(options_str);
                    //location.reload();
                   
                }
            })
        });

            $('#id_email').on('change', function() {
            var email = $('#id_email').val();
                    $.ajax({
                        url:"ajax/ajax_action.php",    //the page containing php script
                        method: "POST",    //+request type,
                        dataType: 'json',
                        data: {action:'check_dupicacy', customer_email: email},
                        success:function(result){
                            if(result.status == 'error'){
                            $("#dup_alert").html("Sorry, This Email is already registered. Please add another one").css("color", "red");
                            $('input[name=email_emp').val('');
                            }
                        }
                    });
            });

        function edit_employee(el){
            var emp_id = $(el).data('id');
            $.ajax({
                url: "ajax/ajax_action.php",
                method: "POST",
                data:{action: 'getEmployeeDetails',
                    data_id: emp_id},
                dataType: "json",
                success: function(data){
                    $("#EditUpdate").trigger( "reset" );               
                    $('#EditUpdate').modal('show'); 
                    $('#edit_emp_id').val(data.data1[0]['emp_id']);
                    $('#name_emp_edit').val(data.data1[0]['emp_name']);
                    $('#email_emp_edit').val(data.data1[0]['emp_email']);
                    $('#phone_emp_edit').val(data.data1[0]['emp_phone_no']);
                    $('#role_emp_edit_id').val(data.data1[0]['emp_role']);
                    var options_str2 = "";
                    $.each(data.data2, function (key, val) {
                        if(val.emp_id == data.data1[0]['manager_id']){
                            var text = "selected";
                        }
                        options_str2 += '<option '+ text +' value="' + val.emp_id + '">' + val.emp_name + '</option>';
                    });
                    $('#role_manager_edit_id').html(options_str2);
                    $('#editModal').val('updateEmp');
                }
                
            });
        }
    // Add Employee Details Update Submit Button
    $("#EditUpdate").on('submit','#EditUpdateForm', function(event){ 
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
            $("#button-edit-emp").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
        },
        success:function(data){	
            $("#button-edit-emp").html('<button type="submit" id="button-edit-employee" class="btn btn-primary"><em class="icon ni ni-edit"></em><span>Edit</span></button>');
            $('#EditUpdate').modal('toggle');
            datatable();
        }
    })
});
// Make Disable User ID
function disable_id(el){
            var emp_id = $(el).data('id');
            $.ajax({
                url: "ajax/ajax_action.php",
                method: "POST",
                data:{action: 'getDisableId',
                    data_id: emp_id},
                dataType: "json",
                success: function(data){
                    alert("Id Disabled");
                    datatable();
                }
                
            });
}

// Make Disable User ID
function enable_id(el){
            var emp_id = $(el).data('id');
            $.ajax({
                url: "ajax/ajax_action.php",
                method: "POST",
                data:{action: 'getEnableId',
                    data_id: emp_id},
                dataType: "json",
                success: function(data){
                    alert("Id Enabled");
                    datatable();
                }
                
            });
}
</script>