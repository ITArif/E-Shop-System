<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Add slider</a>
            </li>

        
          </ol>
              <?php 
          
                if ($_SERVER["REQUEST_METHOD"]=="POST") {
              
                  $simage_name  =$_FILES['simage']['name'];
                  $simage_tmp   =$_FILES['simage']['tmp_name'];
                  $unique_name =time().$simage_name;
                  $upload_image="upload/".$unique_name;
                  if ($simage_name=="") {
                    echo "<p style='color:red'>Slider image should be picked</p>";
                  }else{
                    move_uploaded_file($simage_tmp, $upload_image);
                    $sql="INSERT INTO slider (image)VALUES('$upload_image')";
                    $query=mysqli_query($connection,$sql);
                    if ($query !=false) {
                      echo "<p style='color:green'>Slider image inserted</p>";
                    }
                  }
            } 

         ?>
            <div style="width: 700px;padding: 12px 12px;margin: 50px auto">
        
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                 <label for="simage">Image</label>
                 <input type="file" class="form-control-file" id="simage" name="simage">
               </div>
              <button type="submit" class="btn btn-primary">Add slider</button>
            </form>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>