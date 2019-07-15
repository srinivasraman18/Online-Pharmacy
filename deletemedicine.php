<?php
session_start();
include 'connect.php';
include 'header.html';
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $id=$_POST['medicine_id'];
    $query="DELETE FROM medicines where mid=$id";
    $queryid=oci_parse($conn,$query);
    $result=oci_execute($queryid);
    if(!$result)
    {
        echo "Unable to delete";
    }
    else
    {
        echo "Deleted successfully";
    }
}



else
{
$id=$_SESSION['id'];
$sql="SELECT cid,cname from category";
$sqlid=oci_parse($conn,$sql);
$result=oci_execute($sqlid);

?>
<html>
    <head>
        <title>
            Welcome Admin
        </title>
    </head>
    <body>
        <form action="#" method="POST">
                
                    <?php
                    $sql="SELECT mid,mname from medicines";
                    $sqlid=oci_parse($conn,$sql);
                    $result=oci_execute($sqlid);
                    ?>
                    <select name="medicine_id">
                    <?php
                    while($row=oci_fetch_assoc($sqlid))
                    {
                        ?>
                        <option value="<?php echo $row['MID']?>"><?php echo $row['MNAME']?></option>
                        <?php
                    }
                   
                    ?>
                </select>
                <br/>
                <input type="submit" value="Delete Medicine">
                
        </form>
    </body>
    
</html>
<?php
}
?>
