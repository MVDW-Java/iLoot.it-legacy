<?php
include("./connect.php");
              $sql="SELECT * FROM Ads";
              $result = mysqli_query($con, $sql);
              $rowcount = mysqli_num_rows($result);
$advertise = rand(1,$rowcount);

?>