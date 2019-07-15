<?php
session_start();
include 'connect.php';
include 'header.html';

if($_SERVER['REQUEST_METHOD']=='POST')
{
    $mid=$_SESSION['mid'];
    $stock=$_POST['stock'];
    $query="UPDATE medicines SET stock=$stock WHERE mid=$mid";
    $queryid=oci_parse($conn,$query);
    $result=oci_execute($queryid);
    if(!$result)
    {
        echo "Unable to insert";
    }
    else
    {
        echo "Stock Updated successfully";
    }
    unset($_SESSION['mid']);


}
else
{
$id=$_SESSION['id'];
$mid=$_GET['id'];
?>
<form action="#" method="POST">
    Enter new stock availability:<input type="number" name="stock" palceholder="Enter new availability">
    <br/>
   <?php $_SESSION['mid']=$id;?>

    <input type="submit" value="Update">

</form>
<?php

}

?>