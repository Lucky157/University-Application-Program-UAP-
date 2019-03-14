<?php
session_start();
if(isset($_SESSION['$progID'])){
$progID=$_SESSION['progID'];}
if(isset($_POST['signUp'])){
	include_once 'connect.php';
	$usertype = $_POST['usertype'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	
	$sqlUser1 = "insert into user (username, password, fullname, email, usertype) VALUES ('$username', '$password', '$fullname','$email','S')";
	$sqlApplicant = "insert into applicant (username, password, fullname, email, IDType, IDNumber, phoneno, dateOfBirth) VALUES ('$username', '$password', '$fullname','$email','$idType','$idNumber','$phoneNo','$date')";
	$con -> query($sqlUser1);
	$con -> query($sqlApplicant);
	echo "<script type='text/javascript'>alert('You have Sucessfully Signed Up!');location.href='../signUpLogin.php'</script>";			
	exit();
	}

if (isset($_POST['login'])){
	include_once 'connect.php';
	$username = $_POST['username1'];
	$password = $_POST['password1'];
	$sql = "SELECT * FROM user WHERE username='$username'";
		$result = mysqli_query($con, $sql);
		$resultCheck = mysqli_num_rows($result);
		//username not found
		if($resultCheck < 1){
			echo "<script type='text/javascript'>alert('Username not found');location.href='../signUpLogin.php?login=error'</script>";
			exit();
		}else{
			if($row = mysqli_fetch_assoc($result)){
				//incorrect password
				$hashedPwdCheck = password_verify($password, $row['password']);
				if($password == $row['password']){
					$_SESSION['username'] = $row['username'];
					$_SESSION['usertype'] = $row['usertype'];
					echo "<script type='text/javascript'>alert('Login success!');location.href='../index.php?login=success'</script>";
					exit();
				}
				else{
					echo "<script type='text/javascript'>alert('Incorrect password');location.href='../signUpLogin.php?login=error'</script>";
					exit();
				}
			}
		}
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
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">							
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">			
			<link rel="stylesheet" href="css/jquery-ui.css">			
			<link rel="stylesheet" href="css/main.css">
			<link rel="stylesheet" href="css/Programmes.css">
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
								Login 	
							</h1>	
							<p class="text-white link-nav"><a href="index.html">Programmes</a>  <span class="lnr lnr-arrow-right"></span>  <a href="signUpLogin.html"> Login</a></p>
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
								<h1 class="mb-0">Login or Sign Up</h1>
							</div>
						</div>
					</div>						
			</section>
			<!-- End popular-courses Area -->			

			<!-- Start search-course Area -->
			<section class="search-course-area relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row justify-content-between align-items-center">
						<div class="col-lg-4 col-md-4 search-course-right section-gap">
							<form class="form-wrap" action="#" method="post">
								<h4 class="text-white pb-20 text-center mb-30">Log in to Your Account</h4>		
								<input type="text" class="form-control" required=""  name="username1" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" >
								<input type="password" class="form-control" required=""  name="password1" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" >									
								<input name="login" type="submit" value = "login" class="primary-btn text-uppercase text-center"></input>
							</form>
						</div>
						<div class="col-lg-3 col-md-4 search-course-left">
							<h1 class="text-white">
								New here? <br>
								Create your account ->
							</h1>
						</div>
						<div class="col-lg-5 col-md-4 search-course-right section-gap">
								<h4 class="text-white pb-20 text-center mb-30">Join Us</h4>
					<div class="tab-content" id="signupascontent">
						<div class="tab-pane fade show active" id="student" role="tabpanel" aria-labelledby="student-tab">
							<form action="#" method="POST">
								<div class="form-group">
									<input type="username" name="username" required="" class="form-control" id="usernameInput" placeholder="Username">
								</div>
								<div class="form-group">
									<input type="password" name="password" required="" class="form-control" id="passwordInput" placeholder="Password">
								</div>
								<div class="form-group">
									<input type="fullname" name="fullname" required="" class="form-control" id="fullnameInput" placeholder="Full Name">
								</div>
								<div class="form-group">
									<input type="mobile" name="phoneno" required="" class="form-control" id="mobileInput" placeholder="Mobile No.">
								</div>
								<div class="form-group">
									<input type="email" name="email" required="" class="form-control" id="addressInput" placeholder="Email Address">
								</div>
								<div class="form-group">
									<input type="text" name="idType" required="" class="form-control" id="idtInput" placeholder="ID Type (MyKad or passport)">
								</div>
								<div class="form-group">
									<input type="text" name="idNumber" required="" class="form-control" id="idnInput" placeholder="ID Number">
								</div>
								<div class="form-group">
									<input type="date" name="dateOfBirth" required="" class="form-control" id="cdInput" placeholder="Closing Date">
								</div>
								<div class="text-center mt-2">
								<input id="signupbtn" type="submit" name="signUp" class="primary-btn text-uppercase text-center" value="Sign Up" /></input>
								
								</div>
							</form>
					</div>
				</div>	
				</div>
			</section>
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