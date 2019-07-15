<?php

session_start();
include 'connect.php';
include 'header.html';

if(isset($_SESSION['cart']))
{  
    $total=$_SESSION['totalprice'];
    $userid=$_SESSION['id'];
    
    
    $query1="INSERT INTO orders(order_by,total_cost) values($userid,$total) RETURNING order_id INTO :p_val";
    $query1id=oci_parse($conn,$query1);
    oci_bind_by_name($query1id,":p_val",$var);
    $result1=oci_execute($query1id);
    if(!$result1)
    {
       
        oci_rollback($conn);
        die;
        echo "Fatal error,try again";
    }
    
    
    foreach($_SESSION['cart'] as $id=>$value)
    {
        $quantity=$_SESSION['cart'][$id]['quantity'];
        $query2="INSERT INTO purchase(order_id,mid,quantity,dop) values($var,$id,$quantity,current_timestamp)";
        $query2id=oci_parse($conn,$query2);
        $result2=oci_execute($query2id);
        if(!$result2)
        {
            oci_rollback($conn);
            die;
            echo "Fatal error,try again";
        }

    }

    echo "Thanks for purchasing. Your order has been placed and will be delivered shortly";


}
?>