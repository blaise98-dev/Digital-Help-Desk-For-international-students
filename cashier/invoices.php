<?php
session_start();
error_reporting(0);
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
					<div class="row mb-4 mt-4">
						<div class="col-md-12">

						</div>
					</div>
					<div class="row">
						<!-- FORM Panel -->

						<!-- Table Panel -->
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<b>List of Payments</b>
									<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_invoice">
											<i class="fa fa-plus"></i> New Entry
										</a></span>
								</div>
								<div class="card-body">
									<table class="table table-condensed table-bordered table-hover">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="">Date</th>
												<th class="">Tenant</th>
												<th class="">Invoice</th>
												<th class="">Amount</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											$invoices = $conn->query("SELECT p.*,concat(t.lastname,', ',t.firstname,' ',t.middlename) as name FROM payments p inner join tenants t on t.id = p.tenant_id where t.status = 1 order by date(p.date_created) desc ");
											while ($row = $invoices->fetch_assoc()) :

											?>
												<tr>
													<td class="text-center"><?php echo $i++ ?></td>
													<td>
														<?php echo date('M d, Y', strtotime($row['date_created'])) ?>
													</td>
													<td class="">
														<p> <b><?php echo ucwords($row['name']) ?></b></p>
													</td>
													<td class="">
														<p> <b><?php echo ucwords($row['invoice']) ?></b></p>
													</td>
													<td class="text-right">
														<p> <b><?php echo number_format($row['amount'], 2) ?></b></p>
													</td>
													<td class="text-center">
														<button class="btn btn-sm btn-outline-primary edit_invoice" type="button" data-id="<?php echo $row['id'] ?>">Edit</button>
														<button class="btn btn-sm btn-outline-danger delete_invoice" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
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
		<div class="modal fade" id="add_tenant" role='dialog' tabindex="-1" role="dialog" aria-labelledby="add_tenant" aria-hidden="true">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Adding new tenant...</h5>
					</div>
					<div class="modal-body">
						<form action="" method="POST">
							<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
							<div class="row form-group">
								<div class="col-md-4">
									<label for="" class="control-label">Last Name</label>
									<input type="text" class="form-control" name="lastname" value="<?php echo isset($lastname) ? $lastname : '' ?>" required>
								</div>
								<div class="col-md-4">
									<label for="" class="control-label">First Name</label>
									<input type="text" class="form-control" name="firstname" value="<?php echo isset($firstname) ? $firstname : '' ?>" required>
								</div>
								<div class="col-md-4">
									<label for="" class="control-label">Middle Name</label>
									<input type="text" class="form-control" name="middlename" value="<?php echo isset($middlename) ? $middlename : '' ?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-4">
									<label for="" class="control-label">Email</label>
									<input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
								</div>
								<div class="col-md-4">
									<label for="" class="control-label">Contact #</label>
									<input type="text" class="form-control" name="contact" value="<?php echo isset($contact) ? $contact : '' ?>" required>
								</div>

							</div>
							<div class="form-group row">
								<div class="col-md-4">
									<label for="" class="control-label">House</label>
									<select name="house_id" id="" class="custom-select select2">
										<option value=""></option>
										<?php
										$house = $conn->query("SELECT * FROM houses where id not in (SELECT house_id from tenants where status = 1)" . (isset($house_id) ? " or id = $house_id" : "") . " ");
										while ($row = $house->fetch_assoc()) :
										?>
											<option value="<?php echo $row['id'] ?>" <?php echo isset($house_id) && $house_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['house_no'] . ' ' . $row['description'] ?></option>
										<?php endwhile; ?>
									</select>
								</div>
								<div class="col-md-4">
									<label for="" class="control-label">Registration Date</label>
									<input type="date" class="form-control" name="date_in" value="<?php echo isset($date_in) ? date("Y-m-d", strtotime($date_in)) : '' ?>" required>
								</div>
							</div>

							<div class="modal-footer">
								<input type="submit" class="btn btn-primary" name="save_tenant" value="Save">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</form>
					</div>

					<?php
					if (isset($_POST['save_tenant'])) {
						$insert_house = $conn->query("INSERT INTO `tenants`(`id`, `firstname`, `middlename`, `lastname`, `email`, `contact`, `house_id`, `status`, `date_in`) VALUES (null,'" . $_POST['firstname'] . "','" . $_POST['middlename'] . "','" . $_POST['lastname'] . "','" . $_POST['email'] . "','" . $_POST['contact'] . "','" . $_POST['house_id'] . "',1,'" . $_POST['date_in'] . "')") or die(mysqli_error);
						echo '<meta http-equiv="refresh" content="0;url=tenants.php">';
						header('Location:tenants.php');
					}
					?>

				</div>
			</div>
		</div>
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