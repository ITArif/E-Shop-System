<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Show Order List</a>
            </li>
           
          </ol>

            <?php 

                 if (isset($_GET["delete_id"]) AND $_GET['delete_id'] !=NULL) {
                    $delete_id=$_GET["delete_id"];
                    $delete_id=preg_replace('/[^a-zA-Z0-9]/','',$delete_id);

                    $sql="DELETE FROM productorder  where order_id='$delete_id'";
                    $query=mysqli_query($connection,$sql); 
                    if ($query !=false) {
                                echo "<p style='color:green'>You have deleted this order </p>";
                        }      
                }

            ?>  


            <?php 

           if (isset($_GET["order_id"]) AND $_GET['order_id'] !=NULL) {
                        $order_id=$_GET["order_id"];
                        $order_id=preg_replace('/[^a-zA-Z0-9]/','',$order_id); 

                      $sql="UPDATE productorder set ostatus='1' where order_id='$order_id'"; 
                      $query=mysqli_query($connection,$sql);
                      if ($query !=false) {
                            $sql="SELECT * FROM productorder where order_id='$order_id'";
                            $query=mysqli_query($connection,$sql);
                            if ($query !=false) {
                              $row=mysqli_num_rows($query);
                              if ($row>0) {
                                $value=mysqli_fetch_assoc($query);
                                $product_id=$value['product_id'];
                                    $sql="SELECT * FROM product where product_id='$product_id'";
                                    $query=mysqli_query($connection,$sql);
                                    if ($query !=false) {
                                  $value=mysqli_fetch_assoc($query);
                                  $pstatus=$value['pstatus'];
                                  $pstatus=$pstatus+1;
                                  $sql="UPDATE product set pstatus='$pstatus' where product_id='$product_id'";
                                  $query=mysqli_query($connection,$sql);
                                  if ($query !=false) {
                                    echo "<p style='color:green'>Order has been confirmed successfully</p>";
                                  }else{
                                    echo mysqli_error($connection);
                                  }

                                 }

                              }
                            }
                        }     
                    }

             ?>
          <div class="card mb-3">
            <div class="card-header">

              <i class="fas fa-table"></i>
              Data Table Example</div>
            <div class="card-body">
              <div class="table-responsive">

                <table class="table table-bordered"  id="dataTable" mwidth="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S</th>
                      <th>P. Name</th>
                      <th>U. Price</th>
                      <th>Quantity</th>
                      <th>T. Price</th>
                      <th>Brand name</th>
                      <th>Category Name</th>
                      <th>Customer Details</th>
                      <th>Image</th>
                      <th width="18%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    <?php 

                      $sql="SELECT productorder.*, product.*,brand.bname,category.cname from productorder INNER JOIN product on productorder.product_id=product.product_id INNER JOIN brand on productorder.brand_id=brand.brand_id INNER JOIN category on productorder.category_id=category.category_id";
                    $query=mysqli_query($connection,$sql);
                     if ($query !=false) {
                      $i=0;
                      while ($value=mysqli_fetch_assoc($query)) {
                   ?>
                      <tr>
                      <td><?php echo ++$i; ?></td>
                      <td><?php echo $value['name'] ?></td>
                      <td><?php echo $value['price'] ?></td>
                      <td><?php echo $value['quantity'] ?></td>
                      <td><?php echo $value['price']*$value['quantity']." TK" ?></td>
                      <td><?php echo $value['bname'] ?></td>
                      <td><?php echo $value['cname'] ?></td>
                      <td><a href="viewuser.php?user_id=<?php echo $value['user_id'] ?>" class="btn">View user</a></td>
                      <td><img src="<?php echo $value['image'] ?>" style="width: 100px;height: 60px;"></td>
                      <td>
                        <?php 
                            if ($value['ostatus']=='0') {
                              # code...
                            

                         ?>
                         <a href="?order_id=<?php echo $value['order_id'] ?>" class="btn">Not Confirmed</a> 
                         <a href="?delete_id=<?php echo $value['order_id'] ?>" onclick="return confirm('Do you want to delete this order ???')" class="btn">Delete</a>
                       <?php }else if($value['ostatus']=='1'){ ?>

                        <span class="text-success">Confirmed</span>
                         <a href="?delete_id=<?php echo $value['order_id'] ?>" onclick="return confirm('Do you want to delete this order ?')" class="btn">Delete</a>

                       <?php }else{ ?>
                         <span class="text-success">Delivered</span>
                         <a href="?delete_id=<?php echo $value['order_id'] ?>" onclick="return confirm('Do you want to delete this order ?')" class="btn">Delete</a>
                        <?php  }?>
                      </td>
                    </tr>
                    <?php }}else{echo mysqli_error($connection);} ?>

                  </tbody>
                </table>
              </div>
            </div>
          
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>