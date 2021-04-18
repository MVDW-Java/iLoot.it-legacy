<?PHP
	include("connect.php");
	
	  $sql="SELECT * FROM members WHERE username='".$_SESSION["email"]."'";
	  $result = mysqli_query($con, $sql);
	  $row = mysqli_fetch_assoc($result);
	  $rowcount = mysqli_num_rows($result);

	  if($row['discordID'] == 0){

		  echo "Connect You Discord Account";

	  } else {

		  echo "".$row['discordID']."";

	  }
?>