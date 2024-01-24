<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .hr-custom {
            height: 2px;
            background-color: #000;
            width: 100%;
            margin: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <table>
            <tr>
                <td class="logo-container">
                    <img src="img/logo_bps.png" height="80" width="100" style="margin-right: 30px;">
                </td>
                <td>
                    <h3 class="kop" style="font-size: 25px; font-weight: bold;">
                        BADAN PUSAT STATISTIK
                    </h3>
                    <p class="kop" style="font-size: 16px; font-weight: bold;">
                        KOTA PEKALONGAN
                    </p>
                    <br />
                    JL. Singosari Telp. (0285)423504
                    </p>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td colspan="2" width="700" style="text-align: center;">
                    <hr class="hr-custom">
                    <p class="judul" style="font-size: 16px; font-weight: bold;">LEMBAR DISPOSISI</p>
                    <hr class="hr-custom">
                </td>
            </tr>
        </table>

        <!-- Content Section 1 -->
        <table>
            <tr>
                <td width="120">Tgl Masuk</td>
                <td>: <?php $date = date_create($detail['no_petunjuk']); ?>
                    <?= date_format($date, "d-m-Y"); ?></td>
                <td width="120" style="text-align: right;">No Disposisi</td>
                <td>: <?= $detail['no_berkas']; ?></td>
            </tr>
            <tr>
                <td>Perihal Surat</td>
                <td>: <?= $detail['perihal']; ?></td>
            </tr>
            <tr>
                <td width="120">Surat Tgl</td>
                <td>: <?php $date = date_create($detail['tgl_surat']); ?>
                    <?= date_format($date, "d-m-Y"); ?></td>
                <td width="120" style="text-align: right;">Nomor</td>
                <td>: <?= $detail['no_surat']; ?></td>
            </tr>
            <tr>
                <td>Asal Surat</td>
                <td>: <?= $detail['alamat']; ?></td>
            </tr>
        </table>
        <table>
            <tr>
                <td colspan="2" width="700" style="text-align: center;">
                    <hr class="hr-custom">
                </td>
            </tr>
        </table>

        <!-- Content Section 2 -->
        <table>
            <tr>
                <td width="120">Catatan</td>
                <td width="180">: <?= $detail['catatan']; ?></td>
            </tr>
        </table>

        <table>
            <tr>
                <td colspan="2" width="700" style="text-align: center;">
                    <hr class="hr-custom">
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <table>
            <tr>
                <td>
                    Sesudah digunakan harus segera dikembalikan,
                </td>
            </tr>
            <tr>
                <td width="100">Kepada</td>
                <td width="180">: <?= $detail['kepada']; ?></td>
            </tr>
        </table>

        <table>
            <tr>
                <td colspan="2" width="700" style="text-align: center;">
                    <hr class="hr-custom">
                </td>
            </tr>
        </table>


    </div>
</body>

</html>