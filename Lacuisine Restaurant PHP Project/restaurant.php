<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
?>
<head>
    <meta charset="utf-8">
     <title>Restaurant Selection</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
<!-- Bootstrap CSS -->
    <!-- Font Awesome -->
    <script src="js/all.js"></script>
<!-- Google Fonts -->
<!-- Magnific popup -->
    <link href="css/main.css" rel="stylesheet"> 
    <link href="css/style.css" rel="stylesheet"> 
    <link rel="stylesheet" href="css/bootstrap.min.css">

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

<!-- top Links -->
<div class="top-links">
    <div class="container">
        <ul class="row links">
            <li class="col-xs-12 col-md-5 link-item active head-text"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
            <li class="col-xs-12 col-md-4 link-item head-text"><span>2</span><a href="#">Pick Your favorite food</a></li>
            <li class="col-xs-12 col-md-3 link-item head-text"><span>3</span><a href="#">Order Now</a></li>
        </ul>
    </div>
</div>
<!-- end:Top links -->
<!-- start: Inner page hero -->
<div class="inner-page-hero bg-image" data-image-src="images/img/main.jpeg">
    <div class="container"> </div>
    <!-- end:Container -->
</div>
<div class="result-show">
    <div class="container">
        <div class="row">
        </div>
    </div>
</div>


<!-- //results show -->
<section class="restaurants-page">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="bg-gray restaurant-entry">
                    <div class="row">
                        <?php $ress= mysqli_query($db,"select * from restaurant");
                            while($rows=mysqli_fetch_array($ress))
                            {
                                echo'<div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                        <div class="entry-logo">
                                        <a class="img-fluid" href="dishes.php?res_id='.$rows['RS_ID'].'" > <img src="admin/Res_img/'.$rows['image'].'" alt="Food logo"></a>
                                        </div>

                                        <div class="entry-dscr">
                                        <h5><a href="dishes.php?res_id='.$rows['RS_ID'].'" >'.$rows['title'].'</a></h5> <span>'.$rows['address'].' <a href="#">...</a></span>
                                            <ul class="list-inline">
                                                <li class="list-inline-item"><i class="fa fa-check"></i> Min 400-pkr</li>
                                                <li class="list-inline-item"><i class="fa fa-motorcycle"></i> 30 min</li>
                                            </ul>
                                        </div>
                                    </div>

                                 <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                    <div class="right-content bg-white">
                                        <div class="right-review">
                                            <div class="rating-block"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> 
                                            </div>
                                                <p> 600+ Reviews</p> <a href="dishes.php?RS_ID='.$rows['RS_ID'].'" class="btn theme-btn-dash">View Menu</a> 
                                        </div>
                                    </div>
                                </div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
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