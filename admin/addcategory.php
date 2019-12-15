<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Add Category</a>
            </li>

           
          </ol>

            <div style="width: 700px;padding: 12px 12px;margin: 50px auto">
              <?php 
            if ($_SERVER['REQUEST_METHOD']=="POST") {
                  $cname=trim(stripcslashes(htmlspecialchars($_POST['cname'])));
    
                  if ($cname=="") {
                      echo "<p style='color:red'>Category name must not be empty</p>";
                  }else{
                    $sql="SELECT * FROM category where cname='$cname'";
                    $query=mysqli_query($connection,$sql);
                    if ($query !=false) {
                         $row=mysqli_num_rows($query);
                    if ($row>0) {
                        echo "<p style='color:red'>This category already exists</p>";
                    }else{
                      $sql="INSERT INTO category(cname)VALUES('$cname')";
                      $query=mysqli_query($connection,$sql);
                      if ($query !=false) {
                          echo "<p style='color:green'>Category inserted successfully</p>";
                      }
                    }
                    }
                   
                  }
            }


         ?>
              <form action="" method="POST">
              <div class="form-group">
                <label for="cname">Category Name</label>
                <input type="test" class="form-control" id="cname"  name="cname">
              </div>
              <button type="submit" class="btn btn-primary">Add category</button>
            </form>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>