<?php
//include_once 'session.php';
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

// function myFunction() 

function is_email_validation(){

// alert("Input field lost focus.");

var get_email = $('#get_email').val();


    if(get_email != ''){

        $.ajax({

            url:"../ajax/index.php",    //the page containing php script

            method: "POST",    //+request type,

            dataType: 'json',

            data: { get_mail: "is_email_exist", get_email: get_email},

            success:function(result){
                if(result.status == 'error'){
                    toastr.error('Email is not registered');
                }else{
                    //var link = 'password_confirm.php?email='+get_mail;
                  //  alert(link);
                  //   window.location.href = link;
                  //  window.location.replace("password_confirm.php");
                  $('#submit_data').prop('disabled', false);          

                }

            }

        });

        }else{

            toastr.remove();

            toastr.warning('Please enter your registered email address'); 

        }

}

</script>



<script>

    function otp(){

    //alert("Input field lost focus.");
    var get_email = $('#get_email').val();

            $.ajax({

            url:"../ajax/index.php",    //the page containing php script

            method: "POST",    //+request type,

            dataType: 'json',

            data: { function_name: "send_otp_validation", get_email: get_email},

            success:function(result){
                var link = "password_confirm.php?email="+get_email;
                 window.location.replace(link);

                // if(result.status == 'error'){

                //     // toastr.info('Sorry, wrong credential'); 

                //     toastr.error('Sorry, wrong credential'); 

                // }else{
                //     window.location.replace("password_confirm.php");
                // }

            }

        });





    // var email = $('#get_email').val();

    // var password = $('#id_otp').val();

 

    //     $.ajax({

    //         url:"../ajax/index.php",    //the page containing php script

    //         method: "POST",    //+request type,

    //         dataType: 'json',

    //         data: { function_name: "otp_validation", email: email, otp: otp},

    //         success:function(result){

    //             if(result.status == 'error'){

    //                 // toastr.info('Sorry, wrong credential'); 

    //                 toastr.error('Sorry, wrong credential'); 

    //             }else{
    //                 window.location.replace("password_confirm.php");
    //             }

    //         }

    //     });

}

    </script>



    <script>

    // $(document).on("keypress", function(e){

    //     if(e.which == 13){

    //         var email = $('#get_email').val();

    //         var password = $('#id_otp').val();

            

    //                 $.ajax({

    //                     url:"../ajax/index.php",    //the page containing php script

    //                     method: "POST",    //+request type,

    //                     dataType: 'json',

    //                     data: { function_name: "submit_data", email: email, password: password},

    //                     success:function(result){

    //                         if(result.status == 'error'){

    //                             // toastr.info('Sorry, wrong credential'); 

    //                             toastr.error('Sorry, wrong credential'); 

    //                         }else{
    //                             // session_start();
    //                             window.location.href = 'password_confirm.php';
    //                             //window.location.replace("dashboard.php");
    //                         }

    //                     }

    //                 });

    //     }

    // });

</script>
    <title>Change Password</title>

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

                    <div class="newstyle">

                        <div class="login-inner-form ">

                            <div class="input center">

                                <img class="details" src="Writex-Logo_Web.png" alt="logo">

                                <h3 >Change Your Account Password</h3>

                            </div>  

                        </div>

                            

                         <form action="password_confirm.php" method="GET" > 

                            <div class="io">

                                <div class="alert alert-danger" role="alert" id="otp_validation" style="display:none;"></div>

                                    <div class="form-group form-box ">

                                        <input type="email" onblur ="is_email_validation()" name="email" id="get_email" class="form-control" placeholder="Email Address" aria-label="Email Address" required="" autocomplete="off">

                                    </div>

                                    <!-- <div class="form-group form-box ">

                                        <input type="text" name="password" id="id_otp" class="form-control" placeholder="Put OTP" aria-label="Password" required="" autocomplete="off">

                                    </div>

                                    <div class="form-group form-box ">

                                        <input type="password" onblur ="otp_validation()" name="email" id="get_email" class="form-control" placeholder="Confirm Password" aria-label="Password" required="" autocomplete="off">

                                    </div>

                                    <div class="form-group form-box ">

                                        <input type="password" name="password" id="id_otp" class="form-control" placeholder="Confirm Password" aria-label="Password" required="" autocomplete="off">

                                    </div> -->

                                    <div class="form-group account">
                                                    <button type="button" name="submit" onclick ="otp()" id="submit_data" disabled class="btn-md btn-theme w-100 btn">Get otp</button>

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