<?php include_once "include/header.php" ?>

    <div id="wrapper">
     <?php include_once "include/sidebar.php" ?>
  
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Reply Massage</a>
            </li>
            <?php 

           if (isset($_GET["contact_id"]) AND $_GET['contact_id'] !=NULL) {
                        $contact_id=$_GET["contact_id"];
                        $contact_id=preg_replace('/[^a-zA-Z0-9]/','',$contact_id);       
                    }else{
                        echo "<script>window.location='massage.php'</script>";
                    }
             ?>
          </ol>
            <?php 

              if ($_SERVER["REQUEST_METHOD"]=="POST") {
                $tomail  =trim(stripcslashes(htmlspecialchars($_POST['tomail'])));
                $fromeamil=trim(stripcslashes(htmlspecialchars($_POST['fromeamil'])));
                $massage =trim(stripcslashes(htmlspecialchars($_POST['massage'])));
                $subject =trim(stripcslashes(htmlspecialchars($_POST['subject'])));

                if ($tomail=="" || $fromeamil=="" || $subject=="" || $massage=="") {
                  echo "<p style='color:red'>Fields must not be empty</p>";
                }else if(!filter_var($fromeamil,FILTER_VALIDATE_EMAIL)){
                  echo "<p style='color:red'>Enter your valid email</p>";
                }else{
                    $sendmail=mail($tomail, $subject, $massage, $fromeamil);
                    $sql="UPDATE contact set status=1 where contact_id='$contact_id'";
                    $query=mysqli_query($connection,$sql);    
                    if ($sendmail !=false) {
                      echo "<p style='color:red'>Email send successfully</p>";
                    }else{
                      echo "<p style='color:green'>Email send successfully</p>";
                    }
                }
              }
            ?>
          <?php 
          $sql="SELECT * FROM contact where contact_id='$contact_id'";
                $query=mysqli_query($connection,$sql);
              if ($query !=false) {
                  $value=mysqli_fetch_assoc($query);
                  $email=$value['email'];
                  $contact_id=$value['contact_id'];
              }
        
           ?>

            <div style="width: 700px;padding: 12px 12px;margin: 50px auto">

              <form action="" method="POST">
              <div class="form-group">
                <label for="tomail">To email</label>
                <input type="test" class="form-control"  readonly="" value="<?php echo $email ?>" name="tomail">
              </div>
              <div class="form-group">
                <label for="fromeamil">From email</label>
                <input type="test" class="form-control" name="fromeamil">
              </div>
              <div class="form-group">
                <label for="subject">Subject</label>
                <input type="test" class="form-control" name="subject">
              </div>
              <div class="form-group">
               <label for="massage">Msaage</label>
               <textarea class="form-control" id="massage" rows="3" name="massage"></textarea>
              </div>
              
              <button type="submit" class="btn btn-primary">Reply</button>
            </form>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        
          <?php include_once "include/footer.php" ?>