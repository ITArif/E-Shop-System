<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Update Brand</a>
            </li>
            <?php 

           if (isset($_GET["brand_id"]) AND $_GET['brand_id'] !=NULL) {
                        $brand_id=$_GET["brand_id"];
                        $brand_id=preg_replace('/[^a-zA-Z0-9]/','',$brand_id);       
                    }else{
                        echo "<script>window.location='showbrand.php'</script>";
                    }

             ?>


           
          </ol>

            <div style="width: 700px;padding: 12px 12px;margin: 50px auto">

              <?php 

               if ($_SERVER['REQUEST_METHOD']=="POST") {
                $bname=$_POST['bname'];
                $bname=trim(stripcslashes(htmlentities($bname)));
                if ($bname=="") {
                 echo "<p style='color:red'>Brand name must not be empty</p>";
                }else{

                $sql="UPDATE brand SET bname='$bname' where brand_id='$brand_id'";
                $query=mysqli_query($connection,$sql);
                if ($query !=false) {
                  echo "<p style='color:green'>Brand name has been updated successfully</p>";
                }else{
                   echo "<p style='color:red'>Brand name has  not been updated</p>";
                }
                }
               }



              ?>


              
         <?php 
                $sql="SELECT * FROM brand where brand_id='$brand_id'";
                $query=mysqli_query($connection,$sql);
                if ($query !=false) {
                  $value=mysqli_fetch_assoc($query);
                  $bname=$value['bname'];
                }

             ?>
            
              <form action="" method="POST">
              <div class="form-group">
                <label for="bname">Brand Name</label>
                <input type="test" class="form-control" id="bname"  name="bname" value="<?php echo $bname; ?>">
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>