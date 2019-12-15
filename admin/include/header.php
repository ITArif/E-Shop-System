
<?php 
  session_start();
    include_once "../connection/connection.php";
    
    error_reporting(0);
    $login=$_SESSION['login'];
    $role=$_SESSION['role'];
    if ($login ==false and $role!='admin') {
        header("location:login.php");
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
    <?php 
        $path=$_SERVER['SCRIPT_FILENAME'];
        $title=basename($path,'.php')

     ?>
    <title><?php echo ucwords($title); ?></title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <?php 
            $sql="SELECT * FROM logo";
            $query=mysqli_query($connection,$sql);
            if ($query !=false) {
                $value=mysqli_fetch_assoc($query);
                $logo_id=$value['logo_id'];
                $logo=$value['logo'];
            }     
           ?>
    <link rel="icon" href="<?php echo $value['logo'] ?>" />
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
      

      <a class="navbar-brand mr-1" href="index.php"><img src="<?php echo $logo ?>" width="40px;" height="30px;"></a>

      

      <!-- Navbar Search -->
	   <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        
      </form>

      <?php 

        if (isset($_GET['action']) AND $_GET['action']=='logout') {
          session_destroy();
          header("location:login.php");
        }

     ?>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1" style="padding-right: 12px;">
          <a class="nav-link" href="uppdatelogo.php?logo_id=<?php echo $logo_id ?>" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-pen-alt"></i>
          <span class="">Update Logo</span> 
          </a>
        </li>
        <li class="nav-item dropdown no-arrow mx-1" style="padding-right: 12px;">
          <a class="nav-link dropdown-toggle" href="massage.php" id="messagesDropdown" role="button"  aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-envelope fa-fw"></i>
            <?php 

                $sql="SELECT * FROM contact where status =0";
                $query=mysqli_query($connection,$sql);
                if ($query !=false) {
                  $row=mysqli_num_rows($query);
                }
             ?>
          <span class="badge badge-danger" style="font-size: 12px;"> <?php echo $row ?> </span> 
          </a>
        </li>

        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo($_SESSION['name']) ?> <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
         
            <a class="dropdown-item" href="profile.php">Profile</a>
			 <a class="dropdown-item" href="password.php">Change password</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="?action=logout" >Logout</a>
          </div>
        </li>
      </ul>

    </nav>