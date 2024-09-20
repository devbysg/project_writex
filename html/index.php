<?php
ini_set('display_errors', 1);
// phpinfo();die();
include_once '../function/functions.php';
include_once 'constant.php';

if(isset($_POST['submit_action']))
{
    $submit_action = isset($_POST['submit_action']) ? $_POST['submit_action'] : '';

    switch ($submit_action) {
        case "login":
            if(isset($_POST['email']) && isset($_POST['password']))
            {
                {
                    $userEmail=$_POST["email"];
                    $userEmailTrim = trim($userEmail);

                    $user_password=$_POST["password"];
                    $user_password_trim = md5(trim($user_password));

                    $query_check = select_query("employees_master", array ("emp_id", "emp_name", "emp_email", "emp_role", "status"),array("emp_email"=>"$userEmailTrim", "password"=>"$user_password_trim"));
                    if($query_check && $query_check[0]['status']== 1)
                    {  
                        // session_start();
                        $_SESSION['emp_name'] = $query_check[0]['emp_name'];
                        $_SESSION['emp_id'] = $query_check[0]['emp_id'];
                        $_SESSION['emp_email'] = $query_check[0]['emp_email'];
                        $_SESSION['emp_role'] = $query_check[0]['emp_role'];
                        $_SESSION['is_login'] = 'y';
                        header("Location: ".rtrim(CURRENT_URL, '/')."?action=dashboard");
                    }
                    else if($query_check && ($query_check[0]['status']== 0))
                    {
                        echo '<script>alert("Sorry, this account is disabled")</script>';
                    }
                    else
                    { 
                        echo '<script>alert("Sorry, wrong credential")</script>';
                    }
                }
            }
        break;
    }
    
}
if(!empty($_SESSION))
{
    if(isset($_SESSION) && isset($_GET['action']))
    {
        include('layout/header.php');

        if ($_SESSION['is_login'] == 'y' && !empty($_GET['action'])){
            switch ($_GET['action']) {
                case 'user_profile':
                    include_once('profile_user.php');
                    break;
                case 'record_monthly':
                    include_once('get_record.php');
                    break;
                case 'record_all':
                    include_once('get_record_all.php');
                    break;
                case 'dashboard':
                    include_once('dashboard_new.php');
                    break;
                case 'record_ticket':
                    include_once('get_record_ticket.php');
                    break;
                case 'ticket':
                    include_once('ticket.php');
                    break;
                case 'accounts':
                    include_once('accounts.php');
                    break;
                case 'invoice':
                    include_once('invoice.php');
                    break;
                case 'list_product':
                    include_once('list_product.php');
                    break;
                case 'sme':
                    include_once('sme.php');
                    break;
                case 'payment':
                    include_once('payment.php');
                    break;
                case 'testing_quality':
                    include_once('testing_quality.php');
                    break;
                case 'employee':
                    include_once('employee.php');
                    break;
                case 'monthly_target':
                    include_once('monthly_target.php');
                    break;
                case 'template':
                    include_once('template.php');
                    break;
                case 'wordcount':
                    include_once('wordcount.php');
                    break;
                case 'addcategory':
                    include_once('addcategory.php');
                    break;
                case 'bankdetails':
                    include_once('bankdetails.php');
                    break;
                case 'template_ticket':
                    include_once('template_ticket.php');
                    break;
                case 'university':
                    include_once('university.php');
                    break;
                case 'resetpassword':
                    include_once('resetpassword.php');
                    break;
                case 'payment_details':
                    include_once('payment_details.php');
                    break;
                case 'ticket_description': 
                    include_once('ticket_description.php');
                break;
                case 'assign_team_record': 
                    include_once('team_assign.php');
                break;
                case 'record_invoice': 
                    include_once('record_invoice.php');
                break;
            }
        }
        include('layout/footer.php');

    }
}
else
{
    include_once('login.php');
}
?>