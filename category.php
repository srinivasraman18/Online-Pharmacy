<?php
    session_start();
    include 'connect.php';
    include 'header.html';
?>
<html>
    <head>
        <title>
            Add category
        </title>
    </head>
    <body>
        <?php
        if($_SERVER['REQUEST_METHOD']=="POST")
        {

            $cat=$_POST['category'];
           
           $sql="INSERT INTO category(cname) values('$cat') ";
           $sqlid=oci_parse($conn,$sql);
        
            if(!oci_execute($sqlid))
                echo "Unable to insert into database";
            else
                echo "Medicine Category updated successfully";
        }
        else
        {

        ?>
        <form action="" method="POST">
           Category: <input type="text" name="category" placeholder="Enter category to add">
           <br/>
           <input type="submit" value="Add category">

        </form>
    </body>
</html>
<?php
        }?>