<?php include_once "include/header.php" ?>


<div class="content-area">




<div class="featured-products">

    <div class="container">
       <div class="clear"></div>
        <div class="clear"></div>
        <div class="featured-items">
            <?php 
                if ($_SERVER["REQUEST_METHOD"]=="POST") {
                    $email  =trim(stripcslashes(htmlspecialchars($_POST["email"])));
                    $massage=trim(stripcslashes(htmlspecialchars($_POST["massage"])));
                    if ($email=="" || $massage=="") {
                           echo "<div class='alert alert-danger'>!!! No fields can be empty</div>";
                    }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                         echo "<div class='alert alert-danger'>!!! Email is not valid</div>";
                    }else{
                        $sql="INSERT INTO contact (email,massage)VALUES('$email','$massage')";
                        $query=mysqli_query($connection,$sql);
                        if ($query !=false) {
                             echo "<div class='alert alert-success'>!!! Your Massage has been send successfully</div>";
                        }else{
                           echo "<div class='alert alert-danger'>!!! Massaage not send something went wrong </div>";
                        }
                    }
                }
             ?>
            <div class="row">
            <div class="col-md-4">
              <h3>Contact Us</h3>
              <form action="" method="POST">
                   <div class="form-group">
                     <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group">
                     <label for="massage">Message</label>
                    <textarea class="form-control" id="massage" name="massage" rows="3"></textarea>
                 </div>
                   <button type="submit" class="btn btn-primary">Send message</button>
               </form>
               <h3>Call Details</h3>
               <hr>
               <label for="call">Call: +8801683952047</label>
               <br>
               <label for="call">Call: +8801786501022</label>
               <br>
               <label for="mail">mail: atula251@gmail.com</label>
            </div>
                <div class="col-md-8">
                  <h2>Find us</h2>
                  <div class="my-map">
                      <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3652.4069865471306!2d90.38360071445554!3d23.732862045364158!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1snilket!5e0!3m2!1sen!2sbd!4v1538048929618" width="720" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                  </div>
                  <div class="my-map">
                      <iframe width="720" height="350" src="https://www.youtube.com/embed/TcMBFSGVi1c" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
               </div>            
          </div>

        </div>
    </div>
</div> <!--End Featured products Div-->

</div> <!-- End content Area class -->


<?php include_once "include/footer.php" ?>