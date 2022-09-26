<?php
session_start();
include('../connect.php');

$applicationID = $_SESSION['applicationID'];

 $sql = "SELECT * FROM admission WHERE applicationID='". $applicationID."'";
  $result = mysqli_query($conn, $sql);
($row = mysqli_fetch_assoc($result));
if (mysqli_num_rows($result) > 0) {
// output data of each row

 ?>
									
<script type="text/javascript" language="Javascript">
window.location = "index.php";
window.open('status.php');
</script>

	<?php	}


?>