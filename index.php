<?php
session_start();
include 'connect.php';
include 'header.html';
if(!isset($_SESSION['id']))
{
    echo "Please log in to continue";
}

else
{


$id=$_SESSION['id'];
$level=$_SESSION['userlevel'];
?>
<html>
    <head>
        <title>
            Welcome to Medfast  
        </title>
    </head>
    <body>
   
        <?php
        if($level==1)
        {
            echo "<a href='category.php'>Add new Medicine category</a><br>";
            echo "<a href='medicine.php'>Insert New Stock</a><br>";
            echo "<a href='medicineupdate.php'>Update Existing Stock</a><br>";
            echo "<a href='deletemedicine.php'>Delete Existing Stock</a><br>";
            echo "<a href='orderhistory.php'>View order History</a><br>";
        }
        else
        {
            ?>
            <table border="5" cellspacing="2" cellpadding="2">
            <tr>
                <th>Medicine Name</th>
                <th>Availability</th>
                <th>Cost</th>
            <?php
            $query="SELECT mid,mname,stock,mcost from medicines";
            $queryid=oci_parse($conn,$query);
            $result=oci_execute($queryid);
            while($row=oci_fetch_assoc($queryid))
                {
                    ?>
                    <tr>
                    <th><a href="buymedicine.php?id=<?php echo $row['MID']?>"><?php echo $row['MNAME']?></th></option>
                    <td><?php echo $row['STOCK']?></td>
                    <td>₹<?php echo $row['MCOST']?></td>
                    </tr>
                    <?php
                }
               
                ?>
            </table>
        <?php
        }

    }
        ?>

