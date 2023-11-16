<?php
	$conn = new mysqli('localhost', 'root', '', 'lms') or die(mysqli_error());
	if(!$conn){
		die("Fatal Error: Connection Failed!");
	}