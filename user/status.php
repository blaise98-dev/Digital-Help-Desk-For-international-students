    <link rel="shortcut icon" href="../images/logo.jpg" type="image/x-icon" />

    <?php
    session_start();
    error_reporting(0);
    include('../connect.php');

    $applicationID = $_SESSION['applicationID'];

    ?>
    <style>
      @media print {
        @page {
          margin: 0mm;
        }

        body {
          margin: 1.6cm;
        }
      }
    </style>
    <div id="content">
      <div class="content_item" class="container">
        <div class="col-md-12">
          <button class="btn btn-primary" onclick="printadmission()">Print</button>

          <div class="well well-md" id="print">
            <p>
              <?php
              $sql = "SELECT * FROM admission WHERE applicationID = '$applicationID' AND status = '1'";
              $result = mysqli_query($conn, $sql);
              ($row = mysqli_fetch_assoc($result));
              if ($row['status'] == '1') {
              ?>
            </p>
            <p><img src="../images/aucalogo.jpg" width="700" height="100" /></p><br><br>
            <?php echo date('jS F Y'); ?><br>
            <h2><u>Letter of Admission to <?php echo $row['fullname'] ?></u></h2>

            <p>Dear <b><?php echo $row['fullname'] . "," ?></b> Admission number: <b><?php echo $row['applicationID'] ?> </b></p>
            <p>
              Congratulations! We are pleased to offer you admission to AUCA, Rwanda.
            </p>
            <p>
              <?php
                $acceptancedate = strtotime("+7 day");
                $tuitionfeedate = strtotime("+30 day"); ?>
              Procedure for payment of acceptance fee, academic clearance & payment of tuition fee you are expected to pay the acceptance fee on or before

              <b><?php echo date('jS F Y', $acceptancedate); ?>.</b><br> Please note that the acceptance fee is non-refundable and does not guarantee your admission. Note that under no circumstance would the date for the payment of acceptance fee be extended.

            <ol>
              <li>Pay your acceptance fee on the following bank account: <b>00040-00280275-75 (Bank of Kigali)</b></li>
              <li>Print your acceptance fee receipt and clearance schedule.</li>
              <li>Keep your receipt and clearance schedule for registration.

              </li>
              <li>Deadline for payment of tuition fee is:

                <b><?php echo date('jS F Y', $acceptancedate); ?>.</b>
              </li>
            </ol>
            <h3>The following documents are required for registration:

            </h3>
            <ol>
              <li>Transcript/equivalence.

              </li>
              <li>Application slip.

              </li>
              <li>Admission slip.

              </li>
              <li>Acceptance fee receipt.

              </li>
              <li>Receipt for payment made for change of course/institution. (if applicable)

              </li>
            </ol>


            <b>Tuition fee must be paid by

              <?php echo date('jS F Y', $acceptancedate); ?> Failing which you forfeit this provisional offer of admission.

            </b><br><br><br>

            Signed by <br>
            ---------------------<br>
            Academic Registrar
            </p>

          <?php } else { ?>
            <h4 style="color:red">Sorry, no Admission yet. Check back later.</h4>
          <?php } ?>

          </div>
        </div>
      </div>
      <!--close content-->
    </div>
    <!--close site_content-->
    <script>
      function printadmission() {
        var prtContent = document.getElementById("print");
        var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();
      }
    </script>