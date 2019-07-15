<?php
session_start();
if(!isset($_SESSION['id']))
{
    echo "You are logged out please login to continue";
}
else
{
    include 'header.html';
    include 'connect.php';
    $sql="SELECT order_id,order_by,total_cost from orders";
    $sqlid=oci_parse($conn,$sql);
    $result=oci_execute($sqlid);
    ?>
    <table border="5">
        <tr>
            <th>Order id</th>
            <th>Customer Name</th>
            <th>Purchase Amount</th>
        </tr>
    <?php
    while($row=oci_fetch_assoc($sqlid))
    {
        $userid=$row['ORDER_BY'];
        ?>
        <tr>
        <td><a href="viewpurchase.php?id=<?php echo $row['ORDER_ID']?>"><?php echo $row['ORDER_ID']?></a></td> 
        <?php
        $query="SELECT name from users where id =$userid";
        $queryid=oci_parse($conn,$query);
        $queryresult=oci_execute($queryid);
        $newrow=oci_fetch_assoc($queryid);
        $username=$newrow['NAME'];
        ?>
        <td><?php echo $username ?></td>
        <td><?php echo $row['TOTAL_COST'] ?></td>
    </tr>
    <?php
    }
    ?></table>
    <?php
   
        
    }?>