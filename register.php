<?php include_once "include/header.php" ?>


<div class="content-area">

    <div class="registration-page">
        <div class="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <?php 
                        if ($_SERVER["REQUEST_METHOD"]=="POST") {

                            $name    =trim(stripcslashes(htmlspecialchars($_POST["name"])));
                            $email   =trim(stripcslashes(htmlspecialchars($_POST["email"])));
                            $city    =trim(stripcslashes(htmlspecialchars($_POST["city"])));
                            $zipcode =trim(stripcslashes(htmlspecialchars($_POST["zipcode"])));
                            $password=trim(stripcslashes(htmlspecialchars($_POST["password"])));
                            $address =trim(stripcslashes(htmlspecialchars($_POST["address"])));
                            $phone   =trim(stripcslashes(htmlspecialchars($_POST["phone"])));
                            if ($name=="" || $email=="" || $city=="" || $zipcode=="" || $password=="" || $address=="" || $phone=="") {
                                echo "<div class='alert alert-danger'>!!! No fields can be empty</div>";
                            }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                               echo "<div class='alert alert-danger'>!!! E-mail is not valid</div>";
                            }else{
                                $sql="SELECT * FROM user where email='$email'";
                                $query=mysqli_query($connection,$sql);
                                $row=mysqli_num_rows($query);
                                if ($row>0) {
                                     echo "<div class='alert alert-danger'>!!! E-mail already exists</div>";
                                }else{

                                   $password=md5($password);
                                   $sql="INSERT INTO user(name,email,city,zipcode,password,address,phone)VALUES('$name','$email','$city','$zipcode','$password','$address','$phone')";
                                    $query=mysqli_query($connection,$sql);
                                   if ($query !=false) {
                                    echo "<div class='alert alert-success'>!!! Account has been created successfully</div>";
                                   }else{
                                     echo "<div class='alert alert-danger'>!!! Acount did not create</div>";
                                   }
                                }
                            }

                        }



                     ?>



                    <h2 class="text-center">Create Your Account</h2>
                    <form method="post" class="cmxform" action="" id="signUpForm">

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 form-control-label">Name:</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 form-control-label">Email:</label>
                            <div class="col-sm-8">
                                <input type="text" name="email" class="form-control email" id="email">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="city" class="col-sm-2 form-control-label">City:</label>
                            <div class="col-sm-8">
                                <input type="text" name="city" class="form-control" id="city" >
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="zipcode" class="col-sm-2 form-control-label">Zip-code:</label>
                            <div class="col-sm-8">
                                <input type="text" name="zipcode" class="form-control" id="zipcode" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 form-control-label">Password:</label>
                            <div class="col-sm-8">
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-sm-2 form-control-label">Address:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="address" id="address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 form-control-label">Phone:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="phone" id="phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-offset-2 col-sm-8">
                                <input type="submit" class="btn btn-success btn-lg btn-block" id="submitForm" value="Sign Up Now" />
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!--End Row-->

        </div>
    </div> <!--End Registration page div-->

</div> <!-- End content Area class -->


<?php include_once "include/footer.php" ?>