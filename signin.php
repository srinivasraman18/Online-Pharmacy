<?php
session_start();

include 'connect.php';
$username=$_POST['username'];
$password=$_POST['password'];
$username = stripslashes($username);

$count=0;

$query = "SELECT 
                        id,
                        username,
                        password,
                        user_level
                    FROM
                        users
                    WHERE
                       username = '$username'
                    
            ";
                         
			
            $sqlid=oci_parse($conn,$query);
            $result=oci_execute($sqlid);
			
			if(!$result)
			{	
			    echo 'Something went wrong Please try again later';
			}
			
            while($row=oci_fetch_assoc($sqlid))
            {
                    if($row['USERNAME']==$username)
                    {
                        if(password_verify($password,$row['PASSWORD']))
                            $count++;
                     }      
            }
            oci_free_statement($sqlid);
if($count==0)
{
    echo "Invalid Username or Password";
}
else
{
    echo "hi";
    $query = "SELECT 
                        id,
                        username,
                        password,
                        user_level
                    FROM
                        users
                    WHERE
                       username = '$username'
                    
            ";
                         
			
            $sqlid=oci_parse($conn,$query);
            $result=oci_execute($sqlid);
	while($row=oci_fetch_assoc($sqlid))
	{
		            $_SESSION['id']=$row['ID'];
                    $_SESSION['user_name']=$row['USERNAME'];
					$_SESSION['userlevel']=$row['USER_LEVEL'];
	}               $_SESSION['Entered']=0;


    header("location:index.php");
} 
    oci_close($conn);


?>