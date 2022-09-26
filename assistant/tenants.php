<?php
session_start();
// error_reporting(0);
include('../connect.php');
if (strlen($_SESSION['admin-username']) == "" || !isset($_SESSION['admin-username'])) {
	header("Location: login.php");
} else {
}
$username = $_SESSION["admin-username"];
date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d');

$sql = "select * from admin where username ='$username'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result);
?>



<?php
	$update = false;
	$id = $fname = $lname =$email = $contact =$date_in = "";
	if (isset($_REQUEST['edit'])) {
		$id = $_REQUEST['edit'];
		$update = true;
		
		$record = mysqli_query($conn, "SELECT * FROM tenants WHERE id=$id");

		if (count(array($record))) {
			$num = mysqli_fetch_array($record);
			$id = $num['id'];
			$fname = $num['firstname'];
			$lname = $num['lastname'];
			$email = $num['email'];
			$contact = $num['contact'];
			
			$date_in = $num['date_in'];
		}

	}
	if(isset($_REQUEST['save'])){
		$insert_house = $conn->query("INSERT INTO `tenants`(`id`, `firstname`, `lastname`, `email`, `contact`, `house_id`, `status`, `date_in`) VALUES (null,'" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['contact'] . "','" . $_POST['house_id'] . "',1,'" . $_POST['date_in'] . "')") or die(mysqli_error);
						echo '<meta http-equiv="refresh" content="0;url=tenants.php">';
						header('Location:tenants.php');

	}
	if(isset($_REQUEST['update'])){
		// $id = $_REQUEST['id'];
			$fname = $_POST['firstname'];
			$lname = $_POST['lastname'];
			$email = $_POST['email'];
			$contact = $_POST['contact'];
			$house_id = $_POST['house_id'];
			$date_in = $_POST['date_in'];

			$updatequery = $conn->query("UPDATE tenants SET firstname = '$fname', lastname = '$lname',
		email = '$email', contact = '$contact',house_id = '$house_id', date_in = '$date_in' WHERE id = $id")or die(mysqli_error);
		
		if ($updatequery) {
			
		echo '<meta http-equiv="refresh" content="0;url=tenants.php">';
		header('Location:tenants.php');
		}
		else{
			echo "failed to update";
		}

	}
	if(isset($_REQUEST['del'])){
		$id = $_REQUEST['del'];
$sql = "DELETE From `tenants` where id ='$id'";
$result = mysqli_query($conn, $sql);
if ($result >0){

header("location: tenants.php");
}
	}


?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard |Online Student Admission system</title>
	<link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon" />
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
	
	<script type="text/javascript">
		function clear(){
			document.getElementById('firstname').clear();
			document.getElementById('lastname').clear();
			document.getElementById('email').clear();
			document.getElementById('contact').clear();
			document.getElementById('house_id').clear();
			document.getElementById('date_in').clear();
		}
		function back(){
			 window.location.href = "tenants.php";
		}
	</script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="#" class="nav-link">Home</a>
					
				</li>

			</ul>

			<!-- SEARCH FORM -->
			<form class="form-inline ml-3">
				<div class="input-group input-group-sm">
					<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
					<div class="input-group-append">
						<button class="btn btn-navbar" type="submit">
							<i class="fas fa-search"></i>
						</button>
					</div>
				</div>
			</form>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="#" class="brand-link">
				<img src="../images/logo.jpg" alt=" Logo" width="167" height="149" style="opacity: .8">
				<span class="brand-text font-weight-light"> &nbsp;&nbsp;&nbsp;&nbsp; </span> </a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="../upload/no_image.jpg" alt="User Image" width="220" height="192" class="img-circle elevation-2">
					</div>
					<div class="info">
						<a href="#" class="d-block"><?php echo $row['username'];  ?></a>
					</div>
				</div>
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

						<?php
						include('sidebar.php');

						?>


					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark">Dashboard</h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active">Dashboard </li>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->




<div class="container-fluid">

				<div class="col-lg-12">
					<div class="row">
						<!-- FORM Panel -->
						<div class="col-md-4">
							<form action="#" method="POST">
								<div class="card">
									<div class="card-header">
										<h5><b>Add new Tenant</b></h5>
									</div>
									<div class="card-body">
										<input type="hidden" name="id">
										<div class="row form-group">
											
										<div class="col-md-6">
											<label for="" class="control-label">First Name</label>
											<input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $fname?>" required>
										</div>
										<div class="col-md-6">
											<label for="" class="control-label">Last Name</label>
											<input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $lname ?>" required>
										</div>
									</div>
									
									<div class="card-body">
										<input type="hidden" name="id">
										
										<div class="form-group row">
											<div class="col-md-6">
												<label for="" class="control-label">Email</label>
												<input type="email" class="form-control" name="email" id="email" value="<?php echo $email ?>" required>
											</div>
											<div class="col-md-6">
												<label for="" class="control-label">Contact #</label>
												<input type="text" class="form-control" name="contact" id="contact" value="<?php echo $contact ?>" required>
											</div>

										</div>
									</div>
									
									<div class="card-body">
										<input type="hidden" name="id">
										
										<div class="form-group row">
											<div class="col-md-6">
											<label for="" class="control-label">House</label>
									<select name="house_id" id="house_id" class="custom-select">
										<option value=""></option>
										<?php
										$house = $conn->query("SELECT * FROM houses where id not in (SELECT house_id from tenants where status = 1)" . (isset($house_id) ? " or id = $house_id" : "") . " ");
										while ($row = $house->fetch_assoc()) :
										?>
											<option value="<?php echo $row['id'] ?>" <?php echo isset($house_id) && $house_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['house_no'] . ' ' . $row['description'] ?></option>
										<?php endwhile; ?>
									</select>
										</div>
											<div class="col-md-6">
											<label for="" class="control-label">Registration Date</label>
									<input type="date" class="form-control" name="date_in" id="date_in" value="<?php echo $date_in ?>" required>
								</div>

										</div>
									</div>
									
								</div>

									<div class="card-footer">
										<div class="row">
											<div class="col-md-12">
											<?php if($update == true) { ?>
				 <input type="submit" class="btn btn-info" name="update" value="Update"> 
				 <?php } elseif ($update == false) { ?>
				 	<button class="btn btn-primary" type="submit" name="save" onclick="clear()"> Save </button>
				 <?php } ?>
															</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- FORM Panel -->

						<!-- Table Panel -->
						<div class="col-md-8">
						<div class="card">
								<div class="card-header">
									<b>List of Tenant</b>
								</div>
								<div class="card-body">
									<table class="table table-condensed table-bordered table-hover">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="">Name</th>
												<th class="">House Rented</th>
												<th class="">Monthly Rate</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											$tenant = $conn->query("SELECT t.*,concat(t.lastname,' ',t.firstname,' ') as name,h.house_no,h.description,h.price FROM tenants t inner join houses h on h.id = t.house_id where t.status = 1 order by h.house_no desc ");
											while ($row = $tenant->fetch_assoc()) :
												$months = abs(strtotime(date('Y-m-d') . " 23:59:59") - strtotime($row['date_in'] . " 23:59:59"));
												$months = floor(($months) / (30 * 60 * 60 * 24));
												$payable = $row['price'] * $months;
												$paid = $conn->query("SELECT SUM(amount) as paid FROM payments where tenant_id =" . $row['id']);
												$last_payment = $conn->query("SELECT * FROM payments where tenant_id =" . $row['id'] . " order by unix_timestamp(date_created) desc limit 1");
												$paid = $paid->num_rows > 0 ? $paid->fetch_array()['paid'] : 0;
												$last_payment = $last_payment->num_rows > 0 ? date("M d, Y", strtotime($last_payment->fetch_array()['date_created'])) : 'N/A';
												$outstanding = $payable - $paid;
											?>
												<tr>
													<td class="text-center"><?php echo $i++ ?></td>
													<td>
														<?php echo ucwords($row['name']) ?>
													</td>
													<td class="">
														<p>House No: <b><?php echo $row['house_no'] ?></b></p>
														<p> Description:<b><?php echo $row['description'] ?></b></p>

													</td>
													<td class="">
														<p> <b><?php echo number_format($row['price'], 2) ?></b></p>
													</td>
													<td class="text-center">
														<a  class="btn btn-sm btn-primary edit_tenant" role="button" href="tenants.php?edit=<?php echo $row['id']; ?>">Edit </a>
														<a  class="btn btn-sm btn-danger m-1 delete_tenant" role="button" href="tenants.php?del=<?php echo $row['id']; ?>" onClick="return deldata('<?php echo $row['name']; ?>');">Delete </a>

													</td>
												</tr>
											<?php endwhile; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- Table Panel -->
					</div>
				</div>

			</div>

			<style>
				td {
					vertical-align: middle !important;
				}

				td p {
					margin: unset;
					padding: unset;
					line-height: 1em;
				}
			</style>
			<!-- /.control-sidebar -->
		</div>




		<script type="text/javascript">
    function deldata(fullname) {
      if (confirm("ARE YOU SURE YOU WISH TO DELETE " + " " + fullname + " " + " FROM THE LIST?")) {
        return true;
      } else {
        return false;
      }

    }
  </script>



		<style>
			td {
				vertical-align: middle !important;
			}

			td p {
				margin: unset
			}

			img {
				max-width: 100px;
				max-height: 150px;
			}
		</style>
		<!-- ./wrapper -->

		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- jQuery UI 1.11.4 -->
		<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
		<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
		<script>
			$.widget.bridge('uibutton', $.ui.button)
		</script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- ChartJS -->
		<script src="plugins/chart.js/Chart.min.js"></script>
		<!-- Sparkline -->
		<script src="plugins/sparklines/sparkline.js"></script>
		<!-- JQVMap -->
		<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
		<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
		<!-- jQuery Knob Chart -->
		<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
		<!-- daterangepicker -->
		<script src="plugins/moment/moment.min.js"></script>
		<script src="plugins/daterangepicker/daterangepicker.js"></script>
		<!-- Tempusdominus Bootstrap 4 -->
		<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
		<!-- Summernote -->
		<script src="plugins/summernote/summernote-bs4.min.js"></script>
		<!-- overlayScrollbars -->
		<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/adminlte.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="dist/js/demo.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="dist/js/pages/dashboard.js"></script>
</body>

</html>