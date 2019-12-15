<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">View details Masage</a>
            </li>
            
          </ol>

            <?php 

           if (isset($_GET["contact_id"]) AND $_GET['contact_id'] !=NULL) {
                        $contact_id=$_GET["contact_id"];
                        $contact_id=preg_replace('/[^a-zA-Z0-9]/','',$contact_id);       
                    }else{
                        echo "<script>window.location='massage.php'</script>";
                    }

         ?>

              <div style="width: 50%;padding:8px;margin:0 auto;text-align:justify;">
              <h4>Read Message</h4>
              <?php 
                $sql="SELECT * FROM contact where contact_id='$contact_id'";
                  $query=mysqli_query($connection,$sql);
                  if ($query !=false) {
                    
                    while ($value=mysqli_fetch_assoc($query)) {
                 ?>
              <p><?php echo $value['massage'] ?></p>
              <?php }} ?>
              <a href="massage.php" class="btn btn-success">Done</a>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>