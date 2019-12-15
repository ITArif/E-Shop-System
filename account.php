
<?php include_once "include/header.php" ?>
<?php 


       # code...
   
        $login=$_SESSION['login'];
        $role=$_SESSION['role'];
        if ($login ==false and $role!='admin') {
          header("location:login.php");
       }
    

 ?>

<div class="content-area">


    <div class="account-page">

        <div class="container">

          <?php 

                 if (isset($_GET["cancel_id"]) AND $_GET['cancel_id'] !=NULL) {
                    $cancel_id=$_GET["cancel_id"];
                    $cancel_id=preg_replace('/[^a-zA-Z0-9]/','',$cancel_id);

                    $sql="DELETE FROM productorder  where order_id='$cancel_id'";
                    $query=mysqli_query($connection,$sql); 
                    if ($query !=false) {
                                echo "<div class='alert alert-success'>You have canceled your order </div>";
                        }      
                }

            ?>  

               <?php 

                 if (isset($_GET["recieve_id"]) AND $_GET['recieve_id'] !=NULL) {
                    $recieve_id=$_GET["recieve_id"];
                    $recieve_id=preg_replace('/[^a-zA-Z0-9]/','',$recieve_id);

                    $sql="UPDATE productorder set ostatus='2' where order_id='$recieve_id'";
                    $query=mysqli_query($connection,$sql); 
                    if ($query !=false) {
                              echo "<div class='alert alert-success'>You have received order successfully</div>";
                        }      
                }

            ?>




          <div class="row">
            <div class="col-sm-4">
                    <?php 
                       $user_id=$_SESSION['user_id'];
                       $sql="SELECT * FROM user where user_id='$user_id'";
                       $query=mysqli_query($connection,$sql);
                       if ($query) {
                            $value=mysqli_fetch_assoc($query);

                       }
                               
                     ?>
                        <div class="well">
                            <h3>Your Profile</h3>
                            <p>Name : <?php echo $value['name'] ?></p>
                            <p>Email : <?php echo $value['email'] ?></p>
                            <p>City : <?php echo $value['city'] ?></p>
                            <p>Zip-code : <?php echo $value['zipcode'] ?></p>
                            <p>Address : <?php echo $value['address'] ?></p>
                            <p>Phone : <?php echo $value['phone'] ?></p>
                           <!-- <p><a href="account_change_email.html">Change Email</a> | <a href="account_change_password.html">Change Password</a></p>-->
                            
                          
                             
                            <div class="clearfix"></div>
                        </div>
            </div>
            <div class="col-sm-8">
                <h2>Your Order Details</h2>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">S.no</th>
                      <th scope="col">Brand</th>
                      <th scope="col">category</th>
                      <th scope="col">Image</th>
                      <th scope="col">Unit price</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Total price</th>
                     <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php 
                        $sessionid=session_id();
                        $sql="SELECT productorder.*, product.*,brand.bname,category.cname from productorder INNER join product on productorder.product_id=product.product_id INNER JOIN brand on productorder.brand_id=brand.brand_id INNER JOIN category on productorder.category_id=
                          category.category_id where user_id='$user_id' and sessionid='$sessionid'";
                        $query=mysqli_query($connection,$sql);
                        if ($query !=false) {
                            $row=mysqli_num_rows($query);
                            if ($row>0) {                        
                            $i=0;
                            while ($value=mysqli_fetch_assoc($query)) {
                          
                     ?>
                    <tr>
                        <th scope="row"><?php echo ++$i; ?></th>
                        <td><?php echo $value['bname'] ?></td>
                        <td><?php echo $value['cname'] ?></td>
                        <td><img src="<?php echo 'admin/'.$value['image'] ?>" width="60px"></td>
                        <td><?php echo $value['price']." TK" ?></td>
                        <td><?php echo $value['quantity'] ?></td>
                        <td><?php echo $value['price']*$value['quantity']." TK" ?></td>
                        <td>
                            <?php 
                                if ($value['ostatus']=='0') {
                               
                             ?>
                            <span class="text-danger">Not confirmed</span>
                             <a href="?cancel_id=<?php echo $value['order_id'] ?>" onclick="return confirm(' Do you wnat to delete your order ?')">Cancel</a>
                            <?php }else if($value['ostatus']=='1'){ ?>
                            <a href="?recieve_id=<?php echo $value['order_id'] ?>">Click To receive</a>
                            <?php }else{ ?>
                              <span class="text-success">Done</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }}else{ ?>
                    <span class="text-danger">You have not ordered yet !!! please order now</span>
                <?php  }}?>
                  </tbody>
                </table>            
                
            </div>
        </div> <!--End Row-->

    </div>
</div> <!--End Account page div-->

</div> <!-- End content Area class -->


<?php include_once "include/footer.php" ?>