<?php
$guru = mysqli_query($con, "SELECT * FROM tb_guru");
$kriteria = mysqli_query($con, "SELECT * FROM tb_kriteria");
$sub_kriteria = mysqli_query($con, "SELECT * FROM tb_sub_kriteria");
$hasilEvaluasi = mysqli_query($con, "SELECT * FROM tb_hasil_evaluasi ORDER BY tahun DESC");
$jumlah_guru = mysqli_num_rows($guru);
$jumlah_kriteria = mysqli_num_rows($kriteria);
$jumlah_sub_kriteria = mysqli_num_rows($sub_kriteria);

$sqlCountLayak = "SELECT COUNT(*) AS jumlah_layak FROM tb_hasil_evaluasi WHERE layak IS NOT NULL AND layak <> ''";
$resultLayak = mysqli_query($con, $sqlCountLayak);
if (!$resultLayak) {
	die("Error fetching count for 'layak' column: " . mysqli_error($con));
}
$rowLayak = mysqli_fetch_assoc($resultLayak);
$jumlah_layak = intval($rowLayak['jumlah_layak']);

$sqlCountTidakLayak = "SELECT COUNT(*) AS jumlah_tidak_layak FROM tb_hasil_evaluasi WHERE tidak_layak IS NOT NULL AND tidak_layak <> ''";
$resultTidakLayak = mysqli_query($con, $sqlCountTidakLayak);
if (!$resultTidakLayak) {
	die("Error fetching count for 'tidak_layak' column: " . mysqli_error($con));
}
$rowTidakLayak = mysqli_fetch_assoc($resultTidakLayak);
$jumlah_tidak_layak = intval($rowTidakLayak['jumlah_tidak_layak']);
?>

<div class="page-inner">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-body px-4 py-4-5">
					<div class="row">
						<h6 class="text-center" id="typedText"><span></span></h6>
						<h6 class="text-center">MUTASI GURU PADA DINAS PENDIDIKAN KAB SINJAI DENGAN ALGORITMA K-MEANS</h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="card">
				<div class="card-body px-4 py-4-5">
					<div class="row">
						<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
							<div class="stats-icon purple mb-2">
								<i class="bi bi-person-fill-check mb-4 me-2"></i>
							</div>
						</div>
						<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
							<h6 class="text-muted font-semibold">Guru</h6>
							<h6 class="font-extrabold mb-0"><?= $jumlah_guru; ?></h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-body px-4 py-4-5">
					<div class="row">
						<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
							<div class="stats-icon blue mb-2">
								<i class="bi bi-clipboard-check mb-4 me-2"></i>
							</div>
						</div>
						<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
							<h6 class="text-muted font-semibold">Kriteria</h6>
							<h6 class="font-extrabold mb-0"><?= $jumlah_kriteria; ?></h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-body px-4 py-4-5">
					<div class="row">
						<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
							<div class="stats-icon red mb-2">
								<i class="bi bi-clipboard-data mb-4 me-2"></i>
							</div>
						</div>
						<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
							<h6 class="text-muted font-semibold">Sub Kriteria</h6>
							<h6 class="font-extrabold mb-0"><?= $jumlah_sub_kriteria; ?></h6>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-body px-4 py-4-5">
					<div class="row">
						<div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
							<div class="stats-icon green mb-2">
								<i class="bi bi-person-vcard mb-4 me-2"></i>
							</div>
						</div>
						<div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
							<h6 class="text-muted font-semibold">Evaluasi</h6>
							<h6 class="font-extrabold mb-0"><?= $jumlah_layak + $jumlah_tidak_layak; ?></h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-8">
			<div class="card">
				<div class="card-header">
					<h4>Hasil Evaluasi</h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-lg" id="hasil_cluster">
							<thead>
								<tr>
									<th>Layak Mutasi</th>
									<th>Tidak Layak Mutasi</th>
									<th>Tahun Rekomendasi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($hasilEvaluasi as $hasil) : ?>
									<tr>
										<td><?= $hasil['layak']; ?></td>
										<td><?= $hasil['tidak_layak']; ?></td>
										<td><?= $hasil['tahun']; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-4">
			<div class="card">
				<div class="card-header">
					<h6>Cluster Rekomendasi Mutasi</h6>
				</div>
				<div class="card-body">
					<div id="chart-visitors-profile"></div>
				</div>
			</div>
		</div>
	</div>
</div>