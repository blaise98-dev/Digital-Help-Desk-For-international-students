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


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>List of Admitted students in AUCA</title>
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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css    ">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="container-fluid">

				<div class="col-lg-12">

					<div class="row" >

						<!-- Table Panel -->
						<div class="col-md-12">
						<div class="card">
								<div class="card-header">
									<b>List of Admitted students in AUCA </b>
								</div>
								<div class="card-body">
									<table class="table table-condensed table-bordered table-hover" id="example">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="">Full Name</th>
												<th class="">Passport number</th>
												<th class="">ApplicationId</th>
                                                <th class="">Email</th>                                    
                                                <th class="">Gender</th>
												<th class="">Country</th>
												<th class=""> Status</th>
												<th class="">Faculty</th>
                                                <th class="">Department</th>

											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											$admission = $conn->query("SELECT * FROM `admission` where status = 1 ");
											while ($row = $admission->fetch_assoc()) :
												
											?>
												<tr>
													<td class="text-center"><?php echo $i++ ?></td>
													<td>
														<?php echo ucwords($row['fullname']) ?>
													</td>
													<td class="">
														<p><?php echo $row['passport_number'] ?></p>

													</td>
													<td class="">
														<p><?php echo $row['applicationID'] ?></p>
													</td>
                                                    <td class="">
														<p> <?php echo $row['email'] ?></p>
													</td>
                                                    <td class="">
														<p> <?php echo $row['sex'] ?></p>
													</td>
                                                    <td class="">
														<p> <?php echo $row['lga'] ?></p>
													</td>
                                                    <td class="">
														<p> admitted</p>
													</td>
                                                    <td class="">
														<p> <?php echo $row['faculty'] ?></p>
													</td>
                                                    <td class="">
														<p> <?php echo $row['dept'] ?></p>
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
		<!-- ./wrapper -->

		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
		<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js "></script>
		<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
		<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
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