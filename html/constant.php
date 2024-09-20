
<?php

session_start();
include_once '../function/functions.php';

// $servername = "test-db-connection.cjgflqqfysj0.ap-south-1.rds.amazonaws.com";
// $username = "admin";
// $password = "Achievex2023";
// $db = "writex";
$servername = "127.0.0.1";
$username = "root";
$password = "Achievex@2023";
$db = "aws_writex_db";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);


// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$URLPREFIX = "http://";
if(isset($_SERVER['HTTPS']))
{
    if($_SERVER['HTTPS'] == 'on') {
        $URLPREFIX = "https://";
    }
}

define("SITE_URL", $URLPREFIX.$_SERVER['SERVER_NAME']."/");

define("CURRENT_URL", $URLPREFIX.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."/");

$ticket_status = array(
    "Ticket_Created"=>"Ticket Created",
    "Performa_Invoice_Send"=>"Performa Invoice Send", 
    "Payment_attachment_added"=>"Payment Attachment Added",
    "Advanced_Recieved"=>"Advanced Recieved",
    "Project_Created"=>"Project Created",
    "Project_Assigned_To_Sme"=>"Project Assigned To Sme",
    "Project_Partially_Completed"=>"Project Partially Completed",
    "Project_InProgress"=>"Project InProgress",
    "Quality_Checking_Initiated"=>"Quality Checking Initiated",
    "Quality_Checked"=>"Quality Checked",
    "Quality_Check_Failed"=>"Quality Check Failed",
    "Project_Completed"=>"Project Completed", 
    "Payment_Recieved"=>"Payment Recieved",
    "Output_Sent"=>"Output Sent",
    "Ticket_Close"=>"Ticket Close", 
    "Ticket_Archieve"=>"Ticket Archieve",
    "Sme_upload_complete"=>"Sme Upload Complete",
    "Assign_to_tm_qe"=>"Assign to tm and qe",
    "Assign_to_tl"=>"Assign to tl",
    "tl_upload_complete"=>"Tl Upload Complete",
    "tm_upload_complete"=>"Tm Upload Complete",
    "pm_upload_complete"=>"Pm Upload Complete"
);
$ticket_status_flip = array(
    "Ticket Created"=>"Ticket_Created",
    "Performa Invoice Send"=>"Performa_Invoice_Send",
    "Advanced Recieved"=>"Advanced_Recieved",
    "Project Created"=>"Project_Created",
    "Proect Assigned"=>"Project_Assigned",
    "Project Partially Completed"=>"Project_Partially_Completed",
    "Project Completed"=>"Project_Completed", 
    "Payment Recieved"=>"Payment_Recieved",
    "Output Sent"=>"Output_Sent",
    "Ticket Close"=>"Ticket_Close"
);
$payment_status = array(
    "Advance_Received" => "Advance Received",
    "Payment_Received" => "Payment Received",
    "Payment_Completed" => "Payment Completed", 
    "Pending" => "Pending",
    "Success" => "Success"
);
$task_status = array(
    "Task_Assigned" => "Task Assigned",
    "Task_Inprogress" => "Task Inprogress",
    "Task_Completed" => "Task Completed"
);
$ticket_role_applicable = array("Admin","Accounts","Sales","project_manager", "team_leader_sales", "sales_lead");

$invoice_role_applicable = array("Admin","Accounts","Sales", "team_leader_sales", "sales_lead");

$accounts_role_applicable = array("Admin", "Accounts");

// $project_role_applicable = array("Admin","Team_Manager","Team_Leader");
$project_role_applicable = array("Admin","Team_Leader");

$sme_role_applicable = array("Admin","Sr_Sme","Jr_Sme","SME");

$quality_role_applicable = array("Admin","Quality_Tester");

$assign_role_applicable = array("project_manager","Team_Manager");

$payment_role_applicable = array("Admin","Accounts","Sales");

$admin_role_applicable = array("Admin");

$sales_role_applicable = array("Sales","Admin");

$desc_role_ticket_applicable = array("project_manager", "Team_Manager", "Sr_Sme", "Jr_Sme", "SME", "Admin");

$upload_button_ticket_applicable = array("Sales", "team_leader_sales","Admin", "sales_lead");

$download_button_ticket_applicable = array("Admin", "Accounts", "project_manager","Sales", "sales_lead", "team_leader_sales");

$edit_button_ticket_applicable = array("Admin", "Sales", "sales_lead", "team_leader_sales");

$send_attach_ticket_applicable = array("Admin", "Sales", "sales_lead");

$send_final_ticket_applicable = array("Admin", "Sales");

$record_role_applicable = array("Admin","Accounts","Sales","team_leader_sales","sales_lead");

$Role = array("Admin" => "Admin","Accounts" => "Accounts","project_manager" =>"Project Manager","sales_lead"=>"Sales Lead", "team_leader_sales"=>"Team Leader(Sales)", "Sales"=>"BDE","Team_Manager"=>"Team Manager","Team_Leader"=>"Team Leader","Quality_Tester" =>"Quality Tester","Sr_Sme"=>"Sr Sme","Jr_Sme" => "Jr Sme","SME"=>"SME");

$manager_role = array("Accounts"=> "Admin","Sales"=>"Admin","project_manager" =>"Admin", "sales_lead" => "project_manager","team_leader_sales" => "sales_lead","Sales" => "team_leader_sales","Team_Manager"=>"project_manager","Team_Leader"=>"Team_Manager","Quality_Tester" =>"Team_Manager","Sr_Sme"=>"Team_Leader","Jr_Sme" => "Team_Leader","SME"=>"Team_Leader");

$ticket_before_project_created = array('Ticket Created', 'Performa Invoice Send', 'Payment Attachment Added', 'Advanced Recieved','Quality Check Failed','Payment Recieved', 'Project Created');

$ticket_before_project_initialize = array('Ticket Created', 'Performa Invoice Send', 'Advanced Recieved');

$get_project_created = array('Advanced Recieved', 'Payment Recieved');

$assign_ticket_status_applicable = array('Ticket Created', 'Performa Invoice Send', 'Advanced Recieved', 'Project Created', 'Quality Check Failed');

$check_quality_ticket_status_applicable = array('Assign to tm and qe', 'Assign to tl', 'Project Assigned To Sme', 'Project InProgress', 'Sme Upload Complete','Tl Upload Complete','Tm Upload Complete','Pm Upload Complete');

$project_created_applicable = array('Project Created', 'Assign to tm and qe', 'Assign to tl', 'Project Assigned To Sme', 'Project Partially Completed', 'Project InProgress', 'Sme Upload Complete','Tl Upload Complete', 'Tm Upload Complete', 'Pm Upload Complete', 'Quality Checking Initiated', 'Quality Checked', 'Quality Check Failed','Project Completed');

$project_manager_ticket_status_applicable = array('Project Created', 'Quality Check Failed');

$desc_role_applicable = array("Admin", "project_manager");

$doc_exten = array('doc','docx','odt','txt');

$image_exten = array('jpg','jpeg','png');

$pdf_exten = array('pptx','ppt','pdf');

$excel_exten = array('.XLS','.XLSX','.ODS'); 	

$video_exten = array('mp4');

$get_sme_role_applicable = array("Sr_Sme","Jr_Sme","SME");

$download_option_applicable = array("Ticket Created", "Performa Invoice Send");

$ticket_advance_edit_applicable = array("Success", "Payment Recieved", "Payment Completed");

$team_manager_ticket_status_applicable = array("Assign to tl", "Project Assigned To Sme", "Project Partially Completed", "Project InProgress", "Quality Checking Initiated", "Quality Checked", "Quality Checked", "Quality Check Failed", "Project Completed", "Output Sent", "Ticket Close", "Ticket Archieve","Tl Upload Complete", "Tm Upload Complete", "Pm Upload Complete");

$team_lead_ticket_status_applicable = array("Project Assigned To Sme", "Project Partially Completed", "Project InProgress", "Quality Checking Initiated", "Quality Checked", "Quality Checked", "Quality Check Failed", "Project Completed", "Output Sent", "Ticket Close", "Ticket Archieve", "Sme Upload Complete","Pm Upload Complete", "Tm Upload Complete", "Tl Upload Complete");

$tl_ticket_status_applicable = array("Assign to tl", "Quality Check Failed", "Project Assigned To Sme", "Project InProgress");

$tm_ticket_status_applicable = array("Assign to tl", "Project Assigned To Sme", "Project Partially Completed", "Project InProgress", "Quality Checking Initiated", "Quality Checked", "Quality Checked", "Quality Check Failed", "Project Completed", "Output Sent", "Ticket Close", "Ticket Archieve");

$pm_ticket_status_applicable = array("Assign to tl", "Quality Check Failed", "Project Assigned To Sme", "Project InProgress");

$document_type = array(
    "Input" => "Input",
    "Sme_Uploaded" => "Sme Uploaded",
    "Check_For_Quality" => "Check For Quality",
    "Quality_Failed" => "Quality Failed",
    "Quality_Checked" => "Quality Checked",
    "Tl_Uploaded" => "Tl Uploaded",
    "Tm_Uploaded" => "Tm Uploaded",
    "Pm_Uploaded" => "Pm Uploaded",
    "Check_For_tm" => "Check For Tm",
    "Check_For_pm" => "Check For Pm",
    "Check_For_client" => "Check For Client"
);
?>

