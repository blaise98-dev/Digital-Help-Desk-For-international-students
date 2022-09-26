<?php
session_start();
error_reporting(0);
include('../connect.php');

if(strlen($_SESSION['applicationID'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
	}

$applicationID = $_SESSION["applicationID"];
//Get Date
date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d');


$sql = "select * from admission where applicationID='$applicationID'"; 
$result = $conn->query($sql);
$rowaccess = mysqli_fetch_array($result);

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile|Online Student Admission system</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images//logo.jpg" type="image/x-icon" />
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
                    <span class="m-r-sm text-muted welcome-message">Welcome to DASHBOARD</span>
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
            <div class="row animated fadeInRight">
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Profile Detail</h5>
                        </div>
                        <div>
                            <div class="ibox-content no-padding border-left-right">
                                <img src="../<?php echo $rowaccess['ssce'];   ?>" alt="image" width="245" height="259" >                            </div>
                            <div class="ibox-content profile-content">
                                <h4><strong><?php echo $rowaccess['fullname'];   ?> </strong></h4>
                               
                                <h5><strong>Application ID</strong>: <?php echo $rowaccess['applicationID'];   ?></h5>
                            </div>
                        </div>
                </div>
                    </div>
                <div class="col-md-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h3>Personal Information</h3>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div>
                                <div class="feed-activity-list">

                                    <div class="feed-element">
                                        <a href="#" class="pull-left">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy"></small>
                                            <strong>Fullname :</strong>                    <?php echo $rowaccess['fullname'];   ?><strong> <br>
                                      </div>
                                    </div>
									<div class="feed-element">
                                        <a href="#" class="pull-left">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy"></small>
                                            <strong>Sex :</strong>                    <?php echo $rowaccess['sex'];   ?>  <strong><br>
                                        </div>
                                    </div>
									<div class="feed-element">
                                        <a href="#" class="pull-left">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy"></small>
                                            <strong>Email:</strong>                    <?php echo $rowaccess['email'];   ?>  <strong><br>
                                        </div>
                                    </div>
									<div class="feed-element">
                                        <a href="#" class="pull-left">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy"></small>
                                            <strong>Phone :</strong>                    <?php echo $rowaccess['phone'];   ?><strong>  <br>
                                        </div>
                                    </div>


									<div class="feed-element">
                                        <a href="#" class="pull-left">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy"></small>
                                            <strong>Country :</strong>                    <?php echo $rowaccess['lga'];   ?> <strong> <br>
                                        </div>
                                    </div>
									<div class="feed-element">
                                        <a href="#" class="pull-left">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy"></small>
                                            <strong>State :</strong>                    <?php echo $rowaccess['state'];   ?> <strong> <br>
                                        </div>
                                    </div>
									<div class="feed-element">
                                        <a href="#" class="pull-left">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy"></small>
                                            <strong>Passport Number :</strong>                    <?php echo $rowaccess['passport_number'];   ?><strong>  <br>
                                        </div>
                                    </div>
                                  <div class="feed-element">
                                        <a href="#" class="pull-left">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy"></small>
                                            <strong>Grade Score :</strong>                    <?php echo $rowaccess['grade_score'];   ?> <strong> <br>
                                        </div>
                                    </div>
									 <div class="feed-element">
                                        <a href="#" class="pull-left">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy"></small>
                                            <strong>Department Applied :</strong>                    <?php echo $rowaccess['dept'];   ?><strong>  <br>
                                        </div>
                                    </div>
									 <div class="feed-element">
                                        <a href="#" class="pull-left">
                                        </a>
                                        <div class="media-body ">
                                            <small class="pull-right text-navy"></small>
                                            <strong> Poficiency Test :</strong>                    <?php echo $rowaccess['proficiency_test'];   ?>  <br>
                                        </div>
                                    </div>
                                </div>
								<form method="post" action="edit-profile.php">

                                <button class="btn btn-primary btn-block m"><i class="fa fa-edit"></i> Edit Profile</button>

</form>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer">
            <div class="pull-right">
            </div>
            <div>
                <?php include('footer.php'); ?>
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>

    <!-- Peity -->
    <script src="js/demo/peity-demo.js"></script>

</body>

</html>
