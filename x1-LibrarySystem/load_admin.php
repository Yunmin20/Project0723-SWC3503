<?php
	require_once 'connect.php';
	$qedit_admin = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = '$_REQUEST[admin_id]'") or die(mysqli_error());
	$fedit_admin = $qedit_admin->fetch_array();
?>
<div class = "col-lg-3"></div>
<div class = "col-lg-6">
	<form method = "POST" action = "edit_admin_query.php?admin_id=<?php echo $fedit_admin['admin_id']?>" enctype = "multipart/form-data">
		<div class = "form-group">
			<label>Username:</label>
			<input type = "text" value = "<?php echo $fedit_admin['username']?>" required = "required" name = "username" class = "form-control" />
		</div>	
		<div class = "form-group">	
			<label>Password:</label>
			<input type = "text" value = "<?php echo $fedit_admin['password']?>"  maxlength = "12" name = "password" required = "required" class = "form-control" />
		</div>	
		<div class = "form-group">	
			<label>Full Names:</label>
			<input type = "text" value = "<?php echo $fedit_admin['fullname']?>"  name = "fullname" required = "required" class = "form-control" />
		</div>	
		<div class = "form-group">	
			<button class = "btn btn-warning" name = "edit_admin"><span class = "glyphicon glyphicon-edit"></span> Save Changes</button>
		</div>
	</form>		
</div>	
