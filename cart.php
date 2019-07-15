<?php
session_start();
include 'connect.php';

if(isset($_GET['action'])&&($_GET['action']=='add'))
{
    $mid=$_GET['id'];
    if(isset($_SESSION['cart'][$mid]))
    {
        $_SESSION['cart'][$mid]['quantity']++;
        echo "Produt updated";
    }
    else
    {
        $sql="SELECT mname,mcost from medicines where mid=$mid";
        $sqlid=oci_parse($conn,$sql);
        $result=oci_execute($sqlid);
        if(!$result)
        {
            echo "Invalid product";
        }
        else
        {

        $row=oci_fetch_assoc($sqlid);
        $_SESSION['cart'][$mid]=array("quantity"=>1,"cost"=>$row['MCOST']);
        echo $_SESSION['cart'][$mid]['quantity'];
        echo " Product added"; 
    }
    }
}