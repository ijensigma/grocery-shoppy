<?php
/**
 * Created by PhpStorm.
 * User: Akansha
 * Date: 27/10/20
 * Time: 12:25 PM
 */

include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
    /* // define variables to empty values
     $fnameErr =  $lnameErr = $emailErr = $mobilenoErr = "";
     $fname = $lname = $email = $mobileno = "";

 //Input fields validation
     if ($_SERVER["REQUEST_METHOD"] == "POST") {

 //String Validation
         if (empty($_POST["fname"])) {
             $fnameErr = "First Name is required";
         } else {
             $fname = input_data($_POST["fname"]);
             // check if name only contains letters and whitespace
             if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
                 $fnameErr = "Only alphabets and white space are allowed";
             }
         }

         if (empty($_POST["lname"])) {
             $lnameErr = "Last Name is required";
         } else {
             $lname = input_data($_POST["lname"]);
             // check if name only contains letters and whitespace
             if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
                 $lnameErr = "Only alphabets and white space are allowed";
             }
         }


         //Email Validation
         if (empty($_POST["email"])) {
             $emailErr = "Email is required";
         } else {
             $email = input_data($_POST["email"]);
             // check that the e-mail address is well-formed
             if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 $emailErr = "Invalid email format";
             }
         }

         //Number Validation
         if (empty($_POST["phone"])) {
             $mobilenoErr = "Mobile no is required";
         } else {
             $mobileno = input_data($_POST["phone"]);
             // check if mobile no is well-formed
             if (!preg_match ("/^[0-9]*$/", $mobileno) ) {
                 $mobilenoErr = "Only numeric value is allowed.";
             }
             //check mobile no length should not be less and greator than 10
             if (strlen ($mobileno) != 10) {
                 $mobilenoErr = "Mobile no must contain 10 digits.";
             }
         }


     }
     function input_data($data) {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
     }

 */

    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $password=md5($_POST['password']);
    $cpassword=md5($_POST['cpassword']);


    /*  if(empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($password) || empty($cpassword)) {
         die('Please fill all required fields!');
      }

      if ($password !== $cpassword) {
      echo 'Password and Confirm password should match!';
      }

          if(!preg_match("/^[a-zA-Z0-9]*$/"), $fname) {
              echo "enter valid username";
          }
          */

    // Image Upload
    $imgfile=$_FILES["image"]["name"];
    $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
    $allowed_extensions = array(".jpg","jpeg",".png",".gif");

    if(!in_array($extension,$allowed_extensions))
    {
        echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        echo "<script>window.location.href ='register.html'</script>";
    }
    else {

        $ret = mysqli_query($con, "select UserEmail from users where UserEmail='$email' || UserPhone='$phone'");
        $result = mysqli_fetch_array($ret);

        if ($result > 0) {
            echo "<script>alert('This Email or Contact Number is already associated with another account');</script>";
            echo "<script>window.location.href ='register.html'</script>";
        }

        else
        {
            $query = mysqli_query($con, "insert into users(UserFirstName, UserLastName, UserPhone, UserEmail,  UserPassword) value('$fname', '$lname', '$phone', '$email', '$password' )");

            if ($query) {
                // Mail
                $from='Baggage Online Store <www.baggageonlinestore.com>';
                $to = $_POST['email'];
                $subject = 'Welcome to Baggage Online Store';
                $body = 'You have sucessfully registered';
                $header= "From: $from";

                mail($to,$subject,$body,$header);
                // echo "($recipientAddr,$subjectStr,$mailBodyText,$headers)";
                echo "<script>alert('Mail sent sucessfully')</script>";

                // Image uplaod
                $imgnewfile = md5($imgfile) . $extension;
                move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $imgnewfile);
                echo "<script>alert('Document uploaded sucessfully')</script>";

                // Confirmation message
                echo "<script>alert('You have successfully registered');</script>";
                echo "<script>window.location.href ='login.html'</script>";
            }

            else {
                echo "<script>alert('Something went wrong. Please try again');</script>";
                echo "<script>window.location.href ='register.html'</script>";
            }
        }
    }


}

//Newsletter Subscription
if(isset($_POST['subscribe']))
{
    // Mail
    $from='Baggage Online Store <www.baggageonlinestore.com>';
    $to = $_POST['email'];
    $subject = 'Welcome to Baggage Online Daily Update Newsletter';
    $body = 'Congratulations! You are subscribed to the Handbags Store mailing list to receive updates on new arrivals, special offers and other discount information.';
    $header= "From: $from";

    mail($to,$subject,$body,$header);
    // echo "($recipientAddr,$subjectStr,$mailBodyText,$headers)";
    echo "<script>alert('Newsletter subscibed successfully! Check your mail box')</script>";
    echo "<script>window.location.href ='index.html'</script>";

}
?>