<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Update Product</a>
            </li>

            <?php 

           if (isset($_GET["product_id"]) AND $_GET['product_id'] !=NULL) {
                        $product_id=$_GET["product_id"];
                        $product_id=preg_replace('/[^a-zA-Z0-9]/','',$product_id);       
                    }else{
                        echo "<script>window.location='showproduct.php'</script>";
                    }

             ?>

          </ol>

            <div style="width: 700px;padding: 12px 12px;margin: 50px auto">
              <?php 
           
                      if ($_SERVER['REQUEST_METHOD']=="POST") {
                              $name       =trim(stripcslashes(htmlentities($_POST['name'])));
                              $brand_id   =trim(stripcslashes(htmlentities($_POST['brand_id'])));
                              $category_id=trim(stripcslashes(htmlentities($_POST['category_id'])));
                              $price      =trim(stripcslashes(htmlentities($_POST['price'])));

                              $image       =$_FILES['image']['name'];
                              $image_tmp   =$_FILES['image']['tmp_name'];
                              $unique_name =time().$image;
                              $upload_image="upload/".$unique_name;

                              if ($name=="" || $brand_id=="" || $category_id=="" || $price=="") {
                                  echo "<p style='color:red'>Fields must not be empty</p>";
                              }else{

                                  if ($image!="") {
                                          
                                       move_uploaded_file($image_tmp, $upload_image);
                                      $sql="UPDATE product set 
                                      name       ='$name',
                                      brand_id   ='$brand_id',
                                      category_id='$category_id',
                                      image      ='$upload_image',
                                      price      ='$price'
                                      where product_id='$product_id'";

                                      $query=mysqli_query($connection,$sql);
                                       if ($query !=false) {
                                        echo "<p style='color:green'>Product updated successfully</p>";
                                       }else{
                                        echo "<p style='color:red'>product did not updated</p>";
                                        }
                                  }else{

                                      $sql="UPDATE product set 
                                      name       ='$name',
                                      brand_id   ='$brand_id',
                                      category_id='$category_id',
                                      price      ='$price'
                                      where product_id='$product_id'";
                                      $query=mysqli_query($connection,$sql);
                                       if ($query !=false) {
                                        echo "<p style='color:green'>Product updated successfully</p>";
                                       }else{
                                        echo "<p style='color:red'>product did not update</p>";
                                        }
                                  }

                               }

                            
                      }

              ?>
              
              <?php 
               $sql="SELECT product.*, brand.bname, category.cname from product INNER JOIN brand on product.brand_id=brand.brand_id INNER JOIN category on product.category_id=category.category_id where product_id='$product_id'";
               $query=mysqli_query($connection,$sql);
               if ($query !=false) {
                  $result=mysqli_fetch_assoc($query);
               }else{
                  echo mysqli_error($connection);
               }

             ?>
              <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="test" class="form-control" id="name"  name="name" value="<?php echo $result['name'] ?>">
              </div>

              <div class="form-group">
                <label for="brand_id">Brand</label>
                <select class="form-control" id="brand_id" name="brand_id">
                  <option value="">Select One</option>
                  <?php 
                    $sql="SELECT * FROM brand";
                    $query=mysqli_query($connection,$sql);
                    if ($query !=false) {
                        while ($valueb=mysqli_fetch_assoc($query)) {
                  ?>
                  <option 
                      value="<?php echo $valueb['brand_id'] ?>"><?php echo $valueb['bname'] ?></option>
                 
                <?php }} ?>
                </select>
              <span style="color: green"><?php echo $result['bname'] ?></span>
              </div>

               <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id">
                  <option value="">Select one</option>
                  <?php 
                    $sql="SELECT * FROM category";
                    $query=mysqli_query($connection,$sql);
                    if ($query !=false) {
                      while ($valuec=mysqli_fetch_assoc($query)) {
                  ?>
                  <option  
                       
                         
                  value="<?php echo $valuec['category_id'] ?>"><?php echo $valuec['cname'] ?></option>
                  
                <?php }} ?>
                </select>
                 <span style="color: green"><?php echo $result['cname'] ?></span>
              </div>
              <div class="form-group">
                 <label for="image">Image</label>
                 <input type="file" class="form-control-file" id="image" name="image">
               </div>
               <img src="<?php echo $result['image'] ?>" width="100px;">
               <div class="form-group">
                <label for="price">Price</label>
                 <input type="number" class="form-control-file" id="price" name="price" min="1" step="1" value="<?php echo $result['price'] ?>">
                </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>