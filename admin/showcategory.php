<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">ShowBrand</a>
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
                      <th>Cegory Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 

                      if (isset($_GET["category_id"]) AND $_GET['category_id'] !=NULL) {
                        $category_id=$_GET["category_id"];
                        $category_id=preg_replace('/[^a-zA-Z0-9]/','',$category_id); 
                            
                        $sql="DELETE FROM category WHERE category_id='$category_id'";
                        $query=mysqli_query($connection,$sql);
                        if ($query) {
                            echo "<p style='color:green'>Category  has been deleted successfully</p>";
                        }else{
                            echo "<p style='color:red'>Category name has not been deleted</p>";
                        }
      
                       }
                    ?>
                    <?php 

                     $sql="SELECT * FROM category";
                    $query=mysqli_query($connection,$sql);
                     if ($query !=false) {
                      $i=0;
                      while ($value=mysqli_fetch_assoc($query)) {
                   ?>
                      <tr>
                      <td><?php echo ++$i; ?></td>
                      <td><?php echo $value['cname'] ?></td>
                      <td>
                        <a href="editcat.php?category_id=<?php echo $value['category_id'] ?>">Edit</a> | 
                         <a href="?category_id=<?php echo $value['category_id'] ?>" onclick="return confirm('Do you want to delete this brand name ?')">Delete</a>
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