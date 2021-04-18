<style>
#p01 {
  border-radius: 25px; 
  width: 750px; 
  height: 240px;
}
</style>
<center>
<?php
include("./connect.php");

include("assets/php/ads.php");
              $sql="SELECT * FROM Ads WHERE ID='".$advertise."'";
              $result = mysqli_query($con, $sql);
              $row = mysqli_fetch_assoc($result);
              $rowcount = mysqli_num_rows($result);

echo "<a href=\"" . $row['Link'] . "\"><img src=\"" . $row['Imagre'] . "\" id=\"p01\"</a>";
?>
<p></p>

</a>
</center>