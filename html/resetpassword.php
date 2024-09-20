
<?php
// session_start();
// print_r($_SESSION);die("mmm");
// include('layout/header.php');
include_once('../html/constant.php');

// include_once '../function/functions.php';

if($_POST){
    if($_POST['new_passoword'] == $_POST['confirm_new_passoword']){
       
        if(!empty($_POST['old_passoword']) && !empty($_SESSION['emp_id'])){
	        $check_old_password = select_query("employees_master",array("password"),array("emp_id" => $_SESSION['emp_id']));
            
            if($check_old_password[0]['password'] == md5($_POST['old_passoword'])){
                $password = $_POST['password'];
                execute_update('employees_master',array('password' => md5($password )),array('emp_id' => $_SESSION['emp_id']));
                echo "<script>window.location.href='resetpassword.php?status='success'';</script>";
                exit;
            }else{
                echo '<script type="text/javascript">toastr.error("Old Password Does Not Matched")</script>';
            }
        }
        
    }else{

        echo '<script type="text/javascript">toastr.error("Password And Confirm Password Does Not Matched")</script>';
    }
}
if(isset($_GET['status']))
{
   if($_GET['status'] == 'success'){
      echo '<script type="text/javascript">toastr.success("Password Successfully Changed")</script>';
  }
}

?>
<div class="nk-content ">
   <div class="container-fluid">
      <div class="nk-content-inner">
         <div class="nk-content-body">
            <div class="components-preview wide-md mx-auto">
               
               <div class="nk-block nk-block-lg">
                  
                  <div class="card">
                     <div class="card-inner">
                        <div class="card-head">
                           <h5 class="card-title">Change Password</h5>
                        </div>
                        <!-- <form  method="POST"> -->
                           <div class="row g-4">
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="form-label" for="full-name-1">Old Password</label>
                                    <div class="form-control-wrap"><input type="password" class="form-control" name="old_passoword" id="old_passoword"></div>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="form-label" for="email-address-1">New Password</label>
                                    <div class="form-control-wrap"><input type="password" class="form-control" name="new_passoword" id="new_passoword"></div>
                                 </div>
                              </div>
                              <div class="col-lg-12">
                                 <div class="form-group">
                                    <label class="form-label" for="phone-no-1">Confirm New Password</label>
                                    <div class="form-control-wrap"><input type="password" class="form-control" name="confirm_new_passoword" id="confirm_new_passoword"></div>
                                 </div>
                              </div>
                            
                              <div class="col-12">
                                 <div class="form-group"><button onclick="test();" type="button" class="btn btn-lg btn-primary">Save Informations</button></div>
                              </div>
                           </div>
                        <!-- </form> -->
                     </div>
                  </div>
               </div>
              
            </div>
         </div>
      </div>
   </div>
</div>
<script>
    function test(){
        alert("m");
        var confirm_new_passoword = $('#confirm_new_passoword').val();
        var new_passoword = $('#new_passoword').val();
        var old_passoword = $('#old_passoword').val();
        $.ajax({
            url:"ajax/ajax_action.php",    //the page containing php script
            method: "POST",    //+request type,
            dataType: 'json',
            data: { function_name: "change_password", confirm_new_passoword: confirm_new_passoword,new_passoword:new_passoword,old_passoword:old_passoword},
            success:function(result){
                if(result.status == 'error'){
                    toastr.error('Sorry, wrong otp'); 
                }else{
                    location.replace("html/index.php");
                   // $('#submit_div').prop('disabled', false);
                }
            }
        }); 
    }
    </script>