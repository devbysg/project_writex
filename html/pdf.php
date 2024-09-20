<?php 
  require ("../library/fpdf/fpdf.php");
  $get_amount = amountToWord($_POST["bill_value_amount"],$_POST["get_currency"] );
  // print_r($_POST["id"]);
  // print_r($get_amount);
  //customer and invoice details
  $info=[
    "customer"=>$_POST['client_name'],
    "email"=>$_POST['client_email'],
    "phone"=>$_POST['client_phone'],
    "invoice_no"=> $_SESSION['invoice_number'],
    "invoice_date"=> date("Y/m/d"),
    "total_amt"=>$_POST["bill_value_amount"],
    // "words"=>"Rupees Five Thousand Two Hundred Only",
    "words"=>$get_amount,
  ];
  
  
  //invoice Products
 
  $products_info=[
    [
      // "desc"=>$_POST["ticket_desc"],
      "id"=>$_POST["id"],
      "word_count"=>$_POST["word_count"],
      // "rate"=>$std_rate,
      "currency"=>$_POST["get_currency"],
      "total"=>$_POST["bill_value_amount"],

    ]
  ];
  
  class PDF extends FPDF
  {
    function Header(){
      
      //Display Company Info

      // $this->SetFont('Arial','',18);
      // $this->SetFillColor(200,220,255);
      // $this->Cell(0,6,"PROFORMA INVOICE",0,1,'L',1);
      // $this->Ln(1);
      $this->SetFont('Arial','B',14);
      $this->SetFillColor(100,120,255);
      $this->Cell(50,10,"WriteX",0,1);
      $this->SetFont('Arial','',14);
      $this->Cell(50,7,"Kolkata, West Bengal-700050.",0,1);
      $this->Cell(50,7,"PH : +91 7003882237",0,1);
      $this->Cell(50,7,"E : infowritex@gmail.com",0,1);
      
      //Display INVOICE text
      $this->SetY(15);
      $this->SetX(-40);
      $this->SetFont('Arial','B',18);
      // $this->Image('https://achievexsolutions.in/writexdemonew/images/Writex-Logo_Web_new.png',135,15,60);
      $this->Image('http://13.233.32.132/images/Writex-Logo_Web_new.png',135,15,60);
      $this->Line(0,48,210,48);

      
    }
    
    function body($info,$products_info){
      $this->SetY(53);
      $this->SetX(10);
      $this->SetFont('Arial','',18);
      $this->SetFillColor(200,220,255);
      $this->Cell(0,6,"PROFORMA INVOICE",0,1,'C',1);
      $this->Ln(2);
      //Billing Details
       $this->SetY(60);
       $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,10,"Bill To: ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$info["customer"],0,1);
      $this->Cell(50,7,$info["email"],0,1);
      $this->Cell(50,7,$info["phone"],0,1);
      
      //Display Invoice no
      $this->SetY(58);
      $this->SetX(-60);
      $this->Cell(50,7,"Invoice No : ".$info["invoice_no"]);
      
      //Display Invoice date
      $this->SetY(63);
      $this->SetX(-60);
      $this->Cell(50,7,"Invoice Date : ".$info["invoice_date"]);
      
      //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      // $this->Cell(80,9,"TICKET DESCRIPTION",1,0);
      $this->Cell(80,9,"TICKET ID",1,0);
      // $this->Cell(40,9,"RATE",1,0,"C");
      $this->Cell(30,9,"WORD",1,0,"C");
      $this->Cell(40,9,"Currency",1,0,"C");
      $this->Cell(40,9,"TOTAL",1,1,"C");
      $this->SetFont('Arial','',12);
      
      //Display table product rows
      foreach($products_info as $row){
        // $this->Cell(80,9,$row["desc"],"LR",0);
        $this->Cell(80,9,$row["id"],"LR",0);
        // $this->Cell(40,9,$row["rate"],"R",0,"R");
        $this->Cell(30,9,$row["word_count"],"R",0,"C");
        $this->Cell(40,9,$row["currency"],"R",0,"R");
        $this->Cell(40,9,$row["total"],"R",1,"R");
      }
      //Display table empty rows
      // for($i=0;$i<2-count($products_info);$i++)
      // {
      //   $this->Cell(80,9,"","LR",0);
      //   $this->Cell(40,9,"","R",0,"R");
      //   $this->Cell(30,9,"","R",0,"C");
      //   $this->Cell(40,9,"","R",1,"R");
      // }
      //Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(150,9,"TOTAL",1,0,"R");
      $this->Cell(40,9,$info["total_amt"],1,1,"R");
      
      //Display amount in words
      $this->SetY(130);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,9,"Amount in Words ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(0,9,$info["words"],0,1);

      // $this->SetY(140);
      // $this->SetX(10);
      // $this->SetFont('Arial','',12);
      // // $this->Cell(0,10,"Authorized Signature",0,1,"R");
      // $this->Cell(0,9,"Authorized Signature",0,1,"R");
      // $this->SetFont('Arial','',10);

      $records = select_query("bank_details", array("*"), array());
      $account_holder_name = $records[0]['account_holder_name'];
      $account_number = $records[0]['account_number'];
      $ifsc_code = $records[0]['IFSC_code'];
      $account_type = $records[0]['account_type'];
      $bank_name = $records[0]['bank_name'];
      $upi_id = $records[0]['upi_id'];
      $code_swift = $records[0]['swift_code'];

      $account_holder_name2 = $records[1]['account_holder_name'];
      $account_number2 = $records[1]['account_number'];
      $ifsc_code2 = $records[1]['IFSC_code'];
      $account_type2 = $records[1]['account_type'];
      $bank_name2 = $records[1]['bank_name'];
      $upi_id2 = $records[1]['upi_id'];
      $code_swift2 = $records[1]['swift_code'];

      $account_holder_name3 = $records[2]['account_holder_name'];
      $account_number3 = $records[2]['account_number'];
      $ifsc_code3 = $records[2]['IFSC_code'];
      $account_type3 = $records[2]['account_type'];
      $bank_name3 = $records[2]['bank_name'];
      $upi_id3 = $records[2]['upi_id'];
      $code_swift3 = $records[2]['swift_code'];
      //set footer position

      $this->SetY(140);
      $this->SetX(10);
      $this->SetFont('Arial','B',14);
      $this->Cell(0,10,"Bank Details ",0,1,"C");

      $this->SetY(150);
      $this->SetX(10);
      $this->SetFont('Arial','B',14);
      $this->Cell(0,10,"",0,1);
      $this->SetFont('Arial','B',8);
      $this->Cell(0,10,"Account Holder Name : $account_holder_name",0,1,"L");
      $this->SetY(155);
      $this->SetX(10);
      $this->Cell(0,10,"Account Number :	$account_number",0,1,"L");
      $this->Cell(0,10,"IFSC :	$ifsc_code",0,1,"L");
      $this->SetY(170);
      $this->SetX(10);
      $this->Cell(0,10,"Account Type : $account_type",0,1,"L");
      $this->SetY(175);
      $this->SetX(10);
      $this->Cell(0,10,"Bank : $bank_name",0,1,"L");
      $this->SetY(180);
      $this->SetX(10);
      $this->Cell(0,10,"Phonepe UPI :	$upi_id",0,1,"L");
      $this->SetY(185);
      $this->SetX(10);
      $this->Cell(0,10,"Swift Code :	$code_swift",0,1,"L");

      //set footer position
      // $this->SetY(150);
      // $this->SetX(10);
      // $this->SetFont('Arial','B',14);
      // $this->Cell(0,10,"Bank Details ",0,1,"C");

      $this->SetY(150);
      $this->SetX(10);
      $this->SetFont('Arial','B',14);
      $this->Cell(0,10,"",0,1);
      $this->SetFont('Arial','B',8);
      $this->Cell(0,10,"Account Holder Name : $account_holder_name2",0,1,"R");
      $this->SetY(155);
      $this->SetX(10);
      $this->Cell(0,10,"Account Number :	$account_number2",0,1,"R");
      $this->Cell(0,10,"IFSC :	$ifsc_code2",0,1,"R");
      $this->SetY(170);
      $this->SetX(10);
      $this->Cell(0,10,"Account Type : $account_type2",0,1,"R");
      $this->SetY(175);
      $this->SetX(10);
      $this->Cell(0,10,"Bank : $bank_name2",0,1,"R");
      // $this->SetY(180);
      // $this->SetX(10);
      // $this->Cell(0,10,"Phonepe UPI :	$upi_id2",0,1,"R");
      // $this->SetY(185);
      // $this->SetX(10);
      // $this->Cell(0,10,"Swift Code :	$code_swift2",0,1,"R");



      $this->SetY(190);
      $this->SetX(10);
      $this->SetFont('Arial','B',15);
      $this->Cell(0,10,"",9,8);
      $this->SetFont('Arial','B',8);
      $this->Cell(0,10,"Account Holder Name : $account_holder_name3",0,1,"L");
      $this->SetY(195);
      $this->SetX(10);
      $this->Cell(0,10,"Account Number :	$account_number3",0,1,"L");
      $this->Cell(0,10,"IFSC :	$ifsc_code3",0,1,"L");
      $this->SetY(210);
      $this->SetX(10);
      $this->Cell(0,10,"Account Type : $account_type3",0,1,"L");
      $this->SetY(215);
      $this->SetX(10);
      $this->Cell(0,10,"Bank : $bank_name3",0,1,"L");
      $this->SetY(220);
      $this->SetX(10);
      $this->Cell(0,10,"Phonepe UPI :	$upi_id3",0,1,"L");
      $this->SetY(225);
      $this->SetX(10);
      $this->Cell(0,10,"Swift Code :	$code_swift3",0,1,"L");

      // $this->SetY(200);
      // $this->SetX(10);
      // $this->SetFont('Arial','B',15);
      // $this->Cell(0,10,"Bank Details ",9,8,"R");
      // $this->SetFont('Arial','B',8);
      // $this->Cell(0,10,"Account Holder Name : $account_holder_name",0,1,"R");
      // $this->SetY(205);
      // $this->SetX(10);
      // $this->Cell(0,10,"Account Number :	$account_number",0,1,"R");
      // $this->Cell(0,10,"IFSC :	$ifsc_code",0,1,"R");
      // $this->SetY(220);
      // $this->SetX(10);
      // $this->Cell(0,10,"Account Type : $account_type",0,1,"R");
      // $this->SetY(225);
      // $this->SetX(10);
      // $this->Cell(0,10,"Bank : $bank_name",0,1,"R");
      // $this->SetY(230);
      // $this->SetX(10);
      // $this->Cell(0,10,"Phonepe UPI :	$upi_id",0,1,"R");
      // $this->SetY(235);
      // $this->SetX(10);
      // $this->Cell(0,10,"Swift Code :	$code_swift",0,1,"L");
      
    }
    function Footer(){
      $records = select_query("bank_details", array("*"), array("status" => 1));
      $account_holder_name = $records[0]['account_holder_name'];
      $account_number = $records[0]['account_number'];
      $ifsc_code = $records[0]['IFSC_code'];
      $account_type = $records[0]['account_type'];
      $bank_name = $records[0]['bank_name'];
      $upi_id = $records[0]['upi_id'];
      $code_swift = $records[0]['swift_code'];
      //set footer position
      $this->SetY(-50);
      // $this->SetFont('Arial','B',8);
      // $this->Cell(0,10,"Account Holder Name: $account_holder_name",0,1,"R");
      // $this->Cell(0,10,"Account Number:	$account_number",0,1,"R");
      // $this->Cell(0,10,"IFSC:	$ifsc_code",0,1,"R");
      // $this->Cell(0,10,"Account Type: $account_type",0,1,"R");
      // $this->Cell(0,10,"Bank: $bank_name",0,1,"R");
      // $this->Cell(0,10,"Phonepe UPI:	$upi_id",0,1,"R");
      // $this->Cell(0,10,"Swift Code:	$code_swift",0,1,"R");
      // $this->Ln(15);

      //Display T&C
      $this->SetFont('Arial','B',9);  
      $this->Cell(0,10,"T&C",0,1,"L");    
      $this->Cell(0,6,"1. Payments to account except the above bank accounts shall not be accepted",0,1,"L");
      $this->Cell(0,6,"2. 50% Payment in Advance and remaining before final delivery",0,1,"L");
      $this->Cell(0,6,"3. Kindly quote the Invoice Number before remitting the funds",0,1,"L");

      
      //Display Footer Text
      $this->Cell(0,12,"This is a System generated invoice and this does not require any signature",0,1,"C");
      
    }
   
    //   IFSC	HDFC0009518
    //   Account Type	Current
    //   Bank	HDFC Bank
    //   Phonepe UPI	asxcontent@ybl
    //   Swift Code	HDFCINBBCAL
  }
  //print_r($_SESSION['invoice_number']);die("hsssere");
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$products_info);
  $path =  "../upload/pdf/".$_SESSION['invoice_number'].".pdf";
  //$pdf->Output();
  $pdf->Output('F', $path);
?>