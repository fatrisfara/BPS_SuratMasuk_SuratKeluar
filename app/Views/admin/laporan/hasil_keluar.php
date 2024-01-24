<!-- app/Views/admin/hasil_pdf.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Cetak Data PDF</title>
    <!-- Tambahkan stylesheet atau styling sesuai kebutuhan -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
        text-align: center;
        background-color: #f2f2f2;
        white-space: nowrap; /* Mengatur agar teks tidak melakukan pemisahan kata atau menyesuaikan ukurannya*/
    }
        
    </style>
</head>

<body>

    <h2 style="text-align: center;">Data Surat Keluar</h2>

    <table>
        <thead>
            <tr>
                <th >Nomor Berkas</th>
                <th>Alamat Penerima</th>
                <th>Tanggal</th>
                <th>Perihal</th>
                <th>Nomor Petunjuk</th>
                <th>Nomor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suratKeluar as $row) : ?>
                <tr>
                    <td style="text-align: center;"><?= $row['no_berkas']; ?></td>
                    <td><?= $row['alamat']; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tgl_surat'])); ?></td>

                    <td><?= $row['perihal']; ?></td>
                    <td><?= date_format(date_create($row['no_petunjuk']), "d-m-Y"); ?></td>

                    <td><?= $row['no_surat']; ?></td>
                   
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>