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
          
            if (isset($_GET["slider_id"]) AND $_GET['slider_id'] !=NULL) {
              $slider_id=$_GET["slider_id"];
               $slider_id=preg_replace('/[^a-zA-Z0-9]/','',$slider_id);  
            }else{
                        echo "<script>window.location='index.php'</script>";
                 }

            ?>

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
                    $sql="UPDATE slider set image ='$upload_image' where slider_id='$slider_id'";
                    $query=mysqli_query($connection,$sql);
                    if ($query !=false) {
                      echo "<p style='color:green'>Slider image updated</p>";
                    }
                  }
            } 
         ?>

            <div style="width: 700px;padding: 12px 12px;margin: 50px auto">
              <?php 

            $sql="SELECT * FROM slider where slider_id='$slider_id'";
            $query=mysqli_query($connection,$sql);
            if ($query !=false) {
              $value=mysqli_fetch_assoc($query);

            }
         ?>
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                 <label for="simage">Image</label>
                 <input type="file" class="form-control-file" id="simage" name="simage">
               </div>
              <button type="submit" class="btn btn-primary">Add slider</button>
            </form>
            </div>

          <div style="width: 90%;padding:2px; margin:0 auto; height:300px;">
          <img src="<?php echo $value['image'] ?>" style="width: 100%;height:100%;">
         </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>