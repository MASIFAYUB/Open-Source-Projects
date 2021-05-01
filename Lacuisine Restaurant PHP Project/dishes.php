<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); // connection to db
error_reporting(0);
session_start();

include_once 'product-action.php'; //including controller

?>


<head>
    <meta charset="utf-8">
    <title>Food Items</title>
    <!-- Bootstrap core CSS -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Font Awesome -->
    <script src="js/all.js"></script>
<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mr+Dafoe&display=swap" rel="stylesheet">
<!-- Magnific popup -->
    <link href="css/main.css" rel="stylesheet"> 
    <link href="css/style.css" rel="stylesheet"> 

</head>

<body>
  <!-------------------------------------------------------------------------------------------------------------->

<!--Navigation Bar-->

<nav class="navbar navbar-expand-lg">
    <a href="index.php" class="navbar-brand text-uppercase primary-color">La Cuisine</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar">
        <div class="toggler-btn">
            <div class="bar bar1"></div>
            <div class="bar bar2"></div>
            <div class="bar bar3"></div>
        </div>
    </button> 
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="navbar-nav mx-auto head-text">
            <?php
            if(!empty($_SESSION["user_id"])) 
            {
              echo '<li><a href="your_orders.php" class="btn nav-btn text-capitalize">My_Orders</a></li>';
            }
            ?>            
        </ul>
    <form class="form-inline d-none d-lg-block mr-5">
        <ul class="navbar-nav mx-auto">
          <li><a href="restaurant.php" class="btn nav-btn text-capitalize">Food Items</a></li>
            <?php
            if(empty($_SESSION["user_id"])) 
            {
              // if user is not login
              echo '<li><a href="login.php" class="btn nav-btn text-capitalize">login/signup</a></li>';
            }
            else
            {
              //if user is login
              echo '<li"><a href="logout.php" class="btn nav-btn text-capitalize">logout</a></li>';
            }
            ?>            
        </ul>
    </form>
    </div>
</nav>

<!--End of Navigation Bar-->

<!------------------------------------------------------------------------------------------------------------->

<div class="top-links">
    <div class="container">
        <ul class="row links">
          
            <li class="col-xs-12 col-sm-5 link-item head-text"><span>1</span><a href="restaurant.php">Choose Restaurant</a></li>
            <li class="col-xs-12 col-sm-4 link-item active head-text"><span>2</span><a href="dishes.php?RS_ID=<?php echo $_GET['RS_ID']; ?>">Pick Your favorite food</a></li>
            <li class="col-xs-12 col-sm-3 link-item head-text"><span>3</span><a href="#">Order Now</a></li>
        </ul>
    </div>
</div>
<!-- end:Top links -->
<!-- start: Inner page hero -->


<?php $ress= mysqli_query($db,"select * from restaurant where RS_ID='$_GET[RS_ID]'");
						     $rows=mysqli_fetch_array($ress);
							  
							  ?>
<section class="inner-page-hero bg-image" data-image-src="images/img/dish.jpeg">
    <div class="profile">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                    <div class="image-wrap">
                        <figure><?php echo '<img src="admin/Res_img/'.$rows['image'].'" alt="Restaurant logo">'; ?></figure>
                    </div>
                </div>
				
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                    <div class="pull-left right-text white-txt">
                        <h6><a href="#"><?php echo $rows['FName']; ?></a></h6>
                        <p><?php echo $rows['address']; ?></p>
                        <ul class="nav nav-inline">
                            <li class="nav-item"> <a class="nav-link active" href="#"><i class="fa fa-check"></i> Min 500-pkr</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="#"><i class="fa fa-motorcycle"></i> 30 min</a> </li>
                            <li class="nav-item ratings">
                                <a class="nav-link" href="#"> <span>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-o"></i>
                        </span> </a>
                            </li>
                        </ul>
                    </div>
                </div>
				
				
            </div>
        </div>
    </div>
</section>

<section class="pampambole">
<div class="container m-t-30">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">            
             <div class="widget widget-cart">
                <div class="widget-heading">
                    <h3 class="widget-title text-dark">Your Shopping Cart</h3>
                        <div class="clearfix">
                        </div>
                </div>
                    <div class="order-row bg-white">
                        <div class="widget-body">		
							<?php
                                $item_total = 0;
                                    foreach ($_SESSION["cart_item"] as $item)  // fetch items define current into session ID
                                    {
                            ?>									
									
                            <div class="title-row">
							<?php echo $item["FName"]; ?><a href="dishes.php?RS_ID=<?php echo $_GET['RS_ID']; ?>&action=remove&id=<?php echo $item["D_ID"]; ?>" >
								<i class="fa fa-trash pull-right"></i></a>
							</div>
										
                            <div class="form-group row no-gutter">
                                <div class="col-xs-8">
                                    <input type="text" class="form-control b-r-0" value=<?php echo "PKR".$item["price"]; ?> readonly id="exampleSelect1">
                                </div>
                                <div class="col-xs-4">
                                    <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input"> </div>
                                        
							</div>
									  
	                           <?php
                                    $item_total += ($item["price"]*$item["quantity"]); // calculating current price into cart
                                }
?>								  
									  
									  
									  
                                    </div>
                                </div>
                               
                                <!-- end:Order row -->
                             
                                <div class="widget-body">
                                    <div class="price-wrap text-xs-center">
                                        <p>TOTAL</p>
                                        <h3 class="value"><strong><?php echo "PKR-".$item_total; ?></strong></h3>
                                        <p>Including Delivery charges</p>
                                        <a href="checkout.php?res_id=<?php echo $_GET['RS_ID'];?>&action=check"  class="btn theme-btn btn-lg">Checkout</a>
                                    </div>
                                </div>
								
						
								
								
                            </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-9">
                      
                        <!-- end:Widget menu -->
                        <div class="menu-widget" id="2">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                              POPULAR ORDERS Delicious hot food! 
                           </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="c" id="popular2">
						<?php  // display values and item of food/dishes
									$stmt = $db->prepare("select * from dishes where RS_ID='$_GET[RS_ID]'");
									$stmt->execute();
									$products = $stmt->get_result();
									if (!empty($products)) 
									{
									foreach($products as $product)
										{							 
						?>
                                <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
										<form method="post" action='dishes.php?RS_ID=<?php echo $_GET['RS_ID'];?>&action=add&id=<?php echo $product['D_ID']; ?>'>
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/dishes/'.$product['img'].'" alt="Food logo">'; ?></a>
                                            </div>
                                            <!-- end:Logo -->
                                            <div class="rest-descr">
                                                <h6><a href="#"><?php echo $product['FName']; ?></a></h6>
                                                <p> <?php echo $product['Description']; ?></p>
                                            </div>
                                            <!-- end:Description -->
                                        </div>
                                        <!-- end:col -->
                                        <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info"> 
										<span class="price pull-left" ><?php echo $product['price']; ?></span>
										  <input class="b-r-0" type="text" name="quantity"  style="margin-left:30px;" value="1" size="2" />
										  <input type="submit" class="btn theme-btn" style="margin-left:40px;" value="Add to cart" />
										</div>
										</form>
                                    </div>
                                    <!-- end:row -->
                                </div>
                                <!-- end:Food item -->
								
								<?php
									  }
									}
									
								?>
								
								
                              
                            </div>
                            <!-- end:Collapse -->
                        </div>
                        <!-- end:Widget menu -->
                       
                    </div>
</section>
<!------------------------------------------------------------------------------------------------------------->

<!--Footer social icons-->
<div class="container-fluid info p-3">
    <div class="row">
        
        <div class="col d-flex justify-content-between align-items-baseline flex-wrap">
            <div class="info-icons p-2">
                <a href="https://web.facebook.com/Lacuisine111/" class="mr-2 primary-color"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#" class="mr-2 primary-color"><i class="fab fa-instagram fa-2x"></i></a>
                <a href="#" class="mr-2 primary-color"><i class="fab fa-youtube fa-2x"></i></a>
                <a href="#" class="mr-2 primary-color"><i class="fab fa-twitter fa-2x"></i></a>
            </div>
            <h2 class="primary-color p-2 text-capitalize">&copy;Copyright 2020 | UETP</h2>
        </div>
    </div>
</div>    
<!--End of Footer Social Icons-->

<!------------------------------------------------------------------------------------------------------------->
    <link rel="stylesheet" href="magnific-popup/magnific-popup.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">

<!-- JQuery -->
    <script src="js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap js -->
    <script src="js/bootstrap.bundle.min.js"></script>
<!-- Magnific Popup -->
    <script src="magnific-popup/jquery.magnific-popup.js"></script>
<!-- Ripple Effect -->
    <script src="js/jquery.ripples-min.js"></script>
<!-- JavaScript -->
   <script src="js/script.js"></script>
   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/headroom.js"></script>
<script src="js/foodpicky.min.js"></script>
</body>

</html>
