<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="shortcut icon" href="./images/favicon.png" />

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

        <link rel="stylesheet" href="style.css" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

        <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <title>LOGIN PAGE</title>
    </head>

    <body class="bgimg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 d-none d-sm-block text">
                    <div class="justify-content-center">
                        <img class="center" src="Axo-Right.jpg" alt="logo" />
                        <!-- <img class="center" src="Axo-holi.png" alt="holi special logo" /> -->
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 form">
                    <div class="newstyle">
                        <div class="login-inner-form">
                            <div class="input center">
                                <img class="details" src="Writex-Logo_Web.png" alt="logo" />

                                <h3>Sign Into Your Account</h3>
                            </div>
                        </div>

                        <!-- <form action="dashboard.php" method="post" > -->

                        <div class="io">
                            <form action="index.php" method="post" >
                                <input type="hidden" name="submit_action" value="login">
                                <div class="form-group form-box">
                                    <input type="email" name="email" id="id_email" class="form-control" placeholder="Email Address" aria-label="Email Address" required="" autocomplete="off" />
                                </div>
                                <div class="form-group form-box ">
                                    <input type="password" name="password" id="id_password" class="form-control" placeholder="Password" aria-label="Password" required="" autocomplete="off">
                                </div>
                                <div class="form-group account">
                                    <button type="submit" name="submit" class="btn-md btn-theme w-100 btn" id="submit_data">Login</button>

                                    <p>Forget Password?<a class="reg" href="password_forget.php">&nbsp;Click Here</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
