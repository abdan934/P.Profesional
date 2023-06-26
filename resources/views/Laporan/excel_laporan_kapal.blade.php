{{$no=1}}
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Laporan</title>
    <style>
body {
  font-family: 'Times New Roman', Arial, sans-serif;
}
    </style>
</head>
<body>
<center>    
    <h3 class="m-3">ABSENSI TENAGA SUPERVISI</h3 class="m-3">
    <header>
        <h4 style="border-bottom: 2px solid black;" class="col-4">NAMA KAPAL</h4>
    </header>
    <header>
        <h5>Tanggal : .....................................................................</h5>
    </header>

    <table class="col-11">
        <tr style="font-size: 13px;">
            <td>
                1. Di tanda tangani oleh masing-masing personil tanp diwakilkan <br> Sesuai Jam/Shift masing-masing <br>
                2. Dilakukan diawal shift dan diupload ke Group oleh Leader/Foreman <br> beserta bukti foto briefing awal sebelum kerja<br>
                3. Ketidakhadiran harus dengan ijin dari petugas PT. DSK <br>
                4. Selanjutnya Lembar ini akan dilampirkan ke CSP sebagai lampiran <br> penagihan Upah Tenaga Kerja (Harus dijaga kebersihannya) 
            </td>

            <td style="display: inline-block; text-align: left;  margin-left: 150px;">
                5. Perhitungan absensi menjadi dasar pemberian uang makan dan untuk penilaian kinerja karyawan yang bersangkutan <br> serta untuk penerapan sanksi administratif bilamana perlu. <br>
                6. Karyawan yang tidak masuk kerja lebih dari 1 (satu) hari karena sakit diwajibkan membawa surat keterangan dokter <br> dan menyerahkan keapda HRD langsung pada hari pertama masuk kerja kembali <br>
                7. Ketidakhadiran tanpa pemberitahuan akan dikenakan sanksi Administrasi. <br>
                8. Mengabaikan kewajiban melakukan absensi ini dianggap sebagai mangkir atau cuti, kecuali jika ada penjelasan <br>
                9. Lain-lain akan diatur kemudian.
            </td>
        </tr>
    </table>

    <div class="col-11 table-responsive align-items-center mt-3">
        <table class="table-bordered text-center">
            <thead>
              <tr >
                <th class="m-1" rowspan="3">NO</th>
                <th class="m-1" colspan="1">JAM KERJA</th>
                @foreach ($detailLaporan as $item1)
                <th class="m-1" colspan="1">00.00-08.00</th>
                <th class="m-1" colspan="1">08.00-16.00</th>
                <th class="m-1" colspan="1">16.00-00.00</th>
                @endforeach
              </tr>
              <tr>
                <th rowspan="1">TANGGAL</th>
                @foreach ($detailLaporan->tgl as $tgl)
                <th class="m-1" colspan="3">{{$tgl}}</th>
                @endforeach
              </tr>
              <tr>
                <th>SHIFT</th>
                @foreach ($detailLaporan as $item2)
                <th colspan="1">I</th>
                <th colspan="1">II</th>
                <th colspan="1">III</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach ($detailLaporan as $item3)
                <td>{{$no++}}</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
                <td>Data 5</td>
                @endforeach
              </tr>
              <!-- Tambahkan baris data lainnya -->
            </tbody>
          </table>
          
    </div>

</center>    
</body>
</html>