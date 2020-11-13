





<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome Page</title>

</head>

<body>

<?php
$uid=$_SESSION['uid'];
$ret=mysqli_query($con,"select UserFirstName from users where UserID='$uid'");
$row=mysqli_fetch_array($ret);
$name=$row['UserFirstName'];

?>
<h4 style="color: blue; text-align: center;">Welcome !! <?php echo $name;?></h4>

<a href="logout.php" class="btn btn-outline btn-default">Logout</a>
<a href="index.php" class="btn btn-outline btn-default">Home Page</a>



</body>

</html>