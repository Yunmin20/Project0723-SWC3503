<?php
	require_once 'connect.php';
	$q_book = $conn->query("SELECT * FROM `book` WHERE `book_id` = '$_REQUEST[book_id]'") or die(mysqli_error());
	$f_book = $q_book->fetch_array();
?>
<div class = "col-lg-3"></div>
<div class = "col-lg-6">
	<form method = "POST" action = "edit_book_query.php?book_id=<?php echo $f_book['book_id']?>" enctype = "multipart/form-data">
		<div class = "form-group">
			<label>Book Entry NumberXß:</label>
			<input type = "text" value = "<?php echo $f_book['entry_number']?>" name = "entry_number" required = "required" class = "form-control" />
		</div>
		<div class = "form-group">
			<label>Book Title:</label>
			<input type = "text" value = "<?php echo $f_book['book_title']?>" name = "book_title" required = "required" class = "form-control" />
		</div>
		<div class = "form-group">
			<label>Book Author:</label>
			<input type = "text" value = "<?php echo $f_book['book_author']?>" name = "book_author" class = "form-control" />
		</div>
		<div class = "form-group">
			<label>Book Publisher:</label>
			<input type = "text" name = "book_publisher" value = "<?php echo $f_book['book_publisher']?>" class = "form-control" required = "required"/>
		</div>
		<div class = "form-group">
			<label>ISBN:</label>
			<input type = "text" name = "book_isbn" value = "<?php echo $f_book['book_isbn']?>" class = "form-control" required = "required" />
		</div>
		<div class = "form-group">
			<label>Edition:</label>
			<input type = "date" name = "date_publish" value = "<?php echo $f_book['date_publish']?>" required = "required" class = "form-control" />
		</div>
		<div class = "form-group">
			<label>Shelf Number:</label>
			<input type = "text" name = "book_shelf" value = "<?php echo $f_book['book_shelf']?>" class = "form-control" required = "required" />
		</div>
		<div class = "form-group">
			<label>Quantity:</label>
			<input type = "number" min = "0" value = "<?php echo $f_book['qty']?>" name = "qty" required = "required" class = "form-control" />
		</div>
		<div class = "form-group">
			<button name = "edit_book" class = "btn btn-warning"><span class = "glyphicon glyphicon-edit"></span> Save Changes</button>
		</div>
	</form>		
</div>