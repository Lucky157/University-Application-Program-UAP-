<?php
session_start();
$progID=$_SESSION['progID'];
if(isset($_SESSION["username"]) && !empty($_SESSION["username"])) {

$username = $_SESSION['username'];
$usertype = $_SESSION['usertype'];
					}

if(isset($_POST['submit'])){
	include_once 'connect.php';
	$pnameAdd = $_POST['progName'];
	$descAdd = $_POST['description'];
	$dateAdd = $_POST['closDate'];
	
	$sqlgetvalues = "SELECT * FROM programme WHERE programmeID = '$progID'";
	$runquery = mysqli_query($con, $sqlgetvalues);
	while ($rowGet = mysqli_fetch_assoc($runquery))
	{
									//Getting records from database woopee do
										if ($pnameAdd == ''){
											$pnameAdd = $rowGet["programmeName"];
										}
										
										if ($descAdd == ''){
											$descAdd = $rowGet["description"];
										}
										
										if ($dateAdd == ''){
											$dateAdd = $rowGet["closingDate"];
										}
										}
	$sqlupdate = "UPDATE programme SET programmeName='$pnameAdd', description='$descAdd', closingDate='$dateAdd' where programmeID = '$progID'";								
	$con->query($sqlupdate);
	echo "<script type='text/javascript'>alert('Changed sucessfully');location.href='../adminEditProgramme.php?login=error'</script>";
					exit();
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
			<section class="banner-area relative about-banner" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Edit Programme		
							</h1>	
							<p class="text-white link-nav"><a href="programsListAdmin.php">Programmes </a>  <span class="lnr lnr-arrow-right"></span>  <a href="adminEditProgramme.php">Edit Programme</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start course-details Area -->
			
			
			<!--if(isset($_SESSION["progID"])){
			include_once 'connect.php';
			$sql = "SELECT * FROM programme, university where programme.universityID=university.universityID and programmeID = 
			'$progID'";
			$result = mysqli_query($con, $sql);
			if (mysqli_num_rows($result) > 0){
			$resultArray = mysqli_fetch_assoc($result);	
				$pname = $resultArray['programmeName'];
				$uname = $resultArray['universityName'];
				$desc = $resultArray['description'];
				$closDate = $resultArray['closingDate'];?>
			-->	
			<section class="course-details-area pt-120">
				<div class="container">
					<div class="row">
						<div class="col-lg-7 left-contents">
							<div class="main-image">
								<img class="img-fluid" src="img/m-img.jpg" alt="">
							</div>
							<div class="jq-tab-wrapper" id="horizontalTab">
	                            <div class="jq-tab-content-wrapper">
	                                <div class="jq-tab-content active" data-tab="1">
									<?php
	                                    include_once 'connect.php';
						
						$sql = "SELECT programmeID, closingDate, programmeName, description, university.universityID, university.universityName FROM programme, university where programme.universityID=university.universityID
						and programmeID='$progID'
						and CURRENT_TIMESTAMP < closingDate";
						//$sql = "select * from programme where programmeID='$progID'";
						$result=mysqli_query($con,$sql);
						if (mysqli_num_rows($result)>0){
							$resultArray=mysqli_fetch_assoc($result);
							$pname = $resultArray['programmeName'];
							$uname = $resultArray['universityName'];
							$desc = $resultArray['description'];
							$pid = $resultArray['programmeID'];
							$date = $resultArray['closingDate'];
						}?>
										<?php echo $desc;?>
										<br>	                                    
										<br>
	                                    
	                                </div>
						                                </div>
						                            </div>
						                        </div>                        	
						<div class="col-lg-5 right-contents">
						
							<ul>
								<li>
									<a class="justify-content-between d-flex" style="color:black;">
										<p>Programme Name</p> 
										<span style = "color:#FC6600;"><?php echo $pname;?></span>
									
								</li>
								<li>
									<a class="justify-content-between d-flex" style="color:black;">
										<p>University Name </p>
										<span style = "color:#FC6600;"><?php echo $uname;?></span>
									</a>
								</li>
								<li>
									<a class="justify-content-between d-flex" style="color:black;">
										<p>Closing Date </p>
										<span style = "color:#FC6600;"><?php echo $date;?></span>
									</a>
								</li>
							</ul>
							<!--button  button-full-mobile  float-right-->
							<!--primary-btn text-uppercase-->
						</div>	
						</div>
						</div>
			</section>
			<!-- End course-details Area -->
			<section class="search-course-area relative">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row justify-content-between align-items-center">
						<div class="col-lg-12 col-md-12 search-course-right section-gap">
							<form class="form-wrap" action="#" method = "post">
								<h1 class="text-white pb-20 text-center mb-30">Edit Programme</h1>		
								<input type="text" class="form-control" name="progName" placeholder="Programme Name (Skip if no changes)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Programme Name'" >
								<textarea class="form-control" name="description" rows="5" placeholder="Description (Skip if no changes)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'" ></textarea>
								<h6 class="text-white">Closing Date</h6>	
								<input type="date" class="form-control" name="closDate" placeholder="Closing Date" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Closing Date'" >								
									<input type="submit" name="submit" class="genric-btn primary" value="Save"> 
									<input type="reset" name="reset" class="genric-btn info-border" value="Cancel">
							</form>
						</div>
					</div>
				</div>	
			</section>

			<!-- Start popular-courses Area --> 
			<section class="popular-courses-area section-gap courses-page">
			</section>
			<!-- End popular-courses Area -->					

			<!-- Start cta-two Area -->
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