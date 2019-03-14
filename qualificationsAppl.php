<?php
session_start();
if(isset($_SESSION['progID'])){
$progID=$_SESSION['progID'];}
$username=$_SESSION['username'];
$usertype = $_SESSION['usertype'];
if(isset($_POST['submit'])){
	include_once 'connect.php';
	$qidInput = $_POST['qidInput'];

	$sql = "SELECT QID FROM qualification WHERE QID='$qidInput'";
	$result = mysqli_query($con, $sql);
	
	if (mysqli_num_rows($result) > 0){
		$resultArray = mysqli_fetch_assoc($result);
		
		$_SESSION['QID']=$resultArray['QID'];
		header('location:qual-details.php');
	}else{
		$recordmessage = '<span style="color:#ff0000;">Invalid Qualification ID!</br></span>';
	}
}
if(isset($_POST['add'])){
	include_once 'connect.php';
	$qname = $_POST['name'];
	$overallScore = $_POST['score'];
	$sqlInput = "insert into qualification (`QID`, `name`, `minScore`, `maxScore`, `resultCalcDescription`,`noOfSubjects`, `gradeList`) VALUES
	('','$qname','','','',1,'')";
	$con -> query($sqlInput);
	$sqlGet = "select QID from qualification where name = '$qname'";
	$resultGet = mysqli_query($con, $sqlGet);
	$row = mysqli_fetch_assoc($resultGet);
	$QID = $row['QID'];
	$sqlGet2 = "select IDNumber from applicant where username = '$username'";
	$resultGet2 = mysqli_query($con, $sqlGet2);
	$row2 = mysqli_fetch_assoc($resultGet2);
	$IdNumber = $row2['IDNumber'];
	$sqlInput2 = "insert into qualificationObtained (`QID`, `IDNumber`, `overallScore`) VALUES
	('$QID','$IdNumber','$overallScore')";
	$con -> query($sqlInput2);
	echo "<script type='text/javascript'>alert('Your qualification has been saved');location.href='../index.php?login=error'</script>";
					exit();
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
			        <a href="index.html"><img src="img/logo.png" alt="" title="" /></a>
			      </div>
			      <nav id="nav-menu-container">
			        <ul class="nav-menu">
					<?php
						if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
							If ( $usertype == 'UA') {
							   $navLink = "programsListAdmin.php";
							   $navLinkText = "Programmes";
							}else  {
							   $navLink = "courses.php";
							   $navLinkText = "Programmes";
							}}
							else{
							   $navLink = "courses.php";
							   $navLinkText = "Programmes";}
							?>
			          <li><a href="index.php">Home</a></li>
			          <li><a href="about.php">About</a></li>
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
								Choose Qualification	
							</h1>	
							<p class="text-white link-nav"><a href="signUpLogin.html">Sign Up</a>  <span class="lnr lnr-arrow-right"></span>  <a href="courses.html">Choose Qualification</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start popular-courses Area --> 
			<div class="whole-wrap">
				<div class="container">
				<div class="section-top-border">
						<h3 class="mb-30">Please choose the type of qualification you have</h3>
						<div class="progress-table-wrap mb-30">
							<div class="progress-table">
								<div class="table-head">
									<div class="serial" style="font-weight:bold;">ID</div>
									<div class="country" style="font-weight:bold;">Qualification</div>
									<div class="country" style="font-weight:bold;">Maximum Score</div>
									
								</div>
								<?php
								include 'connect.php';
								$sql = "SELECT * from qualification";
								$result = mysqli_query($con, $sql);
								while($row = mysqli_fetch_assoc($result)){	
									$qid = $row['QID'];
									$name = $row['name'];
									$maxScore = $row['maxScore'];
								echo
								'<div class="table-row" style="font-weight:bold;">
									<div class="serial">'.$qid.'</div>
									<div class="country">'.$name.'</div>
									<div class="country">'.$maxScore.'</div>
								</div>';};?>								
							</div>
						</div>
					<form action="" method="post">
					<p style="font-weight:bold;">Enter ID of the qualification you would like to add: </p>
					<input type="text" class="form-control" required = "" placeholder = "Qualification ID" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Qualification ID'" name="qidInput"></br>
					<input type = "submit" name = "submit" class="button  button-full-mobile  float-right" value="Submit">
					<!--<a href="course-details.php" class="button  button-full-mobile  float-right"> Submit</a> -->
				</form>
				</div>
				</div>
				</div>
				
				<section class="popular-courses-area section-gap courses-page">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-10 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">Didn't find your qualification?</h1>
								<h3 class="mb-10">No problem can enter it below </h3>
							</div>
						</div>
					</div>	
						</section>
				
				<section class="search-course-area relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row justify-content-between align-items-center">
					<div class="col-lg-12 col-md-12 search-course-right section-gap">
							<form class="form-wrap" action="#" method="post">
								<h1 class="text-white pb-20 text-center mb-30">Add Qualification</h1>
									<div class="mt-10">
										<input type="text" required = "" name="name" placeholder="Qualification Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Qualification Name'" required class="single-input">
									</div>
									<div class="mt-10 mb-10">
										<input type="text" required = "" name="score" placeholder="Score" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Score'" required class="single-input">
									</div>
									<input type = "submit" name = "add" class="genric-btn primary" style="font-size:130%;" value="Add">
									<input type="reset" name="reset" class="genric-btn info-border" value="Reset">
								</div>
								</form>
					</div>
				</div>	
			</section>
					
			<!-- End popular-courses Area -->	

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