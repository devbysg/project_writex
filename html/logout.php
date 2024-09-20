<?php

session_start();

unset($_SESSION['emp_name']);

unset($_SESSION['emp_email']);

session_destroy();

echo '<script>alert("You have been logout successfully!")</script>';

header("Location: login.php");

?>