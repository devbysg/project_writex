<?php 
ini_set('display_errors', 1);
ini_set('upload_max_filesize', '1000M');
include_once '../phpmailer/PHPMailerAutoload.php';
include_once('../html/constant.php');
// print_r($_POST);
// print_r($_FILES);
// die("aaa");
// Get RealTime Date Values
date_default_timezone_set("Asia/Calcutta");
$today_date = new DateTime();
$get_date_today =  $today_date->format('Y-m-d');

$get_status_applicable = "'" .implode("', '",$ticket_before_project_created). "'";
$get_assign_ticket_status_applicable = "'" .implode("', '",$assign_ticket_status_applicable). "'";
$get_check_quality_ticket_status_applicable = "'" .implode("', '",$check_quality_ticket_status_applicable). "'";
$get_project_created_applicable = "'" .implode("', '",$project_created_applicable). "'";
$get_project_manager_ticket_status_applicable = "'" .implode("', '",$project_manager_ticket_status_applicable). "'";
$get_team_manager_ticket_status_applicable = "'" .implode("', '",$team_manager_ticket_status_applicable). "'";
$get_team_lead_ticket_status_applicable = "'" .implode("', '",$team_lead_ticket_status_applicable). "'";
// Get ticket Records
if(isset($_POST['action']) && $_POST['action'] == 'listRecords') {
	$payment_desc = select_query("payment_master",array("transaction_id","amount_received", "accounts_approval_date"),array("ticket_id" => "id"));
    $get_data = get_ticket();

	$records = [];

	if(!empty($get_data))
	{
		$cost = ($get_data[0]['rate'])*($get_data[0]['wordcount']);

		foreach($get_data as $key => $val){ 
			$rows = array();
			$getDateFromTicketCreated = explode(" ",$val['date_added']);
			$dateAdded = $getDateFromTicketCreated[0];

			$ticket_value = round((($val['wordcount'] * $val['rate'])/ $val['word_limit']),2)+ (int)$val['extra_amount'];
			// $rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);">ID <b>#</b>'.$val['ticket_id'].'<br>Word Count:&nbsp'.($val['wordcount']).'<br>Date added:&nbsp'.($dateAdded).'<br>Created By:&nbsp'.($val['emp_name']).'<br>Cost:&nbsp'.$val['total_value'].' '.$val['currency'].'</span>';
			$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);">ID <b>#</b>'.$val['ticket_id'].'<br>Word Count:&nbsp'.($val['wordcount']).'<br>Date added:&nbsp'.($dateAdded).'<br>Created By:&nbsp'.($val['emp_name']).'<br>Ticket Value:&nbsp'.$val['total_value'].'</span>';
			$rows[] = '<span><em class="ni ni-user"></em>&nbsp'.$val['customer_name']."<br><em class='icon ni ni-mobile'></em>&nbsp<a href = 'https://wa.me/".$val['phone_number']."'>".$val['phone_number']."</a><br><em class='icon ni ni-mail-fill'></em>&nbsp<a href = 'mailto:".$val['customer_email']."'>".$val['customer_email'].'</a></span>';
			$earlier = new DateTime(date('Y-m-d'));
			$later = new DateTime($val['assigned_deadline']);
			$pos_diff = $earlier->diff($later)->format("%r%a"); //3
			if($val['assigned_date'] != '0000-00-00 00:00:00')
			{
				$get_date = explode(' ',$val['assigned_date']);
				$rows[] = $get_date[0];
			}
			else{
				$rows[] = 'N/A';
			}
			if( $val['assigned_deadline'] != '0000-00-00 00:00:00')
			{
				$get_dedline = explode(' ',$val['assigned_deadline']);
				$rows[] = $get_dedline[0];
			}
			else{
				$rows[] = 'N/A';
			}
			if($val['assigned_date'] != '0000-00-00 00:00:00' && $val['assigned_deadline'] != '0000-00-00 00:00:00')
			{		
				if($pos_diff <= 2){
						$rows[] = '<span class="text-danger">'.$pos_diff.' Days Left</span>';
					}else{
						$rows[] = '<span class="text-success">'.$pos_diff.' Days Left</span>';
					}
			}	
			else{
				$rows[] = '<span class="text-primary">Sorry, No Date Found</span>';
			}	
			if($val['status'] == $ticket_status['Ticket_Created']){
				$rows[] = '<span class="badge badge-dot bg-danger">'.$val['status'].'</span>';
			}
			else if($val['status'] == $ticket_status['Ticket_Close']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else if($val['status'] == $ticket_status['Ticket_Archieve']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else{
				// $rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].'</span>';
				$rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].' <br> '.$val['status_payment'].'</span>';
			}
			$btn = '';
				if((in_array($_SESSION['emp_role'], $desc_role_ticket_applicable)) && (!in_array($val['status'], $ticket_before_project_initialize))){
				$btn .= '<a href =html/?action=ticket_description&ticketId='.$val['ticket_id'].' class="btn btn-sm btn-outline-info mt-3" target="_blank" title="Check All Remarks"><em class="icon ni ni-notice"></em></a>';
			}
				if((in_array($_SESSION['emp_role'], $upload_button_ticket_applicable))){
					$btn .= '&nbsp;&nbsp;<div class="btn-group" aria-label="Basic example"> <button type="button" id="upload-payment" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalTabs" onclick="uploadDocumnets(this);" title="Upload Documents"><em class="icon ni ni-upload"></em></button>';
			}
			// if((in_array($_SESSION['emp_role'], $download_button_ticket_applicable)) && (!in_array($val['status'], $download_option_applicable))){
			if((in_array($_SESSION['emp_role'], $download_button_ticket_applicable)) && (isset($val['status_payment']))){
				$btn .= '&nbsp;&nbsp;<div class="btn-group" aria-label="Basic example"> <button type="button" id="download-attachment" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalTabs" onclick="downloadDocumnets(this);" title="Ticket Attachment Download"><em class="icon ni ni-download"></em></button>';
			}
			if((in_array($_SESSION['emp_role'], $edit_button_ticket_applicable)) && (in_array($val['status_payment'], $get_project_created)) && (in_array($val['status'], $ticket_before_project_initialize)))
			 {
				$btn .= '&nbsp;&nbsp;<button type="button"  class="btn btn-sm btn-outline-info mt-3" id="edit_ticket"  data-id="'.$val['ticket_id'].'"  onclick="edit_ticket(this);" data-bs-toggle="modal" data-bs-target="" data-bs-placement="top" title="Edit"><em class="icon ni ni-edit-alt-fill"></em></button>';
			 }
			if($val['input_documents_id'] == 1){
				$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-warning mt-3" onclick="view_attchment(this);" title="view"><em class="icon ni ni-eye-alt-fill"></em></button>';
	
			}
				if((in_array($_SESSION['emp_role'], $send_attach_ticket_applicable)) && ($val['status'] == $ticket_status['Payment_Recieved'])){
				$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn btn-outline-primary mt-3" onclick="send_output(this);" title="Send Final Attachment"><em class="icon ni ni-send"></em></button>';
			}
				if((in_array($_SESSION['emp_role'], $send_final_ticket_applicable)) && ($val['status'] == $ticket_status['Project_Completed'])){
				$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn btn-outline-secondary mt-3" onclick="send_final_invoice(this);" title="Send Final Invoice"><em class="icon ni ni-file-docs"></em></button>';
			}
			// if(!in_array($val['status_payment'], $download_option_applicable)){
				if($val['status_payment']){
				$btn .= '&nbsp;&nbsp;<a href =html/?action=payment_details&ticketId='.$val['ticket_id'].' class="btn btn-sm btn-outline-info mt-3" target="_blank" title="Check Payment Status"><em class="icon ni ni-sign-inr"></em></a>';

			$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-success mt-3" onclick="modalAddRemarks(this);" title="Add Remarks"><em class="icon ni ni-note-add"></em></button>&nbsp; ';
			}
			$rows[] = $btn;
			$records[] = $rows;
		}
	}
	

	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// Get ticket Records By Id
if(!empty($_POST['action']) && $_POST['action'] == 'listIdRecords') {
	
	$key_values  = array("ticket_id","ticket_desc", "status");
	$payment_desc = select_query("payment_master",array("transaction_id","amount_received", "accounts_approval_date"),array("ticket_id" => "id"));
    $get_data = get_ticket_id();

	$records = [];
	
	if(!empty($get_data))
	{
		$cost = ($get_data[0]['rate'])*($get_data[0]['wordcount']);
		foreach($get_data as $key => $val){ 
			$rows = array();
			$getDateFromTicketCreated = explode(" ",$val['date_added']);
			$dateAdded = $getDateFromTicketCreated[0];
			$ticket_value = round((($val['wordcount'] * $val['rate'])/ $val['word_limit']),2)+ (int)$val['extra_amount'];
			$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);">ID <b>#</b>'.$val['ticket_id'].'<br>Word Count:&nbsp'.($val['wordcount']).'<br>Date added:&nbsp'.($dateAdded).'<br>Created By:&nbsp'.($val['emp_name']).'<br>Ticket Value:&nbsp'.$val['total_value'].'</span>';
			$rows[] = '<span><em class="ni ni-user"></em>&nbsp'.$val['customer_name']."<br><em class='icon ni ni-mobile'></em>&nbsp<a href = 'https://wa.me/".$val['phone_number']."'>".$val['phone_number']."</a><br><em class='icon ni ni-mail-fill'></em>&nbsp<a href = 'mailto:".$val['customer_email']."'>".$val['customer_email'].'</a></span>';
			$earlier = new DateTime(date('Y-m-d'));
			$later = new DateTime($val['assigned_deadline']);
			$pos_diff = $earlier->diff($later)->format("%r%a"); //3
			if($val['assigned_date'] != '0000-00-00 00:00:00')
			{
				$get_date = explode(' ',$val['assigned_date']);
				$rows[] = $get_date[0];
			}
			else{
				$rows[] = 'N/A';
			}
			if( $val['assigned_deadline'] != '0000-00-00 00:00:00')
			{
				$get_dedline = explode(' ',$val['assigned_deadline']);
				$rows[] = $get_dedline[0];
			}
			else{
				$rows[] = 'N/A';
			}
			if($val['assigned_date'] != '0000-00-00 00:00:00' && $val['assigned_deadline'] != '0000-00-00 00:00:00')
			{		
				if($pos_diff <= 2){
						$rows[] = '<span class="text-danger">'.$pos_diff.' Days Left</span>';
					}else{
						$rows[] = '<span class="text-success">'.$pos_diff.' Days Left</span>';
					}
			}	
			else{
				$rows[] = '<span class="text-primary">Sorry, No Date Found</span>';
			}	
			if($val['status'] == $ticket_status['Ticket_Created']){
				$rows[] = '<span class="badge badge-dot bg-danger">'.$val['status'].'</span>';
			}
			else if($val['status'] == $ticket_status['Ticket_Close']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else if($val['status'] == $ticket_status['Ticket_Archieve']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else{
				$rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].' <br> '.$val['status_payment'].'</span>';
			}
			$btn = '';
				if((in_array($_SESSION['emp_role'], $desc_role_ticket_applicable)) && (!in_array($val['status'], $ticket_before_project_initialize))){
				$btn .= '<a href =html/?action=ticket_description&ticketId='.$val['ticket_id'].' class="btn btn-sm btn-outline-info mt-3" target="_blank" title="Check All Remarks"><em class="icon ni ni-notice"></em></a>';
			}
				if((in_array($_SESSION['emp_role'], $upload_button_ticket_applicable))){
				$btn .= '&nbsp;&nbsp;<div class="btn-group" aria-label="Basic example"> <button type="button" id="upload-payment" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalTabs" onclick="uploadDocumnets(this);" title="Upload Documents"><em class="icon ni ni-upload"></em></button>';
			}
			// if((in_array($_SESSION['emp_role'], $download_button_ticket_applicable)) && (!in_array($val['status'], $download_option_applicable))){
			if((in_array($_SESSION['emp_role'], $download_button_ticket_applicable)) && (isset($val['status_payment']))){
				$btn .= '&nbsp;&nbsp;<div class="btn-group" aria-label="Basic example"> <button type="button" id="download-attachment" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalTabs" onclick="downloadDocumnets(this);" title="Ticket Attachment Download"><em class="icon ni ni-download"></em></button>';
			}
			// if((in_array($_SESSION['emp_role'], $edit_button_ticket_applicable)) && (in_array($val['status_payment'], $get_project_created)))
			if((in_array($_SESSION['emp_role'], $edit_button_ticket_applicable)) && (in_array($val['status_payment'], $get_project_created)) && (in_array($val['status'], $ticket_before_project_initialize)))
			 {
				$btn .= '&nbsp;&nbsp<button type="button"  class="btn btn-sm btn-outline-info mt-3" id="edit_ticket"  data-id="'.$val['ticket_id'].'"  onclick="edit_ticket(this);" data-bs-toggle="modal" data-bs-target="" data-bs-placement="top" title="Edit"><em class="icon ni ni-edit-alt-fill"></em></button>';
			 }
			if($val['input_documents_id'] == 1){
				$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-warning mt-3" onclick="view_attchment(this);" title="view"><em class="icon ni ni-eye-alt-fill"></em></button>';
	
			}
				if((in_array($_SESSION['emp_role'], $send_attach_ticket_applicable)) && ($val['status'] == $ticket_status['Payment_Recieved'])){
				$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn btn-outline-primary mt-3" onclick="send_output(this);" title="Send Final Attachment"><em class="icon ni ni-send"></em></button>&nbsp;&nbsp;';
			}
				if((in_array($_SESSION['emp_role'], $send_final_ticket_applicable)) && ($val['status'] == $ticket_status['Project_Completed'])){
				$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn btn-outline-secondary mt-3" onclick="send_final_invoice(this);" title="Send Final Invoice"><em class="icon ni ni-file-docs"></em></button>&nbsp;&nbsp;';
			}
			// if(!in_array($val['status_payment'], $download_option_applicable)){
				if($val['status_payment']){
				$btn .= '&nbsp;&nbsp;<a href = html/?action=payment_details&ticketId='.$val['ticket_id'].' class="btn btn-sm btn-outline-info mt-3" target="_blank" title="Check Payment Status"><em class="icon ni ni-sign-inr"></em></a>';

				$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-success mt-3" onclick="modalAddRemarks(this);" title="Add Remarks"><em class="icon ni ni-note-add"></em></button>&nbsp; ';
			}
			$rows[] = $btn;
			$records[] = $rows;
		}
	}

	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}

if(!empty($_POST['action']) && $_POST['action'] == 'upload_attachment') {
	if(isset($_SESSION['emp_id']))
	{
		if(!empty($_FILES['uploadpaymentattachment']['name'][0])){
			$file_path = "payment_receive";
			$name = file_upload($_FILES['uploadpaymentattachment'],$file_path);
			foreach($name as $key){ 
				$extn_array = explode(".",$key);
				$extn = $extn_array[1];
				$data = array();
				$data['ticket_id'] = $_POST['uploadpaymentticket_id'];
				$extn = strtolower($extn);
				$data['file_name'] = $key; 
				// if(in_array($extn,$image_exten)){
				// 	$data['file_name'] = $key; 
				// }
				// if(in_array($extn,$doc_exten)){
				// 	$data['file_name'] = $key;
				// }
				// if(in_array($extn,$pdf_exten)){
				// 	$data['file_name'] = $key;
				// }
				// if(in_array($extn,$video_exten)){
				// 	$data['file_name'] = $key;
				// }
				// if(in_array($extn,$excel_exten)){
				// 	$data['file_name'] = $key;
				// }
			}
		}
			$update_status = execute_insert('payment_master', array('ticket_id' => $data['ticket_id'], 'file_name' => $data['file_name'], 'payment_attached_by' => $_SESSION['emp_id'], 'status' => "Pending", 'get_comments' => addslashes($_POST['add_bdecomments'])));
			execute_update('ticket_master', array('status_payment' => $ticket_status['Payment_attachment_added']),array('ticket_id' => $data['ticket_id']));
			echo json_encode(array("response"=>'Payment Files Uploaded Successfully', "status" => 'success','data' => $update_status));
			// echo json_encode(array("response"=>'Payment Files Uploaded Successfully', "status" => 'success'));
	}
	else{
		echo json_encode(array("response"=>'Payment Files Uploaded Failed', "status" => 'Failed'));
	}	
}
// Get Payment uploaded files
if(!empty($_POST['action']) && $_POST['action'] == 'get_payment_files') {
	$get_ticket_id = $_POST['ticket_id'];
	$get_payment_documents = select_query('payment_master',array('file_name'),array('ticket_id' => $get_ticket_id));
	// if($get_payment_documents)
	// {
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_payment_documents));
	// }	
}
//get template
if(!empty($_POST['action']) && $_POST['action'] == 'assigned_temp_list') {
	$temp_details = select_query('template_ticket',array('template_id','template_text'),array('template_id' => $_POST['template']));
	if($temp_details){
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$temp_details));
	}
	

}
// Add Ticket Record
if(!empty($_POST['action']) && $_POST['action'] == 'addRecord') {
	if(isset($_SESSION['emp_id']))
	{
		$data = array();
		$data['customer_name'] = $_POST['client_name'];
		$data['customer_email'] = $_POST['client_email'];
		$data['phone_number'] = $_POST['client_phone'];
		if(isset($_POST['customer_id'])){
			$customer_id = execute_insert("customer_master", $data);
		}else{
			$customer_id = execute_insert("customer_master", $data);
		}
		$data = array();
		$data['customer_id'] = $customer_id;
		$data['wordcount'] = $_POST['word_count'];
		$data['country_id'] = $_POST['Country'];
		$data['assigned_deadline'] = $_POST["deadline"];
		$data['assigned_date'] = $_POST["assigned_for"];
		$data['category_id'] = $_POST["Category"];
		$data['status'] = $ticket_status['Ticket_Created'];
		$data['created_by'] =  $_SESSION['emp_id'];
		$data['university'] = $_POST['university'];
		$data['total_value'] = $_POST["bill_value_amount"];
		$ticket_id = execute_insert("ticket_master", $data);
		$_POST["id"] = $ticket_id;
		
		// $data = array();
		$data = array();
		// if (date('m') <= 6) {//Upto June 2014-2015
		// 	$financial_year = (date('Y')) . '-' . (date('Y')+1);
		// } else {//After June 2015-2016
		// 	$financial_year = date('Y') . '-' . (date('Y') + 1);
		// }
		// $data['invoice_number'] = $financial_year."-".$ticket_id;
		$data['invoice_number'] = $ticket_id;
		$_SESSION['invoice_number'] = $data['invoice_number']; 
		create_pdf();
		
		$data['invoice_date'] = date("Y/m/d");
		$data['ticket_id'] = $ticket_id;
		$data['invoice_amount'] = $_POST["bill_value_amount"];
		if(isset($_POST["extra_amount"]) && $_POST["extra_amount"] != ''){
			$data['extra_charges'] = $_POST["extra_amount"];
		}
		$data['word_count'] = $_POST['word_count'];
		$data['std_rate'] = $_POST['std_rate'];
		
		$invoice_id = execute_insert("invoice_master", $data);
		$path = $_SERVER["DOCUMENT_ROOT"]."/upload/pdf/".$_SESSION['invoice_number'].".pdf";
		$template_details = select_query("template_master",array('template_subject','template_body'),array('template_type' => 'create_ticket'));
		$datas = array();
		$datas['first_name'] = $_POST['client_name'];
		$email_body = prepare_mail_msg( $template_details[0]['template_body'],$datas);
		$email_subject = '#'.$ticket_id.'';
		send_mail_attachment($_POST['client_email'],$email_subject,$email_body,$path);
		execute_update('ticket_master',array('status' => $ticket_status['Performa_Invoice_Send']),array('ticket_id' => $ticket_id));
		if($ticket_id ){
			echo json_encode(array("response"=>'Inserted Successfully', "status" => 'success','data' => $ticket_id));
		}
	}
	else{
		// header("Location: login.php");
		echo json_encode(array("response"=>'Inserted Failed', "status" => 'Failed'));
	}
	
}
// Get Ticket Details for edit purpose
if(!empty($_POST['action']) && $_POST['action'] == 'get_ticketdetails') { 
	$get_id = $_POST['data_id'];
	$sql="SELECT `t`.`ticket_id`,`country_id`,`category_id`,`assigned_date`,`assigned_deadline`,`wordcount`, `in_doc`.status as 'document_status',cm.customer_name,cm.customer_email,cm.phone_number FROM `ticket_master` t LEFT JOIN input_documents in_doc on t.ticket_id = in_doc.ticket_id INNER JOIN customer_master cm on t.customer_id = cm.customer_id WHERE t.ticket_id= $get_id";
	$get_info=execute_query($sql);
	if($get_info){
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_info));
	}
	
}

//edit ticket in modal
if(!empty($_POST['action']) && $_POST['action'] == 'updateticket') {
	// print_r($_POST);
	// print_r($_FILES);
	// die("AAA");
	if(isset($_SESSION['emp_id']))
	{
		$get_ticket_id = $_POST['modticket_id'];
		$_POST['modticket_desc'] = addslashes($_POST['modticket_desc']);
		if(!empty($_FILES['modticket_image']['name'][0])){
			$name = file_upload($_FILES['modticket_image']);
			foreach($name as $key){ 
				$extn_array = explode(".",$key);
				$extn = $extn_array[1];
				$data = array();
				$data['ticket_id'] = $get_ticket_id;
				$data['documents_type'] ="Input"; 
				$data['extension'] = $extn;
				$extn = strtolower($extn);
				$data['file_name'] = $key;
				// if(in_array($extn,$image_exten)){
				// 	$data['file_name'] = $key; 
				// }
				// if(in_array($extn,$doc_exten)){
				// 	$data['file_name'] = $key;
				// }
				// if(in_array($extn,$pdf_exten)){
				// 	$data['file_name'] = $key;
				// }
				// if(in_array($extn,$video_exten)){
				// 	$data['file_name'] = $key;
				// }
				// if(in_array($extn,$excel_exten)){
				// 	$data['file_name'] = $key;
				// }
				$insert_files = execute_insert('input_documents', $data);
			}
			execute_update('ticket_master',array('input_documents_id' => 1),array('ticket_id' => $get_ticket_id));
		}

		$update_ticket = execute_update('ticket_master',array('assigned_date'=>$_POST['modassigned_for'],'assigned_deadline'=>$_POST['moddeadline_for'],'update_by' => $_SESSION['emp_id'], 'university' => $_POST['university'], 'status' => $ticket_status['Project_Created'], 'code_module' => $_POST['code_module']), array('ticket_id'=>$_POST['modticket_id']));
		$data_desc['ticket_id'] = $get_ticket_id;
		$data_desc['ticket_desc'] = $_POST['modticket_desc'];
		$data_desc['created_by'] = $_SESSION['emp_id'];
		$get_role = select_query("employees_master",array('emp_role'),array('emp_id' => $_SESSION['emp_id']));
		$data_desc['role'] = $get_role[0]['emp_role'];
		$data_desc_insert = execute_insert("ticket_desc", $data_desc);
		if($update_ticket){
			echo json_encode(array("response"=>'Project Created Successfully', "status" => 'success', "data"=>$update_ticket));
		}
	}
	else
	{
		echo json_encode(array("response"=>'Project Allocation Failed', "status" => 'Failed'));
	}
	
}
if(!empty($_POST['action']) && $_POST['action'] == 'getRecord') {
	$get_id = $_POST["id"];
	$get_record = get_data("ticket_master", $get_id);
	if($get_record)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_record));
	}
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateRecord') {
    $desc = $_POST["ticket_desc"];
	$id = $_POST['ticket_id'];
	$update_new = execute_update('ticket_master',array('ticket_desc' => $desc),array('ticket_id' => $id));
	echo json_encode(array("response"=>'Update Successfully', "status" => 'success', "data"=>$id));
	
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteRecord') {
	$record->id = $_POST["id"];
	$record->deleteRecord();
}
if(!empty($_POST['action']) && $_POST['action'] == 'show_doc') {
	$get_id = $_POST["id"];
	$get_doc = select_query('input_documents',array('doc_attached','pic_attached','pdf_attached','video_attached','excel_attached'),array('ticket_id' => $get_id));
	if($get_doc)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_doc));
	}
}
// Employee Table List
if(!empty($_POST['action']) && $_POST['action'] == 'listEmp') {
	$cond = 'order by `emp_id` desc';
    $get_data = select_query('employees_master', array('*'),array(),$cond);
	foreach($get_data as $key => $val){ 
		
		$rows = array();
		$rows[] = '<span><em class="ni ni-user"></em>&nbsp'.$val['emp_name']."<br><em class='icon ni ni-mobile'></em>&nbsp<a href = 'https://wa.me/:".$val['emp_phone_no']."'>".$val['emp_phone_no']."</a><br><em class='icon ni ni-mail-fill'></em>&nbsp<a href = 'mailto:".$val['emp_email']."'>".$val['emp_email'].'</a></span>';	
		$rows[] = $Role[$val['emp_role']];
		$btn = 	'';
		$btn .= '<button type="button" name="update" id="edit_employee" onclick="edit_employee(this);" data-id="'.$val['emp_id'].'" class="btn btn-sm btn-outline-info mt-3" data-bs-toggle="modal" data-target="#editEmployeeModal" data-bs-placement="top" title="Edit"><em class="icon ni ni-edit-alt"></em></button>';
		if($val['status'] == 1)
		{
			$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['emp_id'].'" class="btn btn-sm btn-outline-danger mt-3" onclick="disable_id(this);" title="Disable ID"><em class="icon ni ni-na"></em></button>';
		}	
		else{
			$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['emp_id'].'" class="btn btn-sm btn-outline-success mt-3" onclick="enable_id(this);" title="Enable ID"><em class="icon ni ni-check-circle"></em></button>';		
		}
		$rows[] = $btn;
		$records[] = $rows;
	}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	echo json_encode($output);

}
//Disable User
if(!empty($_POST['action']) && $_POST['action'] == 'getDisableId') {
    $get_emp_id = $_POST["data_id"];
	$emp_update = execute_update('employees_master',array('status' => 0),array('emp_id' => $get_emp_id));
	if($emp_update){
		echo json_encode(array("response"=>'Disable Successfully', "status" => 'success', "data"=>$emp_update));
	}
}
//Enable User
if(!empty($_POST['action']) && $_POST['action'] == 'getEnableId') {
    $get_emp_id = $_POST["data_id"];
	$emp_update = execute_update('employees_master',array('status' => 1),array('emp_id' => $get_emp_id));
	if($emp_update){
		echo json_encode(array("response"=>'Disable Successfully', "status" => 'success', "data"=>$emp_update));
	}
}
//assigned manager
if(!empty($_POST['action']) && $_POST['action'] == 'assigned_maneger_list') {
    $role = $_POST["role"];
	$emp_details = select_query('employees_master',array('emp_id','emp_name'),array('emp_role' => $manager_role[$role]));
	if($emp_details){
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$emp_details));
	}
}
// Check Employees by email
if(!empty($_POST['action']) && $_POST['action'] == 'check_dupicacy') {

	$get_mail = $_POST['customer_email'];
        $check_dup = select_query("employees_master", array ("emp_id"),array("emp_email"=>"$get_mail"));
        if(($check_dup)){
            echo json_encode(array("response"=>'Email id already there', "status" => 'error', $check_dup));
        }
}

// Emp Table Insert
if(!empty($_POST['action']) && $_POST['action'] == 'addEmp') {  
	
	$data['emp_name'] = $_POST["name"];
    $data['emp_email'] = $_POST["email"];
	$data['emp_phone_no'] = $_POST["phone_number"];
	$data['emp_role'] = $_POST["emp_role"];
	$data['manager_id'] = $_POST["maneger_id"];
	$data['password'] = md5(12345);
    $emp_add = execute_insert("employees_master", $data);
	send_mail($_POST["email"],"registration");
	if($emp_add){
		echo json_encode(array("response"=>'Inserted Successfully', "status" => 'success','data' => $emp_add));
	}
}
// Get Employee Details
if(!empty($_POST['action']) && $_POST['action'] == 'getEmployeeDetails')
{
	$empId = $_POST['data_id'];
	$emp_desc = select_query("employees_master",array("emp_id", "emp_name","emp_email", "emp_phone_no", "emp_role", "manager_id"),array("emp_id" => "$empId"));
	$role = $emp_desc[0]['emp_role'];
	$emp_details = select_query('employees_master',array('emp_id','emp_name'),array('emp_role' => $manager_role[$role]));
	echo json_encode(["response"=>'Fetch Successfully', "status" => 'success', 'data1'=>$emp_desc, 'data2'=>$emp_details]);

}
//edit employee in modal
if(!empty($_POST['action']) && $_POST['action'] == 'updateEmp') {
        $emp_update = execute_update('employees_master',array('emp_name'=>$_POST["name"], 'emp_email'=>$_POST["email"], 'emp_phone_no'=>$_POST["phone_number"], 'emp_role'=>$_POST["emp_role"], 'manager_id'=>$_POST["emp_role_manager"]),array('emp_id' =>$_POST['emp_id']));
		echo json_encode(["response"=>'Updated Successfully', "status" => 'success', 'data'=>$emp_update]);
}
//assigned manager
if(!empty($_POST['action']) && $_POST['action'] == 'assigned_template_list') {
    $role = $_POST["role"];
	$emp_details = select_query('employees_master',array('emp_id','emp_name'),array('emp_role' => $manager_role[$role]));
	if($emp_details){
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$emp_details));
	}
	

}
// Role Table List
if(!empty($_POST['action']) && $_POST['action'] == 'datarole') {
    $get_data = select_query('role_master', array('role_id', 'role_name', 'role_desc'));
	foreach($get_data as $key => $val){ 
		
		$rows = array();
		$rows[]	= '<input type="checkbox" class="custom-control-input" id="emp_data">';	
		$rows[] = $val['role_id'];
		$rows[] = $val['role_name'];
		$rows[] = $val['role_desc'];
		$rows[] = "N/a";	
		$rows[] = '<button type="button" name="update" id="'.$val['role_id'].'" class="btn btn-sm btn-outline-info mt-3"data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><em class="icon ni ni-edit-alt"></em></button>&nbsp;&nbsp;<button type="button" name="delete" id="'.$val['role_id'].'" class="btn btn-sm btn-primary mt-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Share" ><em class="icon ni ni-share-fill"></em></button>';
		$records[] = $rows;
	}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	echo json_encode($output);
}
// Role Table Insert
if(!empty($_POST['action']) && $_POST['action'] == 'addRole') {  
	$data['role_name'] = $_POST["name"];
    $role_insert = execute_insert("role_master", $data);
	if($role_insert ){
		echo json_encode(array("response"=>'Inserted Successfully', "status" => 'success','data' => $role_insert));
	}	
}
// WordCount List
if(!empty($_POST['action']) && $_POST['action'] == 'listWordCount') {
	$get_data = select_query('country_cost_master', array('country_id', 'country_name', 'currency', 'rate', 'country_mobile_extention', 'dissertation_rate'),array(),'order by `country_id` desc');
	
	if(count($get_data) > 0)
	{
		foreach($get_data as $key => $val){ 
		
			$rows = array();
			$rows[] = $val['country_id'];
			$rows[] = $val['country_name'];
			$rows[] = $val['currency'];
			$rows[] = $val['rate'];
			$rows[] = $val['country_mobile_extention'];		
			$rows[] = $val['dissertation_rate'];
			$rows[] = '<button type="button" name="update" id="'.$val['country_id'].'" onclick="edit_rate_chart(this);" data-id="'.$val['country_id'].'" class="btn btn-sm btn-outline-info mt-3"data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><em class="icon ni ni-edit-alt"></em></button>&nbsp;&nbsp;<button type="button" name="delete" id="'.$val['country_id'].'" class="btn btn-sm btn-primary mt-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Share" ><em class="icon ni ni-share-fill"></em></button>';
			$records[] = $rows;
		}
	}
	else
	{
		$records = [];
	}
	
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// Word Count Table Insert
if(!empty($_POST['action']) && $_POST['action'] == 'addCountry') {  
	$data['country_id'] = $_POST["country_id"];
	$data['country_name'] = $_POST["name"];
    $data['country_mobile_extention'] = $_POST["country_code"];
	$data['rate'] = $_POST["rate"];
	$data['currency'] = $_POST['currency'];
	$data['word_limit'] = $_POST['word_count'];
    $word_count = execute_insert("country_cost_master", $data);
	if($word_count ){
		echo json_encode(array("response"=>'Inserted Successfully', "status" => 'success','data' => $word_count));
	}	
}

// Invoice Table List
if(!empty($_POST['action']) && $_POST['action'] == 'datainvoice') {
	if(in_array($_SESSION['emp_role'],$download_button_ticket_applicable) ){
		$data_sql = "SELECT ticket_master.ticket_id,ticket_master.total_value, invoice_master.invoice_number, invoice_master.word_count, invoice_master.std_rate, invoice_master.invoice_date, invoice_master.updated_at,currency FROM ticket_master JOIN invoice_master ON ticket_master.ticket_id = invoice_master.ticket_id join country_cost_master on ticket_master.country_id = country_cost_master.country_id ORDER BY ticket_master.ticket_id desc";
	}else{
		$data_sql = "SELECT ticket_master.ticket_id,ticket_master.total_value, invoice_master.invoice_number, invoice_master.word_count, invoice_master.std_rate, invoice_master.invoice_date, invoice_master.updated_at,currency FROM ticket_master JOIN invoice_master ON ticket_master.ticket_id = invoice_master.ticket_id join country_cost_master on ticket_master.country_id = country_cost_master.country_id where ticket_master.created_by =" .$_SESSION['emp_id']." ORDER BY ticket_master.ticket_id desc";
	}
	
	$get_record = execute_query($data_sql);
	$cost = ($get_record[0]['total_value'])*($get_record[0]['word_count']);


	foreach($get_record as $key => $val){ 
		
		$rows = array();
		if(isset($val['updated_at']))
		{
			$dates = explode(' ', ($val['updated_at']));
			$get_date = $dates[0];
		}
		else {
			$get_date = "Not Available";
		}
		$rows[]	= '<input type="checkbox" class="custom-control-input" id="customCheck1">';		
		$rows[] = '<span data-bs-toggle="tooltip" data-bs-placement="top" data-id="'.$val['ticket_id'].'" onclick="get_id(this);">ID <b>#</b>'.$val['ticket_id'].'<br>Word Count:&nbsp'.($val['word_count']).'<br>Cost:&nbsp'.($val['total_value']).' '.$val['currency'].'</span>';
		if($get_date == 0000-00-00){
			$get_date = "N/A";
			$rows[]= '<span<small>Invoice Date:</small> '.$val['invoice_date'].'<br><small>Final Invoice Date:</small> &nbsp;'.$get_date.'</span>';
		}
		else{	
			$rows[]= '<span<small>Invoice Date:</small> '.$val['invoice_date'].'<br><small>Final Invoice Date:</small> &nbsp;'.$get_date.'</span>';
		}
		$rows[] = '<a href="html/download_invoice.php?file='.$val['invoice_number'].'.pdf"><button class="btn btn-sm btn-primary mt-3"><em class="icon ni ni-printer-fill"></em></button></a>';	
		$records[] = $rows;
	}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}

// Category List
if(!empty($_POST['action']) && $_POST['action'] == 'list_category') {
	$get_data = select_query('category_master', array('category_id', 'category_name', 'category_description'),array(),'order by `category_id` desc');

	if(count($get_data) > 0)
	{
		foreach($get_data as $key => $val){ 
		
			$rows = array();
			$rows[] = $val['category_id'];
			$rows[] = $val['category_name'];
			$rows[] = $val['category_description'];			
			$rows[] = '<button type="button" name="update" id="editcat" data-id="'.$val['category_id'].'" class="btn btn-sm btn-outline-info mt-3 "onclick="category(this);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-target="#modcategory" title="Edit"><em class="icon ni ni-edit-alt"></em></button>';
			$records[] = $rows;
		}
	}
	else
	{
		$records = [];
	}
	
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// Category Table Insert
if(!empty($_POST['action']) && $_POST['action'] == 'addCategory') {  
	
	$data['category_name'] = $_POST["name"];
    $data['category_description'] = $_POST["description"];
    $ticket_id = execute_insert("category_master", $data);
	if($ticket_id ){
		echo json_encode(array("response"=>'Inserted Successfully', "status" => 'success','data' => $ticket_id));
	}	
}

//Category details view in modal
if(!empty($_POST['action']) && $_POST['action'] == 'get_category') {
	$get_id = $_POST['data_id'];
	$get_info = select_query('category_master',array('category_name','category_description'),array('category_id' => $get_id));
	if($get_info)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_info));
	}
	
}
//category edit in modal
if(!empty($_POST['action']) && $_POST['action'] == 'updatecategory') {
	$update_ticket = execute_update('category_master',array('category_name'=>$_POST['modcategoryname'],'category_description'=>$_POST['moddescription']), array('category_id'=>$_POST['modcategory_id']));
	if($update_ticket)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$update_ticket));
	}
	
}
if(!empty($_POST['action']) && $_POST['action'] == 'getRateByCountry') { 
	$data['country_id'] = $_POST["data"];
	$get_data_currency = select_query('country_cost_master', array('rate', 'currency','dissertation_rate', 'word_limit'),$data);
	if($get_data_currency){
		echo json_encode(array("response"=>'Country Wise Rate Fetch Sucessfully', "status" => 'success','data' => $get_data_currency));
	}	
}

if(!empty($_POST['action']) && $_POST['action'] == 'getAdvanceDetailsById'){
	$data['p_id'] = $_POST['payment_id'];
	
	$get_payment_details = select_query("payment_master",array("ticket_id","transaction_id","amount_received", "accounts_approval_date", "date_added","file_name","get_comments"),array("p_id" => $data['p_id']));
	$get_data = select_query('invoice_master', array('invoice_number', 'invoice_amount'),array('ticket_id' => $get_payment_details[0]['ticket_id']));
	$payment_date = explode(' ', $get_payment_details[0]['date_added']);
	$get_curr_data_sql = "select amount_in_currency,country_cost_master.currency from currency_to_inr inner join country_cost_master on currency_to_inr.currency COLLATE utf8mb4_general_ci = country_cost_master.currency inner join ticket_master on country_cost_master.country_id COLLATE utf8mb4_general_ci = ticket_master.country_id where ticket_master.ticket_id = ".$get_payment_details[0]['ticket_id']." and currency_to_inr.date LIKE '$get_date_today%'";
	$sql = "SELECT SUM(amount_received) AS Total_paid FROM payment_master where ticket_id = ".$get_payment_details[0]['ticket_id'];
	$get_curr_data = execute_query($get_curr_data_sql);
	if(empty($get_curr_data[0]['amount_in_currency']))
	{
		echo json_encode(array("response"=>'Current Rate didnot find', "status" => 'success','data' => "No Data Found"));
	}
	else{
		$amount = execute_query($sql);
		$get_data[0]['attachment'] = $payment_date[0];
		$get_data[0]['Total_paid'] = $amount[0]['Total_paid'];
		$get_data[0]['currency'] = $get_curr_data[0]['currency'];
		$get_data[0]['exchange'] = $get_curr_data[0]['amount_in_currency'];
		$get_data[0]['file_name'] = $get_payment_details[0]['file_name'];
		$get_data[0]['ticket_id'] = $get_payment_details[0]['ticket_id'];
		$get_data[0]['get_remarks'] = $get_payment_details[0]['get_comments'];
		$html = '';
		foreach($get_payment_details as $key => $val){ 
			$html .= '<tr>';
			$html .='<td>'.$val['transaction_id'].'</td>';
			$html .='<td>'.$val['amount_received'].'</td>';
			$html .='<td>'.$val['accounts_approval_date'].'</td>';
			$html .= '</tr>';
		}
		$get_data[0]['html'] = $html;
		if($get_data){
			echo json_encode(array("response"=>'Invoice amount Fetch Succesfully', "status" => 'success','data1' => $get_data,'data2' => $get_data[0]['file_name']));
		}
   }
}

if(!empty($_POST['action']) && $_POST['action'] == 'get_rate'){
	$data['ticket_id'] = $_POST['ticket_id'];
	$query = "select amount_in_currency from currency_to_inr inner join country_cost_master on currency_to_inr.currency COLLATE utf8mb4_general_ci = country_cost_master.currency inner join ticket_master on country_cost_master.country_id COLLATE utf8mb4_general_ci = ticket_master.country_id where ticket_master.ticket_id = ".$data['ticket_id']." and currency_to_inr.date LIKE '".$_POST['date']."%'";
	$amount = execute_query($query);
	if($amount){
		echo json_encode(array("response"=>'Inr Rate fetch successfully', "status" => 'success','data' => $amount[0]['amount_in_currency']));
	}else{
		echo json_encode(array("response"=>'Inr Rate Not available', "status" => 'success','data' => 0));
	}
}

if(!empty($_POST['action']) && $_POST['action'] == 'addAdvancePayment'){
    
	$data['accounts_approval_date'] = $_POST['accounts_approval_date'];
	$data['transaction_date'] = $_POST['transaction_date'];
	$data['bank_details_id'] = $_POST['bank'];
	$data['invoice_number'] = $_POST['invoice_number'];
	$data['amount_received'] = $_POST['ticket_advance'];
	$data['transaction_id'] = $_POST['advance_transction_id'];
	$data['status_id'] = $payment_status['Advance_Received'];
	$data['accounts_approval_by'] = $_SESSION['emp_id'];
	$data['inr_rate'] = $_POST['rate_current'];
	$data['status'] = "Success";
	$ticket_value = $_POST['ticket_value'];
	$ticket_advance = $_POST['ticket_advance'];
	$get_ticket_id = select_query("payment_master", array("ticket_id"), array('p_id' => $_POST['advance_payment_id']));

	$txn_id = execute_update("payment_master", $data, array('p_id' => $_POST['advance_payment_id']) ); 
	if($ticket_value == $ticket_advance){
		// $update_ticket = execute_update('ticket_master',array('status' => $ticket_status['Payment_Recieved']),array('ticket_id' => $get_ticket_id[0]['ticket_id']));
		$update_ticket = execute_update('ticket_master',array('status_payment' => $ticket_status['Payment_Recieved']),array('ticket_id' => $get_ticket_id[0]['ticket_id']));
		echo json_encode(array("response"=>'Payment Added Successfully', "status" => 'success','data' => $txn_id));
	}
		else{
			// $update_ticket = execute_update('ticket_master',array('status' => $ticket_status['Advanced_Recieved']),array('ticket_id' => $get_ticket_id[0]['ticket_id']));
			$update_ticket = execute_update('ticket_master',array('status_payment' => $ticket_status['Advanced_Recieved']),array('ticket_id' => $get_ticket_id[0]['ticket_id']));
			echo json_encode(array("response"=>'Payment Added Successfully', "status" => 'success','data' => $txn_id));
		}
		
}

if(!empty($_POST['action']) && $_POST['action'] == 'get_adv_data'){
	$data['p_id'] = $_POST['get_p_id'];
	$sql = "SELECT SUM(amount_received) AS Total_paid FROM payment_master where p_id = ".$data['p_id'];
	$get_amount = execute_query($sql);
	$query_advance = select_query('payment_master', array('amount_received', 'accounts_approval_date', 'transaction_date', 'bank_details_id', 'invoice_number', 'amount_received', 'transaction_id', 'inr_rate', 'ticket_id', 'file_name','get_comments'),$data);
	$get_ticket_data = select_query('invoice_master', array('invoice_amount'),array('ticket_id' => $query_advance[0]['ticket_id']));
	$query_advance[0]['amount'] = $get_amount[0]['Total_paid'];
	$query_advance[0]['invoice_amount'] = $get_ticket_data[0]['invoice_amount'];
	$html = '';
		foreach($query_advance as $key => $val){ 
			$html .= '<tr>';
			$html .='<td>'.$val['transaction_id'].'</td>';
			$html .='<td>'.$val['amount_received'].'</td>';
			$html .='<td>'.$val['accounts_approval_date'].'</td>';
			$html .= '</tr>';
		}
		$query_advance[0]['html'] = $html;

	if($query_advance){
		echo json_encode(array("response"=>'Advance Record fetch successfully', "status" => 'success','data' => $query_advance, 'data2' => $query_advance[0]['file_name']));
	}
}

// For assigned smes
if(!empty($_POST['action']) && $_POST['action'] == 'getTicketDetailsById'){
	$data['ticket_id'] = $_POST['ticket_id'];
	$get_data = select_query('ticket_master', array('ticket_id', 'assigned_ids'),$data);
	if($get_data){
		echo json_encode(array("response"=>'Ticket Data Fetch Successfully', "status" => 'success','data' => $get_data));
	}
}
// For assigned quality analyst data
if(!empty($_POST['action']) && $_POST['action'] == 'getQualityDetailsById'){
	$data['ticket_id'] = $_POST['ticket_id'];
	$get_data = select_query('ticket_master', array('ticket_id', 'assigned_quality'),$data);
	if($get_data){
		echo json_encode(array("response"=>'Ticket Data Fetch Successfully', "status" => 'success','data' => $get_data));
	}
}
// Insert Data for sme, quality analysts and filesystem
// For Sme Assign
if(!empty($_POST['action']) && $_POST['action'] == 'addAssignedSme'){
	$get_ticket_id = $_POST['ticket_id_sme_assign'];
	$get_attachment = select_query('input_documents', array('id','file_name','extension'),array('ticket_id' => $get_ticket_id));
	$file_With_path_array = array();
	$emp_assign_ids = ($_POST['assign_sme']);


	$get_sme_ids = implode(",",$emp_assign_ids);
	foreach($get_attachment  as $key => $val){
		$path = "../upload/".$val['file_name'];
		array_push($file_With_path_array,$path);
	}

	// echo $_SESSION['emp_id'];die();
	$get_role_rem = select_query("employees_master",array('emp_role'),array('emp_id' => $_SESSION['emp_id']));
	$data_rem_insert = execute_insert("ticket_desc", array('ticket_id' => $get_ticket_id,'role' => $get_role_rem[0]['emp_role'], 'ticket_desc' => $_POST['prod_remarks'], 'created_by' => $_SESSION['emp_id']));	

	// Send mail for assigned smes
	foreach($_POST['assign_sme'] as $key){
		$data['ticket_id'] = $_POST['ticket_id_sme_assign'];
		$data['emp_id'] = $key;
		$data['task_type'] = "Sme";
		$data['status'] = $task_status['Task_Assigned'];
		$data['assigned_by'] = $_SESSION['emp_id'];
		$txn_id1 = execute_insert("task_master", $data);
		$get_sme_data = select_query('employees_master', array('emp_email','emp_name'),array('emp_id' => $key));
		$template_details = select_query("template_master",array('template_subject','template_body'),array('template_type' => 'task_assigned'));
		$datas = array();
		$datas['ticket_id'] = $_POST['ticket_id_sme_assign'];
		$email_subject = prepare_mail_msg( $template_details[0]['template_subject'],$datas);
		$datas['first_name'] = $get_sme_data[0]['emp_name'];
		$email_body = prepare_mail_msg( $template_details[0]['template_body'],$datas);
		
		send_mail_attachment_multi($get_sme_data[0]['emp_email'],$email_subject,$email_body,$file_With_path_array);
	}
	$update_ticket1 = execute_update('ticket_master',array('assigned_ids' => $get_sme_ids, 'status' => $ticket_status['Project_Assigned_To_Sme'], 'is_viewed' => 0),array('ticket_id' => $get_ticket_id));
	// outside email check
	if(isset($_POST['check_box']) && $_POST['check_box']!= ''){
		if(!empty($_POST['client_email_output_data'])){
			$get_emails = explode(",",$_POST['client_email_output_data']);
			array_push($get_emails);
			foreach($get_emails as $key){
				prepare_mail_msg($template_details[0]['template_subject'],$get_emails);
				send_mail_attachment_multi($key,$email_subject,$email_body,$file_With_path_array);
			}
		}
	}
	echo json_encode(array("response"=>'Mail Send to smes Successfully', "status" => 'success'));
}
// All Projects
if(!empty($_POST['action']) && $_POST['action'] == 'project_all') {
	$sql = "SELECT t.ticket_id, t.status, t.assigned_deadline, TIMEDIFF(t.assigned_deadline,ADDTIME(SYSDATE(),'0 05:30:00')) as restTime, t.assigned_ids FROM ticket_master as t join assign_master as am on t.ticket_id = am.ticket_id where t.status IN ($get_team_manager_ticket_status_applicable) AND am.assign_id = ".$_SESSION['emp_id']."";
	$emp_details = select_query("employees_master",array("emp_id","emp_name", "emp_email")); 
	
	$get_data = execute_query($sql);
	$employees_Array_details = array();
	foreach($emp_details as $key =>  $val){
		$employees_Array_details[$val['emp_id']] = $val['emp_name'];
		$employees_email_details[$val['emp_id']] = $val['emp_email'];
	}
	foreach($get_data as $key => $val){ 
		
		$rows = array();
		
		$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);"style="cursor:pointer;">ID <b>#</b>'.$val['ticket_id'].'</span>';

		$earlier = new DateTime(date('Y-m-d'));
		$later = new DateTime($val['assigned_deadline']);
		$pos_diff = $earlier->diff($later)->format("%r%a");

		if($val['assigned_deadline'] != '0000-00-00 00:00:00')
		{
			if($pos_diff <= 2){
				$rows[] = '<span class="text-danger">'.$pos_diff.' Days Left</span>';
			}else{
				$rows[] = '<span class="text-success">'.$pos_diff.' Days Left</span>';
			}
		}

		else{
			$rows[] = '<span class="text-primary">Sorry, No Date Found</span>';
		}	

		if($val['status'] == $ticket_status['Ticket_Created']){
			$rows[] = '<span class="badge badge-dot bg-danger">'.$val['status'].'</span>';
		}
		else if($val['status'] == $ticket_status['Ticket_Close']){
			$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
		}
		else if($val['status'] == $ticket_status['Ticket_Archieve']){
			$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
		}
		else{
			$rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].'</span>';
		}
		
		if($val['status'] == $ticket_status['Ticket_Close'])
		{
			$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn btn-outline-primary mt-3" onclick="archieve_ticket(this);" title="Make Archieve"><em class="icon ni ni-archive"></em></button>';
		}

		$records[] = $rows;
	}
	
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// Project Listing
if(!empty($_POST['action']) && $_POST['action'] == 'project_listing') {
	$sql = "SELECT t.ticket_id, t.status, t.assigned_deadline, t.status, TIMEDIFF(t.assigned_deadline,ADDTIME(SYSDATE(),'0 05:30:00')) as restTime, t.assigned_ids FROM ticket_master as t join assign_master as am on t.ticket_id = am.ticket_id where t.status IN ($get_team_lead_ticket_status_applicable) AND am.assign_id = ".$_SESSION['emp_id']."";
	$emp_details = select_query("employees_master",array("emp_id","emp_name", "emp_email")); 
	
	$get_data = execute_query($sql);
	$employees_Array_details = array();

	if(!empty($emp_details))
	{
		foreach($emp_details as $key =>  $val){
			$employees_Array_details[$val['emp_id']] = $val['emp_name'];
			$employees_email_details[$val['emp_id']] = $val['emp_email'];
		}
	}
	
	if(count($get_data) > 0 )
	{
		foreach($get_data as $key => $val){ 
		
			$rows = array();
			
			$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);" style="cursor:pointer;">ID <b>#</b>'.$val['ticket_id'].'</span>';
			// For Assigned Ids
			$html_sme='';
			$html_sme .= '<ul class="preview-list g-1">';
			if(!empty($val['assigned_ids'])){
				$emp_id_array = explode(",",$val['assigned_ids']);
				foreach($emp_id_array as $key1){
					$name_intial = printInitials($employees_Array_details[$key1]);
					$get_name = $employees_Array_details[$key1];
					$get_email =$employees_email_details[$key1];
						$html_sme .='<li class="preview-item"><div class="user-avatar"><spandata-bs-toggle="tooltip" data-bs-placement="top" title="'.$get_name.'('.$get_email.')'.'" style="cursor:pointer;">'.$name_intial.'</span></div></li>';
				}
				$html_sme .= '</ul>';
			}else{
				$html_sme = 'n/a';
			}
			$rows[]= $html_sme;
	
			$earlier = new DateTime(date('Y-m-d'));
			$later = new DateTime($val['assigned_deadline']);
			$pos_diff = $earlier->diff($later)->format("%r%a"); 
	
			if($val['assigned_deadline'] != '0000-00-00 00:00:00')
			{
				if($pos_diff <= 2){
					$rows[] = '<span class="text-danger">'.$pos_diff.' Days Left</span>';
				}else{
					$rows[] = '<span class="text-success">'.$pos_diff.' Days Left</span>';
				}
			}
	
			else{
				$rows[] = '<span class="text-primary">Sorry, No Date Found</span>';
			}	
	
			if($val['status'] == $ticket_status['Ticket_Created']){
				$rows[] = '<span class="badge badge-dot bg-danger">'.$val['status'].'</span>';
			}
			else if($val['status'] == $ticket_status['Ticket_Close']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else if($val['status'] == $ticket_status['Ticket_Archieve']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else{
				$rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].'</span>';
			}
	
			if($val['status'] == $ticket_status['Ticket_Close'])
			{
				$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn btn-outline-primary mt-3" onclick="archieve_ticket(this);" title="Make Archieve"><em class="icon ni ni-archive"></em></button>';
			}
	
			$btn = '';

			if((!in_array($val['status'], $tl_ticket_status_applicable))){
			$btn .= '<div class="btn-group" aria-label="Basic example"><button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-warning mt-3" onclick="view_all_attachment(this);" title="view"><em class="icon ni ni-eye-alt-fill"></em></button>&nbsp; ';
			}

			$btn .= '<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-success mt-3" onclick="modalAddRemarks(this);" title="View Remarks"><em class="icon ni ni-note-add"></em></button>&nbsp; ';

			if($val['status'] != $ticket_status['tl_upload_complete']){
				$btn .= '<button type="button" id="uploadtlbutton" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-dim btn-outline-info mt-3" data-bs-target="#uploadAttachment"onclick="modaluploadtlattachment(this);" title="Upload"><em class="icon ni ni-upload"></em></button>';
			}
	
			$rows[] = $btn;  
	
			$records[] = $rows;
		}
	}
	else
	{
		$records = [];
	}
	
	
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// For assigned quality analyst data
if(!empty($_POST['action']) && $_POST['action'] == 'get_assign_smes'){
	$data['ticket_id'] = $_POST['ticket_id'];
	$get_data_assign = select_query('ticket_master', array('ticket_id', 'assigned_ids'),$data);
	if($get_data_assign){
		echo json_encode(array("response"=>'Ticket Data Fetch Successfully', "status" => 'success','data' => $get_data_assign));
	}
}
// Get Team Leader Remarks
if(!empty($_POST['action']) && $_POST['action'] == 'addTLRemarks') {
	$get_ticket_id_for_comment = $_POST['ticket_id_TeamLead_Comment'];
	$get_tl_comment = addslashes($_POST['add_TLremarks']);
	$add_role_rem = select_query("employees_master",array('emp_role'),array('emp_id' => $_SESSION['emp_id']));
	if(isset($_FILES['UploadAttachment']['name'][0]))
	{	
		$file_path = "get_desc_ticket";
		$name = file_upload($_FILES['UploadAttachment'],$file_path);
			foreach($name as $key){ 
				$extn_array = explode(".",$key);
				$extn = $extn_array[1];
				$data = array();
				$extn = strtolower($extn);
				$data['file_name'] = $key;
				// if(in_array($extn,$image_exten)){
				// 	$data['file_name'] = $key; 
				// }
				// if(in_array($extn,$doc_exten)){
				// 	$data['file_name'] = $key;
				// }
				// if(in_array($extn,$pdf_exten)){
				// 	$data['file_name'] = $key;
				// }
				// if(in_array($extn,$video_exten)){
				// 	$data['file_name'] = $key;
				// }
				// if(in_array($extn,$excel_exten)){
				// 	$data['file_name'] = $key;
				// }
			}
		$add_rem_insert = execute_insert("ticket_desc", array('ticket_id' => $get_ticket_id_for_comment,'role' => $add_role_rem[0]['emp_role'], 'ticket_desc' => $get_tl_comment, 'created_by' => $_SESSION['emp_id'], 'desc_file' => $data['file_name']));
	}
	else{
		$add_rem_insert = execute_insert("ticket_desc", array('ticket_id' => $get_ticket_id_for_comment,'role' => $add_role_rem[0]['emp_role'], 'ticket_desc' => $get_tl_comment, 'created_by' => $_SESSION['emp_id']));	
	}
	if($add_rem_insert)
	{
		echo json_encode(array("response"=>'Remarks Added Successfully', "status" => 'success', "data"=>$add_rem_insert));
	}	
}
// Get Quality Analyst Remarks
if(!empty($_POST['action']) && $_POST['action'] == 'get_quality_rem') {
	$get_ticket_id = $_POST['ticket_id'];
	$get_qa_rem = select_query('task_master',array('ticket_id', 'remarks_qa'),array('ticket_id' => $get_ticket_id));
	if($get_qa_rem)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_qa_rem));
	}	
}
// New Ticket records
if(!empty($_POST['action']) && $_POST['action'] == 'record_new_ticket'){ 
	$query_new_tickets = "SELECT t.ticket_id, t.status, t.assigned_deadline, TIMEDIFF(t.assigned_deadline,ADDTIME(SYSDATE(),'0 05:30:00')) as restTime, am.assign_id FROM ticket_master as t join assign_master as am on t.ticket_id = am.ticket_id where t.status = '".$ticket_status['Assign_to_tl']."' AND am.assign_id = ".$_SESSION['emp_id']."";
	$get_new_tickets_data = execute_query($query_new_tickets);

	if(count($get_new_tickets_data) > 0)
	{
		foreach($get_new_tickets_data as $key => $val){ 
				
			$rows = array();
			$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);">ID <b>#</b>'.$val['ticket_id'].'</span>';
			$earlier = new DateTime(date('Y-m-d'));
			$later = new DateTime($val['assigned_deadline']);
			$pos_diff = $earlier->diff($later)->format("%r%a");

			if($val['assigned_deadline'] != '0000-00-00 00:00:00')
			{
				if($pos_diff <= 2){
					$rows[] = '<span class="text-danger">'.$pos_diff.' Days Left</span>';
				}else{
					$rows[] = '<span class="text-success">'.$pos_diff.' Days Left</span>';
				}
			}

			else{
				$rows[] = '<span class="text-primary">Sorry, No Date Found</span>';
			}	

			if($val['status'] == $ticket_status['Quality_Check_Failed']){
				$rows[] = '<span class="badge badge-dot bg-danger">'.$val['status'].'</span>';
			}
			else if($val['status'] == $ticket_status['Ticket_Close']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else if($val['status'] == $ticket_status['Ticket_Archieve']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else{
				$rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].'</span>';
			}

			$btn = '';

			$btn .= '<div class="btn-group" aria-label="Basic example"> <button type="button" id="advance-payment" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-primary mt-3" onclick="assignedSmes(this);" title="Assign Smes"><em class="icon ni ni-plus-round-fill"></em></button>&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-warning mt-3" onclick="view_attchment(this);" title="view"><em class="icon ni ni-eye-alt-fill"></em></button>';
			$btn .= '&nbsp;&nbsp;<a href =html/?action=ticket_description&ticketId='.$val['ticket_id'].' class="btn btn-sm btn-outline-info mt-3" target="_blank" title="Check All Remarks"><em class="icon ni ni-notice"></em></a>';

				$rows[] = $btn;

				$records[] = $rows;
		}
	}
	else
	{
		$records = [];
	}

			

	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// View Ticket Attachments For Product Manager
if(!empty($_POST['action']) && $_POST['action'] == 'get_product_attachment_by_id') {
	$get_id = $_POST['ticket_id'];
	$get_ticket_input_info = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => $document_type['Input']));

	// if($get_ticket_input_info)
	// {
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_ticket_input_info));
	// }	
}
// View Ticket Attachments For Team Manager
if(!empty($_POST['action']) && $_POST['action'] == 'get_product_attachment_by_sme') {
	$get_id = $_POST['ticket_id'];
	$get_ticket_input_info = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => $document_type['Input']));

	$get_ticket_output_info_tl = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => $document_type['Check_For_Quality']));

	$get_ticket_tl_info = execute_query("SELECT `file_name`, `extension` FROM `input_documents` where `documents_type` IN ('".$document_type['Tl_Uploaded']."', '".$document_type['Check_For_tm']."')and `ticket_id` = $get_id");

	// if($get_ticket_input_info)
	// {
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data1"=>$get_ticket_input_info, "data2"=>$get_ticket_output_info_tl, "data3"=>$get_ticket_tl_info));
	// }	
}
// View Ticket Attachments For Team Manager
if(!empty($_POST['action']) && $_POST['action'] == 'get_product_attachment_by_tl') {
	$get_id = $_POST['ticket_id'];
	$get_ticket_input_info = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => $document_type['Input']));

	$get_ticket_output_info = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => $document_type['Check_For_tm']));

	// $get_ticket_tl_info = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => $document_type['Tl_Uploaded']));
	$get_ticket_tm_info = execute_query("SELECT `file_name`, `extension` FROM `input_documents` where `documents_type` IN ('".$document_type['Tm_Uploaded']."', '".$document_type['Check_For_pm']."') and `ticket_id` = $get_id");

	// if($get_ticket_input_info)
	// {
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data1"=>$get_ticket_input_info, "data2"=>$get_ticket_output_info, "data3"=>$get_ticket_tm_info));
	// }	
}
// View Ticket Attachments For Project Manager
if(!empty($_POST['action']) && $_POST['action'] == 'get_product_attachment_by_tm') {
	$get_id = $_POST['ticket_id'];
	$get_ticket_input_info = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => $document_type['Input']));

	$get_ticket_output_info = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => $document_type['Check_For_pm']));

	// $get_ticket_tl_info = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => $document_type['Tl_Uploaded']));
	$get_ticket_pm_info = execute_query("SELECT `file_name`, `extension` FROM `input_documents` where `documents_type` IN ('".$document_type['Pm_Uploaded']."', '".$document_type['Check_For_client']."') and `ticket_id` = $get_id");

	// if($get_ticket_input_info)
	// {
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data1"=>$get_ticket_input_info, "data2"=>$get_ticket_output_info, "data3"=>$get_ticket_pm_info));
	// }	
}
// View Ticket Description Attachments 
if(!empty($_POST['action']) && $_POST['action'] == 'get_ticket_desc_by_id') {
	$get_id = $_POST['ticket_id'];
	$get_ticket_desc_info = select_query('ticket_desc',array('desc_file'),array('ticket_id' => $get_id));

	// if($get_ticket_input_info)
	// {
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_ticket_desc_info));
	// }	
}
// Get Ticket Data for Product Listing
if(!empty($_POST['action']) && $_POST['action'] == 'get_ticket_desc') {
	$get_data_ticket_id = $_POST['ticket_id'];
	$get_ticket_input_data = select_query('ticket_master',array('ticket_id','ticket_desc'),array('ticket_id' => $get_data_ticket_id));
	if($get_ticket_input_data)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_ticket_input_data));
	}	
}
// Ticket Archieve
if(!empty($_POST['action']) && $_POST['action'] == 'getTicketStatusById'){ 
	$archieve_ticket = execute_update('ticket_master', array('status' => 'Ticket Archieve'), array('ticket_id' => $_POST['ticket_id']));
	echo json_encode(array("response"=>'Archive Successfully', "status" => 'success'));
};

// Payment Listing
if(!empty($_POST['action']) && $_POST['action'] == 'payment_data') {
	if($_SESSION['emp_role'] == "Admin" || $_SESSION['emp_role'] == "Accounts"){
		// $exec_quality_sql = "select payment_master.p_id, payment_master.ticket_id, payment_master.transaction_date, payment_master.date_added,payment_master.accounts_approval_date, payment_master.invoice_number, payment_master.amount_received, payment_master.inr_rate,invoice_master.invoice_amount from payment_master join ticket_master on payment_master.ticket_id= ticket_master.ticket_id join invoice_master on payment_master.ticket_id = invoice_master.ticket_id  order by payment_master.ticket_id desc";
		$exec_quality_sql = "select payment_master.p_id, payment_master.ticket_id, payment_master.transaction_date, payment_master.date_added,payment_master.accounts_approval_date, invoice_master.invoice_number, payment_master.amount_received, payment_master.inr_rate,invoice_master.invoice_amount from payment_master join ticket_master on payment_master.ticket_id= ticket_master.ticket_id join invoice_master on payment_master.ticket_id = invoice_master.ticket_id  order by payment_master.ticket_id desc";
	}
	else{
			$get_id_ticket = select_query('ticket_master', array('ticket_id'), array('created_by' => $_SESSION['emp_id']));
			$get_payment_ticket_id = array();
			foreach($get_id_ticket as $key => $val){ 
				array_push($get_payment_ticket_id, $val['ticket_id']);
			}
			$select_id_ticket = implode(", ",$get_payment_ticket_id);

			// $exec_quality_sql = "select payment_master.p_id, payment_master.ticket_id, payment_master.transaction_date, payment_master.accounts_approval_date, payment_master.invoice_number,payment_master.date_added, payment_master.amount_received, payment_master.inr_rate,invoice_master.invoice_amount from payment_master join ticket_master on payment_master.ticket_id= ticket_master.ticket_id inner join invoice_master on payment_master.ticket_id = invoice_master.ticket_id where ticket_master.ticket_id in ($select_id_ticket)";
			$exec_quality_sql = "select payment_master.p_id, payment_master.ticket_id, payment_master.transaction_date, payment_master.accounts_approval_date, invoice_master.invoice_number,payment_master.date_added, payment_master.amount_received, payment_master.inr_rate,invoice_master.invoice_amount from payment_master join ticket_master on payment_master.ticket_id= ticket_master.ticket_id inner join invoice_master on payment_master.ticket_id = invoice_master.ticket_id where ticket_master.ticket_id in ($select_id_ticket)";
		}

	
	$get_data = execute_query($exec_quality_sql);

	if(count($get_data) > 0)
	{
		foreach($get_data as $key => $val){ 
		
			$rows = array();
			$get_id = $val['ticket_id'];
			$rows[] = '<span data-bs-toggle="tooltip" data-bs-placement="top" style="cursor:pointer;">'.$val['ticket_id'].'</span>';
	
			$rows[] = $val['invoice_number'];
			$rows[] = $val['amount_received'];	
			$rows[] = (($val['amount_received'])*($val['inr_rate']));
			$rows[] = $val['invoice_amount'];
			$date_arr = explode(" ",$val['date_added']);
			$rows[] = $date_arr[0];
			$rows[] = '<button type="button" name="update" id="editpayment" data-id="'.$val['p_id'].'" class="btn btn-sm btn-info mt-1 "onclick="payment(this);" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><em class="icon ni ni-edit-alt"></em></button>';
			$records[] = $rows;
		}
	}
	else
	{
		$records = [];
	}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// Get Payment information
if(!empty($_POST['action']) && $_POST['action'] == 'get_payment_desc'){
	$data['p_id'] = $_POST['ticket_id'];
	$get_payment_data = select_query('payment_master', array('accounts_approval_date', 'transaction_date', 'transaction_id'),$data);
	
	if($get_payment_data){
		echo json_encode(array("response"=>'Invoice amount Fetch Succesfully', "status" => 'success','data' => $get_payment_data));
	}
}
// Edit Payment Payment Modal
if(!empty($_POST['action']) && $_POST['action'] == 'editPaymentData'){
	$data['accounts_approval_date'] = $_POST['modassigned_for'];
	$data['transaction_date'] = $_POST['moddeadline'];
	$data['transaction_id'] = $_POST['advance_transction_id'];
	$data['status'] = $ticket_status['Payment_Recieved'];

    if(!empty($_FILES['receive_payment']['name'][0])){
        $file_path = "payment_receive";
		$name = file_upload($_FILES['receive_payment'],$file_path);
		foreach($name as $key){ 
			$extn_array = explode(".",$key);
			$extn = $extn_array[1];
			$data = array();
			$extn = strtolower($extn);
			$data['file_name'] = $key;
			// if(in_array($extn,$image_exten)){
			// 	$data['file_name'] = $key; 
			// }
			// if(in_array($extn,$doc_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$pdf_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$video_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$excel_exten)){
			// 	$data['file_name'] = $key;
			// }
		}
			$txn_id = execute_update("payment_master", $data, array('p_id' => $_POST['edit_payement_id']) ); 

	}
	
	else{
		$txn_id = execute_update("payment_master", $data, array('p_id' => $_POST['edit_payement_id']) ); 

	}

	echo json_encode(array("response"=>'Updated Successfully', "status" => 'success', $txn_id));	
}
//bank details
if(!empty($_POST['action']) && $_POST['action'] == 'bankdetails') {
    $get_data = select_query('bank_details', array('ID','account_holder_name','account_number','IFSC_code','account_type','bank_name','upi_id','swift_code','status'),array(),'order by `ID` desc');
	foreach($get_data as $key => $val){ 
		$rows = array();
		$rows[] = $val['ID'];
		$name = '';
		if($val['status'] == 0){
			$name =  $val['account_holder_name'];
		}else{
			$name =  $val['account_holder_name'].'&nbsp;&nbsp;<span class="badge rounded-pill bg-primary">Default</span>';
		}
		$rows[] = $name;
		$rows[]='<span><p> Account Number: '.$val['account_number'].'<br>IFSC Code: &nbsp;'.$val['IFSC_code'].'<br> Account Type: &nbsp;'.$val['account_type'].'<br> Bank Name: &nbsp;'.$val['bank_name'].'<br> UPI ID: &nbsp; '.$val['upi_id'].'<br> Swift Code: &nbsp; '.$val['swift_code'].'</p></span>';
		if($val['status'] == 0){
			$rows[] = '<button type="button" data-id="'.$val['ID'].'" class="btn btn-sm btn-outline-warning mt-3" onclick ="make_default(this)"  id="button-make-default-'.$val['ID'].'"  title="view">Make Default</button>&nbsp;&nbsp;<button type="button" name="update"id="edit" data-id="'.$val['ID'].'" class="btn btn-sm btn-outline-info mt-3 " onclick="test(this);" data-bs-toggle="tooltip" data-bs-target="#updatebankdetails" data-bs-placement="top" title="Edit"><em class="icon ni ni-edit-alt"></em></button>';		
		}else{
			$rows[] = '<button type="button" name="update"id="edit" data-id="'.$val['ID'].'" class="btn btn-sm btn-outline-info mt-3 " onclick="test(this);" data-bs-toggle="tooltip" data-bs-target="#updatebankdetails" data-bs-placement="top" title="Edit"><em class="icon ni ni-edit-alt"></em></button>';	
		}
		$records[] = $rows;
	}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// Send output via mail
if(!empty($_POST['action']) && $_POST['action'] == 'send_output_via_mail') {  
	$sql = 'SELECT customer_email,customer_name from customer_master INNER JOIN ticket_master ON customer_master.customer_id = ticket_master.customer_id WHERE ticket_id = '.$_POST["ticket_id"];
	$get_info = execute_query($sql);
	$output_array = select_query('input_documents', array('file_name'),array('ticket_id' => $_POST["ticket_id"], 'documents_type' => "Output"));
	$path = array();
	foreach($output_array as $key){
		$path_new = $_SERVER["DOCUMENT_ROOT"]."/Writexdemo/upload/".$key['file_name'];
		array_push($path,$path_new);
	}
	if(!empty($_POST['client_email_output'])){
		$emails = explode(",",$_POST['client_email_output']);
		array_push($emails,$get_info[0]['customer_email']);
		foreach($emails as $key){
			$datas = array();
			$template_details = select_query("template_master",array('template_subject','template_body'),array('template_type' => 'Send_Output'));
			$datas['ticket_id'] =  $_POST["ticket_id"];
			$datas['first_name'] = $get_info[0]['customer_name'];
			$email_body = prepare_mail_msg( $template_details[0]['template_body'],$datas);
			$email_subject = $template_details[0]['template_subject'];
			send_mail_attachment_multi($get_sme_data[0]['emp_email'],$email_subject,$email_body,$path);
		}
		execute_update('ticket_master', array('status' => 'Ticket Close'), array('ticket_id' => $_POST['ticket_id']));
	}else{
		send_mail_attachment($get_info[0]['customer_email'],"Send_Output",$path);
		execute_update('ticket_master', array('status' => 'Ticket Close'), array('ticket_id' => $_POST['ticket_id']));
	}
	
	echo json_encode(array("response"=>'Send Successfully', "status" => 'success', "data"=>$get_info));
	
}
//project model
if(!empty($_POST['action']) && $_POST['action'] == 'uploadfiles') {
	$get_id = $_POST['uploadticket_id'];
	 
	if(!empty($_FILES['uploadattachment']['name'][0] )){
		
		$name = file_upload($_FILES['uploadattachment']);
		foreach($name as $key){ 
			$extn_array = explode(".",$key);
			$extn = $extn_array[1];
			
			$data = array();
			$data['ticket_id'] = $get_id; 
			$data['extension'] = $extn;
			$extn = strtolower($extn);
			$data['file_name'] = $key;
			// if(in_array($extn,$image_exten)){
			// 	$data['file_name'] = $key; 
			// }
			// if(in_array($extn,$doc_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$pdf_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$video_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$excel_exten)){
			// 	$data['file_name'] = $key;
			// }
			$data['documents_type'] = $document_type['Check_For_Quality'];

			$ticket_input_id = execute_insert("input_documents", $data);
			execute_update('ticket_master',array('output_documents_id' => 1,'status' => $ticket_status['Quality_Checking_Initiated']),array('ticket_id' => $get_id));

		}
	}
	
}
// Send invoice via email
if(!empty($_POST['action']) && $_POST['action'] == 'send_invoice_via_mail') {  
	$sql = 'SELECT customer_email,customer_name from customer_master INNER JOIN ticket_master ON customer_master.customer_id = ticket_master.customer_id WHERE ticket_id = '.$_POST["ticket_id"];
	$get_info = execute_query($sql);
	$invoice_number_final = final_pdf($_POST["ticket_id"]);
	$path = $_SERVER["DOCUMENT_ROOT"]."/Writexdemo/upload/pdf/".$invoice_number_final.".pdf";
	if(!empty($_POST['client_email_output'])){
		$emails = explode(",",$_POST['client_email_output']);
		array_push($emails,$get_info[0]['customer_email']);
		foreach($emails as $key){
			$template_details = select_query("template_master",array('template_subject','template_body'),array('template_type' => 'send_final_invoice'));
			$datas = array();
			$datas['first_name'] = $get_info[0]['customer_name'];
			$email_body = prepare_mail_msg( $template_details[0]['template_body'],$datas);
			$email_subject = $template_details[0]['template_subject'];
			send_mail_attachment($key,$email_subject,$email_body,$path);
		}
	}else{
		$template_details = select_query("template_master",array('template_subject','template_body'),array('template_type' => 'send_final_invoice'));
		$datas = array();
		$datas['first_name'] = $get_info[0]['customer_name'];
		$email_body = prepare_mail_msg( $template_details[0]['template_body'],$datas);
		$email_subject = $template_details[0]['template_subject'];
		send_mail_attachment($get_info[0]['customer_email'],$email_subject,$email_body,$path);
	}
	
	echo json_encode(array("response"=>'Send Successfully', "status" => 'success', "data"=>$get_info));
	
}
//insert bank details
if(!empty($_POST['action']) && $_POST['action'] == 'addbankdetails') {  
	$data['account_holder_name'] = $_POST["account_holder"];
    $data['account_number'] = $_POST["account_no"];
	$data['IFSC_code'] = $_POST["ifsc_code"];
	$data['account_type']=$_POST["account_type"];
	$data['bank_name']=$_POST["bank_name"];	
	$data['upi_id']=$_POST["upi_id"];	
	$data['swift_code']=$_POST["swift_code"];	
	$emp_add = execute_insert("bank_details", $data);
	
	if($emp_add){
		echo json_encode(array("response"=>'Inserted Successfully', "status" => 'success','data' => $emp_add));
	}
}
//fetch bank details by id
if(!empty($_POST['action']) && $_POST['action'] == 'get_records') {
	$get_id = $_POST['data_id'];
	$get_info = select_query('bank_details',array('account_holder_name','account_number','IFSC_code','account_type','bank_name','upi_id','swift_code'),array('ID' => $get_id));
	if($get_info)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_info));
	}
	
}
// bank details edit in modal
if(!empty($_POST['action']) && $_POST['action'] == 'updatebank') {
	$update_ticket = execute_update('bank_details',array('account_holder_name'=>$_POST['modaccount_holder'],'account_number'=>$_POST['modaccount_no'],'IFSC_code'=>$_POST['modifsc_code'],'account_type'=>$_POST['modaccount_type'],'bank_name'=>$_POST['modbank_name'],'upi_id'=>$_POST['modupi_id'],'swift_code'=>$_POST['modswift_code']), array('ID'=>$_POST['modaccount_id']));
	if($update_ticket)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$update_ticket));
	}
	
}
// Set Default Request
if(!empty($_POST['action']) && $_POST['action'] == 'set_default') {
	$bank_details_id = $_POST["bank_details_id"];
	$set_default = execute_update("bank_details", array('status'=> 1), array('ID' => $_POST["bank_details_id"]));
	$query = "UPDATE `bank_details` SET status = '0' where ID != $bank_details_id";
	$set_status= execute_query_update($query);
	echo json_encode(array("response"=>'Set Successfully', "status" => 'success', "data"=> 1));
	
}
// View Ticket Attachments
if(!empty($_POST['action']) && $_POST['action'] == 'get_attachment_by_id') {
	$get_id = $_POST['ticket_id'];
	$get_ticket_input_info = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => $document_type['Input']));
	// $get_ticket_output_info = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => $document_type['Quality_Checked']));
	$get_ticket_output_info = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => $document_type['Check_For_client']));

	if($get_ticket_input_info || $get_ticket_output_info)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data1"=>$get_ticket_input_info, "data2" => $get_ticket_output_info));
	}	
}
//Template listing
if(!empty($_POST['action']) && $_POST['action'] == 'listTemp') {
	$get_data = select_query('template_master', array('template_id','template_type', 'template_subject', 'template_body'), array(),'order by `template_id` desc');
	
	
	foreach($get_data as $key => $val){ 
		
		$rows = array();
		$rows[] = $val['template_type'];
		$rows[] = $val['template_subject'];
				
		$btn  = '';
		if($val['template_body']){
            $btn .= '<button type="button" data-id="'.$val['template_id'].'" class="btn btn-sm btn-outline-danger" onclick="view_template_body(this);" title="View Template Body"><em class="icon ni ni-file"></em></button>&nbsp; ';
		}
		$btn .= '<button type="button" name="update" id="edit_temp" data-id="'.$val['template_id'].'" class="btn btn-sm btn-outline-info"data-bs-toggle="tooltip" onclick="temp(this)"data-bs-placement="top" title="Edit"><em class="icon ni ni-edit-alt"></em></button>';
		$btn .= '&nbsp;&nbsp;<button type="button" data-type="'.$val['template_type'].'" class="btn btn-sm btn btn-outline-primary" onclick="send_template(this);" title="Send Template Attachment"><em class="icon ni ni-send"></em></button>';
		$rows[] = $btn;
		$records[] = $rows;
	}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// template table insert
if(!empty($_POST['action']) && $_POST['action'] == 'addTemp') { 
	$data['template_type'] = $_POST["temp_type"];
    $data['template_subject'] = $_POST["temp_sub"];
	$data['template_body'] = $_POST["temp_body"];
	$data['created_by'] = $_SESSION['emp_id'];
	 $temp = execute_insert("template_master", $data);
	if($temp ){
		echo json_encode(array("response"=>'Inserted Successfully', "status" => 'success','data' => $temp));

	}	
}
//template details view in modal
if(!empty($_POST['action']) && $_POST['action'] == 'edit_template') {
	$get_id = $_POST['data_id'];
	 
	$get_info = select_query('template_master',array('template_type','template_subject','template_body'),array('template_id' => $get_id));

		if($get_info)
		{
			echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_info));
		}
	
}
//edit template details in modal
if(!empty($_POST['action']) && $_POST['action'] == 'update_temp') {
	$update_template = execute_update('template_master',array('template_type'=>$_POST['modtemp_type'],'template_subject'=>$_POST['modtemp_sub'],'template_body'=>$_POST['modtemp_body']), array('template_id'=>$_POST['modtemp_id']));
		if($update_template)
		{
			echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$update_template));
		}
	
}
// Send template via email
if(!empty($_POST['action']) && $_POST['action'] == 'send_template_via_mail') {  
	
	
	$template_type = $_POST['template_id'];
	if(!empty($_POST['client_email_output'])){
		$emails = explode(",",$_POST['client_email_output']);
		array_push($emails);
		foreach($emails as $key){
			send_mail($key,$template_type);
		}
	}
	
	echo json_encode(array("response"=>'Send Successfully', "status" => 'success'));
	
}
// View Template Attachments
if(!empty($_POST['action']) && $_POST['action'] == 'get_template_body_by_id') {
	$get_temp_id = $_POST['template_id'];
	$get_temp_body = select_query('template_master',array('template_body'),array('template_id' => $get_temp_id));
	if($get_temp_body)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_temp_body[0]['template_body']));
	}	
}
// quality checking data
if(!empty($_POST['action']) && $_POST['action'] == 'data_quality') {
		$data_sql = "select ticket_master.ticket_id, ticket_master.wordcount, ticket_master.status, ticket_master.add_link, assign_master.assign_id FROM ticket_master LEFT JOIN assign_master on ticket_master.ticket_id = assign_master.ticket_id where assign_master.assign_id = '".$_SESSION['emp_id']."'  and ticket_master.status IN ($get_check_quality_ticket_status_applicable)";

	$data_quality = execute_query($data_sql);

	if(count($data_quality) > 0)
	{
		foreach($data_quality as $key => $val){ 
		
			$rows = array();
			$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);" style="cursor:pointer;">ID <b>#</b>'.$val['ticket_id'].'<br>Word Count:&nbsp'.($val['wordcount']).'</span>';
			if($val['status'] == $ticket_status['Quality_Check_Failed']){
				$rows[] = '<span class="badge badge-dot bg-danger">'.$val['status'].'</span>';
			}
			else if($val['status'] == $ticket_status['Quality_Checked']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else{
				$rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].'</span>';
			}
			$btn = '';
			$btn .= '<a href ='.$val['add_link'].' class="btn btn-sm btn-outline-success mt-3" target="_blank" title="View Work Progress"><em class="icon ni ni-activity-alt"></em></a>&nbsp;&nbsp;';

			$btn .= '<div class="btn-group" aria-label="Basic example"> <button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-warning mt-3" onclick="view_check_attachment(this);" title="View Attachment"><em class="icon ni ni-eye-alt-fill"></em></button>';
			{
				$btn .= '&nbsp;&nbsp;<button type="button" id = "revert_quality" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn btn-outline-secondary mt-3" onclick="attachment_revert(this);" title="Revert Attachment"><em class="icon ni ni-repeat-v"></em></button>&nbsp;&nbsp; <button type="button" id="uploaddatabutton" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-dim btn-outline-info mt-3" data-bs-target="#uploadCheckedAttachment"onclick="upload_checked_attchment(this);" title="Check Passed"><em class="icon ni ni-done"></em></button>';
			}
			$rows[] = $btn;
			$records[] = $rows;
		}
	}
	else
	{
		$records = [];
	}
	
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// Completed Quality Check
if(!empty($_POST['action']) && $_POST['action'] == 'data_quality_done') {
	$data_sql = "select ticket_master.ticket_id, ticket_master.wordcount, ticket_master.status, assign_master.assign_id FROM ticket_master LEFT JOIN assign_master on ticket_master.ticket_id = assign_master.ticket_id where assign_master.assign_id = '".$_SESSION['emp_id']."'  and ticket_master.status IN ('".$ticket_status['Quality_Checked']."','".$ticket_status['Quality_Check_Failed']."')";

	$data_quality = execute_query($data_sql);

	$records = [];
	if(!empty($data_quality)){
		foreach($data_quality as $key => $val){ 
		
			$rows = array();
			$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);" data-bs-placement="top" style="cursor:pointer;">ID <b>#</b>'.$val['ticket_id'].'<br>Word Count:&nbsp'.($val['wordcount']).'</span>';
			if($val['status'] == $ticket_status['Quality_Check_Failed']){
				$rows[] = '<span class="badge badge-dot bg-danger">'.$val['status'].'</span>';
			}
			else if($val['status'] == $ticket_status['Quality_Checked']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else{
				$rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].'</span>';
			}
			$btn = '';
			$btn = '<div class="btn-group" aria-label="Basic example"> <button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-warning mt-3" onclick="view_check_attachment(this);" title="View Attachment"><em class="icon ni ni-eye-alt-fill"></em></button>';
			if($val['status'] == $ticket_status['Quality_Checking_Initiated'])
			{
				$btn .= '&nbsp;&nbsp;<button type="button" id = "revert_quality" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn btn-outline-secondary mt-3" onclick="attachment_revert(this);" title="Revert Attachment"><em class="icon ni ni-repeat-v"></em></button>&nbsp;&nbsp; <button type="button" id="uploaddatabutton" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-dim btn-outline-info mt-3" data-bs-target="#uploadCheckedAttachment"onclick="upload_checked_attchment(this);" title="Check Passed"><em class="icon ni ni-done"></em></button>';
			}
			$rows[] = $btn;
			$records[] = $rows;
		}
	}

	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// View quality Documents
if(!empty($_POST['action']) && $_POST['action'] == 'get_quality_documents_by_id') {
	$get_id = $_POST['ticket_id'];
	$get_input_docs = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_id, 'documents_type' => 'Input'));
    $exec_quality_sql = "SELECT `file_name`, `extension` from `input_documents` where documents_type in ('".$document_type['Check_For_Quality']."', '".$document_type['Quality_Checked']."', '".$document_type['Sme_Uploaded']."') AND ticket_id = $get_id";
    $get_output_docs = execute_query($exec_quality_sql);
	if($get_input_docs || $get_output_docs)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data1"=>$get_input_docs, "data2"=>$get_output_docs));
	}	
}
// Quality checked
if(!empty($_POST['action']) && $_POST['action'] == 'upload_documents_files') {
	$get_ticket_id = $_POST['uploadticket_id'];
	$_POST['remarks'] = addslashes($_POST['remarks']);
	$submit_remarks = execute_insert("ticket_desc", array('ticket_desc' => $_POST['remarks'], 'ticket_id'=> $get_ticket_id, 'created_by' => $_SESSION['emp_id'], 'role' => $_SESSION['emp_role']));
    $passed_ticket = execute_update('ticket_master', array('status' => $ticket_status['Quality_Checked']), array('ticket_id' => $_POST['uploadticket_id']));
	$get_quality_documents_id = select_query('input_documents', array('id'), array('ticket_id' => $get_ticket_id, 'documents_type' => $document_type['Check_For_Quality']));
		$get_quality_docs_id = array();
		foreach ($get_quality_documents_id as $key => $val)
				{
					array_push($get_quality_docs_id, $val['id']);
				}
		$select_update_quality_id = implode(", ",$get_quality_docs_id);
		$exec_quality_sql = "UPDATE `input_documents` SET documents_type = '".$document_type['Quality_Checked']."' where id in ($select_update_quality_id)";
		$get_quality_exec = execute_query_status($exec_quality_sql);
		echo json_encode(array("response"=>'Quality Checked Successfully', "status" => 'success', "data"=>$get_quality_exec));
}
// Failed Quality
if(!empty($_POST['action']) && $_POST['action'] == 'failed_quality'){ 
	$_POST['remarks'] = addslashes($_POST['remarks']);
	$submit_remarks = execute_insert("ticket_desc", array('ticket_desc' => $_POST['remarks'], 'ticket_id'=> $_POST['ticket_id'], 'created_by' => $_SESSION['emp_id'], 'role' => $_SESSION['emp_role']));
    $archieve_ticket = execute_update('ticket_master', array('status' => $ticket_status['Quality_Check_Failed']), array('ticket_id' => $_POST['ticket_id']));
	$get_failed_documents_id = select_query('input_documents', array('id'), array('ticket_id' => $_POST['ticket_id'], 'documents_type' => $document_type['Check_For_Quality']));
		$get_failed_docs_id = array();
		foreach ($get_failed_documents_id as $key => $val)
				{
					array_push($get_failed_docs_id, $val['id']);
				}
		$select_update_failed_id = implode(", ",$get_failed_docs_id);
		$exec_failed_sql = "UPDATE `input_documents` SET documents_type = '".$document_type['Quality_Failed']."' where id in ($select_update_failed_id)";
		$get_failed_exec = execute_query_status($exec_failed_sql);
		echo json_encode(array("response"=>'Quality Failed Successfully', "status" => 'success', "data"=>$get_failed_exec));
};
// All Projects
if(!empty($_POST['action']) && $_POST['action'] == 'all_smerecords') {
	$sql = "SELECT `ticket_id`, `wordcount`, `assigned_date`, `assigned_deadline`, `update_at`, TIMEDIFF(`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) FROM ticket_master WHERE status IN ('".$ticket_status['Project_Assigned_To_Sme']."','".$ticket_status['Project_InProgress']."', '".$ticket_status['Sme_upload_complete']."', '".$ticket_status['Quality_Checking_Initiated']."', '".$ticket_status['Quality_Checked']."', '".$ticket_status['Quality_Check_Failed']."', '".$ticket_status['Project_Completed']."', '".$ticket_status['Output_Sent']."') order by TIMEDIFF(`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) asc";
	$records = [];
	$get_data = execute_query($sql);
	if(!empty($get_data))
	{foreach($get_data as $key => $val){ 
		
		$rows = array();
		$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);">ID <b>#</b>'.$val['ticket_id'].'<br>Word Count:&nbsp'.($val['wordcount']).'</span>';
		$rows[] = $val['assigned_date'];
		$rows[] = $val['assigned_deadline'];
		$rows[] = $val['update_at'];

		$earlier = new DateTime(date('Y-m-d'));
		$later = new DateTime($val['assigned_deadline']);
		$pos_diff = $earlier->diff($later)->format("%r%a"); 

		if($pos_diff <= 2){
			$rows[] = '<span class="text-danger">'.$pos_diff.' Days Left</span>';
		}else{
			$rows[] = '<span class="text-success">'.$pos_diff.' Days Left</span>';
		}
		
		$records[] = $rows;
	}}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	echo json_encode($output);

}
// New Assigned Projects
if(!empty($_POST['action']) && $_POST['action'] == 'new_assigned') {
	$sql = "SELECT `ticket_id`, `wordcount`, `assigned_date`, `assigned_deadline`, `input_documents_id`, `output_documents_id`, TIMEDIFF(`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) FROM ticket_master WHERE status IN ('".$ticket_status['Project_Assigned_To_Sme']."', '".$ticket_status['Project_InProgress']."') and is_viewed = 0 order by TIMEDIFF(`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) asc";
	$get_data = execute_query($sql);
	if(count($get_data) > 0)
	{
		foreach($get_data as $key => $val){ 
		
			$rows = array();
			$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);">ID <b>#</b>'.$val['ticket_id'].'<br>Word Count:&nbsp'.($val['wordcount']).'</span>';
			$get_date_assign = explode(' ',$val['assigned_date']);
			$rows[] = $get_date_assign[0];
			$get_date_dedline = explode(' ',$val['assigned_deadline']);
			$rows[] = $get_date_dedline[0];
			$earlier = new DateTime(date('Y-m-d'));
			$later = new DateTime($val['assigned_deadline']);
			$pos_diff = $earlier->diff($later)->format("%r%a"); //3
			if($pos_diff <= 2){
				$rows[] = '</span>(<span class="text-danger">'.$pos_diff.' Days Left</span>)';
			}else{
				$rows[] = '</span>(<span class="text-success">'.$pos_diff.' Days Left</span>)';
			}
			$btn = '';
			if(($val['input_documents_id'] == 1) || $val['output_documents_id'] == 1){
				$btn .= '<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-warning mt-3" onclick="modalopensmeattachment(this);" title="view"><em class="icon ni ni-eye-alt-fill"></em></button>&nbsp; ';
			}
			
			$btn .= '<a href =html/?action=ticket_description&ticketId='.$val['ticket_id'].' class="btn btn-sm btn-outline-primary mt-3" target="_blank" title="Check All Remarks/View Remarks"><em class="icon ni ni-notice"></em></a>&nbsp; ';
			
			$btn .= '<button type="button" id="uploadsmebutton" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-dim btn-outline-info mt-3" data-bs-target="#uploadAttachment"onclick="modaluploadsmeattachment(this);" title="Upload"><em class="icon ni ni-upload"></em></button>';
	
			$rows[] = $btn;
			
			$records[] = $rows;
		}
	}
	else
	{
		$records = [];
	}

	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	echo json_encode($output);

}
// Get Sme uploaded files
if(!empty($_POST['action']) && $_POST['action'] == 'get_uploaded_files') {
	$get_ticket_id = $_POST['ticket_id'];
	$get_input_info = select_query('input_documents',array('file_name','extension'),array('ticket_id' => $get_ticket_id, 'documents_type' => $document_type['Input']));
	$exec_sql = "SELECT `file_name`, `extension` from `input_documents` where documents_type in ('".$document_type['Sme_Uploaded']."', '".$document_type['Quality_Checked']."') AND ticket_id = $get_ticket_id";
    $get_output_info = execute_query($exec_sql);
	if($get_output_info || $get_input_info)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data1"=>$get_output_info, "data2"=>$get_input_info));
	}	
}
// Upload Sme files
if(!empty($_POST['action']) && $_POST['action'] == 'uploadsmefiles') {
    $get_id = $_POST['uploadsmeticket_id'];

    $sme_file_path = "sme_upload";
    if(!empty($_FILES['uploadsmeattachment']['name'][0])){
        $name = file_upload($_FILES['uploadsmeattachment'], $sme_file_path);
		foreach($name as $key){ 
			$extn_array = explode(".",$key);
			$extn = $extn_array[1];
			$data = array();
			$data['ticket_id'] = $get_id; 
			$data['extension'] = $extn;
			$extn = strtolower($extn);
			$data['file_name'] = $key;
			// if(in_array($extn,$image_exten)){
			// 	$data['file_name'] = $key; 
			// }
			// if(in_array($extn,$doc_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$pdf_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$video_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$excel_exten)){
			// 	$data['file_name'] = $key;
			// }
		}
        if(isset($_POST['quality_completed_check']) && $_POST['quality_completed_check'] == 'on'){
			execute_update('ticket_master',array('output_documents_id' => 1, 'status' => $ticket_status['Sme_upload_complete'], 'is_viewed' => 1),array('ticket_id' => $get_id));
            $data['documents_type'] = $document_type['Check_For_Quality'];
            execute_insert("input_documents", $data);
            $get_documents_id = select_query('input_documents', array('id'), array('ticket_id' => $get_id, 'documents_type' => $document_type['Sme_Uploaded']));
            if(!empty($get_documents_id)){
				$get_docs_id = array();
				foreach ($get_documents_id as $key => $val)
				{
					array_push($get_docs_id, $val['id']);
				}
				$select_update_id = implode(", ",$get_docs_id);
				$exec_sql = "UPDATE `input_documents` SET documents_type = '".$document_type['Check_For_Quality']."' where id IN ($select_update_id)";
				$get_exec = execute_query_status($exec_sql);
				$exec_ticket = "UPDATE `ticket_master` SET status = '".$ticket_status['Sme_upload_complete']."' where ticket_id = $get_id";
				$get_ticket_exec = execute_query_status($exec_ticket);
			}
				
            echo json_encode(array("response"=>'Upload Successfully', "status" => 'success', "data"=>$get_ticket_exec));
        }
        else{
            $data['documents_type'] = $document_type['Sme_Uploaded'];
            $get_result = execute_insert("input_documents", $data);
            execute_update('ticket_master',array('output_documents_id' => 1, 'status' => $ticket_status['Project_InProgress']),array('ticket_id' => $get_id));
            echo json_encode(array("response"=>'Upload Successfully', "status" => 'success', "data"=>$get_result));
      }

    }
}
// Get Product Manager Remarks
if(!empty($_POST['action']) && $_POST['action'] == 'get_ticket_rem') {
	$get_ticket_id = $_POST['ticket_id'];
	$get_pm_rem = select_query('task_master',array('ticket_id', 'remarks_pm'),array('ticket_id' => $get_ticket_id));
	if($get_pm_rem)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_pm_rem));
	}	
}
// Add University Record
if(!empty($_POST['action']) && $_POST['action'] == 'addUnivRecord') { 
	$data = array();
	$data['university_name'] = $_POST['university_name'];
	$add_univ = execute_insert("university", $data);
	if($add_univ ){
		echo json_encode(array("response"=>'Inserted Successfully', "status" => 'success','data' => $add_univ));
	}
}
// Get university Records
if(!empty($_POST['action']) && $_POST['action'] == 'data_university') {
	
	$data_univ = select_query("university",array("university_id","university_name"),array());
    foreach($data_univ as $key => $val){ 
		
		$rows = array();
		$rows[] = $val['university_id'];
		$rows[] = $val['university_name'];
				
		$btn  = '';
		// }
		$btn .= '<button type="button" name="update" id="edit_univ" data-id="'.$val['university_id'].'" class="btn btn-sm btn-outline-info"data-bs-toggle="tooltip" onclick="edit_univ(this)"data-bs-placement="top" title="Edit"><em class="icon ni ni-edit-alt"></em></button>';
		$rows[] = $btn;
		$records[] = $rows;
	}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}

// Get University information
if(!empty($_POST['action']) && $_POST['action'] == 'get_univ_desc'){
	$data['university_id'] = $_POST['univ_id'];
	$get_univ_data = select_query('university', array('university_name'),$data);
	
	if($get_univ_data){
		echo json_encode(array("response"=>'University Data Fetch Succesfully', "status" => 'success','data' => $get_univ_data));
	}
}
// update university name in modal
if(!empty($_POST['action']) && $_POST['action'] == 'updateUniversity') {
	$update_name_univ = execute_update('university',array('university_name'=>$_POST["name_univ"], 'updated_by'=>$_SESSION['emp_id']),array('university_id' =>$_POST['edit_univ_id']));
	echo json_encode(["response"=>'Updated Successfully', "status" => 'success', 'data'=>$update_name_univ]);
}
// Get Exchange information
if(!empty($_POST['action']) && $_POST['action'] == 'getExchangeDetails'){
	$data['country_id'] = $_POST['get_id_country'];
	$get_rate_exchange = select_query('country_cost_master', array('country_id', 'country_name', 'rate', 'currency', 'country_mobile_extention', 'word_limit', 'dissertation_rate'),$data);
	
	if($get_rate_exchange){
		echo json_encode(array("response"=>'Exchange Rate Fetch Succesfully', "status" => 'success','data' => $get_rate_exchange));
	}
}
//update exchange rate in modal
if(!empty($_POST['action']) && $_POST['action'] == 'updateExchangeRate') {
	$data_country_id = '"'.$_POST['country_id'].'"';
	$exchange_rate_update = execute_update('country_cost_master',array('country_id'=>$_POST["country_id"], 'country_name'=>$_POST["name"],'country_mobile_extention'=>$_POST["country_code"], 'rate'=>$_POST["rate"], 'currency'=>$_POST["currency"], 'word_limit'=>$_POST["word_count"], 'updated_by'=>$_SESSION['emp_id'], 'dissertation_rate'=>$_POST["rate_dissertion"]),array('country_id' =>$data_country_id));
	echo json_encode(["response"=>'Updated Successfully', "status" => 'success', 'data'=>$exchange_rate_update]);
}
if(!empty($_POST['action']) && $_POST['action'] == 'listTempTicket') {
	$get_data_temp = select_query('template_ticket', array('template_id','template_name'), array(),'order by `template_id` asc');
	
	
	foreach($get_data_temp as $key => $val){ 
		
		$rows = array();
		$rows[] = $val['template_id'];
		$rows[] = $val['template_name'];
		$btn  = '';
		$btn .= '<button type="button" id="advance-payment" data-id="'.$val['template_id'].'" class="btn btn-sm btn-outline-primary mt-3"  onclick="viewTemplate(this);" title="View Ticket Template"><em class="icon ni ni-template"></em></button>';
		$rows[] = $btn;
		$records[] = $rows;
	}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// Ticket Template table insert
if(!empty($_POST['action']) && $_POST['action'] == 'data_template') {  
	$data['template_name'] = $_POST["template_name"];
	$data['template_text'] = $_POST["temp_body"];
	$data['university_id'] = $_POST["university"];
	 $temp_ticket = execute_insert("template_ticket", $data);
	if($temp_ticket){
		echo json_encode(array("response"=>'Inserted Successfully', "status" => 'success','data' => $temp_ticket));

	}	
}
// Get Template Text, Name and ID 
if(!empty($_POST['action']) && $_POST['action'] == 'get_template_body') {
	$get_temp_ticket_id = $_POST['temp_id'];
	$get_temp_ticket_text = select_query('template_ticket',array('template_id','template_name','template_text'),array('template_id' => $get_temp_ticket_id));
	if($get_temp_ticket_text)
	{
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success', "data"=>$get_temp_ticket_text));
	}	
}
// Get Ticket Records For Business
if(!empty($_POST['action']) && $_POST['action'] == 'data_sales') {
	$sql = "Select  `t`.`ticket_id`,`t`.`status`,`t`.`input_documents_id`, `t`.`wordcount`, `t`.`assigned_date`, `t`.`assigned_deadline`, ADDTIME(SYSDATE(),'0 05:30:00') as current_datetime,TIMEDIFF(`t`.`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) AS restTime, cm.customer_name,cm.customer_email,cm.phone_number, ccm.rate, ccm.currency FROM  aws_writex_db.`ticket_master` t  INNER JOIN   aws_writex_db.customer_master cm on t.customer_id  = cm.customer_id  INNER JOIN   aws_writex_db.`country_cost_master` ccm on t.country_id = ccm.country_id  WHERE t.status NOT IN ('".$ticket_status['Ticket_Created']."','".$ticket_status['Performa_Invoice_Send']."', '".$ticket_status['Payment_attachment_added']."', '".$ticket_status['Advanced_Recieved']."') and t.created_by ='".$_SESSION['emp_id']."' ORDER BY TIMEDIFF(`t`.`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) asc";
	$get_data = execute_query($sql);
	if(count($get_data) > 0)
	{
		$cost = ($get_data[0]['rate'])*($get_data[0]['wordcount']);
		foreach($get_data as $key => $val){ 
			$rows = array();
			$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);">ID <b>#</b>'.$val['ticket_id'].'<br>Word Count:&nbsp'.($val['wordcount']).'<br>Cost:&nbsp'.($cost).' '.$val['currency'].'</span>';
			$rows[] = '<span><em class="ni ni-user"></em>&nbsp'.$val['customer_name']."<br><em class='icon ni ni-mobile'></em>&nbsp<a href = 'https://wa.me/".$val['phone_number']."'>".$val['phone_number']."</a><br><em class='icon ni ni-mail-fill'></em>&nbsp<a href = 'mailto:".$val['customer_email']."'>".$val['customer_email'].'</a></span>';
			$earlier = new DateTime(date('Y-m-d'));
			$later = new DateTime($val['assigned_deadline']);
			$pos_diff = $earlier->diff($later)->format("%r%a"); //3
			if($pos_diff <= 2){
				$rows[] = 'Assigned Date: '.$val['assigned_date'].'<br> Deadline: <span class="text-danger">'.$val['assigned_deadline'].'</span>(<span class="text-danger">'.$pos_diff.' Days Left</span>)';
			}else{
				$rows[] = 'Assigned Date: '.$val['assigned_date'].'<br> Deadline: <span class="text-primary">'.$val['assigned_deadline'].'</span>(<span class="text-primary">'.$pos_diff.' Days Left</span>)';
			}		
		
			if($val['status'] == $ticket_status['Ticket_Close']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else{
				$rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].'</span>';
			}
			$btn = '';

			$btn .= '&nbsp;&nbsp;<a href =html/?action=payment_details&ticketId='.$val['ticket_id'].' class="btn btn-sm btn-outline-info mt-3" target="_blank" title="Check Payment Status"><em class="icon ni ni-sign-inr"></em></a>';

			$rows[] = $btn;
			$records[] = $rows;
		}
		
	}
	else
	{
		$records = [];
	}
	
	

	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}

// Add Monthly Target Record
if(!empty($_POST['action']) && $_POST['action'] == 'addTargetRecord') { 
	$data = array();
	$data['target_id'] = $_POST['target_id'];
	$data['year'] = $_POST['year'];
	$data['month'] = $_POST['monthly'];
	$data['monthly'] = $_POST['get_monthly'];
	$data['daily'] = $_POST['get_daly'];
	$add_target = execute_insert("target_monthly", $data);
	if($add_target){
		echo json_encode(array("response"=>'Inserted Successfully', "status" => 'success','data' => $add_target));
	}
}
// Get monthly target Records
if(!empty($_POST['action']) && $_POST['action'] == 'data_target') {
	
	$data_target = select_query("target_monthly",array("year","month", "monthly", "daily"),array());

	if(count($data_target) > 0)
	{
		foreach($data_target as $key => $val){ 
		
			$rows = array();
			$rows[] = $val['year'];
			$rows[] = $val['month'];
			$rows[] = $val['monthly'];
			$rows[] = $val['daily'];
					
			$records[] = $rows;
		}
	}
	else
	{
		$records = [];
	}
    
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// get all payments 
if(!empty($_POST['action']) && $_POST['action'] == 'get_account_records') {

	$payment_desc = select_query("payment_master",array("transaction_id","amount_received", "accounts_approval_date", "status"),array());
	
	$get_sql = "SELECT  `t`.`ticket_id`,`t`.`input_documents_id`,`t`.`date_added`, `t`.`wordcount`, `t`.`extra_amount`, `t`.`assigned_date`, `t`.`assigned_deadline`, `t`.`total_value`, `cm`.`customer_name`,`cm`.`customer_email`,`cm`.`phone_number`, `ccm`.`rate`, `ccm`.`currency`, `ccm`.`word_limit`, `em`.`emp_name`,`payment_master`.`status`, (SELECT COUNT(*) FROM `payment_master` WHERE `ticket_id` = `t`.`ticket_id` AND `status` = 'Pending')as payment_pending FROM `ticket_master` t JOIN  payment_master on t.ticket_id  = payment_master.ticket_id  INNER JOIN  customer_master cm on t.customer_id  = cm.customer_id  INNER JOIN `country_cost_master` ccm on t.country_id = ccm.country_id left JOIN employees_master as em on t.created_by = em.emp_id order by t.ticket_id desc";

	$get_data = execute_query($get_sql);
	$cost = ($get_data[0]['rate'])*($get_data[0]['wordcount']);
	foreach($get_data as $key => $val){ 
		$rows = array();
		$ticket_value = round((($val['wordcount'] * $val['rate'])/ $val['word_limit']),2)+ (int)$val['extra_amount'];
		$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);">ID <b>#</b>'.$val['ticket_id'].'<br>Word Count:&nbsp'.($val['wordcount']).'<br>Ticket Value:&nbsp'.$val['total_value'].'</span>';
		$rows[] = '<span><em class="ni ni-user"></em>&nbsp'.$val['customer_name']."<br><em class='icon ni ni-mobile'></em>&nbsp<a href = 'https://wa.me/".$val['phone_number']."'>".$val['phone_number']."</a><br><em class='icon ni ni-mail-fill'></em>&nbsp<a href = 'mailto:".$val['customer_email']."'>".$val['customer_email'].'</a></span>';
		
		if($val['status'] == $payment_status['Pending']){
			$rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].'</span>';
		}
		else{
			$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
		}
		$btn = '';
		
		if($val['payment_pending'] != 0){

		$btn .= '<a href=html/?action=payment_details&ticketId='.$val['ticket_id'].' class="btn btn-trigger btn-icon dropdown-toggle" target="_blank" title="Add or Edit Attachment"><div class="badge badge-circle bg-danger">'.$val['payment_pending'].'</div><em class="icon ni ni-clip"></em></a>';
		}
		else{
			$btn .= '<a href=html/?action=payment_details&ticketId='.$val['ticket_id'].' class="btn btn-trigger btn-icon dropdown-toggle" target="_blank" title="Add or Edit Attachment"><em class="icon ni ni-clip"></em></a>';
		}
		if($_SESSION['emp_role'] == "Sales" && $val['status'] == $ticket_status['Performa_Invoice_Send']){
			$btn .= '&nbsp;&nbsp;<div class="btn-group" aria-label="Basic example"> <button type="button" id="upload-payment" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalTabs" onclick="uploadDocumnets(this);" title="Upload Documents"><em class="icon ni ni-upload"></em></button>';
		}

			if(($_SESSION['emp_role'] == "Admin" ||$_SESSION['emp_role'] == "Accounts") && $val['status'] == "Pending"){
			$btn .= '&nbsp;&nbsp;<div class="btn-group" aria-label="Basic example"> <button type="button" id="download-attachment" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalTabs" onclick="downloadDocumnets(this);" title="Ticket Attachment Download"><em class="icon ni ni-download"></em></button>';
		}
		if($val['input_documents_id'] == 1){
			$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-warning mt-3" onclick="view_attchment(this);" title="view"><em class="icon ni ni-eye-alt-fill"></em></button>';

		}
		$rows[] = $btn;
		$records[] = $rows;
	}

	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// get pending payments
if(!empty($_POST['action']) && $_POST['action'] == 'get_pending_records') {

	$payment_desc = select_query("payment_master",array("transaction_id","amount_received", "accounts_approval_date", "status"),array());
	
	$get_sql = "SELECT  `t`.`ticket_id`,`t`.`input_documents_id`,`t`.`date_added`, `t`.`wordcount`, `t`.`extra_amount`, `t`.`assigned_date`, `t`.`assigned_deadline`, `t`.`total_value`, `cm`.`customer_name`,`cm`.`customer_email`,`cm`.`phone_number`, `ccm`.`rate`, `ccm`.`currency`, `ccm`.`word_limit`, `em`.`emp_name`,`payment_master`.`status`, (SELECT COUNT(*) FROM `payment_master` WHERE `ticket_id` = `t`.`ticket_id` AND `status` = 'Pending')as payment_pending FROM `ticket_master` t JOIN  payment_master on t.ticket_id  = payment_master.ticket_id  INNER JOIN  customer_master cm on t.customer_id  = cm.customer_id  INNER JOIN `country_cost_master` ccm on t.country_id = ccm.country_id left JOIN employees_master as em on t.created_by = em.emp_id where `payment_master`.`status` = '".$payment_status['Pending']."' order by `payment_master`.`p_id` desc";

	$get_data = execute_query($get_sql);
	$cost = ($get_data[0]['rate'])*($get_data[0]['wordcount']);
	foreach($get_data as $key => $val){ 
		$rows = array();
		$ticket_value = round((($val['wordcount'] * $val['rate'])/ $val['word_limit']),2)+ (int)$val['extra_amount'];
		$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);">ID <b>#</b>'.$val['ticket_id'].'<br>Word Count:&nbsp'.($val['wordcount']).'<br>Ticket Value:&nbsp'.$val['total_value'].'</span>';
		$rows[] = '<span><em class="ni ni-user"></em>&nbsp'.$val['customer_name']."<br><em class='icon ni ni-mobile'></em>&nbsp<a href = 'https://wa.me/".$val['phone_number']."'>".$val['phone_number']."</a><br><em class='icon ni ni-mail-fill'></em>&nbsp<a href = 'mailto:".$val['customer_email']."'>".$val['customer_email'].'</a></span>';
		
		if($val['status'] == $payment_status['Pending']){
			$rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].'</span>';
		}
		else{
			$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
		}
		$btn = '';
		
		if($val['payment_pending'] != 0){

		$btn .= '<a href=html/?action=payment_details&ticketId='.$val['ticket_id'].' class="btn btn-trigger btn-icon dropdown-toggle" target="_blank" title="Add or Edit Attachment"><div class="badge badge-circle bg-danger">'.$val['payment_pending'].'</div><em class="icon ni ni-clip"></em></a>';
		}
		else{
			$btn .= '<a href=html/?action=payment_details&ticketId='.$val['ticket_id'].' class="btn btn-trigger btn-icon dropdown-toggle" target="_blank" title="Add or Edit Attachment"><em class="icon ni ni-clip"></em></a>';
		}
		if($_SESSION['emp_role'] == "Sales" && $val['status'] == $ticket_status['Performa_Invoice_Send']){
			$btn .= '&nbsp;&nbsp;<div class="btn-group" aria-label="Basic example"> <button type="button" id="upload-payment" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalTabs" onclick="uploadDocumnets(this);" title="Upload Documents"><em class="icon ni ni-upload"></em></button>';
		}

			if(($_SESSION['emp_role'] == "Admin" ||$_SESSION['emp_role'] == "Accounts") && $val['status'] == "Pending"){
			$btn .= '&nbsp;&nbsp;<div class="btn-group" aria-label="Basic example"> <button type="button" id="download-attachment" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalTabs" onclick="downloadDocumnets(this);" title="Ticket Attachment Download"><em class="icon ni ni-download"></em></button>';
		}
		if($val['input_documents_id'] == 1){
			$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$val['ticket_id'].'" class="btn btn-sm btn-outline-warning mt-3" onclick="view_attchment(this);" title="view"><em class="icon ni ni-eye-alt-fill"></em></button>';

		}
		$rows[] = $btn;
		$records[] = $rows;
	}

	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
if(!empty($_POST['action']) && $_POST['action'] == 'createNewTicketFromTicketDescription') {
	$data = array();
	$data['ticket_id'] = $_POST['t_id'];
	$data['ticket_desc'] = $_POST['data'];
	$data['created_by'] = $_SESSION['emp_id'];
	$get_emp_role = select_query("employees_master",array('emp_role'),array('emp_id' => $_SESSION['emp_id']));
	$data['role'] = $get_role[0]['emp_role'];
	$store_data = execute_insert("ticket_desc", $data);
	if($store_data){
		echo json_encode(array("response"=>'Inserted Successfully', "status" => 'success','data' => $store_data));
	}
}
// Get Exchange record
if(!empty($_POST['action']) && $_POST['action'] == 'get_exchange_rates') {
	$data_exchange = execute_query("SELECT * FROM currency_to_inr where date LIKE '$get_date_today%'");
		echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success','data1' => $data_exchange, 'data2' => $_SESSION['emp_role']));

}
// Add Exchange Value
if(!empty($_POST['action']) && $_POST['action'] == 'addExchangeValue') {
	unset($_POST['action']) ;
	unset($_POST['exchange_id']) ;
	foreach($_POST as $key=>$value) {
		if($value!='') {
			$post[$key] = $value;
			$data['amount_in_currency'] = $_POST[$key];
			$data['currency'] = $key;
			$data['updated_by'] = $_SESSION['emp_id'];
		}
			execute_insert("currency_to_inr", $data);
}
	echo json_encode(array("response"=>'Insert Successfully', "status" => 'success'));
}
// Get Invoice Record 
if(!empty($_POST['action']) && $_POST['action'] == 'get_data_invoice') {

	$get_all_invoice_record = ("SELECT invoice_master.invoice_number, invoice_master. invoice_date, ticket_master. total_value, ticket_master. wordcount, country_cost_master.currency,customer_master.customer_name, employees_master.emp_name as `Created BY` from invoice_master
	inner join ticket_master on invoice_master.ticket_id = ticket_master.ticket_id join employees_master on employees_master.emp_id = ticket_master.created_by inner join 
    country_cost_master on
	country_cost_master.country_id COLLATE utf8mb4_general_ci = ticket_master.country_id inner join 
    customer_master on ticket_master.customer_id = customer_master.customer_id");
	
	$record_invoice = execute_query($get_all_invoice_record);

	$rows = [];

	if(!empty($record_invoice))
	{
		foreach($record_invoice as $key => $val){ 

			$query = "SELECT currency_to_inr.amount_in_currency FROM `currency_to_inr` join country_cost_master on currency_to_inr.currency = country_cost_master.currency COLLATE utf8mb4_general_ci  where currency_to_inr.currency = '".$val['currency']."' and currency_to_inr.date like '".$val['invoice_date']."%'";

			$getCurrency = execute_query($query);
		
			if(count($getCurrency) >0 )
			{
				$rows = array();
				$rows[] = $val['invoice_number'];
				$rows[] = $val['invoice_date'];
				$rows[] = $val['customer_name'];
				$rows[] = $val['total_value'];
				$rows[] = $val['currency'];
				$rows[] = ($val['total_value']) * ($getCurrency[0]['amount_in_currency']);
				$rows[] = $val['wordcount'];
				$rows[] = $val['Created BY'];
				$records[] = $rows;
			}
			
		}	
	}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}

// Get Team Assign
if(!empty($_POST['action']) && $_POST['action'] == 'getAssignDetails') {
	$get_ticket_id = $_POST['ticket_id'];
	$get_details2 = [];
	if($_SESSION['emp_role'] == "project_manager")
	{
		$get_details = execute_query("SELECT assign_id from assign_master where ticket_id = '$get_ticket_id' and assign_by = '".$_SESSION['emp_id']."' and `status` = 1");
		// $get_details2 = execute_query("SELECT assign_id from assign_master where ticket_id = '$get_ticket_id' and assign_by = '".$_SESSION['emp_id']."' and assign_role = 'Quality_Tester' and `status` = 1");
		$get_details2 = execute_query("SELECT assign_id from assign_master where ticket_id = '$get_ticket_id' and assign_role = 'Quality_Tester' and `status` = 1");
		$get_link_data = select_query("ticket_master",array('add_link'),array('ticket_id' => $get_ticket_id));
	} 
	elseif($_SESSION['emp_role'] == "Team_Manager")
	{
		$get_details = execute_query("SELECT assign_id from assign_master where ticket_id = '$get_ticket_id' and assign_by = '".$_SESSION['emp_id']."' and assign_role = 'Team_Leader' and `status` = 1");
		$get_details2 = execute_query("SELECT assign_id from assign_master where ticket_id = '$get_ticket_id' and assign_role = 'Quality_Tester' and `status` = 1");
		$get_link_data = select_query("ticket_master",array('add_link'),array('ticket_id' => $get_ticket_id));
	}
	// if($_SESSION['emp_role'] == "project_manager")
	// {
	// 	echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success',  "data1"=>$get_details, "data2"=>$get_details2, "data3"=>$get_link_data));
	// }	
	// else{
	// 	echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success',  "data1"=>$get_details, "data2"=>$get_details2, "data3"=>$get_link_data));
	// }
	echo json_encode(array("response"=>'Fetch Successfully', "status" => 'success',  "data1"=>$get_details, "data2"=>$get_details2, "data3"=>$get_link_data));
}

// Get Team Assign
if(!empty($_POST['action']) && $_POST['action'] == 'addAssignTeams') {
	if(isset($_POST['link_share']))
	{	
		// execute_update('ticket_master',array('add_link' => $_POST['link_share'], 'status' => 'Assign to tm and qe'),array('ticket_id' => $_POST['ticket_id_assign']));
		execute_update('ticket_master',array('add_link' => $_POST['link_share']),array('ticket_id' => $_POST['ticket_id_assign']));
	}
	// else{
	// 	// execute_update('ticket_master',array('status' => 'Assign to tl'),array('ticket_id' => $_POST['ticket_id_assign']));
	// 	execute_update('ticket_master',array('add_link' => $_POST['link_share']),array('ticket_id' => $_POST['ticket_id_assign']));
	// }
	if($_POST['prod_remarks'])
	{
		$get_remarks = addslashes($_POST['prod_remarks']);
		$add_desc_team = execute_insert("ticket_desc", array('ticket_desc' => $get_remarks, 'ticket_id' => $_POST['ticket_id_assign'], 'role' => $_SESSION['emp_role'], 'created_by' => $_SESSION['emp_id']));
	}
	if($_SESSION['emp_role'] == "project_manager")
	{
		$get_assign_team = execute_query("SELECT GROUP_CONCAT(assign_id) as assign_id, `status` from assign_master where ticket_id = '".$_POST['ticket_id_assign']."' and `assign_by` = '".$_SESSION['emp_id']."' and `assign_role` = 'Team_Manager'");
		// $get_assign_quality = execute_query("SELECT GROUP_CONCAT(assign_id) as assign_id, `status` from assign_master where ticket_id = ".$_POST['ticket_id_assign']." and `assign_by` = ".$_SESSION['emp_id']." and `assign_role` = 'Quality_Tester'");
		$get_assign_quality = execute_query("SELECT GROUP_CONCAT(assign_id) as assign_id, `status` from assign_master where ticket_id = ".$_POST['ticket_id_assign']." and `assign_role` = 'Quality_Tester'");
			if(($get_assign_team[0]['assign_id']))
			{
				// if($get_assign_team[0]['status'] == 1)
				// {
					execute_query_status("UPDATE `assign_master` SET `status` = 0  where assign_id In (".$get_assign_team[0]['assign_id'].")");
					execute_update('ticket_master',array('status' => 'Project Created'),array('ticket_id' => $_POST['ticket_id_assign']));
				// }
			}
			if(($get_assign_quality[0]['assign_id']))
				{
					// if($get_assign_quality[0]['status'] == 1)
					// {			
						execute_query_status("UPDATE `assign_master` SET `status` = 0  where assign_id In (".$get_assign_quality[0]['assign_id'].")");
						execute_update('ticket_master',array('status' => 'Project Created'),array('ticket_id' => $_POST['ticket_id_assign']));
					// }		
				}
	
		if(isset($_POST['assign'])){
			if(isset($get_assign_team[0]['assign_id'])){
				foreach($_POST['assign'] as $val){
					$prev_get_assign_team = explode(',',($get_assign_team)[0]['assign_id']);
					if (in_array($val, $prev_get_assign_team))
					{
						execute_update('assign_master',array('status' => 1),array('assign_id' => $val));
						execute_update('ticket_master',array('status' => 'Assign to tm and qe'),array('ticket_id' => $_POST['ticket_id_assign']));
					}
					else{
						$get_role = select_query('employees_master',array('emp_role'),array('emp_id' => $val));
						execute_insert('assign_master', array('ticket_id' => $_POST['ticket_id_assign'], 'assign_id' => $val, 'assign_role' => $get_role[0]['emp_role'], 'assign_by' => $_SESSION['emp_id']));
						execute_update('ticket_master',array('status' => 'Assign to tm and qe'),array('ticket_id' => $_POST['ticket_id_assign']));
					}
				}
			}
					else{
						foreach($_POST['assign'] as $val)
						{
							$get_role = select_query('employees_master',array('emp_role'),array('emp_id' => $val));
							execute_insert('assign_master', array('ticket_id' => $_POST['ticket_id_assign'], 'assign_id' => $val, 'assign_role' => $get_role[0]['emp_role'], 'assign_by' => $_SESSION['emp_id']));
							execute_update('ticket_master',array('status' => 'Assign to tm and qe'),array('ticket_id' => $_POST['ticket_id_assign']));
						  }
						}
			
			}
		if(isset($_POST['assign_quality'])){
			if(isset($get_assign_team[0]['assign_id']))
			{
					foreach($_POST['assign_quality'] as $val)
					{
							$prev_get_assign_quality = explode(',',($get_assign_quality)[0]['assign_id']); 
							if (in_array($val, $prev_get_assign_quality))
							{
								execute_update('assign_master',array('status' => 1),array('assign_id' => $val));
								execute_update('ticket_master',array('status' => 'Assign to tm and qe'),array('ticket_id' => $_POST['ticket_id_assign']));
							}
							else{
								$get_role = select_query('employees_master',array('emp_role'),array('emp_id' => $val));
								execute_insert('assign_master', array('ticket_id' => $_POST['ticket_id_assign'], 'assign_id' => $val, 'assign_role' => $get_role[0]['emp_role'], 'assign_by' => $_SESSION['emp_id']));
								execute_update('ticket_master',array('status' => 'Assign to tm and qe'),array('ticket_id' => $_POST['ticket_id_assign']));
							}
					}
			}
				else{
					foreach($_POST['assign_quality'] as $val)
					{
						$get_role = select_query('employees_master',array('emp_role'),array('emp_id' => $val));
						execute_insert('assign_master', array('ticket_id' => $_POST['ticket_id_assign'], 'assign_id' => $val, 'assign_role' => $get_role[0]['emp_role'], 'assign_by' => $_SESSION['emp_id']));
						execute_update('ticket_master',array('status' => 'Assign to tm and qe'),array('ticket_id' => $_POST['ticket_id_assign']));
					}
				}
		}
	}
	else{
			$get_assign_team = execute_query("SELECT GROUP_CONCAT(assign_id) as assign_id, `status` from assign_master where ticket_id = ".$_POST['ticket_id_assign']." and assign_by = ".$_SESSION['emp_id']." and `assign_role` = 'Team_Leader'");
			// 
			$get_assign_quality = execute_query("SELECT GROUP_CONCAT(assign_id) as assign_id, `status` from assign_master where ticket_id = ".$_POST['ticket_id_assign']." and `assign_role` = 'Quality_Tester'");
			if(($get_assign_team[0]['assign_id']))
			{
				// if($get_assign_team[0]['status'] == 1)
				// {
					execute_query_status("UPDATE `assign_master` SET `status` = 0  where assign_id In (".$get_assign_team[0]['assign_id'].")");
					execute_update('ticket_master',array('status' => 'Assign to tm and qe'),array('ticket_id' => $_POST['ticket_id_assign']));
				// }
			}
			// 
			if(($get_assign_quality[0]['assign_id']))
				{
					// if($get_assign_quality[0]['status'] == 1)
					// {			
						execute_query_status("UPDATE `assign_master` SET `status` = 0  where assign_id In (".$get_assign_quality[0]['assign_id'].")");
						execute_update('ticket_master',array('status' => 'Assign to tm and qe'),array('ticket_id' => $_POST['ticket_id_assign']));
					// }		
				}
			if(isset($_POST['assign'])){
				if(isset($get_assign_team[0]['assign_id']))
				{
					foreach($_POST['assign'] as $val)
					{
						// print_r(($get_assign_team)[0]['assign_id']);
						$prev_get_assign_team = explode(',',($get_assign_team)[0]['assign_id']); 
						// print_r($prev_get_assign_team);
						if (in_array($val, $prev_get_assign_team))
						{
							execute_update('assign_master',array('status' => 1),array('assign_id' => $val));
							execute_update('ticket_master',array('status' => 'Assign to tl'),array('ticket_id' => $_POST['ticket_id_assign']));
						}
						else{
							$get_role = select_query('employees_master',array('emp_role'),array('emp_id' => $val));
							execute_insert('assign_master', array('ticket_id' => $_POST['ticket_id_assign'], 'assign_id' => $val, 'assign_role' => $get_role[0]['emp_role'], 'assign_by' => $_SESSION['emp_id']));
							execute_update('ticket_master',array('status' => 'Assign to tl'),array('ticket_id' => $_POST['ticket_id_assign']));
						}
					}
				}
				else{
					foreach($_POST['assign'] as $val)
					{
						$get_role = select_query('employees_master',array('emp_role'),array('emp_id' => $val));
						execute_insert('assign_master', array('ticket_id' => $_POST['ticket_id_assign'], 'assign_id' => $val, 'assign_role' => $get_role[0]['emp_role'], 'assign_by' => $_SESSION['emp_id']));
						execute_update('ticket_master',array('status' => 'Assign to tl'),array('ticket_id' => $_POST['ticket_id_assign']));
					}
				}
			}
			// 
			if(isset($_POST['assign_quality'])){
				if(isset($get_assign_team[0]['assign_id']))
				{
						foreach($_POST['assign_quality'] as $val)
						{
								$prev_get_assign_quality = explode(',',($get_assign_quality)[0]['assign_id']); 
								if (in_array($val, $prev_get_assign_quality))
								{
									execute_update('assign_master',array('status' => 1),array('assign_id' => $val));
									execute_update('ticket_master',array('status' => 'Assign to tl'),array('ticket_id' => $_POST['ticket_id_assign']));
								}
								else{
									$get_role = select_query('employees_master',array('emp_role'),array('emp_id' => $val));
									execute_insert('assign_master', array('ticket_id' => $_POST['ticket_id_assign'], 'assign_id' => $val, 'assign_role' => $get_role[0]['emp_role'], 'assign_by' => $_SESSION['emp_id']));
									execute_update('ticket_master',array('status' => 'Assign to tl'),array('ticket_id' => $_POST['ticket_id_assign']));
								}
						}
				}
					else{
						foreach($_POST['assign_quality'] as $val)
						{
							$get_role = select_query('employees_master',array('emp_role'),array('emp_id' => $val));
							execute_insert('assign_master', array('ticket_id' => $_POST['ticket_id_assign'], 'assign_id' => $val, 'assign_role' => $get_role[0]['emp_role'], 'assign_by' => $_SESSION['emp_id']));
							execute_update('ticket_master',array('status' => 'Assign to tl'),array('ticket_id' => $_POST['ticket_id_assign']));
						}
					}
			}


	}
	echo json_encode(array("response"=>'Assigned Successfully', "status" => 'success'));
}
// For all teams
if(!empty($_POST['action']) && $_POST['action'] == 'assign_all') {
	if($_SESSION['emp_role'] == "project_manager"){
		$sql = "SELECT tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, GROUP_CONCAT( am.assign_id) as assign_id, (select emp_name from employees_master where emp_id = tm.created_by)as created_by, (select emp_name from employees_master where emp_id = am.assign_id)as get_name_emp, (select emp_email from employees_master where emp_id = am.assign_id)as get_email_emp, (select emp_role from employees_master where emp_id = am.assign_id)as get_role_emp from ticket_master as tm LEFT join assign_master as am on tm.ticket_id = am.ticket_id where tm.status IN ($get_project_created_applicable) GROUP BY tm.ticket_id";
	
		$getAllData = execute_query($sql);
	}
	if($_SESSION['emp_role'] == "Team_Manager"){
		$sql="SELECT tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, GROUP_CONCAT( am.assign_id) as assign_id, (select emp_name from employees_master where emp_id = tm.created_by)as created_by, (select emp_name from employees_master where emp_id = am.assign_id)as get_name_emp, (select emp_email from employees_master where emp_id = am.assign_id)as get_email_emp, (select emp_role from employees_master where emp_id = am.assign_id)as get_role_emp from ticket_master as tm join assign_master as am on tm.ticket_id = am.ticket_id JOIN employees_master as em on am.assign_id = em.emp_id where am.assign_id = ".$_SESSION['emp_id']." and am.status = 1 GROUP BY tm.ticket_id";
		$getAllData = execute_query($sql);
	}
	$records = [];
	if(!empty($getAllData))
	{
		foreach($getAllData as $details)
	{
		$rows = array();
		$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$details['ticket_id'].'">ID <b>#</b>'.$details['ticket_id'].'<br>Word Count:&nbsp'.($details['wordcount']).'<br>Created By:&nbsp'.($details['created_by']).'<br>Cost:&nbsp'.$details['created_by'].'</span>';			
		$rows[] = $details['assigned_deadline'];
		$rows[] = $details['date_added'];
		if($details['status'] == $ticket_status['Quality_Check_Failed']){
			$rows[] = '<span class="badge badge-dot bg-danger">'.$details['status'].'</span>';
		}elseif($details['status'] == $ticket_status['Quality_Checked']){
			$rows[] = '<span class="badge badge-dot bg-success">'.$details['status'].'</span>';
		}
		else{
			$rows[] = '<span class="badge badge-dot bg-primary">'.$details['status'].'</span>';
		}
		$records[] = $rows;
	}
}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);
}
// For all assign teams
if(!empty($_POST['action']) && $_POST['action'] == 'team_assign') {
	if($_SESSION['emp_role'] == "project_manager"){
		// $sql = "SELECT tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, GROUP_CONCAT( am.assign_id) as assign_id, (select emp_name from employees_master where emp_id = tm.created_by)as created_by, (select emp_name from employees_master where emp_id = am.assign_id)as get_name_emp, (select emp_email from employees_master where emp_id = am.assign_id)as get_email_emp, (select emp_role from employees_master where emp_id = am.assign_id)as get_role_emp from ticket_master as tm LEFT join assign_master as am on tm.ticket_id = am.ticket_id where tm.status NOT IN ($get_status_applicable) GROUP BY tm.ticket_id";
		// $sql = "SELECT tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, GROUP_CONCAT( am.assign_id) as assign_id, (select emp_name from employees_master where emp_id = tm.created_by)as created_by, (select emp_name from employees_master where emp_id = am.assign_id)as get_name_emp, (select emp_email from employees_master where emp_id = am.assign_id)as get_email_emp, (select emp_role from employees_master where emp_id = am.assign_id)as get_role_emp from ticket_master as tm LEFT join assign_master as am on tm.ticket_id = am.ticket_id where tm.status NOT IN ($get_status_applicable) GROUP BY tm.ticket_id and am.assign_by = ".$_SESSION['emp_id']."";
		$sql = "SELECT tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, GROUP_CONCAT( am.assign_id) as assign_id, (select emp_name from employees_master where emp_id = tm.created_by)as created_by from ticket_master as tm LEFT join assign_master as am on tm.ticket_id = am.ticket_id where am.assign_by = ".$_SESSION['emp_id']." and tm.status NOT IN ($get_status_applicable) GROUP BY tm.ticket_id";
	
		$getAllData = execute_query($sql);
	}
	if($_SESSION['emp_role'] == "Team_Manager"){
		$sql="SELECT tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, GROUP_CONCAT( am.assign_id) as assign_id, (select emp_name from employees_master where emp_id = tm.created_by)as created_by, (select emp_name from employees_master where emp_id = am.assign_id)as get_name_emp, (select emp_email from employees_master where emp_id = am.assign_id)as get_email_emp, (select emp_role from employees_master where emp_id = am.assign_id)as get_role_emp from ticket_master as tm join assign_master as am on tm.ticket_id = am.ticket_id JOIN employees_master as em on am.assign_id = em.emp_id where am.assign_id = ".$_SESSION['emp_id']." and am.status = 1 and tm.status IN ($get_team_manager_ticket_status_applicable) GROUP BY tm.ticket_id";
		$getAllData = execute_query($sql);
	}
	if(!empty($getAllData))
	{
		foreach($getAllData as $details)
		{
			$rows = array();
			$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$details['ticket_id'].'">ID <b>#</b>'.$details['ticket_id'].'<br>Word Count:&nbsp'.($details['wordcount']).'<br>Created By:&nbsp'.($details['created_by']).'<br>Cost:&nbsp'.$details['created_by'].'</span>';	
			$rows[] = $details['assigned_deadline'];
			$rows[] = $details['date_added'];
			$html_at='';
            $html_at .= '<ul class="preview-list g-1">';
			// $sql2 = "SELECT GROUP_CONCAT(assign_id) from assign_master where assign_by = " .$_SESSION['emp_id']." and ticket_id = ".$details['ticket_id']." and `status` = 1 Group by ticket_id";
			if($_SESSION['emp_role'] == "project_manager")
			{
				$sql2 = "SELECT GROUP_CONCAT(assign_id) from assign_master where ticket_id = ".$details['ticket_id']." and assign_role != 'Team_Leader' and `status` = 1 Group by ticket_id";
			}
			else{
				if($_SESSION['emp_role'] == "Team_Manager")
			{
				// $sql2 = "SELECT GROUP_CONCAT(assign_id) from assign_master where ticket_id = ".$details['ticket_id']." and assign_role = 'Team_Manager' and `status` = 1 Group by ticket_id";
				$sql2 = "SELECT GROUP_CONCAT(assign_id) from assign_master where ticket_id = ".$details['ticket_id']." and assign_role != 'Team_Manager' and `status` = 1 Group by ticket_id";
			}
			}
			$get_assign_data = execute_query($sql2);
			$employees_Array_details = array();

	if(!empty($get_assign_data[0]['GROUP_CONCAT(assign_id)']))	{
		$emp_id_array = explode(",",$get_assign_data[0]['GROUP_CONCAT(assign_id)']);
		foreach($emp_id_array as $key1)
		{
			$get_emp_details = select_query("employees_master",array("emp_name","emp_email","emp_role"),array('emp_id' => $key1));
			$name_intial = printInitials($get_emp_details[0]['emp_name']);
			$get_name = $get_emp_details[0]['emp_name'];
			$get_email =$get_emp_details[0]['emp_email'];
			$html_at .='<li class="preview-item"><div class="user-avatar"><spandata-bs-toggle="tooltip" data-bs-placement="top" title="'.$get_name.'('.$get_email.')'.'Role:'.($get_emp_details[0]['emp_role']).'" style="cursor:pointer;">'.$name_intial.'</span></div></li>';
	}
		$html_at .= '</ul>';
	}
	else{
		$html_at = 'Previously Assigned';
	} 
	$btn = '';
	$btn .= '<div class="btn-group" aria-label="Basic example"> <button type="button" id="add-assign-tm" data-id="'.$details['ticket_id'].'" class="btn btn-sm btn-outline-primary mt-3" onclick="assign(this);" title="Assign/Unassigned Team"><em class="icon ni ni-plus-round-fill"></em></button>';
	$btn .= '&nbsp;&nbsp;<a href =html/?action=ticket_description&ticketId='.$details['ticket_id'].' class="btn btn-sm btn-outline-info mt-3" target="_blank" title="Check All Remarks"><em class="icon ni ni-notice"></em></a>';
	$btn .= '&nbsp;&nbsp;<button type="button" data-id="'.$details['ticket_id'].'" class="btn btn-sm btn-outline-success mt-3" onclick="modalAddRemarks(this);" title="View Remarks"><em class="icon ni ni-note-add"></em></button>&nbsp; ';
	if((!in_array($details['status'], $tm_ticket_status_applicable)) && ($_SESSION['emp_role'] == "Team_Manager")){
		$btn .= '<div class="btn-group" aria-label="Basic example"><button type="button" data-id="'.$details['ticket_id'].'" class="btn btn-sm btn-outline-warning mt-3" onclick="view_tl_attachment(this);" title="view"><em class="icon ni ni-eye-alt-fill"></em></button>&nbsp; ';
	}
	if((!in_array($details['status'], $tl_ticket_status_applicable)) && ($_SESSION['emp_role'] == "project_manager")){
		$btn .= '<div class="btn-group" aria-label="Basic example"><button type="button" data-id="'.$details['ticket_id'].'" class="btn btn-sm btn-outline-warning mt-3" onclick="view_tm_attachment(this);" title="view"><em class="icon ni ni-eye-alt-fill"></em></button>&nbsp; ';
	}
	if(($_SESSION['emp_role'] == "Team_Manager") && ($details['status'] != $ticket_status['tm_upload_complete'])){
	$btn .= '<button type="button" id="uploadtlbutton" data-id="'.$details['ticket_id'].'" class="btn btn-sm btn-dim btn-outline-info mt-3" data-bs-target="#uploadAttachment"onclick="modaluploadtmattachment(this);" title="Upload"><em class="icon ni ni-upload"></em></button>';
	}
	else if(($_SESSION['emp_role'] == "project_manager") && ($details['status'] != $ticket_status['pm_upload_complete'])){
		$btn .= '<button type="button" id="uploadtlbutton" data-id="'.$details['ticket_id'].'" class="btn btn-sm btn-dim btn-outline-info mt-3" data-bs-target="#uploadAttachment"onclick="modaluploadpmattachment(this);" title="Upload"><em class="icon ni ni-upload"></em></button>';
	}
		$rows[] = $html_at;
		$rows[] = $btn;
		$records[] = $rows;
	}
}
else{
		$records = [];
}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);
}
// For all unassign teams
if(!empty($_POST['action']) && $_POST['action'] == 'get_project_record') {
	if($_SESSION['emp_role'] == "project_manager"){
		$sql = "SELECT tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, GROUP_CONCAT( am.assign_id) as assign_id, (select emp_name from employees_master where emp_id = tm.created_by)as created_by, (select emp_name from employees_master where emp_id = am.assign_id)as get_name_emp, (select emp_email from employees_master where emp_id = am.assign_id)as get_email_emp, (select emp_role from employees_master where emp_id = am.assign_id)as get_role_emp from ticket_master as tm LEFT join assign_master as am on tm.ticket_id = am.ticket_id where tm.status IN ($get_project_manager_ticket_status_applicable) GROUP BY tm.ticket_id";
	
		$getAllData = execute_query($sql);
	}
	if($_SESSION['emp_role'] == "Team_Manager"){
		// $sql="SELECT tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, GROUP_CONCAT( am.assign_id) as assign_id, (select emp_name from employees_master where emp_id = tm.created_by)as created_by, (select emp_name from employees_master where emp_id = am.assign_id)as get_name_emp, (select emp_email from employees_master where emp_id = am.assign_id)as get_email_emp, (select emp_role from employees_master where emp_id = am.assign_id)as get_role_emp from ticket_master as tm join assign_master as am on tm.ticket_id = am.ticket_id JOIN employees_master as em on am.assign_id = em.emp_id where am.assign_id = ".$_SESSION['emp_id']." and am.status = 1 and tm.status IN ('Assign to tm and qe') GROUP BY tm.ticket_id";
	// 	$sql = "SELECT tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, GROUP_CONCAT( am.assign_id) as assign_id,
	// 	(select emp_name from employees_master where emp_id = tm.created_by)as created_by,
	// 	(select emp_name from employees_master where emp_id = am.assign_id)as get_name_emp,
	// 	(select emp_email from employees_master where emp_id = am.assign_id)as get_email_emp, 
	// 	(select emp_role from employees_master where emp_id = am.assign_id)as get_role_emp, 
	// 	(SELECT GROUP_CONCAT(assign_id) FROM assign_master
	//    WHERE ticket_id = tm.ticket_id and assign_role = 'Quality_Tester') as 'assigned_ids' from ticket_master as tm join assign_master as am on tm.ticket_id = am.ticket_id
	// 	JOIN employees_master as em on am.assign_id = em.emp_id where am.assign_id = ".$_SESSION['emp_id']." and am.status = 1 and tm.status IN
	// 	('Assign to tm and qe') GROUP BY tm.ticket_id";
	// $sql = "SELECT tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, (SELECT GROUP_CONCAT(assign_id) FROM assign_master WHERE ticket_id = tm.ticket_id and assign_master.status = 1 and assign_master.assign_role!= 'Team_Manager') as 'assigned_ids' from ticket_master as tm join assign_master as am on tm.ticket_id = am.ticket_id JOIN employees_master as em on am.assign_id = em.emp_id where am.assign_id = ".$_SESSION['emp_id']." and am.status = 1 and tm.status IN ('Assign to tm and qe') GROUP BY tm.ticket_id";
	$sql = "SELECT tm.ticket_id,tm.wordcount,tm.assigned_deadline,tm.date_added,tm.status, (select GROUP_CONCAT(emp_name) from employees_master where emp_id in(SELECT assign_id FROM assign_master WHERE ticket_id = tm.ticket_id )) as 'assigned_name', (SELECT GROUP_CONCAT(assign_id) FROM assign_master WHERE ticket_id = tm.ticket_id and assign_master.status = 1 and assign_master.assign_role!= 'Team_Manager') as 'assigned_id', (select GROUP_CONCAT(emp_email) from employees_master where emp_id in(SELECT assign_id FROM assign_master WHERE ticket_id = tm.ticket_id and assign_master.status = 1 and assign_master.assign_role!= 'Team_Manager')) as 'assigned_email', (select GROUP_CONCAT(emp_role) from employees_master where emp_id in(SELECT assign_id FROM assign_master WHERE ticket_id = tm.ticket_id and assign_master.status = 1 and assign_master.assign_role!= 'Team_Manager')) as 'assigned_role', (select emp_name from employees_master where emp_id = tm.created_by)as created_by from ticket_master as tm join assign_master as am on tm.ticket_id = am.ticket_id JOIN employees_master as em on am.assign_id = em.emp_id where am.assign_id = ".$_SESSION['emp_id']." and am.status = 1 and tm.status IN ('Assign to tm and qe') GROUP BY tm.ticket_id";

		$getAllData = execute_query($sql);
		// print_r($getAllData);
		// print_r($getAllData[0]['assigned_name']);
	}
	if(!empty($getAllData))
	{
		foreach($getAllData as $details)
		{
			$rows = array();
			$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$details['ticket_id'].'">ID <b>#</b>'.$details['ticket_id'].'<br>Word Count:&nbsp'.($details['wordcount']).'<br>Created By:&nbsp'.($details['created_by']).'<br>Cost:&nbsp'.$details['created_by'].'</span>';	
			$rows[] = $details['assigned_deadline'];
			$rows[] = $details['date_added'];
			if($details['status'] == $ticket_status['Quality_Check_Failed']){
				$rows[] = '<span class="badge badge-dot bg-danger">'.$details['status'].'</span>';
			}else{
				$rows[] = '<span class="badge badge-dot bg-warning">'.$details['status'].'</span>';
			}
			$html_at='';
            $html_at .= '<ul class="preview-list g-1">';
			// $sql2 = "SELECT GROUP_CONCAT(assign_id) from assign_master where assign_by = " .$_SESSION['emp_id']." and ticket_id = ".$details['ticket_id']." and `status` = 1 Group by ticket_id";
			// $get_assign_data = execute_query($sql2);
			$employees_Array_details = array();
			// print_r($details['assigned_name']);

	// if(!empty($get_assign_data[0]['GROUP_CONCAT(assign_id)']))	{
		if(!empty($details['assigned_ids']))	{
		// $emp_id_array = explode(",",$get_assign_data[0]['GROUP_CONCAT(assign_id)']);
	// 	$emp_id_array = explode(",",$details['assigned_ids']);
	// 	foreach($emp_id_array as $key1)
	// 	{
	// 		$get_emp_details = select_query("employees_master",array("emp_name","emp_email","emp_role"),array('emp_id' => $key1));
	// 		$name_intial = printInitials($get_emp_details[0]['emp_name']);
	// 		$get_name = $get_emp_details[0]['emp_name'];
	// 		$get_email =$get_emp_details[0]['emp_email'];
	// 		$html_at .='<li class="preview-item"><div class="user-avatar"><spandata-bs-toggle="tooltip" data-bs-placement="top" title="'.$get_name.'('.$get_email.')'.'Role:'.($get_emp_details[0]['emp_role']).'" style="cursor:pointer;">'.$name_intial.'</span></div></li>';
	// }
	// print_r($details['assigned_name']);
	$emp_name_array = explode(",",$details['assigned_name']);
	// print_r($emp_name_array);
		foreach($emp_name_array as $name)
		{
			// $get_emp_details = select_query("employees_master",array("emp_name","emp_email","emp_role"),array('emp_id' => $key1));
			$name_intial = printInitials($name);
			$get_name = $get_emp_details[0]['emp_name'];
			$get_email =$get_emp_details[0]['emp_email'];
			$html_at .='<li class="preview-item"><div class="user-avatar"><spandata-bs-toggle="tooltip" data-bs-placement="top" title="'.$get_name.'('.$get_email.')'.'Role:'.($get_emp_details[0]['emp_role']).'" style="cursor:pointer;">'.$name_intial.'</span></div></li>';
	}
		$html_at .= '</ul>';
	}
	else{
		$html_at = 'Sorry, Not yet assigned';
	} 
		$rows[] = $html_at;
		$btn = '';		
		$btn .= '<div class="btn-group" aria-label="Basic example"> <button type="button" id="add-assign-tm" data-id="'.$details['ticket_id'].'" class="btn btn-sm btn-outline-primary mt-3" onclick="assign(this);" title="Assign Team Maneger"><em class="icon ni ni-plus-round-fill"></em></button>&nbsp;&nbsp;<button type="button" data-id="'.$details['ticket_id'].'" class="btn btn-sm btn-outline-warning mt-3" onclick="view_attchment(this);" title="view"><em class="icon ni ni-eye-alt-fill"></em></button>';	
		$btn .= '&nbsp;&nbsp;<a href =html/?action=ticket_description&ticketId='.$details['ticket_id'].' class="btn btn-sm btn-outline-info mt-3" target="_blank" title="Check All Remarks"><em class="icon ni ni-notice"></em></a>';		
		$rows[] = $btn;
		$records[] = $rows;
	}
}
else{
		$records = [];
}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);
}
// Get wc Records
if(!empty($_POST['action']) && $_POST['action'] == 'get_wc_data') {
	// print_r($_POST);
	// die;
	if($_POST['mon'] == "jan"){
		$first_day_month = date('Y-01-01');
		$last_day_month = date('Y-02-01');
		// $get_data_wc = get_wc($first_day_january_month, $last_day_january_month);	
	}
	elseif($_POST['mon'] == "feb"){
		$first_day_month = date('Y-02-01');
		$last_day_month = date('Y-03-01');   
		// $get_data_wc = get_wc($first_day_february_month, $last_day_february_month);
	}
	elseif($_POST['mon'] == "mar"){
		$first_day_month = date('Y-03-01');
		$last_day_month = date('Y-04-01');
		// $get_data_wc = get_wc($first_day_march_month, $last_day_march_month);
	}
	elseif($_POST['mon'] == "apr"){
		$first_day_month = date('Y-04-01');
		$last_day_month = date('Y-05-01');
		// $get_data_wc = get_wc($first_day_march_month, $last_day_march_month);
	}
	elseif($_POST['mon'] == "may"){
		$first_day_month = date('Y-05-01');
		$last_day_month = date('Y-06-01');
		// $get_data_wc = get_wc($first_day_march_month, $last_day_march_month);
	}
	elseif($_POST['mon'] == "jun"){
		$first_day_month = date('Y-06-01');
		$last_day_month = date('Y-07-01');
		// $get_data_wc = get_wc($first_day_march_month, $last_day_march_month);
	}
	elseif($_POST['mon'] == "jul"){
		$first_day_month = date('Y-07-01');
		$last_day_month = date('Y-08-01');
		// $get_data_wc = get_wc($first_day_march_month, $last_day_march_month);
	}
	elseif($_POST['mon'] == "aug"){
		$first_day_month = date('Y-08-01');
		$last_day_month = date('Y-09-01');
		// $get_data_wc = get_wc($first_day_march_month, $last_day_march_month);
	}
	elseif($_POST['mon'] == "sep"){
		$first_day_month = date('Y-09-01');
		$last_day_month = date('Y-10-01');
		// $get_data_wc = get_wc($first_day_march_month, $last_day_march_month);
	}
	elseif($_POST['mon'] == "oct"){
		$first_day_month = date('Y-10-01');
		$last_day_month = date('Y-11-01');
		// $get_data_wc = get_wc($first_day_march_month, $last_day_march_month);
	}
	elseif($_POST['mon'] == "nov"){
		$first_day_month = date('Y-11-01');
		$last_day_month = date('Y-12-01');
		// $get_data_wc = get_wc($first_day_march_month, $last_day_march_month);
	}
	elseif($_POST['mon'] == "dec"){
		$first_day_month = date('Y-12-01');
		// $last_day_month = date('Y-12-31');
		$current_year = date('Y');
		$next_year= $current_year + 1;
		$last_day_month = "".$next_year."-01-01";
		// $get_data_wc = get_wc($first_day_march_month, $last_day_march_month);
	}

	$get_wc_cu = execute_query("SELECT ticket_payment.p_id, ticket_payment.ticket_id, ticket_payment.transaction_date, ticket_payment.transaction_id, ticket_payment.accounts_approval_date, ticket_payment.accounts_approval_by, ticket_payment.status, ticket_payment.date_added, ticket_payment.invoice_number, ticket_payment.payment_attached_by, ticket_payment.inr_rate, ticket_payment.total_value, ticket_payment.wordcount, sum(ticket_payment.amount_received) as get_total_val, invoice_master.extra_charges,invoice_master.std_rate FROM ticket_payment join invoice_master on ticket_payment.ticket_id = invoice_master.ticket_id where `created_by` = ".$_SESSION['emp_id']." and (ticket_payment.date_added BETWEEN  '$first_day_month' AND '$last_day_month') and ticket_payment.status = 'success' GROUP BY ticket_payment.ticket_id");
	if($get_wc_cu)
    {
		$get_Cu_final_value = 0;
    $get_dashboard_value = array();
    $calculateExtraWordCountMonthly = 0;
	// $rows = array();
	// $rows[] = $_SESSION['emp_id'];
	// 		$rows[] = $_SESSION['emp_role'];
    foreach($get_wc_cu as $key => $val){
	$rows = array();

			$rows[] = $_SESSION['emp_id'];
			$rows[] = $_SESSION['emp_name'];
			$rows[] = $_SESSION['emp_role'];
			$rows[] = $val['p_id'];
			$rows[] = $val['ticket_id'];
			if(!empty($val['status']))
			{
				$wordCountMonthly = 0;
				if($val['extra_charges'] != '')
				{
					$calculateExtraWordCountMonthly = ((($val['wordcount'] / ($val['total_value'] - $val['extra_charges']))* $val['extra_charges']));

				}
				$wordCountMonthly = $val['wordcount']+round($calculateExtraWordCountMonthly,2);
				$get_cu_value = (($val['get_total_val'] / $val['total_value'])* $wordCountMonthly);
				$get_Cu_final_value += $get_cu_value;
				$rows[]	=$get_Cu_final_value;
				array_push($get_dashboard_value,$get_Cu_final_value);
				$calculateExtraWordCountMonthly = 0;
			}
			$records[] = $rows;
		}
	}
	else{
		$records = [];
	}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// // Upload tl files
if(!empty($_POST['action']) && $_POST['action'] == 'uploadtlfiles') {
    $get_id = $_POST['uploadtlticket_id'];

    $tl_file_path = "tl_upload";
    if(!empty($_FILES['uploadtlattachment']['name'][0])){
        $name = file_upload($_FILES['uploadtlattachment'], $tl_file_path);
		foreach($name as $key){ 
			$extn_array = explode(".",$key);
			$extn = $extn_array[1];
			$data = array();
			$data['ticket_id'] = $get_id; 
			$data['extension'] = $extn;
			$extn = strtolower($extn);
			$data['file_name'] = $key;
			// if(in_array($extn,$image_exten)){
			// 	$data['file_name'] = $key; 
			// }
			// if(in_array($extn,$doc_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$pdf_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$video_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$excel_exten)){
			// 	$data['file_name'] = $key;
			// }
		}
        if(isset($_POST['tl_complete_check']) && $_POST['tl_complete_check'] == 'on'){
			execute_update('ticket_master',array('output_documents_id' => 1, 'status' => $ticket_status['tl_upload_complete'], 'is_viewed' => 1),array('ticket_id' => $get_id));
            $data['documents_type'] = $document_type['Check_For_tm'];
            execute_insert("input_documents", $data);
            $get_documents_id = select_query('input_documents', array('id'), array('ticket_id' => $get_id, 'documents_type' => $document_type['Tl_Uploaded']));
            if(!empty($get_documents_id)){
				$get_docs_id = array();
				foreach ($get_documents_id as $key => $val)
				{
					array_push($get_docs_id, $val['id']);
				}
				$select_update_id_tl = implode(", ",$get_docs_id);
				$exec_sql = "UPDATE `input_documents` SET `documents_type` = '".$document_type['Check_For_tm']."' where `id` IN ($select_update_id_tl)";
				$get_exec = execute_query_status($exec_sql);
				$exec_ticket = "UPDATE `ticket_master` SET status = '".$ticket_status['tl_upload_complete']."' where `ticket_id` IN ($get_id)";
				$get_ticket_exec = execute_query_status($exec_ticket);
			}
				
            echo json_encode(array("response"=>'Upload Successfully', "status" => 'success', "data"=>$get_ticket_exec));
        }
        else{
            $data['documents_type'] = $document_type['Tl_Uploaded'];
            $get_result_tl = execute_insert("input_documents", $data);
            echo json_encode(array("response"=>'Upload Successfully', "status" => 'success', "data"=>$get_result_tl));
      }

    }
}
// Upload tm files
if(!empty($_POST['action']) && $_POST['action'] == 'uploadtmfiles') {
    $get_id = $_POST['uploadtmticket_id'];

    $tm_file_path = "tm_upload";
    if(!empty($_FILES['uploadtmattachment']['name'][0])){
        $name = file_upload($_FILES['uploadtmattachment'], $tm_file_path);
		foreach($name as $key){ 
			$extn_array = explode(".",$key);
			$extn = $extn_array[1];
			$data = array();
			$data['ticket_id'] = $get_id; 
			$data['extension'] = $extn;
			$extn = strtolower($extn);
			$data['file_name'] = $key;
			// if(in_array($extn,$image_exten)){
			// 	$data['file_name'] = $key; 
			// }
			// if(in_array($extn,$doc_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$pdf_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$video_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$excel_exten)){
			// 	$data['file_name'] = $key;
			// }
		}
        if(isset($_POST['tm_complete_check']) && $_POST['tm_complete_check'] == 'on'){
			execute_update('ticket_master',array('output_documents_id' => 1, 'status' => $ticket_status['tm_upload_complete'], 'is_viewed' => 1),array('ticket_id' => $get_id));
            $data['documents_type'] = $document_type['Check_For_pm'];
            execute_insert("input_documents", $data);
            $get_documents_id = select_query('input_documents', array('id'), array('ticket_id' => $get_id, 'documents_type' => $document_type['Tm_Uploaded']));
            if(!empty($get_documents_id)){
				$get_docs_id = array();
				foreach ($get_documents_id as $key => $val)
				{
					array_push($get_docs_id, $val['id']);
				}
				$select_update_id = implode(", ",$get_docs_id);
				$exec_sql = "UPDATE `input_documents` SET documents_type = '".$document_type['Check_For_pm']."' where id IN ($select_update_id)";
				$get_exec = execute_query_status($exec_sql);
				$exec_ticket = "UPDATE `ticket_master` SET status = '".$ticket_status['tm_upload_complete']."' where `ticket_id` = $get_id";
				$get_ticket_exec = execute_query_status($exec_ticket);
			}
				
            echo json_encode(array("response"=>'Upload Successfully', "status" => 'success', "data"=>$get_ticket_exec));
        }
        else{
            $data['documents_type'] = $document_type['Tm_Uploaded'];
            $get_result_tm = execute_insert("input_documents", $data);
            echo json_encode(array("response"=>'Upload Successfully', "status" => 'success', "data"=>$get_result_tm));
      }

    }
}
// Upload pm files
if(!empty($_POST['action']) && $_POST['action'] == 'uploadpmfiles') {
    $get_id = $_POST['uploadpmticket_id'];

    $pm_file_path = "pm_upload";
    if(!empty($_FILES['uploadpmattachment']['name'][0])){
        $name = file_upload($_FILES['uploadpmattachment'], $pm_file_path);
		foreach($name as $key){ 
			$extn_array = explode(".",$key);
			$extn = $extn_array[1];
			$data = array();
			$data['ticket_id'] = $get_id; 
			$data['extension'] = $extn;
			$extn = strtolower($extn);
			$data['file_name'] = $key;
			// if(in_array($extn,$image_exten)){
			// 	$data['file_name'] = $key; 
			// }
			// if(in_array($extn,$doc_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$pdf_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$video_exten)){
			// 	$data['file_name'] = $key;
			// }
			// if(in_array($extn,$excel_exten)){
			// 	$data['file_name'] = $key;
			// }
		}
        if(isset($_POST['pm_complete_check']) && $_POST['pm_complete_check'] == 'on'){
			execute_update('ticket_master',array('output_documents_id' => 1, 'status' => $ticket_status['pm_upload_complete'], 'is_viewed' => 1),array('ticket_id' => $get_id));
            $data['documents_type'] = $document_type['Check_For_client'];
            execute_insert("input_documents", $data);
            $get_documents_id = select_query('input_documents', array('id'), array('ticket_id' => $get_id, 'documents_type' => $document_type['Pm_Uploaded']));
            if(!empty($get_documents_id)){
				$get_docs_id = array();
				foreach ($get_documents_id as $key => $val)
				{
					array_push($get_docs_id, $val['id']);
				}
				$select_update_id = implode(", ",$get_docs_id);
				$exec_sql = "UPDATE `input_documents` SET documents_type = '".$document_type['Check_For_client']."' where id IN ($select_update_id)";
				$get_exec = execute_query_status($exec_sql);
				$exec_ticket = "UPDATE `ticket_master` SET status = '".$ticket_status['pm_upload_complete']."' where `ticket_id` = $get_id";
				$get_ticket_exec = execute_query_status($exec_ticket);
			}
				
            echo json_encode(array("response"=>'Upload Successfully', "status" => 'success', "data"=>$get_ticket_exec));
        }
        else{
            $data['documents_type'] = $document_type['Pm_Uploaded'];
            $get_result_pm = execute_insert("input_documents", $data);
            echo json_encode(array("response"=>'Upload Successfully', "status" => 'success', "data"=>$get_result_pm));
      }

    }
}
// Get ticket Records
if(isset($_POST['action']) && $_POST['action'] == 'getlistRecords') {
	$payment_desc = select_query("payment_master",array("transaction_id","amount_received", "accounts_approval_date"),array("ticket_id" => "id"));
    $get_records_ticket = get_ticket();

	$records = [];

	if(!empty($get_records_ticket))
	{
		$cost = ($get_records_ticket[0]['rate'])*($get_records_ticket[0]['wordcount']);

		foreach($get_records_ticket as $key => $val){ 
			$rows = array();
			$getDateFromTicketCreated = explode(" ",$val['date_added']);
			$dateAdded = $getDateFromTicketCreated[0];

			$ticket_value = round((($val['wordcount'] * $val['rate'])/ $val['word_limit']),2)+ (int)$val['extra_amount'];
			$rows[] = '<span data-bs-toggle="tooltip" data-id="'.$val['ticket_id'].'" onclick="get_id(this);">ID <b>#</b>'.$val['ticket_id'].'<br>Word Count:&nbsp'.($val['wordcount']).'<br>Date added:&nbsp'.($dateAdded).'<br>Created By:&nbsp'.($val['emp_name']).'<br>Cost:&nbsp'.$val['total_value'].' '.$val['currency'].'</span>';
			$rows[] = $dateAdded;
			$rows[] = '<span><em class="ni ni-user"></em>&nbsp'.$val['customer_name']."<br><em class='icon ni ni-mobile'></em>&nbsp<a href = 'https://wa.me/".$val['phone_number']."'>".$val['phone_number']."</a><br><em class='icon ni ni-mail-fill'></em>&nbsp<a href = 'mailto:".$val['customer_email']."'>".$val['customer_email'].'</a></span>';
			$earlier = new DateTime(date('Y-m-d'));
			$later = new DateTime($val['assigned_deadline']);
			$pos_diff = $earlier->diff($later)->format("%r%a"); //3
			if($val['assigned_date'] != '0000-00-00 00:00:00')
			{
				$get_date = explode(' ',$val['assigned_date']);
				$rows[] = $get_date[0];
			}
			else{
				$rows[] = 'N/A';
			}
			if( $val['assigned_deadline'] != '0000-00-00 00:00:00')
			{
				$get_dedline = explode(' ',$val['assigned_deadline']);
				$rows[] = $get_dedline[0];
			}
			else{
				$rows[] = 'N/A';
			}
			if($val['assigned_date'] != '0000-00-00 00:00:00' && $val['assigned_deadline'] != '0000-00-00 00:00:00')
			{		
				if($pos_diff <= 2){
						$rows[] = '<span class="text-danger">'.$pos_diff.' Days Left</span>';
					}else{
						$rows[] = '<span class="text-success">'.$pos_diff.' Days Left</span>';
					}
			}	
			else{
				$rows[] = '<span class="text-primary">Sorry, No Date Found</span>';
			}	
			if($val['status'] == $ticket_status['Ticket_Created']){
				$rows[] = '<span class="badge badge-dot bg-danger">'.$val['status'].'</span>';
			}
			else if($val['status'] == $ticket_status['Ticket_Close']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else if($val['status'] == $ticket_status['Ticket_Archieve']){
				$rows[] = '<span class="badge badge-dot bg-success">'.$val['status'].'</span>';
			}
			else{
				// $rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].'</span>';
				$rows[] = '<span class="badge badge-dot bg-warning">'.$val['status'].' <br> '.$val['status_payment'].'</span>';
			}
			$records[] = $rows;
		}
	}
	

	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	
	echo json_encode($output);

}
// Get all wc Records
if(!empty($_POST['action']) && $_POST['action'] == 'get_rec_all') {
	// $get_wc_all = execute_query("SELECT ticket_payment.p_id, ticket_payment.ticket_id, ticket_payment.transaction_date, ticket_payment.transaction_id, ticket_payment.accounts_approval_date, ticket_payment.accounts_approval_by, ticket_payment.status, ticket_payment.date_added, ticket_payment.invoice_number, ticket_payment.payment_attached_by, ticket_payment.inr_rate, ticket_payment.total_value, ticket_payment.wordcount, sum(ticket_payment.amount_received) as get_total_val, invoice_master.extra_charges,invoice_master.std_rate FROM ticket_payment join invoice_master on ticket_payment.ticket_id = invoice_master.ticket_id where `created_by` = ".$_SESSION['emp_id']." and ticket_payment.status = 'success' GROUP BY ticket_payment.ticket_id");

	$get_wc_all = execute_query("SELECT ticket_payment.p_id, ticket_payment.ticket_id, ticket_payment.transaction_date, ticket_payment.transaction_id, ticket_payment.accounts_approval_date, ticket_payment.accounts_approval_by, ticket_payment.status, ticket_payment.date_added, ticket_payment.invoice_number, ticket_payment.payment_attached_by, ticket_payment.inr_rate, ticket_payment.total_value, ticket_payment.wordcount, sum(ticket_payment.amount_received) as get_total_val, invoice_master.extra_charges,invoice_master.std_rate, (SELECT emp_name FROM employees_master WHERE emp_id = ticket_payment.accounts_approval_by) as name_emp, (SELECT emp_name FROM employees_master WHERE emp_id = ticket_payment.payment_attached_by) as emp_name FROM ticket_payment join invoice_master on ticket_payment.ticket_id = invoice_master.ticket_id where `created_by` = ".$_SESSION['emp_id']." and ticket_payment.status = 'success' GROUP BY ticket_payment.ticket_id");


	if(!empty($get_wc_all))
	{
	foreach($get_wc_all as $key => $val){ 
		$rows = array();
		$rows[] = $val['p_id'];
		$rows[] = $val['ticket_id'];
		$rows[] = $val['transaction_date'];
		$rows[] = $val['transaction_id'];
		$rows[] = $val['accounts_approval_date'];
		// $rows[] = $val['accounts_approval_by'];
		$rows[] = $val['name_emp'];
		$rows[] = $val['status'];
		$rows[] = $val['date_added'];
		// $rows[] = $val['invoice_number'];
		// $rows[] = $val['payment_attached_by'];
		$rows[] = $val['emp_name'];
		$rows[] = $val['inr_rate'];
		$rows[] = $val['total_value'];
		$rows[] = $val['wordcount'];
		$rows[] = $val['get_total_val'];
		$rows[] = $val['extra_charges'];
		$rows[] = $val['std_rate'];
		$records[] = $rows;
	}
	}
	else{
		$records = [];
	}
	$output = array(
		"draw"	=>	0,			
		"iTotalRecords"	=> 	count($records),
		"iTotalDisplayRecords"	=>  count($records),
		"data"	=> 	$records
	);
	echo json_encode($output);
}
// Get User Details
if(!empty($_POST['action']) && $_POST['action'] == 'getUserDetails')
{
	$emp_desc = select_query("employees_master",array("emp_name", "emp_phone_no", "user_dob", "user_address1", "user_address2", "user_state", "user_pincode"),array("emp_id" => $_POST['data']));
	echo json_encode(["response"=>'Fetch Successfully', "status" => 'success', 'data'=>$emp_desc]);

}
//edit user profile in modal
if(!empty($_POST['action']) && $_POST['action'] == 'EditProfile') {
	$emp_update = execute_update('employees_master',array('emp_name'=>$_POST["name_user"], 'emp_phone_no'=>$_POST["ph_user"], 'user_dob'=>$_POST["dob_user"], 'user_address1'=>$_POST["name_l1_address"], 'user_address2'=>$_POST["name_l2_address"], 'user_state'=>$_POST["name_st_address"], 'user_pincode'=>$_POST["name_pin_address"]),array('emp_id' =>$_SESSION['emp_id']));
	echo json_encode(["response"=>'Updated Successfully', "status" => 'success', 'data'=>$emp_update]);
}
?>