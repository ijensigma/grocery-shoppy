
<?php
session_start();
//fetch.php
include('dbconnection.php');

$output = '';
if(isset($_POST["query"]))
{
    $search = mysqli_real_escape_string($con, $_POST["query"]);
    $_SESSION['res']=$search;
   
    $query = "
  SELECT * FROM products 
  WHERE ProductName LIKE '%".$search."%' OR ProductSKU LIKE '%".$search."%' LIMIT 5
 ";
}

$result = mysqli_query($con, $query);
if(mysqli_num_rows($result) > 0)
{
    $output .= '
  <div class="table-responsive">
   <table style="border:1px solid" class="table table bordered">
    <tr>
     <th style="font-weight:bold;color:black;">Product Name</th>
   
    </tr>
 ';
    while($row = mysqli_fetch_array($result))
    {
        
        $output .= '
   <tr>
    <td style="color:black;">'.$row["ProductName"].'</td>
    </td>
   
   </tr>
  ';

    }
    echo $output;
    
   
    ;
}


?>