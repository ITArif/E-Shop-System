<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Show Brand</a>
            </li>
           
          </ol>

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
                      <th>Brand Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 

                      if (isset($_GET["brand_id"]) AND $_GET['brand_id'] !=NULL) {
                        $brand_id=$_GET["brand_id"];
                        $brand_id=preg_replace('/[^a-zA-Z0-9]/','',$brand_id); 
                            
                        $sql="DELETE FROM brand WHERE brand_id='$brand_id'";
                        $query=mysqli_query($connection,$sql);
                        if ($query) {
                            echo "<p style='color:green'>Brand  has been deleted successfully</p>";
                        }else{
                            echo "<p style='color:red'>Brand name has not been deleted</p>";
                        }
      
                       }
                    ?>
                    <?php 

                     $sql="SELECT * FROM brand";
                    $query=mysqli_query($connection,$sql);
                     if ($query !=false) {
                      $i=0;
                      while ($value=mysqli_fetch_assoc($query)) {
                   ?>
                      <tr>
                      <td><?php echo ++$i; ?></td>
                      <td><?php echo $value['bname'] ?></td>
                      <td>
                        <a href="editbrand.php?brand_id=<?php echo $value['brand_id'] ?>">Edit</a> | 
                         <a href="?brand_id=<?php echo $value['brand_id'] ?>" onclick="return confirm('Do you want to delete this brand name ?')">Delete</a>
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