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

<?php
	$update = false;
	$id = $price = $description =$category_id = $house_no = "";
	if (isset($_REQUEST['edit'])) {
		$id = $_REQUEST['edit'];
		$update = true;
		
		$record = mysqli_query($conn, "SELECT * FROM houses WHERE id=$id");

		if (count(array($record))) {
			$num = mysqli_fetch_array($record);
			$id = $num['id'];
			$house_no = $num['house_no'];
			$category_id = $num['category_id'];
			$description = $num['description'];
			$price = $num['price'];
					}

	}
	if(isset($_REQUEST['save'])){
		$insert_house = $conn->query("INSERT INTO `houses`(`id`, `house_no`, `category_id`, `description`, `price`) VALUES (NULL,'" . $_POST['house_no'] . "','" . $_POST['category_id'] . "','" . $_POST['description'] . "','" . $_POST['price'] . "')");
	echo '<meta http-equiv="refresh" content="0;url=houses.php">';
	header('Location:houses.php');

	}
	if(isset($_REQUEST['update'])){
		// $id = $_REQUEST['id'];
			$house_no = $_POST['house_no'];
			$category_id = $_POST['category_id'];
			$description = $_POST['description'];
			$price = $_POST['price'];

			$updatequery = $conn->query("UPDATE houses SET house_no = '$house_no', category_id = '$category_id',
		description = '$description', price = '$price' WHERE id = $id")or die(mysqli_error);
		
		if ($updatequery) {
			
		echo '<meta http-equiv="refresh" content="0;url=houses.php">';
		header('Location:houses.php');
		}
		else{
			echo "failed to update";
		}

	}
	if(isset($_REQUEST['del'])){
		$id = $_REQUEST['del'];
$sql = "DELETE From `houses` where id ='$id'";
$result = mysqli_query($conn, $sql);
if ($result >0){

header("location: houses.php");
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
			document.getElementById('category_id').clear();
			document.getElementById('description').clear();
			document.getElementById('price').clear();
			document.getElementById('house_no').clear();
		}
		function back(){
			 window.location.href = "houses.php";
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
							<form action="" method="POST">
								<div class="card">
									<div class="card-header">
										<h5 class="text-primary"> Add New House</h5>
									</div>
									<div class="card-body">
										<div class="form-group" id="msg"></div>
										<input type="hidden" name="id">
										<div class="form-group">
											<label class="control-label">House No</label>
											<input type="text" class="form-control" name="house_no" value="<?php echo $house_no ?>" required="">
										</div>
										<div class="form-group">
											<label class="control-label">Category</label>
											<select name="category_id" id="" class="custom-select" required>
											<option value="<?php echo $category_id ?>" selected><?php echo $category_id ?></option>
												<?php
												$categories = $conn->query("SELECT * FROM categories order by name asc");
												if ($categories->num_rows > 0) :
													while ($row = $categories->fetch_assoc()) :
												?>
														<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
													<?php endwhile; ?>
												<?php else : ?>
													<option selected="" value="" disabled="">Please check the category list.</option>
												<?php endif; ?>
											</select>
										</div>
										<div class="form-group">
											<label for="" class="control-label">Description</label>
											<textarea name="description" id="" cols="30" rows="4" class="form-control" required><?php echo $description ?></textarea>
										</div>
										<div class="form-group">
											<label class="control-label">Price</label>
											<input type="number" class="form-control text-right" name="price" value="<?php echo $price ?>" step="any" required="">
										</div>
											<div class="form-group">
												<div class="col-md-12">
												<?php if($update == true) { ?>
				 <input type="submit" class="btn btn-info" name="update" value="Update"> 
				 <?php } elseif ($update == false) { ?>
				 	<button class="btn btn-primary" type="submit" name="save" onclick="clear()"> Save </button>
				 <?php } ?>												</div>
											
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
									<b>House List</b>
								</div>
								<div class="card-body">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>House</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											$house = $conn->query("SELECT h.*,c.name as cname FROM houses h inner join categories c on c.id = h.category_id order by id asc");
											while ($row = $house->fetch_assoc()) :
											?>
												<tr>
													<td><?php echo $i++ ?></td>
													<td class="">
														<p>House #: <b><?php echo $row['house_no'] ?></b></p>
														<p><small>House Type: <b><?php echo $row['cname'] ?></b></small></p>
														<p><small>Description: <b><?php echo $row['description'] ?></b></small></p>
														<p><small>Price: <b><?php echo number_format($row['price'], 2) ?></b></small></p>
													</td>
													<td>
													<a  class="btn btn-sm btn-primary edit_house" role="button" href="houses.php?edit=<?php echo $row['id']; ?>">Edit </a>
													<a  class="btn btn-sm btn-danger delete_house" role="button" href="houses.php?del=<?php echo $row['id']; ?>" onClick="return deldata('<?php echo $row['description']; ?>');">Delete </a>

													
														<!-- <button class="btn btn-sm btn-primary edit_house" type="button" data-id="<?php echo $row['id'] ?>" data-house_no="<?php echo $row['house_no'] ?>" data-description="<?php echo $row['description'] ?>" data-category_id="<?php echo $row['category_id'] ?>" data-price="<?php echo $row['price'] ?>">Edit</button>
														<button class="btn btn-sm btn-danger delete_house" type="button" data-id="<?php echo $row['id'] ?>">Delete</button> -->
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

			<script type="text/javascript">
			function deldata(fullname) {
      if (confirm("ARE YOU SURE YOU WISH TO DELETE " + " ' " + fullname + "' " + " house from the list?")) {
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
					margin: unset;
					padding: unset;
					line-height: 1em;
				}
			</style>
			<!-- /.control-sidebar -->
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