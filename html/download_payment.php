<?php 
$filename = "";
if(isset($_GET['file'])){
    $filename = $_GET['file'];
}

//$req_file = "upload/$filename";
$req_file = "../upload/payment_receive/$filename";
//die($req_file);
if(file_exists($req_file)){
    //die($req_file);
    header("Content-Disposition: attachment;filename=$filename");
    readfile("$req_file");
exit;
}
else{
    echo"File not found";
}
?>