<?php
	require_once 'connect.php';
	if(ISSET($_POST['edit_student'])){
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
			$conn->query("UPDATE `student` SET 
				`student_no` = '$student_no',
				`username` 	 = '$username',
				`fullname` 	 = '$fullname', 
				`password` 	 = '$password', 
				`course` 	 = '$course'
				WHERE `student_id` = '$_REQUEST[student_id]'") or die(mysqli_error());
			echo'
				<script type = "text/javascript">
					alert("Save Changes");
					window.location = "student.php";
				</script>
			';
		}
	}	