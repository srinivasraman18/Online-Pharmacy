<?php
session_start();
include 'connect.php';
include 'header.html';
$user_id=$_SESSION['id'];
$mid=$_GET['id'];
$sql="SELECT mname,mdesc,mandate,expdate,stock, mcost,mpower,mcategory FROM medicines where mid=$mid";
$sqlid=oci_parse($conn,$sql);
$result=oci_execute($sqlid);
$row=oci_fetch_assoc($sqlid);
if(!oci_execute($sqlid))
{
    echo "Connection Problem";
}
else
{

?>
<html>
    <head>
        <title>
            Happy shopping!
        </title>
    </head>
    <body>
   
    <table border="5" cellspacing="2" align="center">
    <tr>
    <th>Medicine Name</th>
    <td><?php echo $row['MNAME'] ?></td>
    </tr>
    <tr>
    <th>Medicine Power</th>
    <td><?php echo $row['MPOWER'] ?>mg</td>
    </tr>
    <tr>
    <th>Medicine Category</th>
    <td><?php echo $row['MCATEGORY'] ?>mg</td>
    </tr>
    <tr>
    <th>Medicine Description</th>
    <td><?php echo $row['MDESC'] ?></td>
    </tr>
    <tr>
    <th>Medicine Cost</th>
    <td><?php echo $row['MCOST'] ?></td>
    </tr>
    <tr>
    <th>Medicine Availability</th>
    <td><?php echo $row['STOCK'] ?></td>
    </tr>
    <tr>
    <th>Manufacturing Date</th>
    <td><?php echo $row['MANDATE'] ?></td>
    </tr>
    <tr>
    <th>Expiry Date</th>
    <td><?php echo $row['EXPDATE']?></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><a href="cart.php?page=products&action=add&id=<?php echo $mid ?>">Add to cart</a>
    </tr>
</table>



<?php
}
?>