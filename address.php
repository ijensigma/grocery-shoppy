<?php
session_start();
include ('dbconnection.php');
$uid=$_SESSION['uid'];

$update = false;

if (isset($_POST['save'])) {
    $address = $_POST['address'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];


    $query=mysqli_query($con, "insert into ADDRESS (user_id, address, country, state, city, postcode, phone) values ($uid, '$address', '$country', '$state', '$city', '$postcode', $phone)");
    $_SESSION['message'] = "Address saved";
    header('location:account.php');
}
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $address = $_POST['address'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];

    mysqli_query($con, "UPDATE ADDRESS SET address='$address', country='$country', state='$state', city='$city', postcode='$postcode', phone='$phone' WHERE user_id='$uid' && id=$id");
    $_SESSION['message'] = "Address updated!";
    header('location: account.php');
}
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($con, "DELETE FROM ADDRESS WHERE user_id='$uid' && id=$id");
    $_SESSION['message'] = "Address deleted!";
    header('location: account.php');
}

?>