
<?php 
   session_start();
  include_once "../connection/connection.php"; 
if (isset($_SESSION['login']) and $_SESSION['login']==true) {
     header("location:index.php");
}
    
?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Login</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>

        <div class="card-body">
          <?php 

              if ($_SERVER["REQUEST_METHOD"]=="POST") {
                    $email=trim(stripcslashes(htmlspecialchars($_POST['email'])));
                    $password=trim(stripcslashes(htmlspecialchars($_POST['password'])));
                    if ($email=="" || $password=="") {
                      echo "<p style='color:red'>Filed must must not be empty</p>";
                    }else{
                      $password=md5($password);
                        $sql="SELECT * FROM admin where email='$email' and password='$password'";
                         $query=mysqli_query($connection,$sql);
                         if (mysqli_num_rows($query)==1) {
                            $value=mysqli_fetch_assoc($query);
                             $name=$value['name'];
                            $email=$value['email'];
                            $admin_id=$value['admin_id'];
                            $role=$value['role'];

                            $_SESSION['admin_id']=$admin_id;
                            $_SESSION['email']=$email;
                            $_SESSION['name']    =$name;
                            $_SESSION['role']    =$role;
                            $_SESSION['login']   =true;

                            header("location:index.php");


                         }else{
                             echo "<p style='color:red'>Information did not match</p>";
                         }
                    }
   
              }


           ?>
          <form action="" method="POST">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="email" name="email" class="form-control" >
                <label for="email">Email address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="password" name="password" class="form-control" >
                <label for="password">Password</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Remember Password
                </label>
              </div>
            </div>
            <button class="btn btn-primary" type="submit">Log In</button>
          </form>
          <div class="text-center">
            <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
