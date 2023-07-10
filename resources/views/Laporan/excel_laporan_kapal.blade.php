
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
    <h3 class="m-3">ABSENSI TENAGA SUPERVISI</h3>
    <header>
      
        <h4 style="border-bottom: 2px solid black;" class="col-4">
          @if (isset($namakapal))
          {{$namakapal}}
          @else
          NAMA KAPAL
          @endif
        </h4>
    </header>
    <header>
        <h5>
          @if (isset($tanggal))
          {{$tanggal}}
          @else
          Tanggal : .....................................................................
          @endif
        </h5>
    </header>

    <table class="mb-3">
        <tr  style="font-size: 13px;">
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

  <div class="col-11">
    <div class="table table-bodered">
        <table border="3" class="table table-bordered">
            <thead>
              <tr class="text-center">
                <th  rowspan="3">NO</th>
                <th  colspan="1">JAM KERJA</th>
                <th  colspan="1">00.00-08.00</th>
                <th  colspan="1">08.00-16.00</th>
                <th  colspan="1">16.00-00.00</th>
              </tr>
              <tr class="text-center">
                <th>SHIFT</th>
                <th colspan="1">I</th>
                <th colspan="1">II</th>
                <th colspan="1">III</th>
              </tr>
            </thead>
            
            <tbody>

              @if(isset($P1))
              <tr class="text-center">
                <td>{{$no++}}</td>
                <td>{{$P1}}</td>
                <td>Hadir</td>
                <td>-</td>
                <td>-</td>
              </tr>

              @foreach ($dataS1 as $item1)
              <tr class="text-center">
                <td>{{$no++}}</td>
                <td>{{$item1->name_karyawan}}</td>
                <td>{{$item1->status}}</td>
                <td>-</td>
                <td>-</td>
              </tr>
              @endforeach
              @endif


              @if(isset($P2))
              <tr class="text-center">
                <td>{{$no++}}</td>
                <td>{{$P2}}</td>
                <td>Hadir</td>
                <td>-</td>
                <td>-</td>
              </tr>

              @foreach ($dataS2 as $item2)
              <tr class="text-center">
                <td>{{$no++}}</td>
                <td>{{$item2->name_karyawan}}</td>
                <td>{{$item2->status}}</td>
                <td>-</td>
                <td>-</td>
              </tr>
              @endforeach
              @endif

              @if(isset($P3))
                <tr class="text-center">
                  <td>{{$no++}}</td>
                  <td style="text-align: left">{{$P3}}</td>
                  <td>-</td>
                  <td>-</td>
                  <td>Hadir</td>
                </tr>

                @foreach ($dataS3 as $item3)
                <tr class="text-center">
                  <td>{{$no++}}</td>
                  <td style="text-align: left">{{$item3->name_karyawan}}</td>
                  <td>-</td>
                  <td>-</td>
                  <td>{{$item3->status}}</td>
                </tr>
                @endforeach
              @endif
             
              <!-- Tambahkan baris data lainnya -->
            </tbody>
          </table>
          
    </div>
  </div>

</center>    
</body>

<script>
  window.print()
</script>
</html>
