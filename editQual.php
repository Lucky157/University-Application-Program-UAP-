<?php
session_start();
$qualID=$_SESSION['qualID'];
if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
					}

if(isset($_POST['editQual'])){
	include_once 'connect.php';
	$nameAdd = $_POST['name'];
	$minScoreAdd = $_POST['minScore'];
	$maxScoreAdd = $_POST['maxScore'];
	$gradeList = $_POST['gradeList'];
	$resultCalcDescription = $_POST['resultCalcDescription'];
	$noOfSubjects = $_POST['noOfSubjects'];
	
	$sqlgetvalues = "SELECT * FROM qualification WHERE QID = '$qualID'";
	$runquery = mysqli_query($con, $sqlgetvalues);
	while ($rowGet = mysqli_fetch_assoc($runquery))
	{
									//Getting records from database woopee do
										if ($nameAdd == ''){
											$nameAdd = $rowGet["name"];
										}
										
										if ($minScoreAdd == ''){
											$minScoreAdd = $rowGet["minScore"];
										}
										
										if ($maxScoreAdd == ''){
											$maxScoreAdd = $rowGet["maxScore"];
										}
										if ($gradeList == ''){
											$gradeList = $rowGet["gradeList"];
										}
										if ($resultCalcDescription == ''){
											$resultCalcDescription = $rowGet["resultCalcDescription"];
										}
										if ($noOfSubjects == ''){
											$noOfSubjects = $rowGet["noOfSubjects"];
											}
											}
	$sqlupdate = "UPDATE qualification SET name='$nameAdd', minScore='$minScoreAdd', maxScore='$maxScoreAdd', gradeList = '$gradeList', 
	resultCalcDescription = '$resultCalcDescription', noOfSubjects = '$noOfSubjects' where QID = '$qualID'";								
	$con->query($sqlupdate);
	echo "<script type='text/javascript'>alert('Changed sucessfully');location.href='../editQual.php?login=error'</script>";
					exit();
	}?>
	<html lang="zxx" class="no-js">
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
								Edit Qualification		
							</h1>	
							<p class="text-white link-nav"><a href="qualifications.php">Qualifications </a>  <span class="lnr lnr-arrow-right"></span>  <a href="editQual.php">Edit Qualification</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start Sample Area -->
			<!-- End Sample Area -->
			<!-- Start Button -->
			
			<!-- End Button -->
			<!-- Start Align Area -->
			<div class="whole-wrap">
				<div class="container">
					<div class="section-top-border">
						<div class="row">
							<div class="col-lg-7 col-md-7">
							<h3 class="mb-30">Fill the areas you would like to change</h3>
								<form method="post">
									<div class="mt-10">
										<input type="text" class="form-control" name="name" placeholder="Qualification Name (Skip if no changes)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Qualification Name'">
									</div>
									<div class="mt-10">
										<input type="text" class="form-control"  name="minScore" placeholder="Minimum Score (Skip if no changes)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Minimum Score'" >
									</div>
									<div class="mt-10">
										<input type="text" class="form-control"  name="maxScore" placeholder="Maximum Score (Skip if no changes)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Maximum Score'" >
									</div>
									<div class="mt-10">
										<input type="text" class="form-control"  name="gradeList" placeholder="Grade List (Skip if no changes)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Grade List'" >
									</div>
									<div class="mt-10">
										<input type="text" class="form-control" name = "resultCalcDescription" placeholder="Mode of Calculation (Skip if no changes)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'" >
									</div>
									<div class="mt-10">
										<input type="text" name="noOfSubjects" class="form-control"  placeholder="Number of Subjects (Skip if no changes)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Grade List'" >
									</div>
									<div class = "mt-10">
									<input type="submit" name="editQual" class="genric-btn primary" value="Save"> 
									<input type="reset" name="reset" class="genric-btn info-border" value="Cancel">
									</div>
									</form>
									</div>
							<div class="col-lg-5 right-contents">
							<h3 class="mb-30"style = "color:#f9f9ff;">Hey yo </h3><?php
							include_once 'connect.php';
						$sql = "SELECT QID, name, minScore, maxScore, gradeList, resultCalcDescription, noOfSubjects
						FROM qualification
						where QID='$qualID'";
						//$sql = "select * from programme where programmeID='$progID'";
						$result=mysqli_query($con,$sql);
						if (mysqli_num_rows($result)>0){
							$resultArray=mysqli_fetch_assoc($result);
							$name = $resultArray['name'];
							$minScore = $resultArray['minScore'];
							$maxScore = $resultArray['maxScore'];
							$gradeList = $resultArray['gradeList'];
							$desc = $resultArray['resultCalcDescription'];
							$noOfSubjects = $resultArray['noOfSubjects']; echo'
							<ul>
								<li>
									<a class="justify-content-between d-flex" style="color:black;">
										<p>Qualification Name</p> 
										<span style = "color:#FC6600;">'.$name.'</span>
									
								</li>
								<li>
									<a class="justify-content-between d-flex" style="color:black;">
										<p>Minimum Score </p>
										<span style = "color:#FC6600;">'.$minScore.'</span>
									</a>
								</li>
								<li>
									<a class="justify-content-between d-flex" style="color:black;">
										<p>Maximum Score </p>
										<span style = "color:#FC6600;">'.$maxScore.'</span>
									</a>
								</li>
								<li>
									<a class="justify-content-between d-flex" style="color:black;">
										<p>Grade List </p>
										<span style = "color:#FC6600;">'.$gradeList.'</span>
									</a>
								</li>
								<li>
									<a class="justify-content-between d-flex" style="color:black;">
										<p>Description </p>
										<span style = "color:#FC6600;">'.$desc.'</span>
									</a>
								</li>
								<li>
									<a class="justify-content-between d-flex" style="color:black;">
										<p>Number of Subjects</p>
										<span style = "color:#FC6600;">'.$noOfSubjects.'</span>
									</a>
								</li>
							</ul>';};?>
							<!--button  button-full-mobile  float-right-->
							<!--primary-btn text-uppercase-->
						</div>	
							
					</div>
				</div>
			</div>
			<!-- End Align Area -->

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