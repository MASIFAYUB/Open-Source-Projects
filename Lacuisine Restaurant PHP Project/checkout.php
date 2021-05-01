<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();

if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else
{
    foreach ($_SESSION["cart_item"] as $item)
    {
        $item_total += ($item["price"]*$item["quantity"]);
    	if($_POST['submit'])
	    {
        	$SQL="insert into users_orders(CNIC,FName,quantity,price) values('".$_SESSION["user_id"]."','".$item["FName"]."','".$item["quantity"]."','".$item["price"]."')";
		mysqli_query($db,$SQL);
		
        $success = "Thankyou! Your Order Placed successfully!";
	}
}
?>


<head>
    <meta charset="utf-8">
     <title>Checkout Restaurant</title>
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
            <li class="col-xs-12 col-sm-4 link-item head-text"><span>2</span><a href="#">Pick Your favorite food</a></li>
            <li class="col-xs-12 col-sm-3 link-item active head-text" ><span>3</span><a href="checkout.php">Order Now</a></li>
        </ul>
    </div>
</div>

<section class="pampambol">
<div class="container">
   <span style="color:green;">
	   <?php echo $success; ?>
	</span>
</div>
            
            <div class="container m-t-30">
			<form action="" method="post">
                <div class="widget clearfix">
                    
                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Cart Summary</h4> </div>
                                        <div class="cart-totals-fields">										
                                            <table class="table">
    											<tbody>
                                                    <tr>
                                                        <td>Cart Subtotal</td>
                                                        <td> <?php echo $item_total; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        <td class="text-color"><strong> <?php echo $item_total ." PKR"; ?></strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--cart summary-->
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-20">
                                                 <span class="custom-control-description">Cash on delivery</span>
                                                </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> <input type="submit" onclick="return confirm('Are you sure?');" name="submit"  class="btn btn-outline-success btn-block" value="Order now"> </p>
                                    </div>
									</form>
                                </div>
                            </div>
                    </div>
                </div>
				</form>
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

<?php
}
?>