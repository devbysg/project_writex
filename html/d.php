<?php 
$filename = "";
if(isset($_GET['file'])){
    $filename = $_GET['file'];
}
// header("Content-Type: application/pdf");
// header("Content-Type: application/pptx");
//     header("Content-Disposition: attachment;filename=$filename");
//     $req_file =  "http://13.233.32.132/upload/341672814550.pptx";
//     readfile("$req_file");
$url = "http://13.233.32.132/upload/341672814550.pptx";
// die($url);
$temp_file = tempnam(sys_get_temp_dir(), 'MyFileName');
$fp = fopen($temp_file, "r");
$ch = curl_init($url);
print_r($ch);
// die();
curl_setopt($ch, CURLOPT_TIMEOUT, 600);
// write curl response to file
curl_setopt($ch, CURLOPT_FILE, $fp); 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// get curl response
curl_exec($ch); 
curl_close($ch);
fclose($fp);

?>