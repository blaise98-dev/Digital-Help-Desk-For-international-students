<?php
session_start();
error_reporting(0);
include('connect.php');

date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d H:i:s');

if (isset($_POST['btnsubmit'])) {

	$pin = $_POST['txtpin'];
	$serial = $_POST['txtserial'];

	$sql = "SELECT * FROM student WHERE username='" . $pin . "' and password = '" . $serial . "'";
	$result = mysqli_query($conn, $sql);


	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		($row = mysqli_fetch_assoc($result));
		$_SESSION["serial"] = $row['serial'];

		header("Location: apply/admission.php");
	} else {
?>
		<script>
			alert('Invalid Scratch Card Details or Has Already been Used');
		</script>
<?php
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Site Metas -->
<title>AUCA|Online Student Admission System</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="images/logo.png" type="image/x-icon" />
<link rel="apple-touch-icon" href="images/apple-touch-icon.jpg">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Site CSS -->
<link rel="stylesheet" href="style.css">
<!-- ALL VERSION CSS -->
<link rel="stylesheet" href="css/versions.css">
<!-- Responsive CSS -->
<link rel="stylesheet" href="css/responsive.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="css/custom.css">

<!-- Modernizer for Portfolio -->
<script src="js/modernizer.js"></script>

</head>

<body class="host_version">

	<!-- LOADER -->
	<div id="preloader">
		<div class="loader-container">
			<div class="progress-br float shadow">
				<div class="progress__item"></div>
			</div>
		</div>
	</div>
	<!-- END LOADER -->

	<!-- Start header -->
	<header class="top-navbar">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="index.html">
					<img src="images/logo.jpg" width="130" height="130" />
				</a>
				<ul class="navbar-nav">
					<li class="nav-item"><a class="nav-link" href="index.php">DIGITAL HELP DESK FOR INTERNATIONAL STUDENTS
						</a></li>

				</ul>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"> </span>
				</button>
				<div class="collapse navbar-collapse" id="navbars-host">
					<ul class="navbar-nav navbar-right ml-auto">
						<li><a class="nav-link hover-btn-new log orange" href="index.php"><span>Home</span></a></li>
						<li> <a href="#about-section" class="nav-link hover-btn-new log orange"><span>About</span></a>
						</li>
						<li> <a href="#contact-section" class="nav-link hover-btn-new log orange"><span>Contact</span></a>
						</li>
						<li><a class="nav-link hover-btn-new log orange blink_me" href="apply/admission.php"><span>Apply</span></a></li>
						<li><a class="nav-link hover-btn-new log orange" href="user/index.php"><span>Dashboard</span></a></li>

					</ul>

				</div>
			</div>
		</nav>
	</header>
	<!-- End header -->
	


	<div id="carouselExampleControls" class="carousel slide bs-slider box-slider" data-ride="carousel" data-pause="hover" data-interval="false">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleControls" data-slide-to="1"></li>
			<li data-target="#carouselExampleControls" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
				<div id="home" class="first-section" style="background-image:url('images/slider-01.jpg');">
					<div class="dtab">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 text-right">
									<div class="big-tagline">
										<h2><strong>AUCA </strong>, Rwanda</h2>
									</div>
								</div>
							</div><!-- end row -->
						</div><!-- end container -->
					</div>
				</div><!-- end section -->
			</div>
			<div class="carousel-item">
				<div id="home" class="first-section" style="background-image:url('images/slider-02.jpg');">
					<div class="dtab">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 text-left">
									<div class="big-tagline">
										<h2 data-animation="animated zoomInRight">AUCA <strong>, Rwanda</strong></h2>
										<p class="lead" data-animation="animated fadeInLeft">We inculcates positive values and offers knowledge for use around the world. </p>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<!-- <a href="#" class="hover-btn-new"><span>Read More</span></a> -->
									</div>
								</div>
							</div><!-- end row -->
						</div><!-- end container -->
					</div>
				</div><!-- end section -->
			</div>
			<div class="carousel-item">
				<div id="home" class="first-section" style="background-image:url('images/slider-03.jpg');">
					<div class="dtab">
						<div class="container">
							<div class="row">
								<div class="col-md-12 col-sm-12 text-center">
									<div class="big-tagline">
										<h2 data-animation="animated zoomInRight"><strong>AUCA </strong>, Rwanda</h2>
										<p class="lead" data-animation="animated fadeInLeft">All our courses are accredited by HEC</p>
										<!-- <a href="#" class="hover-btn-new"><span>Read More</span></a> -->
									</div>
								</div>
							</div><!-- end row -->
						</div><!-- end container -->
					</div>
				</div><!-- end section -->
			</div>
			<!-- Left Control -->
			<a class="new-effect carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				<span class="fa fa-angle-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>

			<!-- Right Control -->
			<a class="new-effect carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				<span class="fa fa-angle-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	<div id="overviews ">
		<div class="container">
			<div class="section-title row text-center">
				<div class="col-md-12 ">
					<h3 id="about-section ">About Us </h3>
					<p class="align-left">The Adventist University of Central Africa (AUCA) was founded in 1978. The official opening took place on 15 October 1984 and the university had its definitive operating license via the law n0 0056/05 of 3rd February 1988, granting AUCA the legal personality as a nonprofit making association. At its inception, the University was located at Mudende, former Mutura Commune, Gisenyi Prefecture.</p>

					<p class="align-left"> Until today, AUCA has enjoy a good reputation locally and regionally for its track record in quality teaching. Currently the university operates on three beautiful campuses of Masoro, Gishushu (Kigali City) and Ngoma (Karongi District in the Western Province).

					<h3>Undergraduate studies</h3>

					<b class="align-left">Faculty of Theology:
					</b>
					Bachelor of Theology <br>

					<b class="align-left">Faculty of Health Sciences:
					</b>
					Bachelor of Science in Nursing
					Bachelor of Science in Midwifery <br>

					<b class="align-left">Faculty of Business Administration:
					</b>
					BBA in Accounting;
					BBA in Management;
					BBA in Finance
					BBA in Marketing <br>
					<b class="align-left">Faculty of Information technology:
					</b>
					BSc in Information Management;
					BSc in Networks and Communication Systems;
					BSc in Software Engineering <br>
					<b class="align-left">Faculty of Education:</b>

					BA in in Accounting and Information Technology;
					BA in English Language and Literature & French;
					BA in Geography and History;
					<br>
					<h3>Graduate studies</h3>

					<b class="align-left">Faculty of Information Technology:
					</b>
					Master of Science in Big Data Analytics <br>
					<b>Faculty of Business Administration:
					</b>
					MBA in Accounting;
					MBA in Management;
					MBA in Finance
					MBA in Human Resource Management
					MBA in Project Management <br>
					<b>Faculty of Education:
					</b>
					Master of Arts in Educational Administration
					Master of Arts in Curriculum, Instruction and Supervision <br>
					<b>Professional courses:
					</b>
					Certified Ethical Hacker (C|EH), Postgraduate Diploma in Teaching Methodology, Diploma in Theology, Certified Ethical Hacker, Cisco Certified Network Associate, Certified Public Accountants (CPAs) Coaching, Early Childhood Education, English Language Proficiency, Research and Statistics, Statistical Package for Social Studies (SPSS).
					</p>
				</div>
			</div><!-- end title -->

			<div class="row align-items-center">
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
					<div class="message-box">
						<h4>AUCA, Rwanda </h4>
						<h2>Digital Help Desk for International Students system</h2>
						<p>&nbsp;</p>

						<!-- <a href="#" class="hover-btn-new orange"><span>Learn More</span></a> -->
					</div><!-- end messagebox -->
				</div><!-- end col -->

				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
					<div class="post-media wow fadeIn">
						<img src="images/blog_6.jpg" alt="" width="530" height="420" class="img-fluid img-rounded">
					</div>
					<!-- end media -->
				</div><!-- end col -->
			</div>
			<!-- end row -->
		</div><!-- end container -->
	</div><!-- end section -->
	<!-- end section -->
	<!-- end section -->
	<!-- end section -->
	<!-- end section -->

	<!-- contact -->
	<div id="contact-section" class="section wb">
		<div class="container">
			<div class="section-title row text-center">
				<div class="col-md-8 offset-md-2">
					<h3>Contact Us on </h3>
					<p>Find us here:</p>
					
				</div>
			</div><!-- end title -->

			<div class="row align-items-center">
				<div class="col-12">
					<div class="social text-center">
						<ul>
							<li><a href="#"><i class="fa fa-lg fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-lg fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-lg fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-lg fa-github"></i></a></li>
							<li><a href="#"><i class="fa fa-lg fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-lg fa-youtube"></i></a></li>
						</ul>
					</div>
				</div><!-- end col -->
			</div>
			<!-- end row -->
		</div><!-- end container -->
	</div>



	<?php

	include('footer.php');
	?>

	<a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

	<!-- ALL JS FILES -->
	<script src="js/all.js"></script>
	<!-- ALL PLUGINS -->
	<script src="js/custom.js"></script>
	<script src="js/timeline.min.js"></script>
	<script>
		timeline(document.querySelectorAll('.timeline'), {
			forceVerticalMode: 700,
			mode: 'horizontal',
			verticalStartPosition: 'left',
			visibleItems: 4
		});
	</script>
</body>

</html>