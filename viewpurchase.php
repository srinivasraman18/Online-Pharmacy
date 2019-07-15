<?php
session_start();
if(!isset($_SESSION['id']))
{
    echo "Please log in to continue";
}
else
{
    include 'connect.php';
    include 'header.html';

$orderid=$_GET['id'];
$sql="SELECT  purchase_id, order_id,mid,quantity,dop from purchase where order_id=$orderid";
$sqlid=oci_parse($conn,$sql);
$result=oci_execute($sqlid);
?>
<table border="5">
    <tr>
        
        <th>Medicine</th>
        <th>Quantity</th>
        <th>Date of Purchase</th>
    </tr>
<?php
while($row=oci_fetch_assoc($sqlid))
{
    $med=$row['MID'];
    ?>
    <tr>
        
        <?php
        $query="SELECT mname from medicines where mid =$med";
        $queryid=oci_parse($conn,$query);
        $queryresult=oci_execute($queryid);
        $newrow=oci_fetch_assoc($queryid);
        $mname=$newrow['MNAME'];
        ?>
        <td><?php echo $mname ?></td>
        <td><?php echo $row['QUANTITY']?></td>
        <td><?php echo $row['DOP']?></td>
        <?php
}
}
?>