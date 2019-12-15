<?php include_once "include/header.php" ?>


<div class="content-area prodcuts">

    <div class="row">
        <div class="container">
            <div class="col-sm-2 col-md-2 col-lg-2">
                <div class="sidebar-products-main">


                    <ul class="productcat">
                         <?php 
                            $sql="SELECT * FROM category";
                            $query=mysqli_query($connection,$sql);
                            if ($query !=false) {
                               while ($value=mysqli_fetch_assoc($query)) {
                                ?>
                        <li><a href="productbycat.php?category_id=<?php echo $value['category_id'] ?>"><?php echo $value['cname'] ?></a></li>
                    <?php }} ?>
                    </ul>

                </div>

            </div>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <div class="all-products">
                    <div class="">
                        <h2 class="title-div wow slideInRight" data-wow-duration="1s" data-wow-delay="0s" data-wow-offset="10">Our All Products available</h2>
                        <div class="products">
                            <div class="row">
                            <?php 
                                $sql="SELECT * FROM product";
                                $query=mysqli_query($connection,$sql);
                                if ($query !=false) {
                                   while ($value=mysqli_fetch_assoc($query)) {
                             ?>      
                                <div class="col-md-3">
                                    <div class="product-item">
                                        <div class="product-borde-inner">
                                            <a href="preview.php?product_id=<?php echo $value['product_id'] ?>">
                                                <img src="<?php echo 'admin/'.$value['image'] ?>" class="img img-responsive" style='height: 160px;'/>
                                            </a> 

                                            <div class="product-price">
                                                <a href="preview.php?product_id=<?php echo $value['product_id'] ?>"><?php echo $value['name'] ?></a><br />
                                                <span class="current-price">
                                                   <?php echo $value['price']." TK" ?>
                                                </span>
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div> 
                                </div>
                            <?php }} ?>

                                <div class="clear"></div>
                            </div> <!-- End Latest products row-->
                           
                            <div class="clear"></div>
                        </div> <!-- End products div-->
                    </div> <!-- End container latest products-->
                </div>  <!-- End Latest products -->
            </div>
        </div>

    </div>






 

</div> <!-- End content Area class -->

<?php include_once "include/footer.php" ?>