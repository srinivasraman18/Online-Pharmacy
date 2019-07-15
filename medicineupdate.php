<?php
session_start();
include 'connect.php';
include 'header.html';
?>
<html>
    <head>
        <title>
            Welcome Admin
        </title>
    </head>
    <body>
            <table border="5" cellspacing="2" cellpadding="2">
                <tr>
                    <th>Medicine Name</th>
                    <th>Availability</th>
                <?php
                $query="SELECT mid,mname,stock from medicines";
                $queryid=oci_parse($conn,$query);
                $result=oci_execute($queryid);
                while($row=oci_fetch_assoc($queryid))
                    {
                        ?>
                        <tr>
                        <th><a href="medicineupdatedb.php?id=<?php echo $row['MID']?>"><?php echo $row['MNAME']?></th></option>
                        <td><?php echo $row['STOCK']?></td>
                        </tr>
                        <?php
                    }
                   
                    ?>
                </table>
            
    </body>
    
</html>


