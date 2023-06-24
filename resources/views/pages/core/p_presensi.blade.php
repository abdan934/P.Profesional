@extends('layout/template')

@section('isi-konten')
    
     
<div class="container-fluid pt-4 px-4">
    <div class="row vh-80 bg-light rounded align-items-center justify-content-center mx-0">
        
        {{-- Shift 1 --}}
        <div class="alert alert-success bg-grass-green col-11 m-3 " {{ $sift1 === false ? 'hidden':' ' }}>
            <h2 class="text-light"><i class="bi bi-stopwatch-fill"></i>&nbsp; SHIFT 1 </h2>
            <h5 class="bg-text-shift mx-4"> 00.00-08.00 </h5>
           
            <div class="" {{ $cekabsen === 1 ? 'hidden':' ' }}>
                <div class="d-flex flex-column flex-sm-row justify-content-left align-items-left mb-1 col-12">
                    <button type="button" class="btn btn-light text-light bg-btn-shift mx-2 col-12" onclick="generateCode(1)">Mulai Shift</button>

                </div>
                    <br>
                    <div id="generatedCodeContainer1" style="display: none;">
                            <form action="/absensi-masuk" class=" d-flex flex-wrap" method="post">
                                @csrf
                                <div class="form-floating mb-1 col-6 mt-1">
                                    <input type="text" class="form-control mt-2" name="id_absensi" id="generatedCode1" required readonly
                                        placeholder="Kode Absen" >
                                    <label for="floatingInput mt-1">Kode Absen</label>
                                        <input type="text" class="form-control mt-2" name="id_sift" value="S-1"  hidden >
                                        <input type="text" class="form-control mt-2" name="id_pengawas" value="{{$user->username}}"  hidden >
                                </div>
                                
                                <div class="form-floating mb-1 col-5 mt-1 mx-1">
                                    <input type="text" class="form-control mt-2" name="dermaga"  required
                                        placeholder="Dermaga" >
                                    <label for="floatingInput mt-1">Dermaga</label>
                                </div>
                                <div class="form-floating mb-1 col-12 mt-1 ">
                                    <input type="text" class="form-control mt-2" name="name_kapal"  required
                                        placeholder="Kapal" >
                                    <label for="floatingInput col-4 mt-1">Kapal</label>
                                </div>
                                <div class="form-floating mb-1 col-12 mt-1 ">
                                    <button type="button submit" class="btn btn-light text-light bg-primary col-12 ">Submit</button>
                                </div>
                            </form>
                    </div>
            </div>

            @if (isset($kerja))
            <table class="table table-borderless">
                <thead class="">
                    <tr class="text-center text-light">
                        <th scope="col">Leader</th>
                        <th scope="col">Kapal</th>
                        <th scope="col">Dermaga</th>
                        <th scope="col">Keterangan</th>
                </thead>
                <tbody class="text-center text-light">
                  <td>
                    {{$kerja->name_pengawas}}
                  </td>
                  <td>
                    {{$kerja->name_kapal}}
                  </td>
                  <td>
                    {{$kerja->dermaga}}
                  </td>
                  <td {{ $keluar_1 === true ? 'hidden':' ' }}>
                    === Sedang Berlangsung ===
                  </td>
                  <td {{ $keluar_1 === false ? 'hidden':' ' }}>
                    <a href="{{url('/detail-absen/'.$kerja->id_absensi)}}">
                        <button type="button" class="btn btn-light text-light bg-btn-shift mx-1 col-6 ">Keluar</button>
                    </a>
                  </td>
                </tbody>
            </table>
            <a href="{{url('/detail-absen/'.$kerja->id_absensi)}}" class="text-light">
                <button type="button" class="btn btn-outline-light col-11 m-3 me-auto" ><i class="bi bi-list-check"></i> &nbsp;Details</a></button>
            </a>
            <br><h4 class="text-light">{{$kerja->tgl}}</h4>
            @endif
        </div>
        
        {{-- Shift 2 --}}
        <div class="alert alert-success bg-grass-green col-11 m-3 " {{ $sift2 === false ? 'hidden':' ' }}>
            <h2 class="text-light"><i class="bi bi-stopwatch-fill"></i>&nbsp; SHIFT 2 </h2>
            <h5 class="bg-text-shift mx-4"> 08.00-16.00 </h5>
           
            <div class="" {{ $cekabsen === 1 ? 'hidden':' ' }}>
                <div class="d-flex flex-column flex-sm-row justify-content-left align-items-left mb-1 col-12">
                    <button type="button" class="btn btn-light text-light bg-btn-shift mx-2 col-12" onclick="generateCode(2)">Mulai Shift</button>
                </div>
                    <br>
                    <div id="generatedCodeContainer2" style="display: none;">
                            <form action="/absensi-masuk" class=" d-flex flex-wrap" method="post">
                                @csrf
                                <div class="form-floating mb-1 col-6 mt-1">
                                    <input type="text" class="form-control mt-2" name="id_absensi" id="generatedCode2" required readonly
                                        placeholder="Kode Absen" >
                                    <label for="floatingInput mt-1">Kode Absen</label>
                                        <input type="text" class="form-control mt-2" name="id_sift" value="S-2"  hidden >
                                        <input type="text" class="form-control mt-2" name="id_pengawas" value="{{$user->username}}"  hidden >
                                </div>
                                
                                <div class="form-floating mb-1 col-5 mt-1 mx-1">
                                    <input type="text" class="form-control mt-2" name="dermaga"  required
                                        placeholder="Dermaga" >
                                    <label for="floatingInput mt-1">Dermaga</label>
                                </div>

                                <div class="form-floating mb-1 col-12 mt-1 ">
                                    <input type="text" class="form-control mt-2" name="name_kapal"  required
                                        placeholder="Kapal" >
                                    <label for="floatingInput col-4 mt-1">Kapal</label>
                                </div>

                                <div class="form-floating mb-1 col-12 mt-1 ">
                                    <button type="button submit" class="btn btn-light text-light bg-primary col-12 ">Submit</button>
                                </div>
                            </form>
                    </div>
            </div>

            @if (isset($kerja))
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="">
                        <tr class="text-center text-light">
                            <th scope="col">Leader</th>
                            <th scope="col">Kapal</th>
                            <th scope="col">Dermaga</th>
                            <th scope="col">Keterangan</th>
                    </thead>
                    <tbody class="text-center text-light">
                    <td>
                        {{$kerja->name_pengawas}}
                    </td>
                    <td>
                        {{$kerja->name_kapal}}
                    </td>
                    <td>
                        {{$kerja->dermaga}}
                    </td>
                    <td {{ $keluar_2 === true ? 'hidden':' ' }}>
                        === Sedang Berlangsung ===
                    </td>
                    <td {{ $keluar_2 === false ? 'hidden':' ' }}>
                        <a href="{{url('/detail-absen/'.$kerja->id_absensi)}}">
                            <button type="button" class="btn btn-light text-light bg-btn-shift mx-1 col-6 ">Keluar</button>
                        </a>
                    </td>
                    </tbody>
                </table>
            </div>
            <a href="{{url('/detail-absen/'.$kerja->id_absensi)}}" class="text-light">
                <button type="button" class="btn btn-outline-light col-11 m-3 me-auto" ><i class="bi bi-list-check"></i> &nbsp;Details</a></button>
            </a>
            <br><h4 class="text-light">{{$kerja->tgl}}</h4>
            @endif
        </div>

        {{-- Shift 3 --}}
        <div class="alert alert-success bg-grass-green col-11 m-3 " {{ $sift3 === false ? 'hidden':' ' }}>
            <h2 class="text-light"><i class="bi bi-stopwatch-fill"></i>&nbsp; SHIFT 3 </h2>
            <h5 class="bg-text-shift mx-4"> 16.00-00.00 </h5>
           
            <div class="" {{ $cekabsen === 1 ? 'hidden':' ' }}>
                <div class="d-flex flex-column flex-sm-row justify-content-left align-items-left mb-1 col-12">
                    <button type="button" class="btn btn-light text-light bg-btn-shift mx-2 col-12" onclick="generateCode(3)">Mulai Shift</button>
                </div>
                    <br>
                    <div id="generatedCodeContainer3" style="display: none;">
                            <form action="/absensi-masuk" class=" d-flex flex-wrap" method="post">
                                @csrf
                                <div class="form-floating mb-1 col-6 mt-1">
                                    <input type="text" class="form-control mt-2" name="id_absensi" id="generatedCode3" required readonly
                                        placeholder="Kode Absen" >
                                    <label for="floatingInput mt-1">Kode Absen</label>
                                        <input type="text" class="form-control mt-2" name="id_sift" value="S-3"  hidden >
                                        <input type="text" class="form-control mt-2" name="id_pengawas" value="{{$user->username}}"  hidden >
                                </div>
                                
                                <div class="form-floating mb-1 col-5 mt-1 mx-1">
                                    <input type="text" class="form-control mt-2" name="dermaga"  required
                                        placeholder="Dermaga" >
                                    <label for="floatingInput mt-1">Dermaga</label>
                                </div>

                                <div class="form-floating mb-1 col-12 mt-1 ">
                                    <input type="text" class="form-control mt-2" name="name_kapal"  required
                                        placeholder="Kapal" >
                                    <label for="floatingInput col-4 mt-1">Kapal</label>
                                </div>

                                <div class="form-floating mb-1 col-12 mt-1 ">
                                    <button type="button submit" class="btn btn-light text-light bg-primary col-12 ">Submit</button>
                                </div>
                            </form>
                    </div>
            </div>

            @if (isset($kerja))
            <table class="table table-borderless">
                <thead class="">
                    <tr class="text-center text-light">
                        <th scope="col">Leader</th>
                        <th scope="col">Kapal</th>
                        <th scope="col">Dermaga</th>
                        <th scope="col">Keterangan</th>
                </thead>
                <tbody class="text-center text-light">
                  <td>
                    {{$kerja->name_pengawas}}
                  </td>
                  <td>
                    {{$kerja->name_kapal}}
                  </td>
                  <td>
                    {{$kerja->dermaga}}
                  </td>
                  <td {{ $keluar_3 === true ? 'hidden':' ' }}>
                    === Sedang Berlangsung ===
                  </td>
                  <td {{ $keluar_3 === false ? 'hidden':' ' }}>
                    <a href="{{url('/detail-absen/'.$kerja->id_absensi)}}">
                        <button type="button" class="btn btn-light text-light bg-btn-shift mx-1 col-6 ">Keluar</button>
                    </a>
                  </td>
                </tbody>
            </table>
            <a href="{{url('/detail-absen/'.$kerja->id_absensi)}}" class="text-light">
                <button type="button" class="btn btn-outline-light col-11 m-3 me-auto" ><i class="bi bi-list-check"></i> &nbsp;Details</a></button>
            </a>
            <br><h4 class="text-light">{{$kerja->tgl}}</h4>
            @endif
        </div>



    </div>
</div>


<script>
            function generateCode(shift) {
                var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            var length = 5; // Panjang kode yang dihasilkan

            var generatedCode = "";
            for (var i = 0; i < length; i++) {
            var randomIndex = Math.floor(Math.random() * characters.length);
            generatedCode += characters.charAt(randomIndex);
            }
  
      // Mengubah nilai input dengan kode yang dihasilkan
        var generatedCodeInput = document.getElementById("generatedCode" + shift);
        var generatedCodeContainer = document.getElementById("generatedCodeContainer" + shift);

        generatedCodeInput.value = generatedCode;
        generatedCodeContainer.style.display = "block";
    }

    
  </script>



@endsection