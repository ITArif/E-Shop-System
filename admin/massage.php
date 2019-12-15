<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Show Massage</a>
            </li>
           
          </ol>
          <?php 

                if (isset($_GET["contact_id"]) AND $_GET['contact_id'] !=NULL) {
                        $contact_id=$_GET["contact_id"];
                        $contact_id=preg_replace('/[^a-zA-Z0-9]/','',$contact_id); 
                            
                        $sql="DELETE FROM contact WHERE contact_id='$contact_id'";
                        $query=mysqli_query($connection,$sql);
                        if ($query !=false) {
                            echo "<p style='color:green'>Massage deleted successfully</p>";
                        }else{
                            echo "<p style='color:red'>Not deleted</p>";
                        }
                    }

              ?>
      
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Data Table Example</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered"  id="dataTable" mwidth="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Serial</th>
                      <th>E-mail</th>
                      <th>Massage</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php 

                     $sql="SELECT * FROM contact";
                    $query=mysqli_query($connection,$sql);
                     if ($query !=false) {
                    $i=0;
                     while ($value=mysqli_fetch_assoc($query)) {
                   ?>
                      <tr>
                      <td><?php echo ++$i; ?></td>
                      <td><?php echo $value['email'] ?></td>
                      <td><a href="viewmasage.php?contact_id=<?php echo $value['contact_id'] ?>" class="btn">View Details</a></td>
                      <td>
                        <?php 
                              if ($value['status']==0) {    
                         ?>
                          <a href="replymasage.php?contact_id=<?php echo $value['contact_id'] ?>" class="btn">Reply</a> 
                         <a href="?contact_id=<?php echo $value['contact_id'] ?>" class="btn" onclick="return confirm('Do you want to delete this massage ?')">Delete</a>
                          <?php }else{ ?>
                         <span class="btn">Seen</span>
                        <a href="?contact_id=<?php echo $value['contact_id'] ?>" class="btn">Delete</a>
                       <?php } ?>
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