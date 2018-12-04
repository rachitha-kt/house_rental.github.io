<?php
// Include config file
require_once 'config.php';

session_start();

// Define variables and initialize with empty values
$username = $password = "default";
$username_err = $password_err = "";


if(isset($_SESSION['username']) && isset($_GET['id']))
{
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user_details WHERE username = '".$username."'";

    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    $house_id = $_GET['id']; 

    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $id = $row['id'];


    $sql = "INSERT INTO successful VALUES ($id, $house_id)";

    if($stmt = mysqli_prepare($link, $sql)){

            if(mysqli_stmt_execute($stmt)){

              $to = 'arpit.khurana2015@vit.ac.com';
              $subject = 'House visit request';
              $message = 'Damn Nigga!'; 
              $from = 'arpit.khurana2015@gmail.com';
              
              // mail($to, $subject, $message);

            } else{
                ?>
                <!-- <script type="text/javascript"> -->
                  <!-- alert("Something went wrong. Please try again later."); -->
                <!-- </script> -->
                <?php echo "Error"; ?>
                <?php

            }

}
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>AVL Homes</title>
  <meta charset="utf-8"/>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
  <link href="assets/css/dcalendar.picker.css" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="assets/css/successful.css" media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="assets/css/header.css" media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="assets/css/footer.css" media="screen,projection"/>
  <script src="https://use.fontawesome.com/4ef4ce7ce4.js"></script>
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi"/>
    <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="assets/js/materialize.min.js"></script>
  <script src="assets/js/slick.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
  <div class="avl-header avl-container">
	<a href="index.php">
		<img src="assets/images/images.png">
		<h5>HR SYSTEM</h5>
	</a>
	<ul>
	<!-- <li><a href="accomodate.html">ACCOMODATE</a></li> -->
	  <li><?php if(isset($_SESSION['username'])) { ?>
		   		<a href="index.php">HOME</a>
		  <?php } ?>
	  </li>
      <li><?php if(isset($_SESSION['username'])) { ?>
                <a href="accomodate.php">ACCOMODATE</a>
          <?php } ?>
          <?php  if(!isset($_SESSION['username'])) { ?>
                <a class="modal-trigger" href="#login">ACCOMODATE</a>
          <?php } ?>
      </li>
	  <li><?php if(!isset($_SESSION['username'])) { ?>
		   		<a class="modal-trigger" href="#login">LOGIN</a>
		  <?php } ?>
		  <?php  if(isset($_SESSION['username'])) { ?>
		   		<a class="modal-trigger" href="profile.php">
					<?php echo strtoupper($first_name)." ".strtoupper($last_name) ?>
				</a>
		  <?php } ?>
	  </li>
	  <li><?php  if(!isset($_SESSION['username'])) { ?>
		   		<a class="modal-trigger" href="#signup">SIGN UP</a>
		  <?php } ?>
		  <?php  if(isset($_SESSION['username'])) { ?>
		   		<a href="logout.php"> LOGOUT</a>
		  <?php } ?>
	  </li>
	</ul>
  </div>
  <div class="avl-container">
    <div class="row ack">
      <div class="col s12 m3 l3 offset-l1">
          <img class="responsive-img" src="assets/images/chat.png">
      </div>
      <div class="col s12 m9 l8">
          <div class="tagline">
            <h4>Thank You <span><?php echo $first_name." ".$last_name; ?></span></h4>
            <h4>We have recieved your request.</h4>
            <h4>We will <span>contact you</span> soon.</h4>
          </div>
      </div>
    </div>
  </div>
	
  <script>
$(document).ready(function(){

$('#moveInDate').dcalendarpicker();

});
  </script>
</body>
</html>