<?php
session_start();
include './config/db.php';
?>

<?php
if (isset($_POST['submit'])) {
	$npsn = $_POST['npsn'];
	$nama_sekolah = $_POST['nama'];
	$kecamatan = $_POST['kecamatan'];

	$check_query = mysqli_query($con, "SELECT COUNT(*) AS count FROM tb_kebutuhan WHERE npsn = '$npsn'");
	$row = mysqli_fetch_assoc($check_query);
	$count = $row['count'];

	if ($count > 0) {
		echo "<script>alert('NPSN sudah terdaftar dalam database'); window.location.href = 'registrasi-sekolah.php';</script>";
	} else {
		$sql = "INSERT INTO tb_kebutuhan (npsn, nama_sekolah, kecamatan) VALUES ('$npsn', '$nama_sekolah', '$kecamatan')";
		$result = mysqli_query($con, $sql);

		if ($result) {
			echo "<script>alert('Data sekolah berhasil ditambahkan'); window.location.href = 'sekolah.php';</script>";
		} else {
			echo "<script>alert('Terjadi kesalahan saat menambah data guru');</script>";
		}
	}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Registrasi | Sekolah</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./assets/assets/extensions/sweetalert2/sweetalert2.min.css">
	<link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
	<link rel="stylesheet" href="./assets/assets/compiled/css/app.css">
	<link rel="stylesheet" href="./assets/assets/compiled/css/app-dark.css">

</head>

<body class="overflow-hidden">
	<!-- Dar Mode -->
	<div class="container mt-4">
		<script src="./assets/assets/static/js/initTheme.js"></script>
		<div class="theme-toggle d-flex gap-2 align-items-center">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
				<g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
					<path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3">
					</path>
					<g transform="translate(-210 -1)">
						<path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
						<circle cx="220.5" cy="11.5" r="4"></circle>
						<path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
					</g>
				</g>
			</svg>
			<div class="form-check form-switch">
				<input class="form-check-input" type="checkbox" id="toggle-dark" style="cursor: pointer">
				<label class="form-check-label"></label>
			</div>
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" style="margin-left: -7px;" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
				<path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
				</path>
			</svg>
		</div>
	</div>
	<!-- End dark mode -->
	<section id="multiple-column-form" style="margin-top: 60px; display: flex;">
		<div class=" row match-height" style="justify-content: center;">
			<div class="col-9">
				<div class="card">
					<div class="card-header">
						<img src="./assets/source/logo.png" alt="Logo" style="width: 100px; height: auto; display: block; margin: 0 auto;">
						<h2 class="card-title text-center">Daftar</h2>
					</div>
					<div class="card-content">
						<div class="card-body">
							<form class="form" action="" method="POST">
								<div class="row">
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="first-name-column">NPSN</label>
											<input type="text" id="npsn" class="form-control" placeholder="NPSN" name="npsn" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="last-name-column">Nama Sekolah</label>
											<input type="text" id="last-name-column" class="form-control" placeholder="Nama Sekolah" name="nama" readonly>
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="city-column">Provinsi</label>
											<input type="text" id="city-column" class="form-control" placeholder="Provinsi" name="provinsi" readonly>
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="country-floating">Kab/Kota</label>
											<input type="text" id="country-floating" class="form-control" name="kabupaten" placeholder="Kab/Kota" readonly>
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="company-column">Kecamatan</label>
											<input type="text" id="company-column" class="form-control" name="kecamatan" placeholder="Kecamatan" readonly>
										</div>
									</div>
									<div class="col-md-6 col-12">
										<div class="form-group">
											<label for="email-id-column">Alamat</label>
											<input type="text" id="email-id-column" class="form-control" name="alamat" placeholder="Alamat" readonly>
										</div>
									</div>
									<div class="col-12 d-flex justify-content-end">
										<button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Daftar</button>
										<button type="reset" class="btn btn-warning me-1 mb-1">Reset</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



	<!--===============================================================================================-->
	<script src="./assets/_login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="./assets/_login/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="./assets/_login/vendor/bootstrap/js/popper.js"></script>
	<script src="./assets/_login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="./assets/_login/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="./assets/_login/vendor/daterangepicker/moment.min.js"></script>
	<script src="./assets/_login/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="./assets/_login/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->

	<script src="./assets/js/plugin/sweetalert/sweetalert.min.js"></script>
	<script src="./assets/_login/js/main.js"></script>

	<script src="./assets/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

	<script src="./assets/assets/static/js/components/dark.js"></script>
	<script src="./assets/assets/compiled/js/app.js"></script>
	<script src="./assets/assets/extensions/sweetalert2/sweetalert2.min.js"></script>
	<script src="./assets/assets/static/js/pages/sweetalert2.js"></script>
	<script>
		npsn = document.querySelector('input[name="npsn"]');
		npsn.addEventListener('input', function() {
			const value = this.value;
			fetch(`https://api-sekolah-indonesia.vercel.app/sekolah?npsn=${value}`)
				.then(response => response.json())
				.then(data => {
					document.querySelector('input[name="nama"]').value = data.dataSekolah[0].sekolah.toLowerCase().replace(/(^|\s)\S/g, function(first) {
						return first.toUpperCase();
					});
					document.querySelector('input[name="provinsi"]').value = data.dataSekolah[0].propinsi;
					document.querySelector('input[name="kabupaten"]').value = data.dataSekolah[0].kabupaten_kota;
					document.querySelector('input[name="kecamatan"]').value = data.dataSekolah[0].kecamatan;
					document.querySelector('input[name="alamat"]').value = data.dataSekolah[0].alamat_jalan.toLowerCase().replace(/(^|\s)\S/g, function(first) {
						return first.toUpperCase();
					})
				})
				.catch(error => {
					console.error(error);
				});
		});
	</script>
</body>

</html>