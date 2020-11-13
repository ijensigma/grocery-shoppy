<style>
    <?php include ('results.css') ?>
</style>
<?php

session_start();
include('dbconnection.php');

$search= $_SESSION['res'];
$query = "
  SELECT * FROM products 
  WHERE ProductName LIKE '%".$search."%' OR ProductSKU LIKE '%".$search."%'
 ";
$result = mysqli_query($con, $query);
//if(mysqli_num_rows($result) > 0)
//{
//
//    while($row = mysqli_fetch_array($result))
//    {
//        $output .= '
//        <table id="product">
//           <tr>
//            <td>'.$row["ProductName"].'</td></tr><br />
//           </tr>
//         </table>
//  ';
//}
//    echo $output;
//}
//define total number of results you want per page
$results_per_page = 2;

//find the total number of results stored in the database
$number_of_result = mysqli_num_rows($result);

//determine the total number of pages available
$number_of_page = ceil ($number_of_result / $results_per_page);

//determine which page number visitor is currently on
if (!isset ($_GET['page']) ) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

//determine the sql LIMIT starting number for the results on the displaying page
$page_first_result = ($page-1) * $results_per_page;

//retrieve the selected results from database
$query = " SELECT * FROM products 
  WHERE ProductName LIKE '%".$search."%' OR ProductSKU LIKE '%".$search."%' LIMIT " . $page_first_result . ',' . $results_per_page;
$result = mysqli_query($con, $query);

//display the retrieved result on the webpage
while ($row = mysqli_fetch_array($result)) {
    $output .= '
        <table id="product">
           <tr>
            <td>'.$row["ProductName"].'</td></tr><br />
            <td>'.$row["ProductPrice"].'</td></tr><br />
           </tr>
         </table>
    ';
}
echo $output;


//display the link of the pages in URL
for($page = 1; $page<= $number_of_page; $page++) {
    echo '<a href = "sresults.php?page=' . $page . '">' . $page . ' </a>';
}
?>