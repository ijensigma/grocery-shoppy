<?php
$from = 'Grocery Shoppy';
$to = $_POST['email'];
$subject = 'Welcome to Grocery Shoppy';
$body = 'You have sucessfully registered';
$header = "From: $from";

mail($to, $subject, $body, $header);
echo "<script>alert('Newsletter subscribed succesfully! Check your mailbox')</script>";
echo "<script>window.location.href ='index.php'</script>";

?>