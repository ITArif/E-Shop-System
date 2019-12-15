<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
           
          </ol>
            <?php 

                  $email=$_SESSION['name'];
                  echo $email;


             ?>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>