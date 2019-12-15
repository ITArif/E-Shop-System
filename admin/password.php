<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Update password</a>
            </li>

           
          </ol>

      <?php 
        $admin_id=$_SESSION['admin_id'];
        
        if ($_SERVER["REQUEST_METHOD"]=="POST") {
              $oldpass=$_POST["oldpass"];
              $newpass=$_POST["newpass"];
              if ($oldpass=="") {
                echo "<p style='color:red'>Enter old password</p>";
              }else if($newpass==""){
                  echo "<p style='color:red'>Enter new password</p>";
              }else{
                 $oldpass=md5($oldpass);
                $sql="SELECT * FROM admin where admin_id='$admin_id' and password='$oldpass'";
                $query=mysqli_query($connection,$sql);
                if ($query !=false) {
                  $row=mysqli_num_rows($query);
                  if ($row>0) {
                    $newpass=md5($newpass);
                    $sql="UPDATE admin set password='$newpass' where admin_id='$admin_id' and password='$oldpass'";
                    $query=mysqli_query($connection,$sql);
                    if ($query !=false) {
                      echo "<p style='color:green'>Password update successfully</p>";
                    }
                  }else{
                      echo "<p style='color:red'>Old password is not correct</p>";
                  }
                }
              }
        }
         ?>

            <div style="width: 700px;padding: 12px 12px;margin: 50px auto">
              
              <form action="" method="POST">

              <div class="form-group">
                <label for="oldpass">Old password</label>
                <input type="password" class="form-control" id="oldpass"  name="oldpass">
              </div>
              <div class="form-group">
                <label for="email">New password</label>
                <input type="pasword" class="form-control" id="newpass"  name="newpass" >
              </div>

              <button type="submit" class="btn btn-primary">Update</button>
            </form>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>