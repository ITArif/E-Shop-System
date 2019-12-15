<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Update logo</a>
            </li>

        
          </ol>
          <?php 
          
            if (isset($_GET["logo_id"]) AND $_GET['logo_id'] !=NULL) {
              $logo_id=$_GET["logo_id"];
               $logo_id=preg_replace('/[^a-zA-Z0-9]/','',$logo_id);  
            }else{
                        echo "<script>window.location='index.php'</script>";
                 }

            ?>

            <?php 
          
          if ($_SERVER["REQUEST_METHOD"]=="POST") {
              
                  $logo  =$_FILES['logo']['name'];
                  $logo_tmp   =$_FILES['logo']['tmp_name'];
                  $unique_name =time().$logo;
                  $upload_image="upload/".$unique_name;
                  if ($logo=="") {
                    echo "<p style='color:red'>Logo should be picked</p>";
                  }else{
                    move_uploaded_file($logo_tmp, $upload_image);
                    $sql="UPDATE logo set logo ='$upload_image' where logo_id='$logo_id'";
                    $query=mysqli_query($connection,$sql);
                    if ($query !=false) {
                      echo "<p style='color:green'>Logo updated</p>";
                    }
                  }
            } 
         ?>





          <?php 

          $sql="SELECT * FROM logo where logo_id='$logo_id'";
          $query=mysqli_query($connection,$sql);
          if ($query !=false) {
            $value=mysqli_fetch_assoc($query);

          }
         ?>
            <div style="width: 700px;padding: 12px 12px;margin: 50px auto">
        
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                 <label for="logo">Image</label>
                 <input type="file" class="form-control-file" id="logo" name="logo">
               </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
              <div style="width: 25%;padding:2px; margin:0 auto; height:300px;">
                <img src="<?php echo $value['logo'] ?>" style="width: 100%;height:100%;">
             </div>
            </div>

        </div>

        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>