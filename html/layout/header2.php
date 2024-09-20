<?php 
session_start();
print_r($_SESSION); die("mssshjvhvsm");
include_once '../function/functions.php';
//include_once '../function/SessionHandlerV2.php';

if(!($_SESSION['emp_name']))
 {

     header("Location:index.php");

 }?>

<!DOCTYPE html>

<html lang="zxx" class="js">



<head>

    <base href="../">

    <meta charset="utf-8">

    <meta name="author" content="Softnio">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">

    <!-- Fav Icon  -->

    <link rel="shortcut icon" href="./images/favicon.png">

    <!-- Page Title  -->

    <title>Dashboard</title>

    <!-- StyleSheets  -->

    <link rel="stylesheet" href="./assets/css/writex.css?ver=3.1.0">

    

    <link id="skin-default" rel="stylesheet" href="html/theme.css?ver=3.1.0">

    <link rel="stylesheet" href="./assets/css/jstree.css?ver=3.1.0">
    <link rel="stylesheet" href="./assets/css/editors/summernote.css?ver=3.1.1">
    <!-- <script src="./assets/js/bundle.js?ver=3.1.0"></script> -->

    <script src="./assets/js/scripts.js?ver=3.1.0"></script>

    <script src="./assets/js/libs/jstree.js?ver=3.1.0"></script>

    <script src="./assets/js/example-tree.js?ver=3.1.0"></script>
   
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
   
    <!-- Data Table Essential Links -->

    <script src="html/js/jquery.dataTables.min.js"></script>

    <script src="html/js/dataTables.bootstrap.min.js"></script>

    <script src="html/js/datatable-btns.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.css" integrity="sha512-wcf2ifw+8xI4FktrSorGwO7lgRzGx1ld97ySj1pFADZzFdcXTIgQhHMTo7tQIADeYdRRnAjUnF00Q5WTNmL3+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.min.js" integrity="sha512-lUZZrGg8oiRBygP81yUZ4XkAbmeJn7u7HW5nq7npQ+ZXTRvj3ErL6y1XXDq6fujbiJlu6gHsgNUZLKE6eSDm8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    		

    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css" />
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript"> 
        function display_c(){
        var refresh=1000; // Refresh rate in milli seconds
        mytime=setTimeout('display_ct()',refresh)
        }

        function display_ct() {
        var x = new Date()
        document.getElementById('ct').innerHTML = x;
        display_c();
        }
        $(document).ready(function(){	
            // alert("hey");
           onload=display_ct();
        }); 
</script>

</head>



<body class="nk-body bg-lighter npc-default has-sidebar ">

    <div class="nk-app-root">

        <!-- main @s -->

        <div class="nk-main ">

            <!-- sidebar @s -->

            <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">

                <div class="nk-sidebar-element nk-sidebar-head">

                    <div class="nk-sidebar-brand">

                        <a href="html/dashboard.php" class="logo-link nk-sidebar-logo">

                            <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">

                            <img class="logo-dark logo-img" src="./images/Writex-Logo_Web (1).png" srcset="./images/Writex-Logo_Web (2).png 2x" alt="logo-dark">

                            <img class="logo-small logo-img logo-img-small" src="./images/logo-small.png" srcset="./images/logo-small2x.png 2x" alt="logo-small">


                        </a>

                    </div>

                    <div class="nk-menu-trigger me-n2">

                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>

                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>

                    </div>

                </div><!-- .nk-sidebar-element -->

                <div class="nk-sidebar-element">

                    <div class="nk-sidebar-content">

                        <div class="nk-sidebar-menu" data-simplebar>

                            <ul class="nk-menu">

                                <!-- <li class="nk-menu-heading">

                                    <h6 class="overline-title text-primary-alt">Menu Bar</h6>

                                </li> --><!-- .nk-menu-item -->

                                <li class="nk-menu-heading">

                                  <span id='ct' ></span>

                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item">

                                    <a href="html/dashboard.php" class="nk-menu-link">

                                        <span class="nk-menu-icon"><em class="icon ni ni-bag"></em></span>

                                        <span class="nk-menu-text">Dashboard</span>

                                    </a>

                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item">

                                    <!-- <a href="html/Ticket.php" class="nk-menu-link"> -->
                                    <a href="html/ticket22.php" class="nk-menu-link">


                                        <span class="nk-menu-icon"><em class="icon ni ni-book-read"></em></span>

                                        <span class="nk-menu-text">Ticket</span>

                                        

                                    </a>

                                </li>

                                        <li class="nk-menu-item">

                                            <a href="html/invoice.php" class="nk-menu-link">


                                                <span class="nk-menu-icon"><em class="icon ni ni-cart-fill"></em></span>

                                                <span class="nk-menu-text">Invoice</span>

                                                

                                            </a>

                                        </li>

                                <li class="nk-menu-item has-sub">

                                    <a href="html/product-list.php" class="nk-menu-link">

                                        <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb-fill"></em></span>

                                        <span class="nk-menu-text">Projects</span>

                                    </a>

                                </li> 
                                
                                <li class="nk-menu-item has-sub">
                                    <a href="html/sme2.php" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                        <span class="nk-menu-text">SME</span>
                                    </a>

                                </li> 


                                </li><!-- .nk-menu-item -->

                                <!-- .nk-menu-item -->

                                 <li class="nk-menu-item has-sub">

                                    <a href="html/payment.php" class="nk-menu-link ">

                                        <span class="nk-menu-icon"><em class="icon ni ni-grid-alt-fill"></em></span>

                                        <span class="nk-menu-text">Payment</span>

                                    </a>
                                 </li>

                                    <li class="nk-menu-item">

                                    <a href="html/testing_quality.php" class="nk-menu-link">


                                        <span class="nk-menu-icon"><em class="icon ni ni-check-fill-c"></em></span>

                                        <span class="nk-menu-text">Quality Testing</span>
                                       
                                        

                                    </a>

                                </li>

                                <li class="nk-menu-item has-sub">

<a href="html/admin.php" class="nk-menu-link nk-menu-toggle">

    <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>

    <span class="nk-menu-text">Admin</span>

</a>

<ul class="nk-menu-sub">

    <li class="nk-menu-item">
        <a href="html/employee.php" class="nk-menu-link"><span class="nk-menu-text">Employee</span></a>
    </li>
    
    <li class="nk-menu-item">
        <a href="html/template2.php" class="nk-menu-link"><span class="nk-menu-text">Templates</span></a>
    </li>
    <li class="nk-menu-item">
        <a href="html/wordcount.php" class="nk-menu-link"><span class="nk-menu-text">Rate Chart(Country)</span></a>
    </li>
    <li class="nk-menu-item">
        <a href="html/addcategory.php" class="nk-menu-link"><span class="nk-menu-text">Category</span></a>
    </li>
    <li class="nk-menu-item">
        <a href="html/bankdetails.php" class="nk-menu-link"><span class="nk-menu-text">Bank Details</span></a>
    </li>

    

</ul><!-- .nk-menu-sub -->

</li><!-- .nk-menu-item -->

                                  

                            </ul><!-- .nk-menu -->

                        </div><!-- .nk-sidebar-menu -->

                    </div><!-- .nk-sidebar-content -->

                </div><!-- .nk-sidebar-element -->

            </div>

            <div class="nk-wrap ">

                <!-- main header @s -->

                <div class="nk-header nk-header-fixed is-light">

                    <div class="container-fluid">

                        <div class="nk-header-wrap">

                            <div class="nk-menu-trigger d-xl-none ms-n1">

                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>

                            </div>

                            <div class="nk-header-brand d-xl-none">

                                <a href="html/dashboard.php" class="logo-link">

                                    <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">

                                    <img class="logo-dark logo-img" src="./images/Writex-Logo_Web (1).png" srcset="./images/Writex-Logo_Web (2).png 2x" alt="logo-dark">

                                </a>

                            </div><!-- .nk-header-brand -->

                            <div class="nk-header-tools">

                                <ul class="nk-quick-nav">

                                    <li class="dropdown language-dropdown d-none d-sm-block me-n1">

                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">

                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-s1">

                                            <ul class="language-list">

                                                <li>

                                                    <a href="#" class="language-item">

                                                        <img src="./images/flags/english.png" alt="" class="language-flag">

                                                        <span class="language-name">English</span>

                                                    </a>

                                                </li>

                                                <li>

                                                    <a href="#" class="language-item">

                                                        <img src="./images/flags/spanish.png" alt="" class="language-flag">

                                                        <span class="language-name">Español</span>

                                                    </a>

                                                </li>

                                                <li>

                                                    <a href="#" class="language-item">

                                                        <img src="./images/flags/french.png" alt="" class="language-flag">

                                                        <span class="language-name">Français</span>

                                                    </a>

                                                </li>

                                                <li>

                                                    <a href="#" class="language-item">

                                                        <img src="./images/flags/turkey.png" alt="" class="language-flag">

                                                        <span class="language-name">Türkçe</span>

                                                    </a>

                                                </li>

                                            </ul>

                                        </div>

                                    </li><!-- .dropdown -->

                                    <li class="dropdown chats-dropdown hide-mb-xs">

                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">

                                            <div class="dropdown-head">

                                                <span class="sub-title nk-dropdown-title">Recent Chats</span>

                                                <a href="#">Setting</a>

                                            </div>

                                            <div class="dropdown-body">

                                                <ul class="chat-list">

                                                    <li class="chat-item">

                                                        <a class="chat-link" href="html/apps-chats.php">

                                                            <div class="chat-media user-avatar">

                                                                <span>IH</span>

                                                                <span class="status dot dot-lg dot-gray"></span>

                                                            </div>

                                                            <div class="chat-info">

                                                                <div class="chat-from">

                                                                    <div class="name">Iliash Hossain</div>

                                                                    <span class="time">Now</span>

                                                                </div>

                                                                <div class="chat-context">

                                                                    <div class="text">You: Please confrim if you got my last messages.</div>

                                                                    <div class="status delivered">

                                                                        <em class="icon ni ni-check-circle-fill"></em>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </a>

                                                    </li><!-- .chat-item -->

                                                    <li class="chat-item is-unread">

                                                        <a class="chat-link" href="html/apps-chats.php">

                                                            <div class="chat-media user-avatar bg-pink">

                                                                <span>AB</span>

                                                                <span class="status dot dot-lg dot-success"></span>

                                                            </div>

                                                            <div class="chat-info">

                                                                <div class="chat-from">

                                                                    <div class="name">Souvik Saha</div>

                                                                    <span class="time">4:49 AM</span>

                                                                </div>

                                                                <div class="chat-context">

                                                                    <div class="text">Hi, I am Ishtiyak, can you help me with this problem ?</div>

                                                                    <div class="status unread">

                                                                        <em class="icon ni ni-bullet-fill"></em>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </a>

                                                    </li><!-- .chat-item -->

                                                    <li class="chat-item">

                                                        <a class="chat-link" href="html/apps-chats.php">

                                                            <div class="chat-media user-avatar">

                                                                <img src="./images/avatar/b-sm.jpg" alt="">

                                                            </div>

                                                            <div class="chat-info">

                                                                <div class="chat-from">

                                                                    <div class="name">George Philips</div>

                                                                    <span class="time">6 Apr</span>

                                                                </div>

                                                                <div class="chat-context">

                                                                    <div class="text">Have you seens the claim from Rose?</div>

                                                                </div>

                                                            </div>

                                                        </a>

                                                    </li><!-- .chat-item -->

                                                    <li class="chat-item">

                                                        <a class="chat-link" href="html/apps-chats.php">

                                                            <div class="chat-media user-avatar user-avatar-multiple">

                                                                <div class="user-avatar">

                                                                    <img src="./images/avatar/c-sm.jpg" alt="">

                                                                </div>

                                                                <div class="user-avatar">

                                                                    <span>AB</span>

                                                                </div>

                                                            </div>

                                                            <div class="chat-info">

                                                                <div class="chat-from">

                                                                    <div class="name">Softnio Group</div>

                                                                    <span class="time">27 Mar</span>

                                                                </div>

                                                                <div class="chat-context">

                                                                    <div class="text">You: I just bought a new computer but i am having some problem</div>

                                                                    <div class="status sent">

                                                                        <em class="icon ni ni-check-circle"></em>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </a>

                                                    </li><!-- .chat-item -->

                                                    <li class="chat-item">

                                                        <a class="chat-link" href="html/apps-chats.php">

                                                            <div class="chat-media user-avatar">

                                                                <img src="./images/avatar/a-sm.jpg" alt="">

                                                                <span class="status dot dot-lg dot-success"></span>

                                                            </div>

                                                            <div class="chat-info">

                                                                <div class="chat-from">

                                                                    <div class="name">Larry Hughes</div>

                                                                    <span class="time">3 Apr</span>

                                                                </div>

                                                                <div class="chat-context">

                                                                    <div class="text">Hi Frank! How is you doing?</div>

                                                                </div>

                                                            </div>

                                                        </a>

                                                    </li><!-- .chat-item -->

                                                    <li class="chat-item">

                                                        <a class="chat-link" href="html/apps-chats.php">

                                                            <div class="chat-media user-avatar bg-purple">

                                                                <span>TW</span>

                                                            </div>

                                                            <div class="chat-info">

                                                                <div class="chat-from">

                                                                    <div class="name">Tammy Wilson</div>

                                                                    <span class="time">27 Mar</span>

                                                                </div>

                                                                <div class="chat-context">

                                                                    <div class="text">You: I just bought a new computer but i am having some problem</div>

                                                                    <div class="status sent">

                                                                        <em class="icon ni ni-check-circle"></em>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </a>

                                                    </li><!-- .chat-item -->

                                                </ul><!-- .chat-list -->

                                            </div><!-- .nk-dropdown-body -->

                                            <div class="dropdown-foot center">

                                                <a href="html/apps-chats.php">View All</a>

                                            </div>

                                        </div>

                                    </li>

                                    <li class="dropdown notification-dropdown">

                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end">

                                            <div class="dropdown-head">

                                                <span class="sub-title nk-dropdown-title">Notifications</span>

                                                <a href="#">Mark All as Read</a>

                                            </div>

                                            <div class="dropdown-body">

                                                <div class="nk-notification">

                                                    <div class="nk-notification-item dropdown-inner">

                                                        <div class="nk-notification-icon">

                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>

                                                        </div>

                                                        <div class="nk-notification-content">

                                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>

                                                            <div class="nk-notification-time">2 hrs ago</div>

                                                        </div>

                                                    </div>

                                                    <div class="nk-notification-item dropdown-inner">

                                                        <div class="nk-notification-icon">

                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>

                                                        </div>

                                                        <div class="nk-notification-content">

                                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>

                                                            <div class="nk-notification-time">2 hrs ago</div>

                                                        </div>

                                                    </div>

                                                    <div class="nk-notification-item dropdown-inner">

                                                        <div class="nk-notification-icon">

                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>

                                                        </div>

                                                        <div class="nk-notification-content">

                                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>

                                                            <div class="nk-notification-time">2 hrs ago</div>

                                                        </div>

                                                    </div>

                                                    <div class="nk-notification-item dropdown-inner">

                                                        <div class="nk-notification-icon">

                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>

                                                        </div>

                                                        <div class="nk-notification-content">

                                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>

                                                            <div class="nk-notification-time">2 hrs ago</div>

                                                        </div>

                                                    </div>

                                                    <div class="nk-notification-item dropdown-inner">

                                                        <div class="nk-notification-icon">

                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>

                                                        </div>

                                                        <div class="nk-notification-content">

                                                            <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>

                                                            <div class="nk-notification-time">2 hrs ago</div>

                                                        </div>

                                                    </div>

                                                    <div class="nk-notification-item dropdown-inner">

                                                        <div class="nk-notification-icon">

                                                            <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>

                                                        </div>

                                                        <div class="nk-notification-content">

                                                            <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>

                                                            <div class="nk-notification-time">2 hrs ago</div>

                                                        </div>

                                                    </div>

                                                </div><!-- .nk-notification -->

                                            </div><!-- .nk-dropdown-body -->

                                            <div class="dropdown-foot center">

                                                <a href="#">View All</a>

                                            </div>

                                        </div>

                                    </li>

                                    <li class="dropdown user-dropdown">

                                        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">

                                            <div class="user-toggle">

                                                <div class="user-avatar sm">

                                                    <em class="icon ni ni-user-alt"></em>

                                                </div>

                                                <div class="user-info d-none d-xl-block">

                                                    <div class="user-status user-status-unverified">Verified</div>

                                                    <div class="user-name dropdown-indicator"><?=$_SESSION['emp_name']?></div>

                                                </div>

                                            </div>

                                        </a>

                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">

                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">

                                                <div class="user-card">

                                                    <div class="user-avatar">

                                                        <span>WX</span>

                                                    </div>

                                                    <div class="user-info">

                                                        <span class="lead-text"><?=$_SESSION['emp_name']?></span>

                                                        <span class="sub-text"><?=$_SESSION['emp_email']?></span>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="dropdown-inner">

                                                <ul class="link-list">

                                                    <li><a href="html/user-profile-regular.php"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>

                                                    <li><a href="html/user-profile-setting.php"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>

                                                    <li><a href="html/resetpassword.php"><em class="icon ni ni-lock-alt"></em><span>Change Password</span></a></li>

                                                    <li><a href="html/user-profile-activity.php"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>

                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>

                                                </ul>

                                            </div>

                                            <div class="dropdown-inner">

                                                <ul class="link-list">

                                                    <li><a href="../Writexdemo/html/logout.php"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>


                                                </ul>

                                            </div>

                                        </div>

                                    </li>

                                </ul>

                            </div>

                        </div><!-- .nk-header-wrap -->

                    </div><!-- .container-fliud -->

                </div>
<!-- <script>
     $(document).ready(function(){	
            // alert("hey");
           onload=display_ct();
        });  
    </script> -->