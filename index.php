<?php
session_start();
if(isset($_SESSION['$progID'])){
$progID=$_SESSION['progID'];}
if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];}
if(isset($_POST['submit'])){
	include_once 'connect.php';
	$pidInputAdmin = $_POST['pidInputAdmin'];

	$sql = "SELECT programmeID FROM programme WHERE programmeID='$pidInputAdmin'";
	$result = mysqli_query($con, $sql);
	
	if (mysqli_num_rows($result) > 0){
		$resultArray = mysqli_fetch_assoc($result);
		
		$_SESSION['progIDAdmin']=$resultArray['programmeID'];
		header('location:applicationsList.php');
	}else{
		$recordmessage = '<span style="color:#ff0000;">Invalid Application ID!</br></span>';
	}
}
if(isset($_POST['signUp'])){
	include_once 'connect.php';
	$username = $_POST['username'];
	$password = $_POST['password'];
	$fullname = $_POST['fullname'];
	$phoneNo = $_POST['phoneno'];
	$email = $_POST['email'];
	$idType = $_POST['idType'];
	$idNumber = $_POST['idNumber'];
	$date = $_POST['dateOfBirth'];
	
	if($_POST['usertype'] == 1){
	$sqlUser = "insert into user (username, password, fullname, email, usertype) VALUES ('$username', '$password', '$fullname','$email','S')";
	$sqlApplicant = "insert into applicant (username, password, fullname, email, IDType, IDNumber, phoneno, dateOfBirth) VALUES ('$username', '$password', '$fullname','$email','$idType','$idNumber','$phoneNo','$date')";
	$con -> query($sqlApplicant);
	}
	else {$sqlUser = "insert into user (username, password, fullname, email, usertype) VALUES ('$username', '$password', '$fullname','$email','SA')";}
	$con -> query($sqlUser);
	
	
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
//$_SESSION['progID']=2;
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
			  				<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-behance"></i></a></li>
			  				</ul>			
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
			          <li><a href="about.html">About</a></li>
			          <li><a href=<?php echo $navLink;?>><?php echo $navLinkText;?></a></li>
			          <li><a href="gallery.html">Gallery</a></li>					          					          		          
			          <li><a href="contact.html">Contact</a></li>
			        </ul>
			      </nav><!-- #nav-menu-container -->		    		
		    	</div>
		    </div>
		  </header><!-- #header -->

			<!-- start banner Area -->
			<section class="banner-area relative" id="home">
				<div class="overlay overlay-bg"></div>	
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-between">
						<div class="banner-content col-lg-9 col-md-12">
							<h1 class="text-uppercase">
								We Ensure better education
								for a better world			
							</h1>
							<p class="pt-10 pb-10">
								In the history of modern astronomy, there is probably no one greater leap forward than the building and launch of the space telescope known as the Hubble.
							</p>
							<a href="courses.php" class="primary-btn text-uppercase">View Programmes</a>
						</div>										
					</div>
				</div>					
			</section>
			<!-- End banner Area -->

			<!-- Start feature Area -->
			<!-- End feature Area -->
					
			<!-- Start popular-course Area -->
			<?php
			if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
							If ( $usertype == 'S') {?>
    
<?php
				include 'connect.php';
				$sql = "SELECT programme.programmeID, fullname, programmeName, university.universityID, university.universityName, application.AID, status 
				FROM programme, university, application, applicant 
				where programme.universityID=university.universityID
				and programme.programmeID = application.programmeID
				and application.IDNumber = applicant.IDNumber
				and username = '$username';";
				$result = mysqli_query($con, $sql);
				$resultCheck = mysqli_num_rows($result);
				if ($resultCheck < 1){echo 
				'<section class="popular-course-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-10 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">You do not have any applications yet</h1>
							</div>
							</div>
					</div>
					</div>		
			</section>';
			
			if(isset($_SESSION["progID"]) && !empty($_SESSION["progID"])){echo
				'<section class="popular-course-area section-gap">
				<div class="container">
				<div class="row d-flex justify-content-center">
				<a href="course-details.php" class="button  button-full-mobile center-block">Continue application</a>
				</div>
					</div>		
			</section>';}
				}
				else
				{ echo
				'<section class="popular-course-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">My Applications</h1>
							</div>
						</div>
					</div>';	
				while($row = mysqli_fetch_assoc($result)){	
				$pname = $row['programmeName'];
				$uname = $row['universityName'];
				$aid = $row['AID'];
				$status = $row['status'];
echo					
	'<div id="product-146279" class="card  listing">
    <div class="grid  grid-slim">
      <div class="cell  one-fifth  palm-one-half">
        <div class="listing-thumbnail-container  hide-palm">
          <a class="thumbnail listing-thumbnail" href="/p/146279/AwardSpring/">
              <img alt="BIT" height = "150px" width = "150px" src="https://educationmalaysia.gov.my/media/catalog/product/cache/1/image/270x/9df78eab33525d08d6e5fb8d27136e95/h/e/help_university_2.jpg">
</a>        </div>
      </div>
      <div class="cell  four-fifths  palm-one-whole">
        <div class="grid">
          <div class="cell  nine-twelfths  palm-one-whole">
            <h2 class="listing-name">
			
    <a > '.$pname.'</a>
</h2>';echo
'<h3 class="epsilon  listing-vendor">' .$uname.'</h3>
<h4 class="epsilon  listing-vendor"> Application ID: ' .$aid.'</h4>
          </div>
          <div class="cell  one-whole">
            <h4 class="epsilon  listing-vendor"> Status: ' .$status.'</h4>
          </div>
        </div>
      </div>
    </div>
  </div> 
  
   '; }
   '</div>		
			</section>';}
   $sql = "select name, qualification.QID, overallScore from qualificationObtained, applicant, qualification
					where qualification.QID = qualificationObtained.QID
					and applicant.IDNumber = qualificationObtained.IDNumber
					and username = '$username';";
				$result = mysqli_query($con, $sql);
				$resultCheck = mysqli_num_rows($result);
				if ($resultCheck < 1){echo
				'<section class="popular-course-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">You do not have any qualifications yet</h1>
							</div>
						</div>
						<a href="qualificationsAppl.php" class="button  button-full-mobile center-block">Add Qualification</a>
					</div>
					</div>		
			</section>';
					}
					else{echo
					'<section class="popular-course-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-10 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">My Qualifications</h1>
							</div>
						</div>
					</div>';	
					
					
					while ($row = mysqli_fetch_assoc($result)){
						$qname = $row['name'];
						$overallScore = $row['overallScore'];
						$qid = $row['QID'];
						$sql2 = "SELECT qualification.QID, name, subjectName, grade, score, overallScore, applicant.IDNumber
				FROM qualification, qualificationObtained, result, applicant
				where qualification.QID=qualificationObtained.QID
				and qualification.QID=result.QID
				and applicant.IDNumber = result.IDNumber
				and result.QID = '$qid'
				and username = '$username'";
				$resultName = mysqli_query($con, $sql2);
					echo
						'<div class="whole-wrap">
				<div class="container">
				<div class="section-top-border">
						<h3 class="mb-30">Qualification: '.$qname.'</h3>
						<div class="progress-table-wrap mb-30">
							<div class="progress-table">
								<div class="table-head">
									<div class="serial" style="font-weight:bold;">Subject</div>
									<div class="serial" style="font-weight:bold;">Grade</div>
									
								</div>';
						while($rowName = mysqli_fetch_assoc($resultName)){	
						$sname = $rowName['subjectName'];
						$grade = $rowName['grade'];
						$score = $rowName['score'];
						echo
		
								'<div class="table-row" style="font-weight:bold;">
									<div class="serial">'.$sname.'</div>
									<div class="serial">'.$score.'</div>
								</div>';
																	
							
						};echo
						'</div>
						</div>
						
						<h5 class="mb-30">Overall Score: '.$overallScore.'</h5>';
						};echo
					'<a href="qualificationsAppl.php" class="button  button-full-mobile center-block">Add Qualification</a> 
				</div>
					</div>
					</div>
					</div>		
			</section>';
					
  }; 
  }
  else if($usertype == 'UA' ){
  echo '<div class="whole-wrap">
				<div class="container">
				<div class="section-top-border">
						<h3 class="mb-30">Applications</h3>
						<div class="progress-table-wrap">
							<div class="progress-table">
								<div class="table-head">
									<div class="serial" style="font-weight:bold;">Programme ID</div>
									<div class="country" style="font-weight:bold;">Programme Name</div>
									<div class="visit" style="font-weight:bold;">Closing Date</div>
									<div class="percentage" style="font-weight:bold;">No of Applications</div>
								</div>';
								include_once 'connect.php';
								$sql = "SELECT programme.programmeID, programmeName, closingDate, count(AID) FROM programme, application WHERE programme.programmeID=application.programmeID group by programme.programmeID";
								$result = mysqli_query($con, $sql);
								if (mysqli_num_rows($result) > 0){
										while ($row = mysqli_fetch_assoc($result)){
										$pname = $row['programmeName'];
										$date = $row['closingDate'];
										$pid = $row['programmeID'];
										$noOfAppl = $row['count(AID)'];
										echo 
								'<div class="table-row" style="font-weight:bold;">
									<div class="serial" style="font-weight:bold;">'.$pid.'</div>
									<div class="country"> '.$pname.'</div>
									<div class="visit">'.$date.'</div>
									<div class="percentage">
										'.$noOfAppl.'
									</div>
								</div>';}
								echo 
							'</div>
						</div>
					</div>
					<form action="" method="post">
					<p style="font-weight:bold;">Enter ID of the programme you would like to view: </p>
					<input type="text" class="form-control" placeholder = "Programme ID" name="pidInputAdmin" type="text"></br>
					<input type = "submit" name = "submit" class="button  button-full-mobile  float-right" value="Submit"> 
				</form>
					</div>
					</div>
			<!-- End popular-courses Area -->	

<!-- Start cta-two Area -->
			<section class="popular-courses-area section-gap courses-page">
			</section>
  
							
			<!-- End popular-course Area -->';}
			else {echo
				'<section class="popular-course-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10">You do not have any qualifications yet</h1>
							</div>
						</div>
					</div>
					</div>		
			</section>';};
			
};}
 else {echo 
 
			'<!-- Start search-course Area -->
			<section class="popular-courses-area section-gap courses-page">
			</section>
			<section class="search-course-area relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row justify-content-between align-items-center">
						<div class="col-lg-4 col-md-4 search-course-right section-gap">
							<form class="form-wrap" action="#" method="post">
								<h4 class="text-white pb-20 text-center mb-30">Log in to Your Account</h4>		
								<input type="text" class="form-control" name="username1" placeholder="Username"  " >
								<input type="text" class="form-control" name="password1" placeholder="Password"  " >									
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
							<form class="form-wrap" action="#" method="post">
								<h4 class="text-white pb-20 text-center mb-30">Sign Up As</h4>
									<ul class="nav nav-tabs nav-justified" id="signupas" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="student-tab" data-toggle="tab" href="#student" role="tab" aria-controls="student" aria-selected="true">Student</a>
                        </li>
						<li class="nav-item">
                            <a class="nav-link" id="sysAdmin-tab" data-toggle="tab" href="#sysAdmin" role="tab" aria-controls="sysAdmin" aria-selected="false">System Admin</a>
                        </li>
                    </ul>
					<h4 class="text-white pb-10 text-center mb-10"></h4>
					<div class="tab-content" id="signupascontent">
						<div class="tab-pane fade show active" id="student" role="tabpanel" aria-labelledby="student-tab">
								<div class="form-group" id="hiddenUserType">
									<input type="hidden" name="usertype" value="1" checked>
								</div>
								<input type="text" class="form-control" name="username" placeholder="Username" " >
								<input type="text" class="form-control" name="password" placeholder="Password" " >
								<input type="text" class="form-control" name="fullname" placeholder="Full Name" " >
								<input type="phone" class="form-control" name="phoneno" placeholder="Phone Number" " >
								<input type="email" class="form-control" name="email" placeholder="Email Address" " >
								<input type="text" class="form-control" name="idType" placeholder="ID Type (MyKad or passport)" " >
								<input type="text" class="form-control" name="idNumber" placeholder="ID Number" " >
								<input type="date" class="form-control" name="dateOfBirth" placeholder="Closing Date" " >
								<h6 class="text-white pb-10">Date of Birth</h6>
									</div>
						<div class="tab-pane fade show" id="sysAdmin" role="tabpanel" aria-labelledby="sysAdmin-tab">
								<div class="form-group" id="hiddenUserType">
									<input type="hidden" name="usertype" value="2" checked>
								</div>
								<input type="text" class="form-control" name="username" placeholder="Username" " >
								<input type="text" class="form-control" name="password" placeholder="Password" " >
								<input type="text" class="form-control" name="fullname" placeholder="Full Name" " >
								<input type="email" class="form-control" name="email" placeholder="Email Address" " >
								</div>
								</div>
								<input name="signUp" type="submit" value = "signup" class="primary-btn text-uppercase text-center"></input>
							</form>
				</div>	
			</section>';};?>
			<!-- End search-course Area -->
			
		
			<!-- Start upcoming-event Area -->
			
			<!-- End upcoming-event Area -->
						
			<!-- Start review Area -->
			
			<!-- End review Area -->	
			
			<!-- Start cta-one Area -->
			<!-- End cta-one Area -->

			<!-- Start blog Area -->
			
			<!-- End blog Area -->			
			

			<!-- Start cta-two Area -->
			<section class="popular-courses-area section-gap courses-page">
			</section>
			<!-- End cta-two Area -->
						
			<!-- start footer Area -->		
			<footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Top Products</h4>
								<ul>
									<li><a href="#">Managed Website</a></li>
									<li><a href="#">Manage Reputation</a></li>
									<li><a href="#">Power Tools</a></li>
									<li><a href="#">Marketing Service</a></li>
								</ul>								
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Quick links</h4>
								<ul>
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Brand Assets</a></li>
									<li><a href="#">Investor Relations</a></li>
									<li><a href="#">Terms of Service</a></li>
								</ul>								
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Features</h4>
								<ul>
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Brand Assets</a></li>
									<li><a href="#">Investor Relations</a></li>
									<li><a href="#">Terms of Service</a></li>
								</ul>								
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Resources</h4>
								<ul>
									<li><a href="#">Guides</a></li>
									<li><a href="#">Research</a></li>
									<li><a href="#">Experts</a></li>
									<li><a href="#">Agencies</a></li>
								</ul>								
							</div>
						</div>																		
						<div class="col-lg-4  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h4>Newsletter</h4>
								<p>Stay update with our latest</p>
								<div class="" id="mc_embed_signup">
									 <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get">
									  <div class="input-group">
									    <input type="text" class="form-control" name="EMAIL" placeholder="Enter Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email Address '" required="" type="email">
									    <div class="input-group-btn">
									      <button class="btn btn-default" type="submit">
									        <span class="lnr lnr-arrow-right"></span>
									      </button>    
									    </div>
									    	<div class="info"></div>  
									  </div>
									</form> 
								</div>
							</div>
						</div>											
					</div>
					<div class="footer-bottom row align-items-center justify-content-between">
						<p class="footer-text m-0 col-lg-6 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
						<div class="col-lg-6 col-sm-12 footer-social">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
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