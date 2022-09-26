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
                margin: 0;
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
                    <h3> <b>Director General,<br>
                            Immigration and Emigration</b></h3 <br>
                    Kigali, Rwanda</h3>
                    <h3>RE: Recommending <b><?php echo $row['fullname'] ?></b> for a Study Visa
                        application.</h3>

                    <p>
                        We are pleased to recommend <?php echo $row['fullname'] ?>, a regular student at the
                        Adventist University of Central Africa (AUCA), for a Study Visa application.<br> He is a citizen of
                        <?php echo $row['lga'] ?>. <?php echo $row['fullname'] ?> is registered in the Faculty of Information Technology, Department of
                        Software Engineering.<br>
                        As a student of AUCA, we are hereby recommending him for the Study Visa application to allow
                        him legally stay in the country as per laws/regulations concerning international students.<br>
                        <br>
                        <br>
                        We thank you for your usual collaboration.</ol>
                        <br>
                        <br>
                        <br>
                        <br>


                        <br><br><br>
                        <b>NIYONZIMA Théogène, PhD. WAND</b>
                    <p>Deputy Vice Chancellor for Academics<br>
                        Email: Phone:dvc.academics@auca.ac.rw +250 788 816 014/0724 474806 | theogene.niyonzima@auca.ac.rw</p>
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