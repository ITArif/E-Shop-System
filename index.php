<?php include_once "include/header.php" ?>


<div class="content-area">
<?php include_once "include/slider.php" ?>



<div class="featured-products">
    <div class="container">
        <h2 class="title-div wow slideInLeft pull-left" data-wow-duration="1s" data-wow-delay="0s" data-wow-offset="10">Our Top Featured products</h2><div class="clear"></div>
        <div class="featured-navigation pull-right">
            <span class="">
                <a class="owl-prev owl-navigaiton"><i class="fa fa-angle-double-right"></i></a>
            </span>
            <span class="stop">
                <a class="owl-next owl-navigaiton">||</a>
            </span>
            <span class="">
                <a class="owl-next owl-navigaiton"><i class="fa fa-angle-double-left"></i></a>
            </span>
            
        </div>
        <div class="clear"></div>

        <div class="featured-items">
            <!-- Set up your HTML -->
            <div class="owl-carousel">
                     <?php 
                            $sql="SELECT * FROM product where pstatus>=4";
                            $query=mysqli_query($connection,$sql);
                            if ($query !=false) {
                               while ($value=mysqli_fetch_assoc($query)) {
                                   # code..
                     ?>

                <div class="item featured1">
                    <div class="item-full animated featured1-inner  width0">
                        <p><?php echo $value['name'] ?></p>
                        <h5><?php echo $value['price'] ?></h5>
                        <a href="preview.php?product_id=<?php echo $value['product_id'] ?>" class="btn btn-cart">
                           Details View
                        </a>
                    </div>
                    <a href="products.php">
                        <img src="<?php echo 'admin/'.$value['image'] ?>" class="img img-responsive" alt="Product1" style="height: 200px;"/>
                    </a>
                </div> <!-- Single Featured Item --> 
                    <?php }}else{ echo "No Products available"; } ?>
            </div>
        </div>
    </div>
</div> <!--End Featured products Div-->


<div class="latest-products">
    <div class="container">
        <h2 class="title-div wow slideInLeft" data-wow-duration="1s" data-wow-delay="0s" data-wow-offset="10">Our  Products available</h2>
        <div class="products">
            <div class="row">
                <!--====Pagination====-->
                    <?php 
                        $per_page=12;
                        if (isset($_GET['page'])) {
                            $page=$_GET['page'];

                        }else{
                            $page=1;
                        }
                        $start_form=($page-1)*$per_page;

             ?>

                 <!--====Pagination====-->

                    <?php 
                            $sql="SELECT * FROM product LIMIT $start_form,$per_page";
                            $query=mysqli_query($connection,$sql);
                            if ($query !=false) {
                               while ($value=mysqli_fetch_assoc($query)) { 
                     ?>
                <div class="col-md-3">
                    <div class="product-item">
                        <div class="product-borde-inner">
                            <a href="preview.php?product_id=<?php echo $value['product_id'] ?>">
                                <img src="<?php echo 'admin/'.$value['image'] ?>" class="img img-responsive" style="height: 160px"/>
                            </a>
                            <div class="product-price">
                                <a href="preview.php?product_id=<?php echo $value['product_id'] ?>"><?php echo $value['name'] ?></a><br />
                                <span class="current-price"><?php echo $value['price']." TK" ?></span>
                            </div>
                            <a href="preview.php?product_id=<?php echo $value['product_id'] ?>"  class="btn btn-cart text-center add-to-cart pull-right">
                               <i class="far fa-eye"></i>
                               Details View
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div> 
                  </div>

                    <?php }}else{ echo "No products availables"; } ?>



                <div class="clearfix"></div>
                 <!--====Pagination====-->

                    <?php 

                            $sql="SELECT * FROM product";
                            $query=mysqli_query($connection,$sql);
                            $total_row=mysqli_num_rows($query);
                            $total_page=ceil($total_row/$per_page);

                            if ($total_row>0) {
                                
                            echo "<span class='pagination'> <a href='index.php?page=1'>".'First page'."</a>"; 
                               for ($i=1; $i <=$total_page ; $i++) { 
                                    echo "<a href='index.php?page=".$i."'>".$i."</a>";
                               }
                            echo "<a href='index.php?page=$total_page'>".'Last page'."</a></span>" ;

                            }else{
                                echo "<p style='color'><No product is available/p>";
                            }



                     ?>



                  <!--====Pagination====-->


            </div> <!-- End Latest products row-->
            <div class="clear"></div>
        </div> <!-- End products div-->
    </div> <!-- End container latest products-->
</div>  <!-- End Latest products -->
</div> <!-- End content Area class -->


<?php include_once "include/footer.php" ?>