    <div class="main-slider">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
         <!-- <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>-->

        <!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">

            
        <?php 
            $sql="SELECT * FROM slider where status=0";
            $query=mysqli_query($connection,$sql);
            if ($query !=false) {
              while ($value=mysqli_fetch_assoc($query)) {
                if ($value['active']==1) {      
         ?>
            <div class="item active">
                <img src="<?php echo 'admin/'.$value['image'] ?>" alt="Chania" style="width: 100%; height:480px">
            </div>
          <?php }else{ ?>
             <div class="item">
                <img src="<?php echo 'admin/'.$value['image'] ?>" alt="Chania" style="width: 100%;height: 480px">
            </div>
          <?php } ?>
          <?php }} ?>
   </div>







<!-- Left and right controls -->
<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>

</a>

<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
</a>

</div>
</div> <!-- End Main slider class -->