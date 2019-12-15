<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Add Product</a>
            </li>

           
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

                              if ($name=="" || $brand_id=="" || $category_id=="" || $price=="" || $image=="") {
                                  echo "<p style='color:red'>Fields must not be empty</p>";
                              }else{
                                move_uploaded_file($image_tmp, $upload_image);
                                $sql="INSERT INTO product(name,brand_id,category_id,image,price)VALUES('$name','$brand_id','$category_id','$upload_image','$price')";
                                $query=mysqli_query($connection,$sql);
                                if ($query !=false) {
                                    echo "<p style='color:green'>Product added successfully</p>";
                                }else{
                                    echo "<p style='color:red'>product did not add</p>".mysqli_error($connection);
                                }
                              }

                            
                      }

              ?>
              <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="test" class="form-control" id="name"  name="name">
              </div>

              <div class="form-group">
                <label for="brand_id">Brand</label>
                <select class="form-control" id="brand_id" name="brand_id">
                  <option value="">Select One</option>
                  <?php 
                    $sql="SELECT * FROM brand";
                    $query=mysqli_query($connection,$sql);
                    if ($query !=false) {
                        while ($value=mysqli_fetch_assoc($query)) {
                  ?>
                  <option value="<?php echo $value['brand_id'] ?>"><?php echo $value['bname'] ?></option>
                  <?php }} ?> 
                </select>
              </div>

               <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" id="category_id" name="category_id">
                  <option value="">Select one</option>
                  <?php 
                    $sql="SELECT * FROM category";
                    $query=mysqli_query($connection,$sql);
                    if ($query !=false) {
                        while ($value=mysqli_fetch_assoc($query)) {
                  ?>
                  <option value="<?php echo $value['category_id'] ?>"><?php echo $value['cname'] ?></option>
                <?php }} ?>
                </select>
              </div>
              <div class="form-group">
                 <label for="image">Image</label>
                 <input type="file" class="form-control-file" id="image" name="image">
               </div>
               <div class="form-group">
                <label for="price">Price</label>
                 <input type="number" class="form-control-file" id="price" name="price" min="1" step="1">
                </div>
              <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>