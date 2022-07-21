<?php
session_start();
// hapuskan semua session
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- SWEETALERT2 -->
	<script src="assets/vendor/sweetalert2/sweetalert2.all.min.js"></script>
	<title>Logout</title>
</head>

<body>

	<script>
		Swal.fire('Success', 'Berhasil Logout!', 'success').then(function() {
			window.location = 'login.php';
		});
	</script>

</body>

</html>