@extends('layout/template')

@section('isi-konten')
    
     
<div class="container-fluid pt-4 px-4">
    <div class="row vh-80 bg-light rounded align-items-center justify-content-center mx-0">
        <div class="alert alert-success bg-grass-green col-11 m-3">
           <h2 class="text-light"><i class="bi bi-stopwatch-fill"></i>&nbsp; SHIFT 1 </h2>
           <h5 class="bg-text-shift mx-4"> 00.00-08.00 </h5>
           
           <div class="d-flex flex-column flex-sm-row justify-content-left align-items-left mb-1 col-8">
            <button type="button" class="btn btn-light text-light bg-btn-shift mx-2 col-10 " onclick="generateCode(1)">Generate Code</button>
                <div class="d-flex justify-content-left mt-2 mb-1">
                    <button type="button" class="btn btn-light text-light bg-btn-shift mx-2 col-6">Masuk</button>
                    <button type="button" class="btn btn-light text-light bg-btn-shift mx-1 col-6 ">Keluar</button>
                </div>
           </div>
            <br>
            <div id="generatedCodeContainer1" style="display: none;">
                <form action="" class="col-10 d-flex">
                    <input type="text" class="mx-5 mt-2 form-control" name="id_absen" id="generatedCode1" disabled>
                    <input type="text" class="mx-5 mt-2 form-control" name="id_absen" id="generatedCode" disabled>
                </form>
               </div>
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

        <div class="alert alert-success bg-grass-green col-11 m-3">
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
        </div>

    </div>
</div>


<script>
            function generateCode(shift) {
                var characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
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