<?php ob_start() ?>

<?php 
    include_once "connection/connection.php"; 
 ?>
 <?php  session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <?php 
      $path=$_SERVER["SCRIPT_FILENAME"];
      $title=basename($path,'.php');
   ?>
    <title><?php echo ucwords($title); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta http-equiv="Content-Language" content="en-US" />
    <meta name="description" content="Dynamic responsive Ecommerce free web template" />
    <meta name="keywords" content="Ecommerce template, Ecommerce free responsive template, free template" />
    <meta name="author" content="Atul,Jamal,Himel">

    <!-- CSS links -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />

    
    <!-- Animate.css -->
    <link type="text/css" rel="stylesheet" href="css/animate.css" />

    <!-- Owl Carousel CSS-->
    <link type="text/css" rel="stylesheet" href="css/owl.carousel.min.css" />
    <link type="text/css" rel="stylesheet" href="css/owl.theme.default.min.css" />



    <!-- Mega navigation bar -->
    <link rel="stylesheet" type="text/css" media="all" href="css/webslidemenu.css" />

    <!-- Main css link -->
    <link type="text/css" rel="stylesheet" href="css/main.css" />

    
     <?php 
        $sql="SELECT * FROM logo";
          $query=mysqli_query($connection,$sql);
          if ($query !=false) { 
            while ($value=mysqli_fetch_assoc($query)) {
                             
         ?>

    <link rel="icon" href="<?php echo "admin/".$value['logo'] ?>" />
  <?php }} ?>
 
    
</head>
<body>
    <div class="wrapper">
        <!-- Header part  -->
        <div class="header" id="top">
            <!-- Start Top Header -->
            <!-- End Top Header -->
            <!-- Start Header Main, logo, search bar,cart -->
            <div class="header-bottom">
                <div class="container">
                    <div class="header-logo pull-left">
                      <?php 
                          $sql="SELECT * FROM logo";
                            $query=mysqli_query($connection,$sql);
                            if ($query !=false) { 
                              while ($value=mysqli_fetch_assoc($query)) {
                             
                       ?>
                        <a href="index.php">
                            <img src="<?php echo 'admin/'.$value['logo'] ?>" alt="Your Shop Logo" class="img img-responsive">
                        </a>
                      <?php } }?>
                    </div>

                    <div class="header-search pull-left">
                        <form action="search.php" method="get">
                            <input type="search" name="search" placeholder="Ask me...">
                            <button type="submit" class="btn btn-default" aria-label="Left Align">
                                <i class="fa fa-search" aria-hidden="true"> </i>
                            </button>
                        </form>
                        <br>
                        <marquee><p style="color: red;font-size: 16px;font-style: italic;font-weight: bold;">15% discount for all products</p></marquee></div>    
        </div>
    </div>
    <!-- End Header Main, logo, search bar,cart -->


<?php 

    if (isset($_GET['action']) and $_GET['action']=='logout') {
        session_destroy();
        header("location:login.php");
    }


 ?>


    <div class="header-navigation">
        <div class="wsmenucontainer clearfix">
          <div class="overlapblackbg"></div>
          <div class="wsmobileheader clearfix"> <a href="#" id="wsnavtoggle" class="animated-arrow"><span></span></a> <a class="smallogo"><img src="images/logo.png" alt=""></a></div>
          <div class="headerfull"> 
            <!--Main Menu HTML Code-->
            <div class="wsmain">
              <!-- <div class="smllogo"><a href="#"><img src="images/logo.jpg" alt=""></a></div> -->
              <nav class="wsmenu clearfix">
                <ul class="mobile-sub wsmenu-list">
     <li><a href="index.php" class="navtext"><span style="line-height:40px;">Home</span></a></li>
	 <li><a href="products.php" class="navtext"><span style="line-height:40px;">Product</span></a></li>
	 <li><a href="about.php" class="navtext"><span style="line-height:40px;">About</span></a></li>
	<li><a href="contact.php" class="navtext"><span style="line-height:40px;">Contact</span></a></li>


<li class="wsshopmyaccount clearfix"><span class="wsmenu-click"><i class="wsmenu-arrow fa fa-angle-down"></i></span><a href="#" class="wtxaccountlink"><i class="fa fa-align-justify" style="height: 100px;"></i>My Account <i class="fa  fa-angle-down"></i></a>
    <ul class="wsmenu-submenu" >
      <?php 
           if (isset($_SESSION["login"]) and $_SESSION['login']==true) {           
       ?>
        <li><a href="account.php"><i class="fa fa-user"></i>View Profile</a></li>
      <li><a href="?action=logout"><i class="fa fa-sign-out"></i>Logout</a></li>
   <?php }else{?>
       <li><a href="register.php"><i class="fa fa-black-tie"></i>Sign Up</a></li>
      <li><a href="login.php"><i class="fa fa-sign-in"></i>Login</a></li>
     <?php }?>
  </ul>
</li>
</ul>
</nav>
</div>
<!--Menu HTML Code--> 

</div>
</div>

</div>  <!-- End Navigation header -->

</div>
<!-- Header part  -->