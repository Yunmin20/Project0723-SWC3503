<!DOCTYPE html>
<?php
	require_once 'valid.php';
?>	
<html lang = "eng">
	<head>
		<title>Library Management System</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/chosen.min.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
	</head>
	<body style = "background-color:#d3d3d3;">
		<nav class = "navbar navbar-default navbar-fixed-top">
			<div class = "container-fluid">
				<div class = "navbar-header">
					<h4 class = "navbar-text navbar-right">Library Management System</h4>
				</div>
			</div>
		</nav>
		<div class = "container-fluid">
			<div class = "col-lg-2 well" style = "margin-top:60px;">
				<div class = "container-fluid">
					<br />
					<br />
					<label class = "text-muted"><?php require'account.php'; echo "Hello ".$name.", [ADMIN]";?></label>
				</div>
				<hr style = "border:1px dotted #d3d3d3;"/>
				<ul id = "menu" class = "nav menu">
					
					<li><a  style = "font-size:18px; border-bottom:1px solid #d3d3d3;" href = ""><i class = "glyphicon glyphicon-cog"></i> Settings</a>
						<ul style = "list-style-type:none;">
							<li><a style = "font-size:15px;" href = "logout.php"><i class = "glyphicon glyphicon-log-out"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div class = "col-lg-1"></div>
			<div class = "col-lg-9 well" style = "margin-top:60px;">
				<div class = "alert alert-info">Search Book</div>
				<form method = "POST" action = "borrow.php" enctype = "multipart/form-data">


					<table id = "table" class = "table table-bordered">
						<thead class = "alert-success">
							<tr>
								<th>Book Title</th>
								<th>Book Author</th>
								<th>ISBN</th>
								<th>Version</th>
								<th>Shelf Number</th>
								<th>Quantity</th>
								<th>Left</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i= 0;
								$q_book = $conn->query("SELECT * FROM `book`") or die(mysqli_error());
								while($f_book = $q_book->fetch_array()){
								$q_borrow = $conn->query("SELECT SUM(qty) as total FROM `borrowing` WHERE `book_id` = '$f_book[book_id]' && `status` = 'Borrowed'") or die(mysqli_error());
								$new_qty = $q_borrow->fetch_array();
								$total = $f_book['qty'] - $new_qty['total'];
							?> 
							<tr>
								<td><?php echo $f_book['book_title']?></td>
								<td><?php echo $f_book['book_author']?></td>
								<td><?php echo $f_book['book_isbn']?></td>
								<td><?php echo date("m-d-Y", strtotime($f_book['date_publish']))?></td>
								<td><?php echo $f_book['book_shelf']?></td>
								<td><?php echo $f_book['qty']?></td>
								<td><?php echo $total ?></td>
							</tr>
							<?php
							$i++;
								}
							?>
						</tbody>
					</table>
				</form>
			</div>
		</div>

	</body>
	<script src = "js/jquery.js"></script>
	<script src = "js/bootstrap.js"></script>
	<script src = "js/login.js"></script>
	<script src = "js/sidebar.js"></script>
	<script src = "js/jquery.dataTables.js"></script>
	<script src = "js/chosen.jquery.min.js"></script>	
	<script type = "text/javascript">
		$(document).ready(function(){
			$("#student").chosen({ width:"auto" });	
		})
	</script>
	<script type = "text/javascript">
		$(document).ready(function(){
			$("#table").DataTable();
		});
	</script>
</html>