<!DOCTYPE html>
<html lang="en">
<?php
session_start(); //temp session
error_reporting(0); // hide undefine index
include("connection/connect.php"); // connection
if(isset($_POST['submit'] )) //if submit btn is pressed
{
    if(empty($_POST['CNIC']) ||
    empty($_POST['firstname']) ||  //fetching and find if its empty
      empty($_POST['lastname'])|| 
    empty($_POST['email']) ||  
    empty($_POST['phone'])||
    empty($_POST['password'])||
    empty($_POST['cpassword']))
    {
      $message = "All fields must be Required!";
    }
  else
  {
    //cheching username & email if already present
  $check_username= mysqli_query($db, "SELECT username FROM users where username = '".$_POST['username']."' ");
  $check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' ");
  $CNIC = mysqli_query($db, "SELECT CNIC FROM users where CNIC = '".$_POST['CNIC']."' ");
    

  
  if($_POST['password'] != $_POST['cpassword']){  //matching passwords
        $message = "Password not match";
    }
  elseif(strlen($_POST['password']) < 6)  //cal password length
  {
    $message = "Password Must be >=6";
  }
  elseif(strlen($_POST['phone']) < 10)  //cal phone length
  {
    $message = "invalid phone number!";
  }

  elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // Validate email address
  {
    $message = "Invalid email address please type a valid email!";
  }
  elseif(mysqli_num_rows($check_username) > 0)  //check username
  {
    $message = 'username Already exists!';
  }
  elseif(mysqli_num_rows($CNIC) > 0)  //check CNIC
  {
    $message = 'CNIC Already exists!';
  }
  elseif(mysqli_num_rows($check_email) > 0) //check email
  {
    $message = 'Email Already exists!';
  }
  else
  {     
     //inserting values into db
    $mql = "INSERT INTO users(CNIC,username,f_name,l_name,email,phone,password,address) VALUES('".$_POST['CNIC']."','".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."','".$_POST['address']."')";
    
    mysqli_query($db, $mql);
    
    $success = "Account Created successfully! <p>You will be redirected in <span id='counter'>5</span> second(s).</p>
                <script type='text/javascript'>
                function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML)<=0) {
                  location.href = 'login.php';
                }
                i.innerHTML = parseInt(i.innerHTML)-1;
              }
              setInterval(function(){ countdown(); },1000);
              </script>'";

      header("refresh:5;url=login.php"); // redireted once inserted success
    }
  }
}
?>



<head>
  <meta charset="UTF-8">
  <title>Registration lacuisine</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Main CSS -->
    <link rel="stylesheet" href="css/main.css">
<!-- Font Awesome -->
    <script src="js/all.js"></script>
<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Mr+Dafoe&display=swap" rel="stylesheet">
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
<!-- Magnific popup -->
    <link rel="stylesheet" href="magnific-popup/magnific-popup.css">

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
            if(empty($_SESSION["user_id"])) 
            {
              // if user is not login
              echo '<li class="nav-item"><a href="login.php" class="btn nav-btn text-capitalize active">login/signup</a></li>';
            }
            else
            {
              //if user is login
              echo '<li class="nav-item"><a href="your_orders.php" class="nav-link text-capitalize">My_Orders</a></li>';
              echo '<li class="nav-item"><a href="logout.php" class="btn nav-btn text-capitalize">logout</a></li>';
            }
            ?>            
        </ul>
    <form class="form-inline d-none d-lg-block mr-5">
        <ul class="navbar-nav mx-auto">
          <li><a href="restaurant.php" class="btn nav-btn text-capitalize">Food Items</a></li>
        </ul>
    </form>
    </div>
</nav>

<!--End of Navigation Bar-->


<!------------------------------------------------------------------------------------------------------------->


<section id="contact">    
    <div class="container-fluid">
        <div class="col-md-12 my-3 mx-auto w-50 h-75 p-5">
            <div class="card text-center">
                <div class="card-header">
                    <h1 class="text-uppercase">Registration Form</h1>
                </div>
                <div class="card-body head-text">
                    <center><span style="color:yellow;">
                    <?php 
                      echo $message; 
                    ?>  
                  </span></center> 
            
                  <center><span style="color:green;">
                    <?php
                      echo $success; 
                    ?>
                  </span></center>

                    <form action="" method="post">
<!------------Input Groups------------->
                      <div class="input-group my-3 align-self-center">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fas fa-id-card"></i>
                              </span>
                          </div>
                          <input type="text"class="form-control form-control-lg" placeholder="1210157236327" name="CNIC">
                      </div>
<!------------------------------------->
                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fas fa-user"></i>
                              </span>
                          </div>
                          <input type="text"class="form-control form-control-lg" placeholder="Username" name="username">
                      </div>
<!------------------------------------->
                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fas fa-user"></i>
                              </span>
                          </div>
                          <input type="text"class="form-control form-control-lg" placeholder="First Name" name="firstname">
                      </div>
<!------------------------------------->
                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fas fa-user"></i>
                              </span>
                          </div>
                          <input type="text"class="form-control form-control-lg" placeholder="Last Name" name="lastname">
                      </div>
<!------------------------------------->
                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fas fa-envelope"></i>
                              </span>
                          </div>
                          <input type="text"class="form-control form-control-lg" placeholder="Email" name="email">
                      </div>
<!------------------------------------->

                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fas fa-user-secret"></i>
                              </span>
                          </div>
                          <input type="password" class="form-control form-control-lg" placeholder="Password" name="password">
                      </div>
<!------------------------------------->
                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                                  <i class="fas fa-user-secret"></i>
                              </span>
                          </div>
                          <input type="password"class="form-control form-control-lg" placeholder="Confirm Password" name="cpassword">
                      </div>
<!------------------------------------->
                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="input-phone">
                                  <i class="fas fa-phone"></i>
                              </span>
                          </div>
                          <input type="text" id="phone" class="form-control form-control-lg" placeholder="+923489155239" name="phone">
                      </div>
<!------------------------------------->
                      <div class="input-group my-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text" id="input-phone">
                                  <i class="fas fa-phone"></i>
                              </span>
                          </div>
                          <input type="text" id="phone" class="form-control form-control-lg" placeholder="Example: Sector-H street-15 House #04, Islamabad" name="address">
                      </div>
<!------------------------------------->

<!-------Submit Button-------->
                       <button type="submit" class="btn btn-block btn-lg text-uppercase contact-btn" name="submit" value="login"><i class="far fa-hand-point-right mr-2"></i>Register</button>
                    </form>
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

</body>

</html>