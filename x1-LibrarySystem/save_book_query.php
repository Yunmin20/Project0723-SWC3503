<?php
	require_once 'connect.php';
	if(ISSET($_POST['save_book'])){
		$entry_number	= $_POST['entry_number'];
		$book_title 	= $_POST['book_title'];
		$book_author 	= $_POST['book_author'];
		$book_publisher = $_POST['book_publisher'];
		$book_isbn 		= $_POST['book_isbn'];   
		$date_publish 	= $_POST['date_publish']; //book version
		$book_shelf 	= $_POST['book_shelf'];
		$qty 			= $_POST['qty'];
		$conn->query("INSERT INTO `book` VALUES('', '$entry_number', '$book_title', '$book_author','$date_publish','$book_publisher', '$book_isbn', '$book_shelf',  '$qty')") or die(mysqli_error());
		
		echo'
			<script type = "text/javascript">
				alert("Successfully saved data");
				window.location = "book.php";
			</script>
		';
	}