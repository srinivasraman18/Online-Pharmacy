if($_SERVER['REQUEST_METHOD']=='POST')
{
    $id=$_POST['medicine_id'];
    $stock=$_POST['stock'];
    $query="UPDATE medicines SET stock=$stock WHERE mid=$id";
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
$sql="SELECT mname,mpower,stock from medicines";
$sqlid=oci_parse($conn,$sql);
$result=oci_execute($sqlid);

?>