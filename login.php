<?php include_once "include/header.php" ?>
<?php 
    if (isset($_SESSION['login'])) {
            
        $login=$_SESSION['login'];
        if ($login==true) {
            header("location:account.php");
        }
    }

 ?>
<div class="content-area">
    <div class="login-page">
        <div class="container">

            <?php 
                if ($_SERVER["REQUEST_METHOD"]=="POST") {
                         $email   =trim(stripcslashes(htmlspecialchars($_POST["email"])));
                       $password  =trim(stripcslashes(htmlspecialchars($_POST["password"])));
                       if ($email=="" || $password=="") {
                          echo "<div class='alert alert-danger'>!!! No fields can be empty</div>";
                       }else{
                            $password=md5($password);
                            $sql="SELECT * FROM user where email='$email' and password='$password'";
                            $query=mysqli_query($connection,$sql);
                            if ($query !=false) {
                                $row=mysqli_num_rows($query);
                                if ($row==1) {
                                    $value=mysqli_fetch_assoc($query);
                                    $email  =$value['email'];
                                    $user_id=$value['user_id'];
                                    $role   =$value['role'];

                                    $_SESSION['email']  =$email;
                                    $_SESSION['user_id']=$user_id;
                                    $_SESSION['role']   =$role;
                                    $_SESSION['login']  =true;
                                    header("location:account.php");
                                    ob_end_flush();

                                }else{
                                  echo "<div class='alert alert-danger'>!!! Information did not match</div>";
                                }

                            }else{
                                echo "NO".mysqli_error($connection);
                            }
                       }
                }
             ?>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h2 class="text-center">Sign In Your Account</h2>
                    <form method="post" class="cmxform" action="" id="loginForm">

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 form-control-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" name="email" class="form-control" id="email"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 form-control-label">Password:</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" class="form-control" id="password"/>
                            </div>
                        </div>
                        <div class="form-group row col-sm-offset-2">
                            <input type="checkbox" id="remember" name="remember" />
                            <label for="remember" style="color:#093; font-weight: normal"><span style="opacity:.5"></span>Remember Me</label><br />
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-offset-2 col-sm-8">
                                <input type="submit" class="btn btn-success btn-lg btn-block" id="submitForm" value="Sign In" />
                            </div>
                        </div>
                        <div class="forget">
                            <p class="pull-left"><a href="#">Forgot Password</a></p>
                            <p class="pull-right">Not a memeber yet.. 
                                <a href="register.php">Create a new account</a>
                            </p>
                            <div class="clearfix"></div>
                        </div>

                    </form>

                    


                </div>
            </div> <!--End Row-->

        </div>
    </div> <!--End Registration page div-->

</div> <!-- End content Area class -->


<?php include_once "include/footer.php" ?>