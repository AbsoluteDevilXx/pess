<?php
	if(!isset($_POST['btnProcessCall']) && !isset($_POST['bthDispatch']))
		header("Location: logcall.php");
?>

<DOCTYPE HTML>
<html>
<head>
<title>Dispatch</title>
<script>
	function validateForm()
	{
		var x = document.forms["frmLogCall"]["callerName"].value;
		if (x == "")
		{
			alert("Name must be filled out");
			return false;
		}
	}	
</script>

<?php include 'head.php' ?>
</head>
<body>
<?php
/* Search and retrieve similar pending incidents
and populate a table */

//Connect to a database
$con = mysql_connect("localhost","claudia","Anpanman131");
if(!$con)
{
	die('Cannot connect to database: ' . mysql_error());
}

// select a table in the database
mysql_select_db("10_claudia_pessdb", $con);

$sql = "SELECT patrolcarID, statusDESC FROM patrolcar JOIN patrolcar_status
ON patrolcar.patrolcarStatusID=patrolcar_status.statusID
WHERE patrolcar.patrolcarStatusID='2' OR patrolcar.patrolcarStatusID='3'";

$result = mysql_query($sql, $con);

$incidentArray;
$count=0;

while($row= mysql_fetch_array($result))
{
	$patrolcarArray[$count]=$row;
	$count++;
}
if(!mysql_query($sql,$con))
{
	die('Error: ' . mysql_error());
}

mysql_close($con);

?>
<form name="dispatchForm" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
<table>
				<tr>
					<td>Caller Name:</td>
					<td>
						<?php echo $_POST['callerName'];?>
						<input type="hidden" name="callerName" value="<?php $_POST['callerName']; ?>" />
					</td>
				</tr>
			</table>

<table width="40%" border="1" align="center" cellpadding="4" cellspacing="8">
<tr>
<td width ="20%">&nbsp;</td>
<td width ="51%">Patrol Car ID</td>
<td width="29%">Status</td>
</tr>

<?php
$i=0;
while($i < $count) {
?>
<tr>
<td class="td_label"><input type="checkbox" name="chkPatrolCar[]" value="<?php echo $patrolcarArray[$i]['patrolcarID']?>"></td>
<td><?php echo $patrolcarArray[$i]['patrolcarID']?></td>
<td><?php echo $patrolcarArray[$i]['statusDESC']?></td>
</tr>

<?php $i++;
} ?>
</table>
<table>
<table width="80%" border="0" align="center" cellpadding="4" cellspacing="4">
<td width="46%" class="td_label"><input type="reset" name="btnCancel" id="btnCancel" value="Reset"></td>
<td width="54%" class="td_Data">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="btnSubmit" id="btnSubmit" value="Submit">
</td>
</table>
</body>
</html>
	 
	