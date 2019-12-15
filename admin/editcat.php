<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Update Category</a>
            </li>
            <?php 

           if (isset($_GET["category_id"]) AND $_GET['category_id'] !=NULL) {
                        $category_id=$_GET["category_id"];
                        $category_id=preg_replace('/[^a-zA-Z0-9]/','',$category_id);       
                    }else{
                        echo "<script>window.location='showcategory.php'</script>";
                    }

         ?>

         

           
          </ol>

            <div style="width: 700px;padding: 12px 12px;margin: 50px auto">

              <?php 

               if ($_SERVER['REQUEST_METHOD']=="POST") {
                $cname=$_POST['cname'];
                $cname=trim(stripcslashes(htmlentities($cname)));
                if ($cname=="") {
                 echo "<p style='color:red'>Category name must not be empty</p>";
                }else{

                $sql="UPDATE category SET cname='$cname' where category_id='$category_id'";
                $query=mysqli_query($connection,$sql);
                if ($query !=false) {
                  echo "<p style='color:green'>Category name has been updated successfully</p>";
                }else{
                   echo "<p style='color:red'>category name has  not been updated</p>";
                }
                }
               }
              ?>
            
              <?php 
                $sql="SELECT * FROM category where category_id='$category_id'";
                $query=mysqli_query($connection,$sql);
                if ($query !=false) {
                  $value=mysqli_fetch_assoc($query);
                  $cname=$value['cname'];
                }

             ?>


              <form action="" method="POST">
              <div class="form-group">
                <label for="cname">Category Name</label>
                <input type="test" class="form-control" id="cname"  name="cname" value="<?php echo $cname; ?>">
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>