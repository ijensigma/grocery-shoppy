<style>
    <?php include ('style1.css') ?>
</style>
<?php
    session_start();
    include('dbconnection.php');

    $uid=$_SESSION['uid'];
    $ret=mysqli_query($con,"select UserFirstName from users where UserID='$uid'");
    $row=mysqli_fetch_array($ret);
    $name=$row['UserFirstName'];

    if (strlen($_SESSION['uid']==0)) {
        header('location:logout.php');
    } 
    else{
        ?>
        <?php
        include('header.php');
        ?>
        <?php
        if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $update = true;
            $record = mysqli_query($con, "select id,address,country,state,city,postcode,phone from ADDRESS where user_id='$uid' && id=$id");

            if (count($record) == 1 ) {
                $n = mysqli_fetch_array($record);
                $address = $n['address'];
                $country = $n['country'];
                $state = $n['state'];
                $city = $n['city'];
                $postcode = $n['postcode'];
                $phone = $n['phone'];
            }
        }
        ?>

        <?php $results = mysqli_query($con, "select id,address,country,state,city,postcode,phone from ADDRESS where user_id='$uid'");



        ?>

        <table>
            <thead>
            <tr>
                <th>Address</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>Postcode</th>
                <th>Phone</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>

            <?php

                while ($row=mysqli_fetch_array($results)) { ?>
                <tr>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['country']; ?></td>
                    <td><?php echo $row['state']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['postcode']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td>
                        <a href="account.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
                    </td>
                    <td>
                        <a href="address.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="msg">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>
        <form method="post" action="address.php" class="frm">

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="input-group1">
                <label>Address</label>
                <input type="text" name="address" value="<?php echo $address; ?>">
            </div>
            <div class="input-group1">
                <label>Country</label>
                <input type="text" name="country" value="<?php echo $country; ?>">
            </div>
            <div class="input-group1">
                <label>State</label>
                <input type="text" name="state" value="<?php echo $state; ?>">
            </div>
            <div class="input-group1">
                <label>City</label>
                <input type="text" name="city" value="<?php echo $city; ?>">
            </div>
            <div class="input-group1">
                <label>Postcode</label>
                <input type="text" name="postcode" value="<?php echo $postcode; ?>">
            </div>
            <div class="input-group1">
                <label>Phone</label>
                <input type="tel" name="phone" value="<?php echo $phone; ?>">
            </div>
            <div class="input-group1">
                <?php if ($update == true): ?>
                    <button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
                <?php else: ?>
                    <button class="btn" type="submit" name="save" >Save</button>
                <?php endif ?>
            </div>
        </form>


<?php }
?>