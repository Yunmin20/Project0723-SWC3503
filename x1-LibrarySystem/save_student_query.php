<?php
	require_once 'connect.php';
	if(ISSET($_POST['save_student'])){
		$student_no = $_POST['student_no'];
		$username 	= $_POST['username'];
		$fullname 	= $_POST['fullname'];
		$password 	= $_POST['password'];
		$course 	= $_POST['course'];
		
		$qstudent = $conn->query("SELECT * FROM `student` WHERE `student_no` = '$student_no'") or die(mysqli_error());
		$vstudent = $qstudent->num_rows;
		
		if($vstudent['student_no'] == 1){
			echo '
				<script type = "text/javascript">
					alert("Student ID already exist");
					window.location = "student.php";
				</script>
			';
		}else{
			$conn->query("INSERT INTO `student` VALUES('', '$username', '$student_no', '$fullname', '$password', '$course')") or die(mysqli_error());
			echo'
				<script type = "text/javascript">
					alert("Successfully saved data");
					window.location = "student.php";
				</script>
			';
		}
	}