<!DOCTYPE html>
<?php
require_once 'valid.php';
if (isset($_POST['submit'])) {
	$student_no = $_POST['student_no'];
	$username = $_POST['username'];
	$fullname = $_POST['fullname'];
	$course = $_POST['course'];
	$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$query = "INSERT INTO `student`(`student_no`, `username`, `fullname`, `course`, `password`) VALUES (?,?,?,?,?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("sssss", $student_no, $username, $fullname, $course, $hashed_password);

	if ($stmt->execute()) {
		echo "New student added successfully";
	} else {
		echo "Error: " . $stmt->error;
	}
	$stmt->close();
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<input type="text" name="student_no" placeholder="Student ID" required><br>
	<input type="text" name="username" placeholder="Username" required><br>
	<input type="text" name="fullname" placeholder="Full Name" required><br>
	<input type="text" name="course" placeholder="Course" required><br>
	<input type="password" name="password" placeholder="Password" required><br>
	<input type="submit" name="submit" value="Add Student">
</form>
<html lang="eng">

<head>
	<title>Library Management System</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />
</head>

<body style="background-color:#d3d3d3;">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<h4 class="navbar-text navbar-right">Library Management System</h4>
			</div>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="col-lg-2 well" style="margin-top:60px;">
			<div class="container-fluid" style="word-wrap:break-word;">
				<br />
				<br />
				<label class="text-muted">
					<?php require 'account.php';
					echo "Hello " . $name . ", [ADMIN]"; ?>
				</label>
			</div>
			<hr style="border:1px dotted #d3d3d3;" />
			<ul id="menu" class="nav menu">
				<li><a style="font-size:18px; border-bottom:1px solid #d3d3d3;" href="home.php"><i
							class="glyphicon glyphicon-home"></i> Home</a></li>
				<li><a style="font-size:18px; border-bottom:1px solid #d3d3d3;" href=""><i
							class="glyphicon glyphicon-tasks"></i> Accounts</a>
					<ul style="list-style-type:none;">
						<li><a href="admin.php" style="font-size:15px;"><i class="glyphicon glyphicon-user"></i>
								Admin</a></li>
						<li><a href="student.php" style="font-size:15px;"><i class="glyphicon glyphicon-user"></i>
								Student</a></li>
					</ul>
				</li>
				<li><a style="font-size:18px; border-bottom:1px solid #d3d3d3;" href="book.php"><i
							class="glyphicon glyphicon-book"></i> Books</a></li>
				<li><a style="font-size:18px; border-bottom:1px solid #d3d3d3;" href=""><i
							class="glyphicon glyphicon-th"></i> Transaction</a>
					<ul style="list-style-type:none;">
						<li><a href="borrowing.php" style="font-size:15px;"><i class="glyphicon glyphicon-random"></i>
								Borrowing</a></li>
						<li><a href="returning.php" style="font-size:15px;"><i class="glyphicon glyphicon-random"></i>
								Returning</a></li>
					</ul>
				</li>
				<li><a style="font-size:18px; border-bottom:1px solid #d3d3d3;" href=""><i
							class="glyphicon glyphicon-cog"></i> Settings</a>
					<ul style="list-style-type:none;">
						<li><a style="font-size:15px;" href="logout.php"><i class="glyphicon glyphicon-log-out"></i>
								Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<div class="col-lg-1"></div>
		<div class="col-lg-9 well" style="margin-top:60px;">
			<div class="alert alert-info">Accounts / Student</div>
			<button id="add_student" type="button" class="btn btn-primary"><span
					class="glyphicon glyphicon-plus"></span> Add new</button>
			<button id="show_student" type="button" style="display:none;" class="btn btn-success"><span
					class="glyphicon glyphicon-circle-arrow-left"></span> Back</button>
			<br />
			<br />
			<div id="student_table">
				<table id="table" class="table table-bordered">
					<thead class="alert-success">
						<tr>
							<th>Student ID</th>
							<th>Username</th>
							<th>Full Name</th>
							<th>Course</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$qstudent = $conn->query("SELECT * FROM `student`") or die(mysqli_error());
						while ($fstudent = $qstudent->fetch_array()) {
							?>
							<tr>
								<td>
									<?php echo $fstudent['student_no'] ?>
								</td>
								<td>
									<?php echo $fstudent['username'] ?>
								</td>
								<td>
									<?php echo $fstudent['fullname'] ?>
								</td>
								<td>
									<?php echo $fstudent['course'] ?>
								</td>
								<td><a value="<?php echo $fstudent['student_no'] ?>"
										class="btn btn-danger delstudent_id"><span
											class="glyphicon glyphicon-remove"></span> Delete</a> <a
										class="btn btn-warning estudent_id"
										value="<?php echo $fstudent['student_no'] ?>"><span
											class="glyphicon glyphicon-edit"></span> Edit</a></td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
			<div id="edit_form"></div>
			<div id="student_form" style="display:none;">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<form method="POST" action="save_student_query.php" enctype="multipart/form-data">
						<div class="form-group">
							<label>Student ID:</label>
							<input type="text" name="student_no" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<label>Username:</label>
							<input type="text" name="username" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<label>Full Name:</label>
							<input type="text" name="fullname" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<label>Password:</label>
							<input type="text" name="password" class="form-control" />
						</div>
						<div class="form-group">
							<label>Course:</label>
							<input type="text" required="required" name="course" class="form-control" />
						</div>
						<div class="form-group">
							<button class="btn btn-primary" name="save_student"><span
									class="glyphicon glyphicon-save"></span> Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<br />
	<br />
	<br />
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/login.js"></script>
<script src="js/sidebar.js"></script>
<script src="js/jquery.dataTables.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#table').DataTable();
	});
</script>
<script type="text/javascript">
	$(document).ready(function () {
		$('#add_student').click(function () {
			$(this).hide();
			$('#show_student').show();
			$('#student_table').slideUp();
			$('#student_form').slideDown();
			$('#show_student').click(function () {
				$(this).hide();
				$('#add_student').show();
				$('#student_table').slideDown();
				$('#student_form').slideUp();
			});
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function () {
		$result = $('<center><label>Deleting...</label></center>');
		$('.delstudent_id').click(function () {
			$student_id = $(this).attr('value');
			$(this).parents('td').empty().append($result);
			$('.delstudent_id').attr('disabled', 'disabled');
			$('.estudent_id').attr('disabled', 'disabled');
			setTimeout(function () {
				window.location = 'delete_student.php?student_id=' + $student_id;
			}, 1000);
		});
		$('.estudent_id').click(function () {
			$student_id = $(this).attr('value');
			$('#show_student').show();
			$('#show_student').click(function () {
				$(this).hide();
				$('#edit_form').empty();
				$('#student_table').show();
				$('#add_student').show();
			});
			$('#student_table').fadeOut();
			$('#add_student').hide();
			$('#edit_form').load('load_student.php?student_id=' + $student_id);
		});
	});
</script>

</html>