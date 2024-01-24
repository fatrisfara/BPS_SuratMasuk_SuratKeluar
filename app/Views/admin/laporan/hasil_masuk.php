<!-- app/Views/admin/hasil_pdf.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Surat Masuk</title>
    <!-- Tambahkan stylesheet atau styling sesuai kebutuhan -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            text-align: center; /* Teks di tengah untuk seluruh tabel */
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: center; /* Teks di tengah untuk seluruh sel dalam tabel */
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h3 style="text-align: center;">DATA SURAT MASUK</h3>

    <table>
        <thead>
            <tr>
                <th rowspan="2">Nomor Berkas</th>
                <th rowspan="2">Alamat Pengirim</th>
                <th colspan="3">Dari Surat Masuk</th>
                <th rowspan="2">Nomor Petunjuk</th>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>Nomor</th>
                <th>Perihal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suratMasuk as $row): ?>
                <tr>
                    <td><?=$row['no_berkas'];?></td>
                    <td style="text-align: left;"><?=$row['alamat'];?></td>
                    <td><?= date('d-m-Y', strtotime($row['tgl_surat'])); ?></td>


                    <td><?=$row['no_surat'];?></td>
                    <td style="text-align: left;"><?=$row['perihal'];?></td>
                    <td>
                        <?php $row = date_create($row['no_petunjuk']); ?>
                        <?= date_format($row, "d-m-Y"); ?>
                  </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>

</body>

</html>
