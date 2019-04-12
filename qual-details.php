<?php
session_start();
if(isset($_SESSION['progID'])){
$progID=$_SESSION['progID'];}
if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
$QID=$_SESSION['QID'];

}

if(isset($_POST['submit'])){
								include_once 'connect.php';
								$sname = $_POST['subjectName'];
								$grade = $_POST['grade'];
								$score = $_POST['score'];
								$getSql = "select IDNumber from applicant where username = '$username'";
								$resultGet = mysqli_query($con, $getSql);
								$rowGet = mysqli_fetch_assoc($resultGet);
							$idNo = $rowGet['IDNumber'];
								$insertSql = "insert into result (QID, IDNumber, subjectName, grade, score) VALUES 
								('$QID','$idNo','$sname','$grade','$score')";
								$con -> query($insertSql);
								}	
?>
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
								Add Subjects		
							</h1>	
							<p class="text-white link-nav"><a href="qualificationAppl.php">Choose Qualification </a>  <span class="lnr lnr-arrow-right"></span>  <a href="qual-details.php">Add Subjects</a></p>
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
							<div class="col-lg-8 col-md-8">
							<?php
							include_once 'connect.php'; 
							$sql = "select name, gradeList, noOfSubjects from qualification where QID = '$QID'";
							$result = mysqli_query($con, $sql);
							
							if (mysqli_num_rows($result) > 0) {
								$row = mysqli_fetch_assoc($result);
								$qname = $row['name'];
								$num = $row['noOfSubjects'];
							$grade = $row['gradeList'];
							$sqlCheck = "select subjectName, score from result, applicant where applicant.IDNumber = result.IDNumber and qid = '$QID' and username = '$username'";
							$resultCheck =  mysqli_query($con, $sqlCheck);
						if (mysqli_num_rows($resultCheck) == $num){
							$scores = array();
							while($rowCheck = mysqli_fetch_assoc($resultCheck)){
								$scoreArray = $rowCheck['score'];
								$int = (int)$scoreArray;
								array_push($scores, $int);
							}
							$average = array_sum($scores) / count($scores);
							$qualObtained = $average;
							$sqlQual = "insert into qualificationObtained (QID, IDNumber, overallScore) values ('$QID','$idNo','$qualObtained')";
							$con -> query($sqlQual);
							echo "<script type='text/javascript'>
							alert('Your result had been saved');location.href='../index.php?login=error'</script>";
							exit();	
						} else{?>
							
							
							<h3 class="mb-30">Your qualification is <?php echo $qname;?></h3>
								<h3 class="mb-30">Please enter best <?php echo $num;?> subjects</h3>
								<h5 class="mb-30"><?php echo $grade;?></h3>
								<form action="#" method = "post">
									<div class="mt-10 ">
										<input type="text" name="subjectName" placeholder="Subject Name" required class="single-input">
									</div>
									<div class="mt-10">
									<input type="text" name="grade" placeholder="Grades (A, B, C...) skip if no grades" class="single-input"">
									</div>
									<div class="mt-10">
									<input type="text" name="score" placeholder="Score (4.00,  1,  100%...)" required class="single-input">
									</div>
									<div class="mt-10 pb-50">
					<input type = "submit" name = "submit" class="button  button-full-mobile  float-right" value="Submit">
					</div>
							</form>
							</div>
							
					</div>
				</div>
			</div>
			</div>
							<?php }}?>
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