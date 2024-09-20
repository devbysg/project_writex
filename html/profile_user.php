<?php
$get_data_user = select_query("employees_master",array('emp_name', 'emp_email', 'emp_phone_no', 'user_dob', 'user_address1', 'user_address2', 'user_state', 'user_pincode'),array('emp_id' => $_SESSION['emp_id']));
?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head nk-block-head-lg">
                                    <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                        <div class="user-card">
                                            <div class="user-avatar">
                                                <span>WX</span>
                                            </div>
                                            <div class="user-info">
                                                <span class="lead-text" style="font-size:18px"><?php echo $get_data_user[0]['emp_name'] ?></span>
                                                <span class="sub-text" style="font-size:18px"><?php echo $get_data_user[0]['emp_email'] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">Personal Information</h4>
                                        </div>
                                        <div class="nk-block-head-content align-self-start d-lg-none">
                                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="nk-data data-list">
                                        <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit" class="EditProfile" onclick="editDetails();" >
                                            <div class="data-col">
                                                <span class="data-label">Full Name</span>
                                                <span class="data-value"><?php echo $get_data_user[0]['emp_name'] ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div><!-- data-item -->
                                        <div class="data-item">
                                            <div class="data-col">
                                                <span class="data-label">Email</span>
                                                <span class="data-value"><?php echo $get_data_user[0]['emp_email'] ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                        </div><!-- data-item -->
                                        <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit" class="EditProfile" onclick="editDetails();">
                                            <div class="data-col">
                                                <span class="data-label">Phone Number</span>
                                                <span class="data-value text-soft"><?php echo $get_data_user[0]['emp_phone_no'] ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div><!-- data-item -->
                                        <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit" class="EditProfile" onclick="editDetails();">
                                            <div class="data-col">
                                                <span class="data-label">Date of Birth</span>
                                                <span class="data-value"><?php echo $get_data_user[0]['user_dob'] ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div><!-- data-item -->
                                        <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit" data-tab-target="#address" class="EditProfile" onclick="editDetails();">
                                            <div class="data-col">
                                                <span class="data-label">Address</span>
                                                <span class="data-value"><?php echo $get_data_user[0]['user_address1'] . ", " . $get_data_user[0]['user_address2'] . ", " . $get_data_user[0]['user_state'] . "- " . $get_data_user[0]['user_pincode'] ?></span>
                                            </div>
                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                        </div><!-- data-item -->
                                    </div><!-- data-list -->
                                </div><!-- .nk-block -->
                            </div>
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" id="EditInfo" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Update Profile</h4>
                    <div class="tab-content">
                        <div class="tab-pane active" id="personal">
                            <div class="row gy-4">
                                <form action="" id="EditFormPersonal" method="POST">
                                <input type="hidden" name="action" value="EditProfile" id="EditProfileId">
                                <div class="form-group row col-md-12 my-3">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="full-name">Full Name</label>
                                                    <input type="text" class="form-control form-control-lg" id="name_emp" placeholder="Enter Full name" name="name_user">
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="phone-no">Phone Number</label>
                                                    <input type="text" class="form-control form-control-lg" id="phone_emp" placeholder="Phone Number" name="ph_user">
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-12">
                                            <div class="form-group">
                                                <label class="form-label" for="birth-day">Date of Birth</label>
                                                <input type="text" class="form-control form-control-lg date-picker" id="birth-day" placeholder="Enter your birth date" name="dob_user">
                                            </div>
                                    </div>

                                    <div class="form-group row col-md-12 my-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="address-l1">Address Line 1</label>
                                                <input type="text" class="form-control form-control-lg" id="l1_address" name="name_l1_address"  placeholder="Enter Address Line 1" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="address-l2">Address Line 2</label>
                                                <input type="text" class="form-control form-control-lg" id="l2_address" name="name_l2_address"  placeholder="Enter Address Line 2" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="address-st">State</label>
                                                <input type="text" class="form-control form-control-lg" id="st_address" name="name_st_address"  placeholder="Enter State" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="address-county">Pin Code</label>
                                                <input type="number" class="form-control form-control-lg" id="pin_address" minlength="8" name="name_pin_address" placeholder="Enter Pin Code" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 my-2">
                                        <div class="col-12 mt-4" id="button-add-new">
                                            <button type="submit" class="btn btn-lg btn-primary"><em class="icon ni ni-edit"></em><span>Update Profile</span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- .tab-pane -->
                    </div><!-- .tab-content -->
                </div>
            </div>
        </div>
    </div>
    
<script>
function editDetails(){
    var session_id = '<?php echo $_SESSION['emp_id'];?>';
            $.ajax({
                    url: "ajax/ajax_action.php",
                    method: "POST",
                    data:{data: session_id, action: 'getUserDetails'},
                    dataType: "json",
                    success: function(data){
                        $('#name_emp').val(data.data[0]['emp_name']);
                        $('#phone_emp').val(data.data[0]['emp_phone_no']);    
                        $('#birth-day').val(data.data[0]['user_dob']);                       
                        $('#l1_address').val(data.data[0]['user_address1']);                       
                        $('#l2_address').val(data.data[0]['user_address2']);                       
                        $('#st_address').val(data.data[0]['user_state']);                       
                        $('#pin_address').val(data.data[0]['user_pincode']);                                          
                        $('#EditInfo').modal('show');
                    }
                });

    }
    $("#EditInfo").on('submit','#EditFormPersonal', function(event){ 
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
                    $("#button-add-new").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
                },
                success:function(data){	
                    location.reload();
                }
            })
        });
    </script>