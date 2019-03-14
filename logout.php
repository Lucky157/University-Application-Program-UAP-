<?php
	session_start();
	session_unset();
	session_destroy();
	echo "<script type='text/javascript'>alert('Logout success!');location.href='../index.php?logout=success'</script>";
	exit();
	?>