<?php
session_start();
if(isset($_SESSION['$progID'])){
$progID=$_SESSION['progID'];}
if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
include_once 'connect.php';
$sql = "SELECT IDNumber FROM applicant WHERE username='$username'";
$result = mysqli_query($con, $sql);
$resultArray = mysqli_fetch_assoc($result);
$IdNo = $resultArray ['IDNumber'];
}
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
	$sqlUser = "insert into user (username, password, fullname, email, usertype) 
	VALUES ('$username', '$password', '$fullname','$email','S')";
	$sqlApplicant = "insert into applicant (username, password, fullname, email, IDType, IDNumber, phoneno, dateOfBirth) 
	VALUES ('$username', '$password', '$fullname','$email','$idType','$idNumber','$phoneNo','$date')";
	$con -> query($sqlUser);
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
	if(isset($_POST['addQual'])){
	include_once 'connect.php';
	$nameAdd = $_POST['name'];
	$minScoreAdd = $_POST['minScore'];
	$maxScoreAdd = $_POST['maxScore'];
	$gradeList = $_POST['gradeList'];
	$resultCalcDescription = $_POST['resultCalcDescription'];
	$noOfSubjects = $_POST['noOfSubjects'];
	
	$sqlInsert = "insert into qualification (QID, name, minScore, maxScore, resultCalcDescription, noOfSubjects, gradeList) 
	VALUES ('', '$nameAdd', '$minScoreAdd','$maxScoreAdd','$resultCalcDescription','$noOfSubjects','$gradeList')";
	$con -> query($sqlInsert);
	echo "<script type='text/javascript'>alert('Added sucessfully');location.href='../index.php?login=error'</script>";
					exit();
}
if(isset($_POST['submitQual'])){
	include_once 'connect.php';
	$qidInput = $_POST['qidInput'];

	$sql = "SELECT QID FROM qualification WHERE QID='$qidInput'";
	$result = mysqli_query($con, $sql);
	
	if (mysqli_num_rows($result) > 0){
		$resultArray = mysqli_fetch_assoc($result);
		
		$_SESSION['qualID']=$resultArray['QID'];
		header('location:editQual.php');
	}else{
		$recordmessage = '<span style="color:#ff0000;">Invalid Application ID!</br></span>';
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
</h2> 
<h3 class="epsilon  listing-vendor">' .$uname.'</h3>
<h4 class="epsilon  listing-vendor"> Application ID: ' .$aid.'</h4>
          </div>
          <div class="cell  one-whole">
            <h4 class="epsilon  listing-vendor"> Status: ' .$status.'</h4>
          </div>
        </div>
      </div>
    </div>
  </div> 
   '; }echo
   '</div>		
			</section>';};
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
				and username = '$username'
				and qualificationObtained.IDNumber = '$IdNo'";
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
								$sql = "SELECT programme.programmeID, status, programmeName, closingDate, count(AID) 
								FROM programme, application 
								WHERE programme.programmeID=application.programmeID 
								and status = 'pending'
								group by programme.programmeID";
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
					<input type="text" class="form-control" required = "" placeholder = "Programme ID" name="pidInputAdmin" type="text"></br>
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
								<h1 class="mb-10">You do not have any programmes yet</h1>
							</div>
						</div>
					</div>
					</div>		
			</section>';};
			
}
else {echo 
'<div class="whole-wrap">
				<div class="container">
				<div class="section-top-border">
						<h3 class="mb-30">Qualifications</h3>
						<div class="progress-table-wrap mb-30">
							<div class="progress-table">
								<div class="table-head">
									<div class="serial" style="font-weight:bold;">ID</div>
									<div class="country" style="font-weight:bold;">Qualification</div>
									<div class="country" style="font-weight:bold;">Maximum Score</div>
								</div>';
								include_once 'connect.php';
								$sql = "SELECT name, QID, maxScore
								FROM qualification";
								$result = mysqli_query($con, $sql);
								if (mysqli_num_rows($result) > 0){
										while ($row = mysqli_fetch_assoc($result)){
										$name = $row['name'];
										$QID = $row['QID'];
										$maxScore = $row['maxScore'];
								echo '
								<div class="table-row" style="font-weight:bold;">
									<div class="serial">'.$QID.'</div>
									<div class="country">'.$name.'</div>
									<div class="country">'.$maxScore.'</div>
								</div>';} echo'						
							</div>
						</div>
					<form action="" method="post">
					<p style="font-weight:bold;">Enter ID of the qualification you would like to edit: </p>
					<input type="text" class="form-control" required=""  placeholder = "Qualification ID" name="qidInput"></br>
					<input type = "submit" name = "submitQual" class="button  button-full-mobile  float-right" value="Edit">
				</form>';} echo'
				</div>
				</div>
				</div>
				</div>
				<section class="search-course-area relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row justify-content-between align-items-center">
					<div class="col-lg-12 col-md-12 search-course-right section-gap">
							<form class="form-wrap" method = "post">
								<h1 class="text-white pb-20 text-center mb-30">Add Qualification</h1>
									<div class="mt-10">
										<input type="text" name="name" placeholder="Qualification Name"  required class="single-input">
									</div>
									<div class="mt-10">
										<input type="text" name="minScore" placeholder="Minimum Score"  required class="single-input">
									</div>
									<div class="mt-10">
										<input type="text" name="maxScore" placeholder="Maximum Score"  required class="single-input">
									</div>
									<div class="mt-10">
										<input type="text" name="gradeList" placeholder="Grade List"   required class="single-input">
									</div>
									<div class="mt-10">
										<textarea class="single-textarea mb-20" name="resultCalcDescription" placeholder="Mode of calculation (Total or Average)"  required=""></textarea>
									</div>
									<div class="mt-10">
										<input type="text" name="noOfSubjects" placeholder="Number of subjects"   required class="single-input">
									</div>
									<div class = "mt-10">
									<input type="submit" name="addQual" class="genric-btn primary" value="Add"> 
									<input type="reset" name="reset" class="genric-btn info-border" value="Reset">
									</div>
								</div>
								</form>
					</div>
				</div>	
			</section>
					
			<!-- End popular-courses Area -->
			
			<section class="popular-courses-area section-gap courses-page">
			</section>';	};
 }
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
								<input type="text" class="form-control" required=""  name="username1" placeholder="Username"  " >
								<input type="password" class="form-control" required=""  name="password1" placeholder="Password"  " >									
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