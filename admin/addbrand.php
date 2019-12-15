<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Add Brand</a>
            </li>

           
          </ol>

            <div style="width: 700px;padding: 12px 12px;margin: 50px auto">
              <?php 
            if ($_SERVER['REQUEST_METHOD']=="POST") {
                $bname=$_POST['bname'];
                $bname=trim(stripcslashes(htmlspecialchars($bname)));
                if ($bname=='') {
                  echo "<p style='color:red'>Brand name must not be empty</p>";
                }else{
                  $sql="SELECT * FROM brand where bname='$bname'";
                  $query=mysqli_query($connection,$sql);
                  if (mysqli_num_rows($query)==1) {
                    echo "<p style='color:red'>This brand has been already exists</p>";
                  }else{
                    $sql="INSERT INTO brand (bname) VALUES('$bname')";
                    $query=mysqli_query($connection,$sql);
                    if ($query) {
                      echo "<p style='color:green'>Brand name has been inserted successfully</p>";
                    }else{
                      echo "<p style='color:red'>Brand name has not been inserted</p>";
                    }

                  }
                }
            }


         ?>
              <form action="" method="POST">
              <div class="form-group">
                <label for="bname">Brand Name</label>
                <input type="test" class="form-control" id="bname"  name="bname">
              </div>
              <button type="submit" class="btn btn-primary">Add Brand</button>
            </form>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>