<html>
<head><title>Oracle demo</title></head>
<body>
    <?php 
    $conn=oci_connect("system","Wolverine18","localhost/orcl");
    if (!$conn)
        echo 'Failed to connect to Oracle';

 

?>
 
