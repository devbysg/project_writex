<?php
require_once 'dompdf/autoload.inc.php'; 
require_once 'dompdf/vendor/autoload.php'; 
include_once('../html/constant.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function execute_insert($table_name, $data_arr)
{
    global $conn;
    $get_key_array = array_keys($data_arr);
    $get_key_string = "`" .implode("`,`", $get_key_array) ."`";
   
    $get_data = "'" . implode ( "', '", $data_arr ) . "'";
    $query = "INSERT INTO `$table_name` ($get_key_string) VALUES ($get_data)";
    // print_r($query);
    // die();
    $insert_conc = mysqli_query($conn,$query);
    $last_id = $conn->insert_id;
    return $last_id;
}

function execute_query($query){
  global $conn;
  // print_r($query);
  // die;
  $result = mysqli_query($conn, $query);
  $fetch_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $fetch_data;
}

function execute_query_status($query){
  global $conn;
  // print_r($query);
  $result = mysqli_query($conn, $query);
  return $result;
}

function get_ticket(){
  global $conn;
    

    if($_SESSION['emp_role'] == "Admin" || $_SESSION['emp_role'] == "Accounts" || $_SESSION['emp_role'] == "project_manager" || $_SESSION['emp_role'] == "sales_lead"){
      // $sql = "Select  `t`.`ticket_id`,`t`.`status`,`t`.`input_documents_id`, `t`.`wordcount`, `t`.`extra_amount`, `t`.`assigned_date`, `t`.`assigned_deadline`, `t`.`total_value`,`t`.`date_added`,ADDTIME(SYSDATE(),'0 05:30:00') as current_datetime,TIMEDIFF(`t`.`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) AS restTime, `payment_master`.`status` as payment_status, cm.customer_name,cm.customer_email,cm.phone_number, ccm.rate, ccm.currency, ccm.word_limit, em.emp_name FROM writex.`ticket_master` t  INNER JOIN  writex.customer_master cm on t.customer_id  = cm.customer_id JOIN payment_master on payment_master.ticket_id = `t`.`ticket_id` INNER JOIN  writex.`country_cost_master` ccm on t.country_id = ccm.country_id left JOIN employees_master as em on t.created_by = em.emp_id ORDER BY TIMEDIFF(`t`.`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) asc";
    // }else{
    //   $sql = "Select  `t`.`ticket_id`,`t`.`status`,`t`.`input_documents_id`, `t`.`wordcount`, `t`.`extra_amount`, `t`.`assigned_date`, `t`.`assigned_deadline`, `t`.`total_value`,`t`.`date_added`,ADDTIME(SYSDATE(),'0 05:30:00') as current_datetime,TIMEDIFF(`t`.`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) AS restTime, `payment_master`.`status` as payment_status, cm.customer_name,cm.customer_email,cm.phone_number, ccm.rate, ccm.currency, ccm.word_limit, em.emp_name FROM writex.`ticket_master` t  INNER JOIN  writex.customer_master cm on t.customer_id  = cm.customer_id JOIN payment_master on payment_master.ticket_id = `t`.`ticket_id` INNER JOIN  writex.`country_cost_master` ccm on t.country_id = ccm.country_id left JOIN employees_master as em on t.created_by = em.emp_id WHERE `created_by`= ".$_SESSION['emp_id']." ORDER BY TIMEDIFF(`t`.`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) asc LIMIT 0, 10000";
    // }
    $sql = "Select  `t`.`ticket_id`,`t`.`status`,`t`.`input_documents_id`, `t`.`wordcount`, `t`.`extra_amount`, `t`.`assigned_date`, `t`.`assigned_deadline`, `t`.`total_value`,`t`.`date_added`,`t`.`status_payment`,ADDTIME(SYSDATE(),'0 05:30:00') as current_datetime,TIMEDIFF(`t`.`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) AS restTime, cm.customer_name,cm.customer_email,cm.phone_number, ccm.rate, ccm.currency, ccm.word_limit, em.emp_name FROM  aws_writex_db.`ticket_master` t  INNER JOIN   aws_writex_db.customer_master cm on t.customer_id  = cm.customer_id INNER JOIN   aws_writex_db.`country_cost_master` ccm on t.country_id = ccm.country_id left JOIN employees_master as em on t.created_by = em.emp_id ORDER BY TIMEDIFF(`t`.`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) asc";
  }else{
    $sql = "Select  `t`.`ticket_id`,`t`.`status`,`t`.`input_documents_id`, `t`.`wordcount`, `t`.`extra_amount`, `t`.`assigned_date`, `t`.`assigned_deadline`, `t`.`total_value`,`t`.`date_added`,`t`.`status_payment`,ADDTIME(SYSDATE(),'0 05:30:00') as current_datetime,TIMEDIFF(`t`.`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) AS restTime, cm.customer_name,cm.customer_email,cm.phone_number, ccm.rate, ccm.currency, ccm.word_limit, em.emp_name FROM  aws_writex_db.`ticket_master` t  INNER JOIN   aws_writex_db.customer_master cm on t.customer_id  = cm.customer_id INNER JOIN   aws_writex_db.`country_cost_master` ccm on t.country_id = ccm.country_id left JOIN employees_master as em on t.created_by = em.emp_id WHERE `created_by`= ".$_SESSION['emp_id']." ORDER BY TIMEDIFF(`t`.`assigned_deadline`,ADDTIME(SYSDATE(),'0 05:30:00')) asc LIMIT 0, 10000";
  }
   
    $result = mysqli_query($conn, $sql);

    // Fetch all
    $fetch_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $fetch_data;
}

// Get Ticket by ID
function get_ticket_id(){
  global $conn;
  

    if($_SESSION['emp_role'] == "Admin" || $_SESSION['emp_role'] == "Accounts" || $_SESSION['emp_role'] == "project_manager" || $_SESSION['emp_role'] == "sales_lead"){
      $sql = "Select  `t`.`ticket_id`,`t`.`status`,`t`.`input_documents_id`,`t`.`date_added`,`t`.`status_payment`, `t`.`wordcount`, `t`.`extra_amount`, `t`.`assigned_date`, `t`.`assigned_deadline`, `t`.`total_value`, cm.customer_name,cm.customer_email,cm.phone_number, ccm.rate, ccm.currency, ccm.word_limit, em.emp_name FROM  aws_writex_db.`ticket_master` t  INNER JOIN  aws_writex_db.customer_master cm on t.customer_id  = cm.customer_id INNER JOIN  aws_writex_db.`country_cost_master` ccm on t.country_id = ccm.country_id left JOIN employees_master as em on t.created_by = em.emp_id order by t.ticket_id desc";
    }else{
      $sql = "Select  `t`.`ticket_id`,`t`.`status`,`t`.`input_documents_id`,`t`.`date_added`,`t`.`status_payment`, `t`.`wordcount`, `t`.`extra_amount`, `t`.`assigned_date`, `t`.`assigned_deadline`, `t`.`total_value`, cm.customer_name,cm.customer_email,cm.phone_number, ccm.rate, ccm.currency, ccm.word_limit, em.emp_name FROM  aws_writex_db.`ticket_master` t  INNER JOIN   aws_writex_db.customer_master cm on t.customer_id  = cm.customer_id INNER JOIN   aws_writex_db.`country_cost_master` ccm on t.country_id = ccm.country_id left JOIN employees_master as em on t.created_by = em.emp_id WHERE `created_by`= ".$_SESSION['emp_id']." ORDER BY t.ticket_id desc";
    }
    $result = mysqli_query($conn, $sql);

    // Fetch all
    $fetch_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $fetch_data;
}


function select_query($table_name, $output_array, $input_array = 0,$condition=0){ 
    //variable for key values
    global $conn;

    $keys = implode(" ,",$output_array);
    $query = "SELECT $keys FROM `$table_name` ";
    if(!empty($input_array)){
      foreach($input_array as $key => $val){
        $data_arr[] = "`" . $key. "` = '" . $input_array[$key] . "'";
      }
      $where_Cond = implode("AND",$data_arr);
      $query .= 'where '. $where_Cond;
    }
    if(!empty($condition)){
      $query .= $condition;
    }
    // print_r($query);
    $result = mysqli_query($conn, $query);
    // Fetch all
    $fetch_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $fetch_data;
}

function file_upload($files,$path = 0){
    $files_array = array();
    $countfiles = count($files['name']);
    for($i=0;$i<$countfiles;$i++){
      $filename = $files["name"][$i];
      $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
      $file_ext = substr($filename, strripos($filename, '.')); // get file name
      $filesize = $files["size"][$i];
      // $newfilename = rand(10,100).time(). $file_ext;
      $newfilename = $file_basename."-".rand(10,100).time(). $file_ext;
      // print_r($newfilename);
      if($path)
      {
        $file_path = "../upload/".$path."/".$newfilename;
        move_uploaded_file($files["tmp_name"][$i], $file_path);
        array_push($files_array,$newfilename);
        // echo"Hii";
        // die("bbb");
      }else{
        move_uploaded_file($files["tmp_name"][$i], "../upload/" . $newfilename);
        array_push($files_array,$newfilename);
      // echo"Hello, world!";
      // die("aaa");
      }
    }
    return  $files_array;
  }

function select_all($table_name)
{
    global $conn;
    $query = "SELECT * FROM `$table_name`";
    $query_run = mysqli_query($conn, $query);
    $fetch_data = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
    
    return $fetch_data; 
}

function get_data($table_name, $id)
{
    global $conn;
    $query = "SELECT * FROM `$table_name` where `ticket_id` = $id";
    $get_query = mysqli_query($conn, $query);
    $record_data = mysqli_fetch_assoc($get_query);
    return $record_data; 
}

function execute_update($table_name, $effected_column,$cond_array)
{
    global $conn;
    $data_arr_new = array();
    foreach($effected_column as $key => $val){
      $data_arr_new[] = $key." = "."'".$effected_column[$key]."'";
    }
    $effected_col_string = implode(",",$data_arr_new);
    $data_arr = array();
    foreach($cond_array as $key => $val){
      $data_arr[] = $key." = ".$cond_array[$key];
    }
    $where_Cond = implode("AND",$data_arr);
    $sql = "UPDATE `$table_name` SET ". $effected_col_string .' where '. $where_Cond;

    $get_query = mysqli_query($conn, $sql);

    return $get_query; 
}
function prepare_mail_msg($msg, $data = array()){

	if(stripos($msg, "[FNAME]") !== false && !empty($data["first_name"])){
		$msg = str_replace("[FNAME]", $data["first_name"], $msg);
	}else{
		$msg = str_replace("[FNAME]", "", $msg);
	}
	
	if(stripos($msg, "[NAME]") !== false && !empty($data["full_name"])){
	    $msg = str_replace("[NAME]", $data["full_name"], $msg);
	}else{
	    $msg = str_replace("[NAME]", "", $msg);
	}

	if(stripos($msg, "[LNAME]") !== false && !empty($data["last_name"])){
		$msg = str_replace("[LNAME]", $data["last_name"], $msg);
	}else{
		$msg = str_replace("[LNAME]", "", $msg);
	}

  if(stripos($msg, "[TICKET_ID]") !== false && !empty($data["ticket_id"])){
		$msg = str_replace("[TICKET_ID]", $data["ticket_id"], $msg);
	}else{
		$msg = str_replace("[TICKET_ID]", "", $msg);
	}
  if(stripos($msg, "[OTP]") !== false && !empty($data["otp"])){
		$msg = str_replace("[OTP]", $data["otp"], $msg);
	}else{
		$msg = str_replace("[OTP]", "", $msg);
	}
	
	return $msg;
}

function send_mail($email,$template_type = 0){
  $mail = new PHPMailer;
 
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'achievexsolutions.in';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'support@achievexsolutions.in';                 // SMTP username
  $mail->Password = 'AchieveXSupport22';                           // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                                    // TCP port to connect to

  $mail->setFrom('support@achievexsolutions.in', 'WriteX');
  $mail->addAddress($email);     // Add a recipient
  $mail->addCC('19aftab96@gmail.com');

  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->SMTPDebug = 0;
  $template_details = select_query("template_master",array('template_subject','template_body'),array('template_type' => $template_type));
  $mail->Subject =  $template_details[0]['template_subject'];

  $mail->Body    = $template_details[0]['template_body'];
  $resp = $mail->send();
  return $resp;
}
function send_mail_attachment($email,$subject,$body,$path){

  $mail = new PHPMailer;
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'achievexsolutions.in';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'support@achievexsolutions.in';                 // SMTP username
  $mail->Password = 'AchieveXSupport22';                           // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                                    // TCP port to connect to
  $mail->setFrom('support@achievexsolutions.in', 'WriteX');
  $mail->addAddress($email);
  $mail->addCC('writexemail@gmail.com');
  $mail->addCC($_SESSION['emp_email']);
  $mail->addAttachment($path);         // Add attachments
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->SMTPDebug = 0;
  $mail->Subject = $subject;
  $mail->Body = $body;
  $resp = $mail->send();
  return  $resp;
   
}
function send_mail_attachment_multi($email,$subject,$body,$path_array){
  
  $mail = new PHPMailer;
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'achievexsolutions.in';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'support@achievexsolutions.in';                 // SMTP username
  $mail->Password = 'AchieveXSupport22';                           // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                                    // TCP port to connect to

  $mail->setFrom('support@achievexsolutions.in', 'WriteX');
  $mail->addAddress($email);     // Add a recipient
  $mail->addCC('19aftab96@gmail.com');
  foreach($path_array as $key){
    $mail->addAttachment($key);
  }
  $mail->isHTML(true);                                  // Set email format to HTML
  $mail->SMTPDebug = 0;
  $mail->Subject =  $subject;
  $mail->Body = $body;
  $resp = $mail->send();
  return  $resp;
   
}
function create_pdf(){  
  ob_end_clean();
  require('../html/pdf.php');
  return $_SESSION['invoice_number'];
}
function numberToAmount($number,$curr){
   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  $final_amount =  $result . "Rupees  ".$curr ;
  return $final_amount;
}
function final_pdf($ticket_id){

	// $sql = 'SELECT t.ticket_desc,t.wordcount,t.country_id,i.invoice_number,i.invoice_amount,c.customer_name,c.customer_email,c.customer_name,c.phone_number,ccm.currency,ccm.rate,SUM(amount_received) as Current_paid from ticket_master t INNER JOIN invoice_master i on t.ticket_id = i.ticket_id INNER JOIN customer_master c on t.customer_id = c.customer_id INNER JOIN country_cost_master ccm ON t.country_id = ccm.country_id INNER JOIN payment_master p ON t.ticket_id = p.ticket_id WHERE t.ticket_id ='.$ticket_id;
  $sql = 'SELECT t.wordcount,t.country_id,i.invoice_number,i.invoice_amount,c.customer_name,c.customer_email,c.customer_name,c.phone_number,ccm.currency,ccm.rate,SUM(amount_received) as Current_paid from ticket_master t INNER JOIN invoice_master i on t.ticket_id = i.ticket_id INNER JOIN customer_master c on t.customer_id = c.customer_id INNER JOIN country_cost_master ccm ON t.country_id = ccm.country_id INNER JOIN payment_master p ON t.ticket_id = p.ticket_id WHERE t.ticket_id ='.$ticket_id;
	$get_data = execute_query($sql);
	$due_Amount = $get_data[0]["invoice_amount"]-$get_data[0]["Current_paid"];
	if (date('m') <= 6) {//Upto June 2014-2015
		$financial_year = (date('Y')-1) . '-' . date('Y');
	} else {//After June 2015-2016
		$financial_year = date('Y') . '-' . (date('Y') + 1);
	}
	$invoice_number =  $ticket_id."-".$financial_year."-F";
	$amount_in_words = numberToAmount($due_Amount,$get_data[0]['currency']);
    $info=[
        "customer"=> $get_data[0]['customer_name'],
        "email"=> $get_data[0]['customer_email'],
        "phone"=> $get_data[0]['phone_number'],
        "invoice_no" => invoice_number,
        "invoice_date" => date("Y/m/d"),
        "total_amt"=> $get_data[0]["invoice_amount"],
        "words" => $amount_in_words,
		"total_paid" => $get_data[0]["Current_paid"],
		"due" => $due_Amount,
		"invoice_no" => $invoice_number,
    ];

    $products_info=[
        [
          // "desc" => $get_data[0]["ticket_desc"],
          "word_count" => $get_data[0]["wordcount"],
          "rate" => $get_data[0]['rate'],
          "total" => $get_data[0]['invoice_amount']
        ]
    ];
   	require('../html/final_pdf.php');
   	$pdf=new PDF("P","mm","A4");
  	$pdf->AddPage();
   	$pdf->body($info,$products_info);
	
	
	$path =  "../upload/pdf/".$invoice_number.".pdf";
   	$pdf->Output('F', $path);
	execute_update('invoice_master',array('final_invoice_number' => $invoice_number),array('ticket_id' => $ticket_id));
	return $invoice_number;
}
function execute_query_update($query){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "writex";
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $db);
  
  
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $result = mysqli_query($conn, $query);
  return $result;
}
// First, Middle and Last word of name picker
function printInitials($name)
{ 
    $names = '';
    if (strlen($name) == 0){
      return false;
    }else{
      $names .= strtoupper($name[0]);
    }
   
    // Since toupper() returns int, we do typecasting
    
 
    // Traverse rest of the string and print the
    // characters after spaces.
    for ($i = 1; $i < strlen($name) - 1; $i++){
        if ($name[$i] == ' '){
          $names .= " " . strtoupper($name[$i + 1]);
        }
       
    }
    return $names;
}

// amount to Word Convert
function amountToWord($number,$currency){
	//$number = 2500;
     $no = floor($number);
     $point = round($number - $no, 2) * 100;
     $hundred = null;
     $digits_1 = strlen($no);
     $i = 0;
     $str = array();
     $words = array('0' => '', '1' => 'One', '2' => 'Two',
      '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
      '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
      '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
      '13' => 'Thirteen', '14' => 'Fourteen',
      '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
      '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
      '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
      '60' => 'Sixty', '70' => 'Seventy',
      '80' => 'Eighty', '90' => 'Ninety');
     $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
     while ($i < $digits_1) {
       $divider = ($i == 2) ? 10 : 100;
       $number = floor($no % $divider);
       $no = floor($no / $divider);
       $i += ($divider == 10) ? 1 : 2;
       if ($number) {
          $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
          $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
          $str [] = ($number < 21) ? $words[$number] .
              " " . $digits[$counter] . $plural . " " . $hundred
              :
              $words[floor($number / 10) * 10]
              . " " . $words[$number % 10] . " "
              . $digits[$counter] . $plural . " " . $hundred;
       } else $str[] = null;
    }
      $str = array_reverse($str);
      $result = implode('', $str);
      $points = ($point) ?
        "." . $words[$point / 10] . " " . 
              $words[$point = $point % 10] : '';
    // return $result ." ".$currency;
    //  $value_amount = $result ." ".$currency;
    $value_amount = $currency." ".$result."Only";
    // print_r($value_amount);
     return $value_amount;
  }

  // get word count function
  function get_wc($first_day_this_month, $get_last_date){
  $get_wc_cu = execute_query("SELECT ticket_payment.p_id, ticket_payment.ticket_id, ticket_payment.transaction_date, ticket_payment.transaction_id, ticket_payment.accounts_approval_date, ticket_payment.accounts_approval_by, ticket_payment.status, ticket_payment.date_added, ticket_payment.invoice_number, ticket_payment.payment_attached_by, ticket_payment.inr_rate, ticket_payment.total_value, ticket_payment.wordcount, sum(ticket_payment.amount_received) as get_total_val, invoice_master.extra_charges,invoice_master.std_rate FROM ticket_payment join invoice_master on ticket_payment.ticket_id = invoice_master.ticket_id where `created_by` = ".$_SESSION['emp_id']." and (ticket_payment.date_added BETWEEN  '$first_day_this_month' AND '$get_last_date') and ticket_payment.status = 'success' GROUP BY ticket_payment.ticket_id");
    $get_Cu_final_value = 0;
    $get_dashboard_value = array();
    $calculateExtraWordCountMonthly = 0;

    foreach($get_wc_cu as $key => $val){

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
            array_push($get_dashboard_value,$get_Cu_final_value);
            $calculateExtraWordCountMonthly = 0;
        }
    }
    return $get_Cu_final_value;
  }
?>