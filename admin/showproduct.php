<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Show product</a>
            </li>
           
          </ol>
            <?php 

           if (isset($_GET["product_id"]) AND $_GET['product_id'] !=NULL) {
                        $product_id=$_GET["product_id"];
                        $product_id=preg_replace('/[^a-zA-Z0-9]/','',$product_id); 
                     
                     $sql="SELECT * FROM product where product_id='$product_id'"; 
                     $query=mysqli_query($connection,$sql);
                     if ($query !=false) {
                      $value=mysqli_fetch_assoc($query);
                      $imagename=$value['image'];
                      if (file_exists($imagename)) {
                        unlink($imagename);
                      }else{
                        echo "<p style='color:red'>This file is not available in folder</p>";
                      } 
                     }
                        $sql="DELETE  FROM product where product_id='$product_id'";
                         $query=mysqli_query($connection,$sql);
                         if ($query !=false) {
                            echo "<p style='color:green'>Product deleted successfully</p>";
                         }else{
                              echo "<p style='color:red'>>Product did not delete</p>";
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
                      <th>Sesial</th>
                      <th>Product Name</th>
                      <th>Brand Name</th>
                      <th>Category Name</th>
                      <th>Price</th>
                      <th>Image</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    <?php 

                      $sql="SELECT product.*,brand.bname,category.cname FROM product INNER JOIN brand on product.brand_id=brand.brand_id  INNER JOIN category on product.category_id=category.category_id order by product_id desc";
                    $query=mysqli_query($connection,$sql);
                     if ($query !=false) {
                      $i=0;
                      while ($value=mysqli_fetch_assoc($query)) {
                   ?>
                      <tr>
                      <td><?php echo ++$i; ?></td>
                      <td><?php echo $value['name'] ?></td>
                      <td><?php echo $value['bname'] ?></td>
                      <td><?php echo $value['cname'] ?></td>
                      <td><?php echo $value['price']." TK" ?></td>
                      <td><img src="<?php echo $value['image'] ?>" style="width: 100px;height: 60px;"></td>
                      <td>
                        <a href="editproduct.php?product_id=<?php echo $value['product_id'] ?>">Edit</a> | 
                         <a href="?product_id=<?php echo $value['product_id'] ?>" onclick="return confirm('Do you want to delete this product name ?')">Delete</a>
                      </td>
                    </tr>
                    <?php }} ?>

                  </tbody>
                </table>
              </div>
            </div>
          
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>