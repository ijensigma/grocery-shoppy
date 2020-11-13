<?php
    include ('dbconnection.php');
    if (isset($_POST['submit'])){
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $password=($_POST['password']);
        $confirm_password=$_POST['confirm_password'];

        if (empty($fname)) {
           echo "<script>alert('Please Enter First Name');</script>";
            echo "<script > document.location ='index.php'; </script>";
            exit;
        } else if (!ctype_alpha($fname)) {
            echo "<script>alert('Please Enter Letters Only');</script>";
            echo "<script > document.location ='index.php'; </script>";
            exit;
        } else if (empty($lname)) {
            echo "<script>alert('Please Enter Last Name');</script>";
            echo "<script > document.location ='index.php'; </script>";
            exit;
        } else if (!ctype_alpha($lname)) {
            echo "<script>alert('Please Enter Letters Only');</script>";
            echo "<script > document.location ='index.php'; </script>";
            exit;
        } else if (empty($phone)) {
            echo "<script>alert('Please Enter Phone');</script>";
            echo "<script > document.location ='index.php'; </script>";
            exit;
        } else if (!is_numeric($phone)) {
            echo "<script>alert('Please Enter Numerics Only');</script>";
            echo "<script > document.location ='index.php'; </script>";
            exit;
        } else if (strlen($phone) != 10) {
            echo "<script>alert('Please Enter Your 10 Digit Phone');</script>";
            echo "<script > document.location ='index.php'; </script>";
            exit;
        } else if (empty($imgfile)) {
            echo "<script>alert('Please Attach File');</script>";
            echo "<script > document.location ='index.php'; </script>";
            exit;
        } else if (empty($email)) {
            echo "<script>alert('Please Enter Email');</script>";
            echo "<script > document.location ='index.php'; </script>";
            exit;
        } else if (!preg_match("/^[_.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+.)+[a-zA-Z]{2,6}$/i", $email)) {
            echo "<script>alert('Please Match Email Format');</script>";
            echo "<script > document.location ='index.php'; </script>";
            exit;
        } else if (empty($password)) {
            echo "<script>alert('Please Enter Password');</script>";
            echo "<script > document.location ='index.php'; </script>";
            exit;
        }


        if ($_POST['password'] !== $_POST['confirm_password']) {
            echo "<script>alert('Password and Confirm password should match!');</script>";
            echo "<script>window.location.href ='index.php'</script>";
            exit;
        }

        $imgfile=$_FILES["image"]["name"];
        $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
        $allowed_extensions = array(".jpg","jpeg",".png",".gif");

        if(!in_array($extension,$allowed_extensions))
        {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
            echo "<script>window.location.href ='index.php'</script>";
        }
        else {

            $ret = mysqli_query($con, "select UserEmail from users where UserEmail='$email' || UserPhone='$phone'");
            $result = mysqli_fetch_array($ret);

            if ($result > 0) {
                echo "<script>alert('This email or Contact Number already associated with another account');</script>";
                echo "<script>window.location.href ='index.html'</script>";
            }
            else
            {
                $query = mysqli_query($con, "insert into users (UserFirstName, UserLastName, UserEmail,  UserPhone, UserPassword, image_upload) values('$fname', '$lname', '$email', '$phone','$password', '$imgfile')");

                if ($query) {


                    $from = 'Grocery Shoppy';
                    $to = $_POST['email'];
                    $subject = 'Welcome to Grocery Shoppy';
                    $body = 'You have sucessfully registered';
                    $header = "From: $from";

                    mail($to, $subject, $body, $header);
                    echo "<script>alert('Mail sent sucessfully')</script>";

                    // Image uplaod
                    /*$imgnewfile = md5($imgfile) . $extension;
                    move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $imgnewfile);
                    echo "<script>alert('Document uploaded sucessfully')</script>";*/

                    echo "<script>alert('You have successfully registered. Please Login now');</script>";
                    echo "<script>window.location.href ='index.php'</script>";
                }

                else {
                    echo "<script>alert('Something Went Wrong. Please try again');</script>";
                    echo "<script>window.location.href ='index.php'</script>";
                }
            }
        }
    }
?>  