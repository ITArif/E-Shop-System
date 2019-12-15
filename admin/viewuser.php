<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">View user details</a>
            </li>
            <?php 

           if (isset($_GET["user_id"]) AND $_GET['user_id'] !=NULL) {
                        $user_id=$_GET["user_id"];
                        $user_id=preg_replace('/[^a-zA-Z0-9]/','',$user_id);       
                    }else{
                        echo "<script>window.location='showorder.php'</script>";
                    }

             ?>
          </ol>

            <div style="width: 700px;padding: 12px 12px;margin: 50px auto">

            <?php 
                $sql="SELECT * FROM user where user_id='$user_id'";
                $query=mysqli_query($connection,$sql);
                if ($query !=false) {
                  $value=mysqli_fetch_assoc($query);
                
                }

             ?>
              <form action="" method="POST">
              <div class="form-group">
                <label for="name">Customer Name</label>
                <input type="test" class="form-control"  readonly="" value="<?php echo $value['name'] ?>">
              </div>
              <div class="form-group">
                <label for="city"> City</label>
                <input type="test" class="form-control" readonly="" value="<?php echo $value['city'] ?>">
              </div>
              <div class="form-group">
                <label for="zipcode">Zipcode</label>
                <input type="test" class="form-control" readonly="" value="<?php echo $value['zipcode'] ?>">
              </div>
              <div class="form-group">
                <label for="E-mail"></label>
                <input type="test" class="form-control" readonly="" value="<?php echo $value['email'] ?>">
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input type="test" class="form-control"  readonly="" value="<?php echo $value['address'] ?>">
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="test" class="form-control" readonly="" value="<?php echo $value['phone'] ?>">
              </div>
              <a href="showorder.php" class="btn btn-primary">Ok</a>
            </form>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>