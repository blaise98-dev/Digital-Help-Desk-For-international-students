<?php
session_start();
error_reporting(0);
include('../connect.php');

if (isset($_POST['uploadVisaDocuments'])) {
  // File upload configuration 
  $targetDir = "../upload/";
  $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF','pdf');
  $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
  $fileNames = array_filter($_FILES['files']['name']);
  if (!empty($fileNames)) {
      foreach ($_FILES['files']['name'] as $key => $val) {
          // File upload path 
          // $fileName = basename($_FILES['files']['name'][$key]);

          $temp = explode(".", $_FILES["files"]["name"][$key]);

          $newfilename = $_SESSION["applicationID"] . '_visaDoc_' . $temp[0] . '.' . end($temp);
          $targetFilePath = $targetDir . $newfilename;

          // Check whether file type is valid 
          $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
          if (in_array($fileType, $allowTypes)) {
              // Upload file to server 
              if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                  // Image db insert sql 
                  $insertValuesSQL .= "('" . $newfilename . "'),";
                  echo $insertValuesSQL;
                  echo $_SESSION["applicationID"];
              } else {
                  $errorUpload .= $_FILES['files']['name'][$key] . ' | ';
              }
          } else {
              $errorUploadType .= $_FILES['files']['name'][$key] . ' | ';
          }


          // Error message 
          $errorUpload = !empty($errorUpload) ? 'Upload Error: ' . trim($errorUpload, ' | ') : '';
          $errorUploadType = !empty($errorUploadType) ? 'File Type Error: ' . trim($errorUploadType, ' | ') : '';
          $errorMsg = !empty($errorUpload) ? '<br/>' . $errorUpload . '<br/>' . $errorUploadType : '<br/>' . $errorUploadType;

          if (!empty($insertValuesSQL)) {
              $insertValuesSQL = trim($insertValuesSQL, ',');
              // Insert image file name into database 

              $insert = mysqli_query($conn, "INSERT INTO documents (file_name,reason, document_owner) VALUES ('" . $newfilename . "','visa','" . $_SESSION["applicationID"] . "')");
              if ($insert) {
                  $statusMsg = "Files are uploaded successfully." . $errorMsg;
?>
                  <script>
                      alert(<?php echo $statusMsg ?>);
                  </script>
              <?php
                  header('Location:index.php');
              } else {
                  $statusMsg = "Sorry, there was an error uploading your file.";
              ?>
                  <script>
                      alert(<?php echo $statusMsg ?>)
                  </script>
              <?php
              }
          } else {
              $statusMsg = "Upload failed! " . $errorMsg;
              ?>
              <script>
                  alert(<?php echo $statusMsg ?>)
              </script>
      <?php
          }
      }
  } else {
      $statusMsg = 'Please select a file to upload.';
      ?>
      <script>
          alert(<?php echo $statusMsg ?>)
      </script>
<?php
  }

}

if (isset($_POST['save_payment'])) {

    function GUID()
    {
      return strtoupper(bin2hex(openssl_random_pseudo_bytes(8)));
    }
    $trcode = GUID();
    $insert = mysqli_query($conn, "INSERT INTO `payments`(`payfor`, `month`,`amount`, `transaction_code`,`phone`, `academic_year`, `status`, `applicationID`)
    VALUES ('" . $_POST['payfor'] . "','" . $_POST['month'] . "','" . $_POST['amount'] . "','$trcode','" . $_POST['phone'] . "','" . $_POST['academic_year'] . "','pending','" . $_SESSION["applicationID"] . "')");

      $data = array(
      "telephoneNumber" => '25'.$_POST['phone'],
      "amount" =>  $_POST['amount'],
      "organizationId" => 'e8f3a6da-dda2-429f-8cfb-935fc996a7f5',
      "description" =>$_SESSION["applicationID"].' paid '.$_POST['payfor'],
      "callbackUrl" => "http://myonlineprints.com/payments/callback",
        "transactionId" => "$trcode"

    );
    $headers=array(
      "Content-Type"=> "application/json",
      "Accept"=> "application/json",
      "Host"=>"localhost:8080",
      "Content-Length"=> 290);
      $url = "https://opay-api.oltranz.com/opay/paymentrequest";
      $data = http_build_query($data);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $headers);
      curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
      $result = curl_exec($ch);
      $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch); 
      header("Location: payments.php");
}


if (strlen($_SESSION['applicationID']) == "" || !isset($_SESSION["applicationID"])) {
    header("Location: login.php");
} else {
}

$applicationID = $_SESSION['applicationID'];

$sql = "select * from admission where applicationID='$applicationID'";
$result = $conn->query($sql);
$rowaccess = mysqli_fetch_array($result);

date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d H:i:s');

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Dashboard</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon" />

</head>



<body>

    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img src="../<?php echo $rowaccess['ssce'];  ?>" alt="image" width="142" height="153" class="img-circle" />
                            </span>


                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"><span class="text-muted text-xs block"><?php echo $rowaccess['applicationID'];  ?> <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">

                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <?php
                        include('sidebar.php');

                        ?>

                </ul>


            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>


                            <span class="m-r-sm text-muted welcome-message">Welcome to your Dashboard</span>
                        </li>
                        <li class="dropdown">




                        <li>
                            <a href="logout.php">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>

                    </ul>

                </nav>
            </div>
            <div class="wrapper wrapper-content">
                <div class="row">
                     <div class="col-md-3 m-2">
							<form action="#" method="POST">
								<div class="card">
									<div class="card-header">
										<h3><b>Add new Payment</b></h3>
									</div>
										<div class="row form-group">
									
                                            <select class="form-control" name="payfor">	
                                                <option value=" " selected disabled>Payment for</option>
                                                <option value="registration">Registration</option>
                                                <option value="accomodation">Accomodation</option>
                                                </select>	
									    </div>
                                        
									<div class="form-group row">
                                        <input type="month" class="form-control" name="month"   placeholder="Month" required>
										</div> 
                                        <div class="form-group row">
											<input type="text" class="form-control" name="academic_year" placeholder="Academic year"  required>
										
                                        </div>
										<div class="form-group row">
												<input type="number" class="form-control" name="amount" placeholder="Amount" required>
										</div>
                                        <div class="form-group row">
												<input type="number" class="form-control" name="phone" placeholder=" payment phone eg:0788465848" required>
										</div>
                                        <div class="form-group row">
                                                <button class="btn btn-primary" type="submit" name="save_payment" onclick="clear()"> Save </button>
                                           
                 						</div>
									
								</div>
							</form>
					    </div>
						<!-- FORM Panel -->

						<!-- Table Panel -->
					<div class="col-md-9">
						<div class="card">
								<div class="card-header">
									<h3><b>List of Payments</b></h3>
								</div>
								<div class="card-body">
									<table class="table table-condensed table-bordered table-hover">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="">Payment type</th>
                                                <th class="">Period</th>
												<th class="">Amount</th>
                                                <th class="">TransactionId</th>
                                                <th class="">Phone number</th>
												<th class="">Academic year</th>
                                                <th class="">Date</th>
												<th class="text-center">Status</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											$tenant = $conn->query("SELECT * FROM payments where applicationID = ".$_SESSION['applicationID']." ");
											while ($row = $tenant->fetch_array()):
											?>
												<tr>
													<td class="text-center"><?php echo $i++ ?></td>
													<td>
														<?php echo $row['payfor'] ?>
													</td>
                                                    <td>
														<?php echo $row['month'] ?>
													</td>
													<td class="text-center"> <b><?php echo $row['amount'] ?></b>

													</td>
                                                    <td class="text-center"> <b><?php echo $row['transaction_code'] ?></b>

													</td>
                                                    <td class="text-center"> <b><?php echo $row['phone'] ?></b>

</td>
													<td class="">
														<p> <b><?php echo $row['academic_year'] ?></b></p>
													</td>
                                                    <td class="text-center">
														<?php echo $row['date_created'] ?>
													</td>
													<td class="text-center">
                                                        
														<p class="btn-sm btn-primary"> <b><?php echo $row['status'] ?></b></p>

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
                    <div class="footer">

                        <div>
                            <?php include('footer.php');  ?> </div>
                    </div>
                </div>
            </div>
<style>
    input[type="month"]::before {
	color: #999999;
	content: attr(placeholder);
}
input[type="month"] {
	color: #ffffff;
}
input[type="month"]:focus,
input[type="month"]:valid {
	color: #666666;
}
input[type="month"]:focus::before,
input[type="month"]:valid::before {
	content: "" !important;
}</style>
            <!-- Mainly scripts -->
            <script src="js/jquery-2.1.1.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
            <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

            <!-- Flot -->
            <script src="js/plugins/flot/jquery.flot.js"></script>
            <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
            <script src="js/plugins/flot/jquery.flot.spline.js"></script>
            <script src="js/plugins/flot/jquery.flot.resize.js"></script>
            <script src="js/plugins/flot/jquery.flot.pie.js"></script>
            <script src="js/plugins/flot/jquery.flot.symbol.js"></script>
            <script src="js/plugins/flot/jquery.flot.time.js"></script>

            <!-- Peity -->
            <script src="js/plugins/peity/jquery.peity.min.js"></script>
            <script src="js/demo/peity-demo.js"></script>

            <!-- Custom and plugin javascript -->
            <script src="js/inspinia.js"></script>
            <script src="js/plugins/pace/pace.min.js"></script>

            <!-- jQuery UI -->
            <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

            <!-- Jvectormap -->
            <script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
            <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

            <!-- EayPIE -->
            <script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

            <!-- Sparkline -->
            <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

            <!-- Sparkline demo data  -->
            <script src="js/demo/sparkline-demo.js"></script>
</body>

</html>