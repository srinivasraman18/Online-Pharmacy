<?php
session_start();
include 'connect.php';
include 'header.html';



if(isset($_SESSION['cart']))

{

    if(isset($_POST['submit']))
    { 
          
        foreach($_POST['quantity'] as $key => $val) { 
            if($val==0) { 
                unset($_SESSION['cart'][$key]); 
            }else{ 
                $_SESSION['cart'][$key]['quantity']=$val; 
            } 
        } 
          
    } 
    ?>
    <form method="post" action="#"> 
      
      <table border="5"> 
            
          <tr> 
              <th>Name</th> 
              <th>Quantity</th> 
              <th>Cost</th> 
              <th>Medicine's Price</th> 
          </tr> 
    <?php
    $sql="SELECT mid,mname,mcost,mpower from medicines where mid IN (";

    foreach($_SESSION['cart'] as $id=>$value)
    {
        $sql.=$id.",";
    }
    $sql=substr($sql,0,-1).") ORDER BY mname ASC";
    $sqlid=oci_parse($conn,$sql);
    $result=oci_execute($sqlid);
    $totalprice=0;
    while($row=oci_fetch_assoc($sqlid))
    {
        $subtotal=$_SESSION['cart'][$row['MID']]['quantity']*$row['MCOST']; 
        $totalprice+=$subtotal; 
       ?>
        <tr> 
                            <td><?php echo $row['MNAME'] ?></td> 
                            <td><input type="text" name="quantity[<?php echo $row['MID'] ?>]" size="5"
                             value="<?php echo $_SESSION['cart'][$row['MID']]['quantity'] ?>" /></td> 
                            <td>₹<?php echo $row['MCOST'] ?></td> 
                            <td><?php echo $_SESSION['cart'][$row['MID']]['quantity']*$row['MCOST'] ?></td> 
        </tr> 
        <?php 
    }
?>
                    <tr> 
                        <td colspan="4">Total Price: <?php echo $totalprice ?></td> 
                    </tr> 
          
    </table> 
    <br /> 
    <?php $_SESSION['totalprice']=$totalprice ?>
    <button type="submit" name="submit">Update Cart</button> 
    <a href="checkout.php">Proceed to Checkuot</a>
    </form> 
    <br /> 
    <p>To remove an item set its quantity to 0. </p>

<?php
}

?>