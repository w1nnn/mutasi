<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../assets/assets/compiled/css/app-dark.css">
    <title>Laporan Mutasi Guru</title>
    <style>
        body {
            background-color: #fff;
        }

        .header {
            text-align: center;
            padding: 20px 0;
        }

        .logo {
            width: 80px;
            height: auto;
        }

        .title {
            font-size: 24px;
            margin: 10px 0;
            font-weight: bold;
        }

        .subtitle {
            font-size: 18px;
            margin: 5px 0;
        }

        .divider {
            border-top: 2px solid #000;
            margin: 20px auto;
            width: 80%;
        }

        /* CSS untuk tata letak halaman cetakan */
        @media print {
            body * {
                visibility: hidden;
            }

            .header,
            .header * {
                visibility: visible;
            }

            .signatures {
                display: flex;
                justify-content: space-between;
                position: absolute;
                bottom: 0;
                width: 100%;
            }

            .signature-left,
            .signature-right {
                border-bottom: none;
            }
        }

        @media print {
            @page {
                size: landscape;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="../assets/img/bg (1).png" alt="Logo Kabupaten Sinjai" class="logo">
        <div class="title">Dinas Pendidikan Kabupaten Sinjai</div>
        <em>Jl. RA Kartini, Biringere, Kec. Sinjai Utara, Kabupaten Sinjai, Sulawesi Selatan<br> Website: https://disdik.sinjaikab.go.id, Kode Pos: 92611</em>
        <div class="divider"></div>

        <?php
        // Ambil data dari input tahun
        // if (isset($_POST['btn'])) {
        //     $tahun = $_POST['tahun'];
        //     $hasilEvaluasi = mysqli_query($con, "SELECT * FROM tb_hasil_evaluasi WHERE tahun_evaluasi = '$tahun' ORDER BY tahun_evaluasi DESC");
        // } else {
        //     $hasilEvaluasi = mysqli_query($con, "SELECT * FROM tb_hasil_evaluasi ORDER BY tahun_evaluasi DESC");
        // }
        ?>

        <div class="page-inner">
            <div class="row">
                <section class="section">
                    <div class="card">
                        <div class="col-md-12">
                            <div class="card-header">
                                <h5 class="card-title text-center">Data Rekomendasi Mutasi Guru</h5>
                            </div>
                            <div class="card-body">

                                <?php
                                if (isset($_POST['btn'])) {
                                    $tahun = $_POST['tahun'];

                                    $dataEvaluasi = mysqli_query($con, "SELECT * FROM tb_hasil_evaluasi WHERE tahun_evaluasi = '$tahun' ORDER BY tahun_evaluasi DESC");

                                    $layakMutasi = [];
                                    $tidakLayakMutasi = [];

                                    foreach ($dataEvaluasi as $dE) {
                                        if ($dE['cluster'] == '1') {
                                            $layakMutasi[] = $dE;
                                        } else {
                                            $tidakLayakMutasi[] = $dE;
                                        }
                                    }
                                }

                                $jumlahLayakMutasi = count($layakMutasi);
                                $jumlahTidakLayakMutasi = count($tidakLayakMutasi);
                                ?>

                                <h5 class="mt-2">Layak Mutasi</h5>
                                <table class="table table-striped mt-5" id="tableLayakMutasi" style="text-align: center; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Nama Guru</th>
                                            <th>Satuan Pendidikan</th>
                                            <th>Jabatan</th>
                                            <th>Masa Kerja</th>
                                            <th>Jam Kerja</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($layakMutasi as $dE) : ?>
                                            <?php
                                            $namaGuru = htmlspecialchars($dE['nama_guru']);
                                            $dataGuru = mysqli_query($con, "SELECT * FROM tb_guru WHERE nama_guru = '$namaGuru'");
                                            while ($dG = mysqli_fetch_array($dataGuru)) {
                                                echo '<tr>
                                            <td>' . $no++ . '</td>
                                            <td>' . $dG['nip'] . '</td>
                                            <td>' . $dG['nama_guru'] . '</td>
                                            <td>' . $dG['satuan_pendidikan'] . '</td>
                                            <td>' . $dG['jabatan'] . '</td>
                                            <td>' . $dG['masa_kerja'] . ' Tahun' . '</td>
                                            <td>' . $dG['jam_kerja'] . ' Jam' . '</td>
                                            <td>
                                                <img src="../assets/img/user/' . $dG['foto'] . '" alt="Foto Guru" width="40px">
                                            </td>
                                        </tr>';
                                            }
                                            ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <h5 class="mt-5">Tidak Layak Mutasi</h5>
                                <table class="table table-striped mt-5" id="tableTidakLayakMutasi" style="text-align: center; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Nama Guru</th>
                                            <th>Satuan Pendidikan</th>
                                            <th>Jabatan</th>
                                            <th>Masa Kerja</th>
                                            <th>Jam Kerja</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($tidakLayakMutasi as $dE) : ?>
                                            <?php
                                            $namaGuru = htmlspecialchars($dE['nama_guru']);
                                            $dataGuru = mysqli_query($con, "SELECT * FROM tb_guru WHERE nama_guru = '$namaGuru'");
                                            while ($dG = mysqli_fetch_array($dataGuru)) {
                                                echo '<tr>
                                            <td>' . $no++ . '</td>
                                            <td>' . $dG['nip'] . '</td>
                                            <td>' . $dG['nama_guru'] . '</td>
                                            <td>' . $dG['satuan_pendidikan'] . '</td>
                                            <td>' . $dG['jabatan'] . '</td>
                                            <td>' . $dG['masa_kerja'] . ' Tahun' . '</td>
                                            <td>' . $dG['jam_kerja'] . ' Jam' . '</td>
                                            <td>
                                                <img src="../assets/img/user/' . $dG['foto'] . '" alt="Foto Guru" width="40px">
                                            </td>
                                        </tr>';
                                            }
                                            ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <?php $no = 1; ?>
                                <?php
                                $jabatanData = [];

                                $dataEvaluasi = mysqli_query($con, "SELECT nama_guru, cluster FROM tb_hasil_evaluasi");
                                foreach ($dataEvaluasi as $dE) {
                                    $namaGuru = htmlspecialchars($dE['nama_guru']);
                                    $cluster = $dE['cluster'];

                                    $dataGuru = mysqli_query($con, "SELECT jabatan FROM tb_guru WHERE nama_guru = '$namaGuru'");
                                    $guruData = mysqli_fetch_assoc($dataGuru);

                                    if ($guruData) {
                                        $jabatan = $guruData['jabatan'];

                                        if (!isset($jabatanData[$jabatan])) {
                                            $jabatanData[$jabatan] = [
                                                'total' => 0,
                                                'layak_mutasi' => 0,
                                                'tidak_layak_mutasi' => 0
                                            ];
                                        }

                                        $jabatanData[$jabatan]['total']++;

                                        if ($cluster == '1') {
                                            $jabatanData[$jabatan]['layak_mutasi']++;
                                        } else {
                                            $jabatanData[$jabatan]['tidak_layak_mutasi']++;
                                        }
                                    }
                                }
                                ?>

                                <h5 class="mt-5">Detail Evaluasi</h5>
                                <table class="table table-striped mt-3" style="text-align: center; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Jabatan</th>
                                            <th>Jumlah Data Evaluasi</th>
                                            <th>Layak Mutasi</th>
                                            <th>Tidak Layak Mutasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($jabatanData as $jabatan => $data) : ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($jabatan); ?></td>
                                                <td><?php echo $data['total']; ?></td>
                                                <td><?php echo $data['layak_mutasi']; ?></td>
                                                <td><?php echo $data['tidak_layak_mutasi']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <?php

                                $query = "SELECT 
                                   npsn,
                                   nama_sekolah,
                                   SUM(guru_matematika) AS matematika,
                                   SUM(guru_penjaskes) AS penjaskes,
                                   SUM(guru_bahasa_indonesia) AS bahasa_indonesia,
                                   SUM(guru_bahasa_ingris) AS bahasa_inggris,
                                   SUM(guru_ipa) AS ipa,
                                   SUM(guru_ips) AS ips,
                                   SUM(guru_seni_budaya) AS seni_budaya,
                                   SUM(guru_agama) AS agama
                               FROM tb_kebutuhan
                               GROUP BY npsn, nama_sekolah";

                                $result = mysqli_query($con, $query);

                                if ($result) {
                                    $available = 0;
                                    echo '<h5 class="mt-5 text-center">Kebutuhan Sekolah</h5>';
                                    echo '<div class="table-responsive"><table class="table mt-5 table-striped table-sm">';
                                    echo '<thead><tr><th>Sekolah</th><th>Jumlah Kebutuhan</th><th>Guru Matematika</th><th>Guru Penjaskes</th><th>Guru Bahasa Indonesia</th><th>Guru Bahasa Inggris</th><th>Guru IPA</th><th>Guru IPS</th><th>Guru Seni Budaya</th><th>Guru Agama</th></tr></thead><tbody>';

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $matematika = $row['matematika'] > 0 ? $row['matematika'] : "";
                                        $penjaskes = $row['penjaskes'] > 0 ? $row['penjaskes'] : "";
                                        $bahasa_indonesia = $row['bahasa_indonesia'] > 0 ? $row['bahasa_indonesia'] : "";
                                        $bahasa_inggris = $row['bahasa_inggris'] > 0 ? $row['bahasa_inggris'] : "";
                                        $ipa = $row['ipa'] > 0 ? $row['ipa'] : "";
                                        $ips = $row['ips'] > 0 ? $row['ips'] : "";
                                        $seni_budaya = $row['seni_budaya'] > 0 ? $row['seni_budaya'] : "";
                                        $agama = $row['agama'] > 0 ? $row['agama'] : "";

                                        // Menghitung jumlah kebutuhan
                                        $jumlah_kebutuhan = $row['matematika'] + $row['penjaskes'] + $row['bahasa_indonesia'] + $row['bahasa_inggris'] + $row['ipa'] + $row['ips'] + $row['seni_budaya'] + $row['agama'];

                                        if ($matematika || $penjaskes || $bahasa_indonesia || $bahasa_inggris || $ipa || $ips || $seni_budaya || $agama) {
                                            echo '<tr>';
                                            echo '<td>' . $row['nama_sekolah'] . '</td>';
                                            echo '<td>' . $jumlah_kebutuhan . '</td>';
                                            echo '<td>' . $matematika . '</td>';
                                            echo '<td>' . $penjaskes . '</td>';
                                            echo '<td>' . $bahasa_indonesia . '</td>';
                                            echo '<td>' . $bahasa_inggris . '</td>';
                                            echo '<td>' . $ipa . '</td>';
                                            echo '<td>' . $ips . '</td>';
                                            echo '<td>' . $seni_budaya . '</td>';
                                            echo '<td>' . $agama . '</td>';
                                            echo '</tr>';
                                            $available++;
                                        }
                                    }
                                    echo '</tbody></table></div>';
                                } else {
                                    echo "Error: " . mysqli_error($con);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="../assets/assets/static/js/components/dark.js"></script>
    <script src="../assets/assets/compiled/js/app.js"></script>
    <script>
        window.print();
    </script>
</body>

</html>