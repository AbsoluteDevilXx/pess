<!DOCTYPE html>
<html>
<head>
<title>Update</title>
<?php include "Head.php";
	if(!issert($_POST['btnSearch';])) {
	
	<!--Create a form to search for patrol car based on id-->

<form name="form1" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">

<table width="80%" border="0" align="center" cellpadding="4" cellspacing="4">

<tr>
		<td width="25%" class="td_label">Patrol Car ID:</td>
		
		<td width="25%" class="td_Data"><input type="text" name="patrolCarID" id="patrolCarID"</td>
		
		<!--must validate for no empty entry at the client side, HOW??? -->
		
		<td class="td_Data"><input type="submit" name="btnSearch" id="btnSearch" value="Search"></td>
		
	
</tr>
</table>
</form>
?>

<?php
	}else{
		// echo $_POST["patrolCarID"];
		//retrieve patrol car status and patrolcarstatus
		//connect to a database
		$con = mysql_connect("localhost","claudia", "Anpanman131");
		if_!con)
		{
			die('Cannot connect to database: '.mysql_error());
		}
		//select a table in the databasemysql_select_db("10_claudia_pessdb",$con);
		//retrieve patrol car status#sql="SELECT * FROM WHERE patrolCarID="'.$_POST['patrolCarID']."";
		
		$result = mysql_query($sql.$con);
		
		$patrolCarID;
		
		$patrolCarStatusID;
		
		while($row = mysql_fetch_array($result))
		{
			//patrolCarID,patrolCarStatusID
			
			$patrolCarID=$row['patrolCarID']
			$patrolCarStatusID = $row['patrolCarStatusID'];
		}
		mysql_close($con);
		
?>
</head>
</body>