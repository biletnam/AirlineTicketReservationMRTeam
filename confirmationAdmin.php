<?php 
include 'header/headerAdmin.php';
?>


<!DOCTYPE html>
<html>
<head>
	<title>Confirmation Panel</title>
	<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="css/form.css" type="text/css">
<style type="text/css">
	table{
		border: 1px solid white;
	}
	tr{
		border: 1px solid white;
	}
	td,th{
		border: 1px solid white;
		padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 15px;
        padding-right: 15px;
	}
	table td a{
		color: white;
	}
	.inpt{
		width: 50px;
	}
</style>
</head>
<body>
<center>
	<h1>Confirmation Panel</h1><br><br>
	<div style="width: 300px;">
	
	<form>
		<input class="inpt" type="text" name="srch" placeholder="Give Your PNR">
		<input type="submit" name="submit" value="SEARCH">
	</form>
	</div>
</center>
<center>
	<table>
		<tr>
			<th>
				<label>Flight Number</label>
			</th>
			<th>
				<label>PNR Number</label>
			</th>
			<th>
				<label>First Name</label>
			</th>
			<th>
				<label>Last Name</label>
			</th>
			<th>
				<label>Phone Number</label>
			</th>
			<th>
				<label>Email</label>
			</th>
			<th>
				<label>Date Booking</label>
			</th>
			<th>
				<label>Amount</label>
			</th>
			<th>
				<label>Accept</label>
			</th>
		</tr>

<?php
	if(isset($_GET['submit'])){
		if($_GET['srch']!=null){
			$pnr = $_GET['srch'];
			$sql="SELECT * FROM `sas`.`flight` where `pnr` = '$pnr' ORDER BY `id`";
		}else{
			$sql="SELECT * FROM `sas`.`flight` ORDER BY `id`";
		}
	}else{
		$sql="SELECT * FROM `sas`.`flight` ORDER BY `id`";
	}        
    
    $result=  mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        while ($row=mysqli_fetch_assoc($result)){
?>
	<tr>
		<td>
			<?php echo $row['flightNumber']; ?>
		</td>
		<td>
			<?php echo $row['pnr']; ?>
		</td>
		<td>
			<?php echo $row['fname']; ?>
		</td>
		<td>
			<?php echo $row['lname']; ?>
		</td>
		<td>
			<?php echo $row['phone']; ?>
		</td>
		<td>
			<?php echo $row['email']; ?>
		</td>
		<td>
			<?php echo $row['dob']; ?>
		</td>
		<td>
			<?php echo $row['amount']; ?>
		</td>
		<td>
			<?php 
			if($row['accept'] == 0){
?>
		<a href="ConfirmFlightCode.php?pnr=<?php echo $row['pnr']?>" style="color: red;">Confirm</a> / <a style="color: yellow" href="CancelRservAdmin.php?pnr=<?php echo $row['pnr']?>">Cancel</a>

<?php
			}else if($row['accept'] == 1){
?>

			<p>Confirmed</p>  / <a style="color: yellow" href="CancelRservAdmin.php?pnr=<?php echo $row['pnr']?>">Cancel</a> / <a style="color: Magenda" href="print.php?pnr=<?php echo $row['pnr']?>">Show Ticket</a>
			
<?php 
			}

?>
		</td>

	</tr>
<?php }}else{
	echo "<script type='text/javascript'>alert('PNR Not Matched');</script>";
}?>

	</table>
</center>




<br><br>


<?php include 'footer.php';?>
</body>
</html>