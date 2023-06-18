@extends('layout/template')

@section('isi-konten')
    
     
<div class="container-fluid pt-4 px-4">
    <div class="row vh-80 bg-light rounded align-items-center justify-content-center mx-0">
        
        <div class="alert alert-success bg-grass-green col-11 m-3 ">
            <h2 class="text-light"><i class="bi bi-stopwatch-fill"></i>&nbsp; SHIFT 1 </h2>
            <h5 class="bg-text-shift mx-4"> 00.00-08.00 </h5>
            
            <div class="" {{ $cekabsen === 1 ? 'hidden':' ' }}>
                <div class="d-flex flex-column flex-sm-row justify-content-left align-items-left mb-1 col-12">
                    <button type="button" class="btn btn-light text-light bg-btn-shift mx-2 col-12" onclick="generateCode(1)">Mulai Shift</button>
                        {{-- <div class="d-flex justify-content-left mt-2 mb-1">
                            <button type="button" class="btn btn-light text-light bg-btn-shift mx-2 col-6">Masuk</button>
                            <button type="button" class="btn btn-light text-light bg-btn-shift mx-1 col-6 ">Keluar</button>
                        </div> --}}
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
                    === Sedang Berlangsung ==
                  </td>
                  <td {{ $keluar_1 === false ? 'hidden':' ' }}>
                    <a href="">
                        <button type="button" class="btn btn-light text-light bg-btn-shift mx-1 col-6 ">Keluar</button>
                    </a>
                  </td>
                </tbody>
            </table>
            @endif

        </div>

        <div class="alert alert-success bg-grass-green col-11 m-3">
            <h2 class="text-light"><i class="bi bi-stopwatch-fill"></i>&nbsp; SHIFT 2 </h2>
            <h5 class="bg-text-shift mx-4"> 08.00-16.00 </h5>
            
            <div class="d-flex flex-column flex-sm-row justify-content-left align-items-left mb-1 col-8">
            <button type="button" class="btn btn-light text-light bg-btn-shift mx-2 col-10 " onclick="generateCode(2)">Generate Code</button>
                <div class="d-flex justify-content-left mt-2 mb-1">
                    <button type="button" class="btn btn-light text-light bg-btn-shift mx-2 col-6">Masuk</button>
                    <button type="button" class="btn btn-light text-light bg-btn-shift mx-1 col-6 ">Keluar</button>
                </div>
            </div>
            <br>
            <div id="generatedCodeContainer2" style="display: none;">
                <form action="" class="col-10 d-flex">
                    <input type="text" class="mx-5 mt-2 form-control" name="id_absen" id="generatedCode2" disabled>
                    <input type="text" class="mx-5 mt-2 form-control" name="id_absen" id="generatedCode" disabled>
                </form>
                </div>
        </div>

            

            

       
         {{-- <div class="alert alert-success bg-grass-green col-11 m-3">
           <h2 class="text-light"><i class="bi bi-stopwatch-fill"></i>&nbsp; SHIFT 3 </h2>
           <h5 class="bg-text-shift mx-4"> 16.00-00.00 </h5>
           
           <div class="d-flex flex-column flex-sm-row justify-content-left align-items-left mb-1 col-8">
            <button type="button" class="btn btn-light text-light bg-btn-shift mx-2 col-10 " onclick="generateCode(3)">Generate Code</button>
                <div class="d-flex justify-content-left mt-2 mb-1">
                    <button type="button" class="btn btn-light text-light bg-btn-shift mx-2 col-6">Masuk</button>
                    <button type="button" class="btn btn-light text-light bg-btn-shift mx-1 col-6 ">Keluar</button>
                </div>
           </div>
            <br>
            <div id="generatedCodeContainer3" style="display: none;">
                <form action="" class="col-10 d-flex">
                    <input type="text" class="mx-5 mt-2 form-control" name="id_absen" id="generatedCode3" disabled>
                    <input type="text" class="mx-5 mt-2 form-control" name="id_absen" id="generatedCode" disabled>
                </form>
               </div>
        </div> --}}

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