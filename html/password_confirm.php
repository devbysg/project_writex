<?php
//include_once 'session.php';
include_once '../function/functions.php';
if($_POST){
    $password = $_POST['password'];
    execute_update('employees_master',array('password' => md5($password )),array('emp_id' => $_POST['emp_id']));
    echo "<script>window.location.href='index.php';</script>";
    exit;
   // header("Location: http://www.yourwebsite.com/user.php");
}
$emp_id = select_query("employees_master",array("emp_id"),array("emp_email" => $_GET['email']));

?>

<!DOCTYPE html>


<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="./images/favicon.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">





    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>










<script>

    function otp_validation(){
        var otp = $('#id_otp').val();
        $.ajax({
            url:"../ajax/index.php",    //the page containing php script
            method: "POST",    //+request type,
            dataType: 'json',
            data: { function_name: "otp_validation", otp: otp},
            success:function(result){
                if(result.status == 'error'){
                    toastr.error('Sorry, wrong otp'); 
                }else{
                    $('#submit_div').prop('disabled', false);
                }
            }
        }); 
    }
    $("form").submit(function(){ alert("m");
            event.preventDefault();
            $.ajax({
            url:"../ajax/index.php",
            method:"POST",
            data:new FormData(this),
            dataType:"JSON",
            beforeSend: function() {
                $("#submit_div").html(' <button class="btn btn-primary" type="button" disabled><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>            <span>Loading...</span>        </button>');
            },
            success:function(data){	
                if(data.status == "success"){
                       // window.location.replace("index.php");
                }
            
            }
        })
    });

</script>



   
    <title>Confirm Password</title>

</head>

<body class="bgimg">

    

    <div class="container-fluid ">

            <div class="row">

                <div class="col-lg-6 col-md-6 d-none d-sm-block text">

                    <div class="justify-content-center">

                         <img class="center"src="Axo-Right copy 2.png" alt="logo">

                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 form">

                    <div class="newstyle" style="height:575px">

                        <div class="login-inner-form ">

                            <div class="input center">

                                <img class="details" src="Writex-Logo_Web.png" alt="logo">

                                <h3 >Confirms Your Account Password</h3>

                            </div>  

                        </div>

                            

                        <form action="" id="change_pass_form" method="post" > 
                            <input type="hidden" value="change_password" name="function_name">
                            <input type="hidden" value="<?=$emp_id[0]['emp_id']?>" name="emp_id">
                            <div class="io">
                                

                                <div class="alert alert-danger" role="alert" id="otp_validation" style="display:none;"></div>

                                    <div class="form-group form-box ">

                                        <input type="text" name="email" value="<?=$_GET['email'] ?>" id="email" class="form-control" placeholder="Put OTP" readonly aria-label="Password" required="" autocomplete="off">

                                    </div>

                                    <div class="form-group form-box ">
                                    <input type="text" name="otp_check" onblur ="otp_validation()" id="id_otp" class="form-control" placeholder="Enter  OTP" required="" autocomplete="off">
                                       
                                    </div>
                                    <div class="form-group form-box ">

                                        <input type="password"  name="password" id="password" class="form-control" placeholder="Confirm Password" aria-label="Password" required="" autocomplete="off">

                                    </div>

                                    <div class="form-group form-box ">

                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" aria-label="Password" required="" autocomplete="off">

                                    </div>

                                    <div class="form-group account" id="submit_divs">
                                        <button  name="submit" type="submit" id="submit_div" disabled class="btn-md btn-theme w-100 btn">Change</button>

                                        <p class="foot"><small><a href="../ajax/index.php" target="_blank">Achievex Solutions</a></small></p>
                                    </div>  

                                </div>

                            </div> 
                        </form>
                    </div> 

                </div >

            </div>

    </div>

    

</body>

</html>