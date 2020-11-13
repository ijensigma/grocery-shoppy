<?php
session_start();
session_unset();
// unset session variable
session_destroy(); // destroy session
header('location:index.php');
?>