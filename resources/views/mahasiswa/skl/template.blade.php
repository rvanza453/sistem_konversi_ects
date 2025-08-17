<!DOCTYPE html>
<html>
<head>
    <title>Surat Keterangan Lulus Konversi ECTS</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; }
        .container { width: 100%; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; padding: 0; }
        .content p { line-height: 1.5; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; }
        .footer { margin-top: 50px; text-align: right; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>SURAT KETERANGAN LULUS</h2>
            <h3>KONVERSI EUROPEAN CREDIT TRANSFER SYSTEM (ECTS)</h3>
        </div>

        <div class="content">
            <p>Dengan ini menerangkan bahwa:</p>
            <table>
                <tr>
                    <td width="20%">Nama</td>
                    <td>: {{ $user->name }}</td>
                </tr>
                <tr>
                    <td>NPM</td>
                    <td>: {{ $biodata->npm }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: {{ $user->email }}</td>
                </tr>
            </table>

            <p>telah menyelesaikan mata kuliah dengan hasil konversi sebagai berikut:</p>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode MK</th>
                        <th>Nama Mata Kuliah</th>
                        <th>Nilai</th>
                        <th>Bobot (SKS)</th>
                        <th>Bobot (ECTS)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transkrips as $index => $transkrip)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $transkrip->mataKuliah->kode_mk }}</td>
                        <td>{{ $transkrip->mataKuliah->nama_mk }}</td>
                        <td>{{ $transkrip->nilai }}</td>
                        <td>{{ $transkrip->mataKuliah->bobot_sks }}</td>
                        <td>{{ $transkrip->mataKuliah->total_ects }}</td>
                    </tr>
                    @endforeach
                    <tr class="total">
                        <td colspan="4" style="text-align: right;">Total</td>
                        <td>{{ $totalSks }}</td>
                        <td>{{ $totalEcts }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="footer">
            <p>Tuban, {{ date('d F Y') }}</p>
            <br><br><br>
            <p>(_________________________)</p>
            <p>Admin Akademik</p>
        </div>
    </div>
</body>
</html>