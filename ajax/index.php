<?php 
include('../function/functions.php');
include '../function/SessionHandlerV2.php';
include_once '../phpmailer/PHPMailerAutoload.php';
// print_r($_POST);
$func = $_POST['function_name'];
// print_r($func);

if($func ==  'check_email_exist'){
    $mail = $_POST['email'];
    // print_r ($mail);
    // die;
    if(!empty($mail)){

        $table_name =  "employees_master" ;
        $email_check = select_query("employees_master", array ("emp_id"),array("emp_email"=>"$mail"));
        //print_r( $email_check);die();
        if(empty($email_check)){
            echo json_encode(array("response"=>'Email id not registered', "status" => 'error'));
        }else{
            echo json_encode(array("response"=>'Email id  registered with us', "status" => 'success'));
        }
    }
}

if($func ==  'submit_data'){
    $mail = $_POST['email'];
    $table_name =  "employees_master" ;
    $pass = md5($_POST['password']);
    if(!empty($mail)){
        $query_check = select_query($table_name, array ("emp_id", "emp_name", "emp_email", "emp_role"),array("emp_email"=>"$mail", "password"=>"$pass"));
        if(empty($query_check)){
            // echo json_encode(array("response"=>'Email id not registered', "status" => 'error'));
            echo json_encode(array("response"=>'Invalid Credencial', "status" => 'error'));
        }else{
            SessionHandlerV2::start();
            // $_SESSION['name'] = $query_check[0]['admin_name'];
            // $_SESSION['con_no'] = $query_check[0]['admin_pno'];
            // $_SESSION['email'] = $query_check[0]['admin_email'];
            SessionHandlerV2::set('is_login', 'y');
            SessionHandlerV2::set('emp_role', $query_check[0]['emp_role']);
			SessionHandlerV2::set('emp_email', $query_check[0]['emp_email']);
			SessionHandlerV2::set('emp_id', $query_check[0]['emp_id']);
			SessionHandlerV2::set('emp_name', $query_check[0]['emp_name']);
          // print_r( $_SESSION);die();
            echo json_encode(array("response"=>'Logged in Successfully', "status" => 'success'));
        }
    }
}

$func_mail = $_POST['get_mail'];


if($func_mail ==  'is_email_exist'){
    // print_r($_POST);
    $verify_mail = $_POST['get_email'];
    // print_r ($get_mail);
    // die;
    if(!empty($verify_mail)){

        $table_name =  "employees_master" ;
        $email_check = select_query("employees_master", array ("emp_id"),array("emp_email"=>"$verify_mail"));
       
        //print_r( $email_check);die();
        if(empty($email_check)){
            echo json_encode(array("response"=>'Email id not registered', "status" => 'error'));
        }else{
            echo json_encode(array("response"=>'Email id  registered with us', "status" => 'success'));
            // $_POST['otp'] = rand(100000,999999);
            // // print_r($_POST);
            // $template_details = select_query("template_master",array('template_subject','template_body'),array('template_type' => 'create_ticket'));
            // $email_body = prepare_mail_msg( $template_details[0]['template_body'],$datas);
            // $email_subject = 'Your OTP is:'.$_POST['otp'].'';
            // send_mail_attachment($verify_mail,$email_subject,$email_body,$path);
        }
    }
}

//$send_otp = $_POST['otp_validation'];
// print_r($_POST);
// print_r($func);

if($_POST['function_name'] ==  'send_otp_validation'){
    //print_r($_POST);
    $verify_mail = $_POST['get_email'];

    $otp = rand(100000,999999);
    // print_r($_POST);
    
    $template_details = select_query("template_master",array('template_subject','template_body'),array('template_type' => 'change_password'));
     //print_r($template_details[0]['template_body']);
    //$datas = array();
    SessionHandlerV2::start();
    SessionHandlerV2::set('otp', $otp);
	$datas['otp'] = $otp;
    $email_subject = $template_details[0]['template_subject'];
    $email_body = prepare_mail_msg($template_details[0]['template_body'],$datas);
    //print_r($email_body);die();
    send_mail_attachment($verify_mail,$email_subject,$email_body,$abc= null);
   // send_mail_attachment($verify_mail, $email_subject);
    echo json_encode(array("response"=>'Otp Send Successfully', "status" => 'success'));
}


if($_POST['function_name'] ==  'otp_validation'){
    $otp = $_POST['otp'];
    session_start();
    if($_SESSION['otp'] ==  $otp){
        echo json_encode(array("response"=>'Otp Validated', "status" => 'success'));
    }else{
        echo json_encode(array("response"=>'Otp Not Matched', "status" => 'error'));
    }
    
}
if($_POST['function_name'] ==  'change_password'){
    // $password = $_POST['password'];print_r($password);die();
    // execute_update('employees_master',array('password' => md5($password )),array('emp_email' => $_POST['email']));
    // echo json_encode(array("response"=>'password updated', "status" => 'success'));

    if($_POST){
        if($_POST['new_passoword'] == $_POST['confirm_new_passoword']){
           
            if(!empty($_POST['old_passoword']) && !empty($_SESSION['emp_id'])){
                $check_old_password = select_query("employees_master",array("password"),array("emp_id" => $_SESSION['emp_id']));
                
                if($check_old_password[0]['password'] == md5($_POST['old_passoword'])){
                    $password = $_POST['password'];
                    execute_update('employees_master',array('password' => md5($password )),array('emp_id' => $_SESSION['emp_id']));
                    echo json_encode(array("response"=>'password changed Succesfully', "status" => 'success'));
                    exit;
                   // echo "<script>window.location.href='resetpassword.php?status='success'';</script>";
                    //exit;
                }else{
                    echo json_encode(array("response"=>'Old Password Does Not Matched', "status" => 'error'));
                    exit;
                   // echo '<script type="text/javascript">toastr.error("Old Password Does Not Matched")</script>';
                }
            }
            
        }else{
            echo json_encode(array("response"=>'Password And Confirm Password Does Not Matched', "status" => 'error'));
            exit;
          //  echo '<script type="text/javascript">toastr.error("Password And Confirm Password Does Not Matched")</script>';
        }
    }
    // if($_SESSION['otp'] ==  $otp){
    //     echo json_encode(array("response"=>'Otp Validated', "status" => 'success'));
    // }else{
    //     echo json_encode(array("response"=>'Otp Not Matched', "status" => 'error'));
    // }
    
}

?>