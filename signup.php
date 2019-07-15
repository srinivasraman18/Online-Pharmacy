<?php

include 'connect.php';


$name=$_POST['name'];
$username=$_POST['username'];
$pwd=$_POST['psw'];
$mail=$_POST['mail'];
$phonenum=$_POST['phonenum'];
$address=$_POST['address'];

$check="SELECT * from users where username='$username' ";
$checkid=oci_parse($conn,$check);
oci_execute($checkid);
$count=0;
while($row=oci_fetch_assoc($checkid))
{
    if($row['USERNAME']==$username)
    {
        echo $row['USERNAME'];
        echo "Username already exists.Please choose another name";
        $count++;
        break;
    }
}

if($count==0)
{
$hash = password_hash($pwd, PASSWORD_DEFAULT, ['cost' => 15]);
$sql="INSERT INTO users(name,username,password,phone_num,address,email,date_created) 
VALUES('$name','$username','$hash','$phonenum','$address','$mail',current_timestamp)";

$sqlid=oci_parse($conn,$sql);

if(!oci_execute($sqlid))
{
    echo "Failure";
}
else
{
    echo "Thanks for signing up. Click <a href='signin.html'>here</a> to continue";
}
oci_close($conn);



}

?>


