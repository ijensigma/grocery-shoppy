<?php
    session_start();
    include('dbconnection.php');



    if (isset($_POST['submit'])) {

        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];



        $query = mysqli_query($con, "select UserID from users where  (UserEmail='$email' || UserPhone='$email') && UserPassword='$password' ");
        $ret=mysqli_fetch_array($query);
        if($ret>0){
            $_SESSION['uid']=$ret['UserID'];
            echo "<script > alert('Login Successful'); </script>";
            echo "<script > document.location ='account.php'; </script>";
        }
        else{
            echo "<script>alert('Invalid Details. Please Login Again.');</script>";
            echo "<script > document.location ='index.php'; </script>";
        }

    }

?>



