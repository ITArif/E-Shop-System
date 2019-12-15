<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Your profile</a>
            </li>

           
          </ol>

<?php 
       $admin_id=$_SESSION['admin_id'];

 ?>
          <?php 
              if ($_SERVER["REQUEST_METHOD"]=="POST") {
                  $name=trim(stripcslashes(htmlspecialchars($_POST['name'])));
                  $email=trim(stripcslashes(htmlspecialchars($_POST['email'])));
                  if ($name=="" || $email=="") {
                    echo "<p style='color:red'>Fields must not be empty</p>";
                  }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                       echo "<p style='color:red'>Enter valid email</p>";
                  }else{
                    $sql="UPDATE admin set name='$name', email='$email' where admin_id='$admin_id'";
                    $query=mysqli_query($connection,$sql);
                    if ($query !=false) {
                         echo "<p style='color:green'>Update successfully</p>";
                    }else{
                       echo "<p style='color:red'>Not updated</p>";
                    }
                  }
              }


           ?>

            <div style="width: 700px;padding: 12px 12px;margin: 50px auto">
              <?php 
                 
                  $sql="SELECT * FROM admin where admin_id='$admin_id'";    
                  $query=mysqli_query($connection,$sql); 
                  if ($query !=false) {
                           $value=mysqli_fetch_assoc($query);
                         }       

              ?>
              <form action="" method="POST">

              <div class="form-group">
                <label for="name">Name</label>
                <input type="test" class="form-control" id="name"  name="name" value="<?php echo $value['name'] ?>">
              </div>
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="test" class="form-control" id="email"  name="email" value="<?php echo $value['email'] ?>">
              </div>

              <button type="submit" class="btn btn-primary">Update</button>
            </form>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>