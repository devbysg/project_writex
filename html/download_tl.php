<?php 
$filename = "";
if(isset($_GET['file'])){
    $filename = $_GET['file'];
}

$req_file = "../upload/tl_upload/$filename";
if(file_exists($req_file)){
// header("Content-Disposition: attachment; filename= invoice.pdf");
header("Content-Disposition: attachment; filename= $filename");
readfile("$req_file");
exit;
}
else{
    echo"File not found";
}
?>