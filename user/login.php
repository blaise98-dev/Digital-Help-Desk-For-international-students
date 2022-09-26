<?php
session_start();
include('../connect.php');

if (isset($_POST['btnlogin'])) {


  //Get Date
  date_default_timezone_set('Africa/Lagos');
  $current_date = date('Y-m-d h:i:s');
  $applicationID = $_POST['txtapplicationID'];
  $password = $_POST['txtpassword'];
  $sql = "SELECT * FROM admission WHERE applicationID='" . $applicationID . "' and password = '" . $password . "'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    ($row = mysqli_fetch_assoc($result));
    $_SESSION["applicationID"] = $row['applicationID'];

    header("Location: index.php");
  } else {

    $_SESSION['error'] = ' Wrong Application ID';
  }
}

?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Login Form</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon" />


</head>

<body class="white-bg">

  <div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
      <div>

        <h1 class="logo-name"><img src="../images/logo.jpg" alt="Online student admission form" width="176" height="164"></h1>

      </div>
      <h3>&nbsp;</h3>
      <form class="m-t" role="form" method="POST" action="">
        <div class="form-group">
          <input type="text" name="txtapplicationID" class="form-control" placeholder="Application Id" required="">
        </div>
        <div class="form-group">
          <input type="password" name="txtpassword" class="form-control" placeholder="Password" required="">
        </div>

        <button type="submit" name="btnlogin" class="btn btn-primary block full-width m-b">Login</button>




        <p class="text-muted text-center">&nbsp;</p>
      </form>
      <p class="m-t"></p>

    </div>
  </div>

  <?Php include('footer.php'); ?>
  <!-- Mainly scripts -->
  <script src="js/jquery-2.1.1.js"></script>
  <script src="js/bootstrap.min.js"></script>
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