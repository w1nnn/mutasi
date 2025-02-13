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
        if (isset($_POST['btn'])) {
            $tahun = $_POST['tahun'];
            $hasilEvaluasi = mysqli_query($con, "SELECT * FROM tb_hasil_evaluasi WHERE tahun = '$tahun' ORDER BY tahun DESC");
        } else {
            $hasilEvaluasi = mysqli_query($con, "SELECT * FROM tb_hasil_evaluasi ORDER BY tahun DESC");
        }
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

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Layak Mutasi</th>
                                            <th>Tidak Layak Mutasi</th>
                                            <th>Tahun Mutasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($hasilEvaluasi as $no => $hasil) : ?>
                                            <tr>
                                                <td><?= $no + 1; ?>.</td>
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