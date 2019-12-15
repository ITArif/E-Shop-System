<?php include_once "include/header.php" ?>


<div class="content-area">

<?php 

         if (isset($_GET["product_id"]) AND $_GET['product_id'] !=NULL) {
            $product_id=$_GET["product_id"];
            $product_id=preg_replace('/[^a-zA-Z0-9]/','',$product_id);       
        }else{
            echo "<script>window.location='index.php'</script>";
        }

    ?>
                    


<div class="featured-products">

    <div class="container">
       <div class="clear"></div>
        <div class="clear"></div>
        <div class="featured-items">

            <div class="row">

              <?php 

                  if ($_SERVER["REQUEST_METHOD"]=="POST") {

                      $user_id=$_SESSION['user_id'];
                      $sessionid=session_id();
                      $quantity=trim(stripcslashes(htmlspecialchars($_POST['quantity'])));
                      if ($quantity=="") {
                           echo "<div class='alert alert-danger'>!!! Define quantity </div>";
                      }else{
                          $sql="SELECT * from product where product_id='$product_id'";
                          $query=mysqli_query($connection,$sql);
                          if ($query !=false) {
                              $sql="SELECT * FROM productorder where product_id='$product_id' and sessionid='$sessionid' and user_id='$user_id'";
                              $query=mysqli_query($connection,$sql);
                              if ($query !=false) {
                                $row=mysqli_num_rows($query);
                                if ($row>0) {
                                  echo "<div class='alert alert-danger'>!!! You have already ordered this product</div>";
                                }else{
                                  $sql="SELECT * FROM product where product_id='$product_id'";
                                  $query=mysqli_query($connection,$sql);
                                  if ($query !=false) {
                                      $value=mysqli_fetch_assoc($query);
                                      $category_id=$value['category_id'];
                                      $brand_id=$value['brand_id'];
                                      $sql="INSERT INTO productorder(quantity,product_id,user_id,brand_id,category_id,sessionid)VALUES('$quantity','$product_id','$user_id','$brand_id','$category_id','$sessionid')";
                                        $query=mysqli_query($connection,$sql);
                                        if ($query !=false) {
                                           echo "<div class='alert alert-success'>!!! Your order has been successfull.  <span style=' font-size:25px;fond-weight:bold'><a href='index.php'>Continue shopping</a></span></div>";
                                        }

                                  }

                                }
                              }

                          }

                      }
                     
                  }
               ?>


                    <?php 

                         $sql="SELECT product.*,brand.bname,category.cname FROM product INNER JOIN brand on product.brand_id=brand.brand_id  INNER JOIN category on product.category_id=category.category_id where product_id='$product_id'";
                        $query=mysqli_query($connection,$sql);
                         if ($query !=false) {
                          $i=0;
                          while ($value=mysqli_fetch_assoc($query)) {
                   ?>
            <div class="col-md-4">
                <div style="width: 200px; height: 190px;padding:6px;">
                 <img src="<?php echo 'admin/'.$value['image'] ?>" class="rounded float-right" alt="gfh" style="width: 100%;height: 100%;">
                </div>
            </div>
                <div class="col-md-4">
                    <span class="spanall">Name:</span><p class="sppanvalue"><?php echo $value['name'] ?></p>
                     <span class="spanall">Brand:</span><p class="sppanvalue"><?php echo $value['bname'] ?></p>
                    <span class="spanall">Category:</span><p class="sppanvalue"><?php echo $value['cname'] ?></p>
                    <span class="spanall">price:</span><p class="sppanvalue"><?php echo $value['price']." TK" ?></p>
                    <div>
                        <form action="" method="POST">
                            <input type="number" name="quantity" min="1" step="1" style="padding-bottom:4px">
                            <?php 
                              if (isset($_SESSION['login']) and $_SESSION['login']==true) {
                             ?>
                            <button type="submit" class="btn btn-primary">Buy Now</button>
                          <?php }else{?>
                            <a href="login.php" class="btn btn-primary">Buy Now</a>
                          <?php } ?>
                        </form>
                    </div>
            </div>
                <?php }} ?>

            <div class="col-md-4">
             
            </div>
     </div>





        </div>
    </div>
</div> <!--End Featured products Div-->

</div> <!-- End content Area class -->


<?php include_once "include/footer.php" ?>