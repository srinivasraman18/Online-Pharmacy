<?php
session_start();
include 'header.html';
include 'connect.php';
if(!isset($_SESSION['id']))
{
    echo "Please log in to continue";
}
else
{


if($_SERVER['REQUEST_METHOD']=='POST')
{
    $name=$_POST['medicinename'];
    $power=$_POST['power'];
    $mandate=$_POST['mandate'];
    $expdate=$_POST['expdate'];
    $cid=$_POST['category'];
    $stock=$_POST['stock'];
    $mdesc=$_POST['mdesc'];
    $cost=$_POST['cost'];
    $query="INSERT INTO medicines( mname, mpower, mcategory,mandate,expdate,stock,mdesc,mcost)
     VALUES('$name',$power,$cid,TO_DATE('$mandate', 'YYYY-MM-DD'),TO_DATE('$expdate', 'YYYY-MM-DD'),$stock,'$mdesc',$cost)";
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
                <label for="medicinename"><b>Medicine Name</b></label>
                <input type="text" placeholder="Enter Medicine name" name="medicinename" required>
                <br/>
                <label for="power"><b>Medicine's power</b></label>
                <input type="number" placeholder="Enter Medicine's power" name="power" required>
                <br/>
                <label for="cost"><b>Medicine's Cost</b></label>
                <input type="number" placeholder="Enter Medicine's Cost" name="cost" required>
                <br/>
                <label for="mandate"><b>Manufacturing Date</b></label>
                <input type="date" placeholder="Enter Medicine's Manufacturing date" name="mandate" required>
                <br/>
                <label for="expdate"><b>Expiry Date</b></label>
                <input type="date" placeholder="Enter Medicine's Expiry date" name="expdate" required>
                <br/>
                <label for="stock"><b>Availability</b></label>
                <input type="number" placeholder="Enter Medicine's Stock Availability" name="stock" required>
                <br/>
                <label for="category"><b>Select Medicine Category</b></label>
                <select name="category">
                    <?php
                    while($row=oci_fetch_assoc($sqlid))
                    {
                        ?>
                        <option value="<?php echo $row['CID']?>"><?php echo $row['CNAME']?></option>
                        <?php
                    }
                   
                    ?>
                </select>
                <br/>
                <textarea name="mdesc" placeholder="Enter medicine description">Medicine description</textarea>
                <br>

                <input type="submit" value="Update Stock">
                
        </form>
    </body>
    
</html>


<?php
}}?>