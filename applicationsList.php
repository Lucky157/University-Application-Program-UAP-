<?php
session_start();
$progIDAdmin=$_SESSION['progIDAdmin'];
if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];}
if(isset($_POST['submit'])){
	include_once 'connect.php';
	$aidInput = $_POST['aidInput'];

	$sql = "SELECT AID FROM application WHERE AID='$aidInput'";
	$result = mysqli_query($con, $sql);
	
	if (mysqli_num_rows($result) > 0){
		$resultArray = mysqli_fetch_assoc($result);
		
		$_SESSION['AID']=$resultArray['AID'];
		header('location:applicationEdit.php');
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
								Programme Applications		
							</h1>	
							<p class="text-white link-nav"><a href="adminApplications.php">Applications </a>  <span class="lnr lnr-arrow-right"></span>  <a href="applicationsList.php">Programme Applications</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start popular-courses Area --> 
			<section class="popular-course-area section-gap">
				<div class="container">
						<h3 class="mb-30">Applications</h3><?php
								include_once 'connect.php';
								$sql = "SELECT AID, applicant.IDNumber, application.programmeID, fullname, status, name, overallScore, count(overallScore) 
								FROM application, applicant, qualificationObtained, qualification
								WHERE applicant.IDNumber=application.IDNumber 
								and applicant.IDNumber = qualificationObtained.IDNumber
								and qualification.QID = qualificationObtained.QID
								and application.programmeID = '$progIDAdmin'
								and status = 'pending'
								group by AID";
								$result = mysqli_query($con, $sql);
								if (mysqli_num_rows($result) > 0){
										while ($row = mysqli_fetch_assoc($result)){
										$aid = $row['AID'];
										$fullname = $row['fullname'];
										$status = $row['status'];
										$noOfQual = $row['count(overallScore)'];
										$IDNumber = $row['IDNumber'];
										echo '
				<div class="whole-wrap">
				<div class="container">
				<div class="section-top-border">
						<h3 class="mb-30">Application Id: '.$aid.'</h3>
						<h3 class="mb-30">'.$fullname.'</h3>
						<h4 class="mb-30">Status: '.$status.'</h3>
						<div class="progress-table-wrap mb-30">
							<div class="progress-table">
								<div class="table-head">
									<div class="percentage" style="font-weight:bold; margin-left:5%;">Qualification</div>
									<div class="visit" style="font-weight:bold;">Overall Score</div>
								</div>';
									$sql2 = "select name, overallScore from qualification, qualificationObtained 
									where qualification.QID = qualificationObtained.QID 
									and IDNumber = '$IDNumber' 
									group by name, overallScore";
									$result2 = mysqli_query($con, $sql2);
									while ($row2 = mysqli_fetch_assoc($result2)){
										$qname = $row2['name'];
										$overallScore = $row2['overallScore'];
									echo
									'<div class="table-row" style="font-weight:bold;">
									<div class="percentage" style="font-weight:bold; margin-left:5%;">'.$qname.'</div>
									<div class="visit">'.$overallScore.'</div>
								</div>';}echo
								'</div>
								</div>';}echo'
								<form action="" method="post">
					<p style="font-weight:bold;">Enter ID of the application you would like to view: </p>
					<input type="text" class="form-control" required = "" placeholder = "Application ID"  name="aidInput" type="text"></br>
					<input type = "submit" name = "submit" class="button  button-full-mobile  float-right" value="Submit"> 
				</form>
								</div>
								</div>
								</div>';
								};?>
								
								

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
