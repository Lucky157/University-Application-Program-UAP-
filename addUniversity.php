<?php
session_start();
if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];}
if(isset($_POST['submit'])){
	include_once 'connect.php';
	$uname = $_POST['uname'];
	$image = $_POST['imageSrc'];
	
	$sqlInsert = "insert into university (universityID, universityName, imageSrc) 
	VALUES ('', '$uname', '$image')";
	$con -> query($sqlInsert);
	echo "<script type='text/javascript'>alert('University added sucessfully');location.href='../addUniversity.php'</script>";
					exit();
}
if(isset($_POST['addAdmin'])){
	include_once 'connect.php';
	$uid = $_POST['uid'];

	$sql = "SELECT universityID FROM university WHERE universityID='$uid'";
	$result = mysqli_query($con, $sql);
	
	if (mysqli_num_rows($result) > 0){
		$resultArray = mysqli_fetch_assoc($result);
		
		$_SESSION['uniAdmin']=$resultArray['universityID'];
		header('location:addUniAdmin.php');
	}else{
		$recordmessage = '<span style="color:#ff0000;">Invalid Application ID!</br></span>';
	}
}
?>	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Education</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/Programmes.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">							
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">			
			<link rel="stylesheet" href="css/jquery-ui.css">			
			<link rel="stylesheet" href="css/main.css">
		</head>
		<body>	
		  <header id="header" id="home">
	  		<div class="header-top">
	  			<div class="container">
			  		<div class="row">
			  			<div class="col-lg-6 col-sm-6 col-8 header-top-left no-padding">			
			  			</div>
			  			<div class="col-lg-6 col-sm-6 col-4 header-top-right no-padding">
<nav id="nav-menu-container">
			        <ul class="nav-menu">
					<?php
                        If ( isset($_SESSION["username"]) ) {
						   $logLink1 = "";
                           $logLink2 = "logout.php";
						   $logLinkText1 = "Welcome ".$username;
                           $logLinkText2 = "Logout";
                        }
                        else {
						   $logLink1 = "signUpLogin.php";
                           $logLink2 = "signUpLogin.php";
                           $logLinkText1 = "Login";
						   $logLinkText2 = "SignUp";
                        }
						?>
			  				 <span class="text"><li><a href=<?php echo $logLink1; ?>><?php echo $logLinkText1;?></a></li>
			          </span>
			  				 <span class="text"><li><a href=<?php echo $logLink2; ?>><?php echo $logLinkText2;?></a></li></span>			
			  			</ul>
						</nav>
						</div>
			  		</div>			  					
	  			</div>
			</div>
		    <div class="container main-menu">
		    	<div class="row align-items-center justify-content-between d-flex">
			      <div id="logo">
			      </div>
			      <nav id="nav-menu-container">
			        <ul class="nav-menu">
					<?php
						if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
							If ( $usertype == 'UA') {
							   $navLink = "programsListAdmin.php";
							   $navLinkText = "Programmes";
							   $navLink1 = "about.php";
							   $navLinkText1 = "About";
							}else if ($usertype = 'SA') {
							   $navLink = "courses.php";
							   $navLinkText = "Programmes";
							   $navLink1 = "addUniversity.php";
							   $navLinkText1 = "Universities";
							}
							else{
							   $navLink = "courses.php";
							   $navLinkText = "Programmes";
							   $navLink1 = "about.php";
							   $navLinkText1 = "About";}}
						else{
							   $navLink = "courses.php";
							   $navLinkText = "Programmes";
							   $navLink1 = "about.php";
							   $navLinkText1 = "About";}
							?>
			          <li><a href="index.php">Home</a></li>
			          <li><a href=<?php echo $navLink1;?>><?php echo $navLinkText1;?></a></li>
			          <li><a href=<?php echo $navLink;?>><?php echo $navLinkText;?></a></li>
			        </ul>
			      </nav><!-- #nav-menu-container -->		    		
		    	</div>
		    </div>
		  </header><!-- #header -->
			  
			<!-- start banner Area -->
			<section class="banner-area relative about-banner" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Universities	
							</h1>	
							<p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="addUniversity.php">Universities</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start popular-courses Area --> 
			<section class="popular-courses-area section-gap courses-page">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-10 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">List of universities</h1>
							</div>
						</div>
					</div><?php
								include_once 'connect.php';
								$sql = "SELECT universityName, university.universityID, imageSrc
								FROM university";
								$result = mysqli_query($con, $sql);
								if (mysqli_num_rows($result) > 0){
										while ($row = mysqli_fetch_assoc($result)){
										$uname = $row['universityName'];
										$image = $row['imageSrc'];
										$uid = $row['universityID'];
										echo 	
													
    '<div id="product-146279" class="card  listing">
    <div class="grid  grid-slim">
      <div class="cell  one-fifth  palm-one-half">
        <div class="listing-thumbnail-container  hide-palm">
          <a class="thumbnail listing-thumbnail" href="/p/146279/AwardSpring/">
              <img alt="BIT" height = "100px" width = "150px" src="'.$image.'">
</a>        </div>
      </div>
      <div class="cell  four-fifths  palm-one-whole">
        <div class="grid">
          <div class="cell  nine-twelfths  palm-one-whole">
            <h2 class="listing-name">
    <a > '.$uname.'</a>
</h2>';
$sqlAdmin = "SELECT universityID, fullname
			FROM uniAdmin
			where universityID = '$uid'";
$resultAdmin = mysqli_query($con, $sqlAdmin);
		if (mysqli_num_rows($resultAdmin) > 0){
			while ($rowAdmin = mysqli_fetch_assoc($resultAdmin)){
					$adminName = $rowAdmin['fullname'];
					echo
'<h3 class="epsilon  listing-vendor"> University Admin:'.$adminName.'</h3>';}}
echo'
<h4 class="epsilon  listing-vendor"> University ID:'.$uid.'</h4>

          </div>
          <div class="cell  one-whole">
          </div>
        </div>
      </div>
    </div>
  </div>';}} ?>
  <form action="" method="post">
					<p style="font-weight:bold;">Enter ID of the university if you want to add University Admin: </p>
					<input type="text" class="form-control" required = "" placeholder = "University ID" name="uid" type="text"></br>
					<input type = "submit" name = "addAdmin" class="button  button-full-mobile  float-right" value="Submit"> 
				</form>
				</div>
							
			</section>
  
  <section class="search-course-area relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row justify-content-between align-items-center">
					<div class="col-lg-12 col-md-12 search-course-right section-gap">
							<form class="form-wrap" method = "post">
								<h1 class="text-white pb-20 text-center mb-30">Add University</h1>
									<div class="mt-10">
										<input type="text" name="uname" placeholder="University Name"  required class="single-input">
									</div>
									<div class="mt-10">
										<input type="text" name="imageSrc" placeholder="Enter link of the university image"  required class="single-input">
									</div>
									<div class = "mt-10">
									<input type="submit" name="submit" class="genric-btn primary" value="Add"> 
									<input type="reset" name="reset" class="genric-btn info-border" value="Reset">
									</div>
								</div>
								</form>
					</div>
				</div>	
			</section>
			<!-- End popular-courses Area -->			
		
						<!-- Start search-course Area -->
			
			<!-- End search-course Area -->			

			<!-- Start upcoming-event Area -->
			<!-- End upcoming-event Area -->				

			<!-- Start cta-two Area -->
			<section class="popular-courses-area section-gap courses-page">
			</section>
			<!-- End cta-two Area -->						    			

			<!-- start footer Area -->		
			<footer class="footer-area section-gap">
				<div class="container">
					<div class="footer-bottom row align-items-center justify-content-between">
						<p class="footer-text m-0 col-lg-6 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
					</div>						
				</div>
			</footer>
			<!-- End footer Area -->	


			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>	
    		<script src="js/jquery.tabs.min.js"></script>						
			<script src="js/jquery.nice-select.min.js"></script>	
			<script src="js/owl.carousel.min.js"></script>									
			<script src="js/mail-script.js"></script>	
			<script src="js/main.js"></script>	
		</body>
	</html>