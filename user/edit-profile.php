<?php
session_start();
// error_reporting(0);
include('../connect.php');

if (strlen($_SESSION['applicationID']) == "") {
    header("Location: login.php");
} else {
}

$applicationID = $_SESSION["applicationID"];


date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d ');


$sql = "select * from admission where applicationID='$applicationID'";
$result = $conn->query($sql);
$rowaccess = mysqli_fetch_array($result);

if (isset($_POST["btnedit"])) {

    $fullname = mysqli_real_escape_string($conn, $_POST['txtfullname']);
    $sex = mysqli_real_escape_string($conn, $_POST['cmdsex']);
    $jamb = mysqli_real_escape_string($conn, $_POST['txtjamb']);
    $score = mysqli_real_escape_string($conn, $_POST['txtscore']);
    $exam = mysqli_real_escape_string($conn, $_POST['txtexam']);
    $phone = mysqli_real_escape_string($conn, $_POST['txtphone']);
    $lga = mysqli_real_escape_string($conn, $_POST['txtlga']);
    $state = mysqli_real_escape_string($conn, $_POST['txtstate']);
    $dept = mysqli_real_escape_string($conn, $_POST['txtdept']);
    $faculty = mysqli_real_escape_string($conn, $_POST['txtfaculty']);


    $image = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
    $image_name = addslashes($_FILES['userImage']['name']);
    $image_size = getimagesize($_FILES['userImage']['tmp_name']);
    move_uploaded_file($_FILES["userImage"]["tmp_name"], "../upload/" . $_FILES["userImage"]["name"]);
    $location = "../upload/" . $_FILES["userImage"]["name"];


    $sql1 = " update admission set fullname='$fullname',sex='$sex',passport_number='$jamb',grade_score='$score',state='$state',faculty='$faculty',dept='$dept',proficiency_test='$exam' where applicationID='$applicationID'";

    if (mysqli_query($conn, $sql1)) {

        header("Location: profile.php");
    } else {
        $_SESSION['error'] = 'Editing Was Not Successful';
    }
}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Profile|Online Student Admission system</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Morris -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />

</head>

<body>
    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img src="../<?php echo $rowaccess['photo'];  ?>" alt="image" width="142" height="153" class="img-circle" />
                            </span>


                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"><span class="text-muted text-xs block"><?php echo $rowaccess['email'];  ?> <b class="caret"></b></span> </span> </a>
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

                            <span class="m-r-sm text-muted welcome-message">Welcome to DASHBOARD.</span>

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
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>

                        <li class="active">
                            <strong>Edit Applicants</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5></h5>
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


                            <?php
                            $sql = "select * from admission where applicationID='$applicationID'";
                            $result = $conn->query($sql);
                            $row = mysqli_fetch_array($result);

                            ?>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-6 b-r">
                                        <h3 class="m-t-none m-b">Edit Applicant Profile</h3>
                                        <form action="" method="POST" enctype="multipart/form-data">


                                            <div class="form-group"><label>Passport Number</label>
                                                <input type="text" size="77" name="txtjamb" value="<?php echo $row['passport_number'];   ?>" class="form-control">
                                            </div>
                                            <div class="form-group"><strong>
                                                    <label>Fullname</label></strong>
                                                <input type="text" size="77" name="txtfullname" value="<?php echo $row['fullname'];   ?>" class="form-control" required="">
                                            </div>
                                            <div class="form-group"><label>Sex</label>
                                                <select name="cmdsex" id="select" class="form-control" required="">
                                                    <option value="<?php echo $row['sex']; ?>"><?php echo $row['sex']; ?></option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group"><label>Phone</label>
                                                <input type="tel" size="77" name="txtphone" value="<?php echo $row['phone'];   ?>" class="form-control">
                                            </div>

                                            <div class="form-group"><label>Email</label>
                                                <input type="email" size="77" name="txtlga" value="<?php echo $row['email'];   ?>" class="form-control">
                                            </div>
                                            <div class="form-group"><label>State</label>
                                                <input type="text" size="77" name="txtstate" value="<?php echo $row['state'];   ?>" class="form-control">
                                            </div>
                                            <div class="form-group"><label>Grade Score</label>
                                                <input type="number" size="77" name="txtscore" value="<?php echo $row['grade_score'];   ?>" class="form-control">
                                            </div>
                                            <div class="form-group"><label>Proficiency test</label>
                                                <input type="text" size="77" name="txtexam" value="<?php echo $row['proficiency_test'];   ?>" class="form-control">
                                            </div>
                                    </div>
                                    <div class="form-group"><label>Faculty</label>
                                        <input type="text" size="77" name="txtfaculty" value="<?php echo $row['faculty'];   ?>" class="form-control">
                                    </div>
                                    <div class="form-group"><label>Department</label>
                                        <input type="text" size="77" name="txtdept" value="<?php echo $row['dept'];   ?>" class="form-control">
                                    </div>

                                    <div class="col-sm-6">

                                        <p class="text-center">
                                            <img src="../<?php echo $row['ssce'];   ?>" alt="dhdis" width="166" height="147">
                                        </p>
                                        <p class="text-center">
                                            <input name="userImage" type="file" class="inputFile" />
                                        </p>
                                    </div>
                                    <div>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="btnedit">
                                            <div align="centre"><strong><i class="fa fa-paste"></i> Edit Profile</strong></div>
                                        </button>
                                    </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5"></div>
            </div>
            <div class="row"></div>
        </div>
        <div class="footer">
            <div class="pull-right"></div>
            <div><?php include('footer.php'); ?></div>
        </div>

    </div>
    </div>


    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
    <link rel="stylesheet" href="popup_style.css">
    <?php if (!empty($_SESSION['success'])) {  ?>
        <div class="popup popup--icon -success js_success-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
                <h3 class="popup__content__title">
                    <strong>Success</strong>
                    </h1>
                    <p><?php echo $_SESSION['success']; ?></p>
                    <p>
                        <button class="button button--success" data-for="js_success-popup">Close</button>
                    </p>
            </div>
        </div>
    <?php unset($_SESSION["success"]);
    } ?>
    <?php if (!empty($_SESSION['error'])) {  ?>
        <div class="popup popup--icon -error js_error-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
                <h3 class="popup__content__title">
                    <strong>Error</strong>
                    </h1>
                    <p><?php echo $_SESSION['error']; ?></p>
                    <p>
                        <button class="button button--error" data-for="js_error-popup">Close</button>
                    </p>
            </div>
        </div>
    <?php unset($_SESSION["error"]);
    } ?>
    <script>
        var addButtonTrigger = function addButtonTrigger(el) {
            el.addEventListener('click', function() {
                var popupEl = document.querySelector('.' + el.dataset.for);
                popupEl.classList.toggle('popup--visible');
            });
        };

        Array.from(document.querySelectorAll('button[data-for]')).
        forEach(addButtonTrigger);
    </script>
</body>

</html>