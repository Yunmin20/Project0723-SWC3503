<?php
	require_once 'connect.php';

	if(ISSET($_POST['edit_book'])){
		///$echo "hello";
		$entry_number	= $_POST['entry_number'];
		$book_title 	= $_POST['book_title'];
		$book_author 	= $_POST['book_author'];
		$book_publisher = $_POST['book_publisher'];
		$book_isbn 		= $_POST['book_isbn'];
		$date_publish 	= $_POST['date_publish']; //book version
		$book_shelf 	= $_POST['book_shelf'];
		$qty 			= $_POST['qty'];
		
		$conn->query("UPDATE `book` SET 
			`entry_number` 	 = '$entry_number',
			`book_title`	 = '$book_title', 
			`book_author` 	 = '$book_author', 
			`book_publisher` = '$book_publisher', 
			`book_isbn` 	 = '$book_isbn', 
			`date_publish` 	 = '$date_publish', 
			`book_shelf` 	 = '$book_shelf', 
			`qty` 			 = '$qty' 
			WHERE `book_id`  = '$_REQUEST[book_id]'") or die(mysqli_error());

		echo '
			<script type = "text/javascript">
				alert("Save Changes");
				window.location = "book.php";
			</script>
		';
	}
