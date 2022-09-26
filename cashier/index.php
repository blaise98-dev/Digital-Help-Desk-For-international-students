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

  <style>
    body {
      background: #80808045;
    }

    .modal-dialog.large {
      width: 80% !important;
      max-width: unset;
    }

    .modal-dialog.mid-large {
      width: 50% !important;
      max-width: unset;
    }

    #viewer_modal .btn-close {
      position: absolute;
      z-index: 999999;
      /*right: -4.5em;*/
      background: unset;
      color: white;
      border: unset;
      font-size: 27px;
      top: 0;
    }

    #viewer_modal .modal-dialog {
      width: 80%;
      max-width: unset;
      height: calc(90%);
      max-height: unset;
    }

    #viewer_modal .modal-content {
      background: black;
      border: unset;
      height: calc(100%);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #viewer_modal img,
    #viewer_modal video {
      max-height: calc(100%);
      max-width: calc(100%);
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

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
            <img src="../upload/no_image.jpg" alt="User Image" width="300" height="150" class="img-circle elevation-2">
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
            <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
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

      <div class="containe-fluid">
        <div class="row mt-3 ml-3 mr-3">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <div class="card border-primary">
                      <div class="card-body bg-primary">
                        <div class="card-body text-white">
                          <span class="float-right summary_icon"> <i class="fa fa-home "></i></span>
                          <h4><b>
                              <?php echo $conn->query("SELECT * FROM payments where status='paid'")->num_rows ?>
                            </b></h4>
                          <p><b>Total Payments</b></p>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-lg-12">
                            <a href="payments.php" class="text-primary float-right">View List <span class="fa fa-angle-right"></span></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <div class="card border-primary">
                      <div class="card-body bg-secondary">
                        <div class="card-body text-white">
                          <span class="float-right summary_icon"> <i class="fa fa-home "></i></span>
                          <h4><b class="badge badge-danger rounded-circle">
                              <?php echo $conn->query("SELECT * FROM payments where status='pending'")->num_rows ?>
                            </b></h4>
                          <p><b>pending Payments</b></p>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-lg-12">
                            <a href="pending_payments.php" class="text-primary float-right">View List <span class="fa fa-angle-right"></span></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <div class="card border-warning">
                      <div class="card-body bg-warning">
                        <div class="card-body text-white">
                          <span class="float-right summary_icon"> <i class="fa fa-user-friends "></i></span>
                          <h4><b>
                              <?php echo $conn->query("SELECT t.*,concat(t.lastname,' ',t.firstname,' ') as name,h.house_no,h.description,h.price FROM tenants t inner join houses h on h.id = t.house_id where t.status = 1 order by h.house_no desc  ")->num_rows ?>
                            </b></h4>
                          <p><b>Total Tenants</b></p>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-lg-12">
                            <a href="tenants.php" class="text-primary float-right">View List <span class="fa fa-angle-right"></span></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <div class="card border-success">
                      <div class="card-body bg-success">
                        <div class="card-body text-white">
                          <span class="float-right summary_icon"> <i class="fa fa-file-invoice "></i></span>
                          <h4><b>
                              <?php
                              $payment = $conn->query("SELECT * FROM admission where status = 1 ");
                              echo $payment->num_rows;
                              ?>
                            </b></h4>
                          <p><b>Total applicants</b></p>
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col-lg-12">
                            <a href="user-record.php" class="text-primary float-right">View List <span class="fa fa-angle-right"></span></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>

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
<script>
  window.start_load = function() {
    $('body').prepend('<di id="preloader2"></di>')
  }
  window.end_load = function() {
    $('#preloader2').fadeOut('fast', function() {
      $(this).remove();
    })
  }
  window.viewer_modal = function($src = '') {
    start_load()
    var t = $src.split('.')
    t = t[1]
    if (t == 'mp4') {
      var view = $("<video src='" + $src + "' controls autoplay></video>")
    } else {
      var view = $("<img src='" + $src + "' />")
    }
    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
    $('#viewer_modal .modal-content').append(view)
    $('#viewer_modal').modal({
      show: true,
      backdrop: 'static',
      keyboard: false,
      focus: true
    })
    end_load()

  }
  window.uni_modal = function($title = '', $url = '', $size = "") {
    start_load()
    $.ajax({
      url: $url,
      error: err => {
        console.log()
        alert("An error occured")
      },
      success: function(resp) {
        if (resp) {
          $('#uni_modal .modal-title').html($title)
          $('#uni_modal .modal-body').html(resp)
          if ($size != '') {
            $('#uni_modal .modal-dialog').addClass($size)
          } else {
            $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
          }
          $('#uni_modal').modal({
            show: true,
            backdrop: 'static',
            keyboard: false,
            focus: true
          })
          end_load()
        }
      }
    })
  }
  window._conf = function($msg = '', $func = '', $params = []) {
    $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
    $('#confirm_modal .modal-body').html($msg)
    $('#confirm_modal').modal('show')
  }
  window.alert_toast = function($msg = 'TEST', $bg = 'success') {
    $('#alert_toast').removeClass('bg-success')
    $('#alert_toast').removeClass('bg-danger')
    $('#alert_toast').removeClass('bg-info')
    $('#alert_toast').removeClass('bg-warning')

    if ($bg == 'success')
      $('#alert_toast').addClass('bg-success')
    if ($bg == 'danger')
      $('#alert_toast').addClass('bg-danger')
    if ($bg == 'info')
      $('#alert_toast').addClass('bg-info')
    if ($bg == 'warning')
      $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({
      delay: 3000
    }).toast('show');
  }
  $(document).ready(function() {
    $('#preloader').fadeOut('fast', function() {
      $(this).remove();
    })
  })
  $('.datetimepicker').datetimepicker({
    format: 'Y/m/d H:i',
    startDate: '+3d'
  })
  $('.select2').select2({
    placeholder: "Please select here",
    width: "100%"
  })
</script>

</html>