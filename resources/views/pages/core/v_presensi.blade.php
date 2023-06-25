@extends('layout/template')

@section('isi-konten')

<div class="container-fluid pt-4 px-4">
    <div class="row vh-15 bg-light rounded align-items-center justify-content-center mx-0">
        <button type="button" class="btn btn-secondary col-11 m-3" data-bs-toggle="modal" data-bs-target="#ModalMasukKaryawan" {{ $keluar === true ? 'hidden':' ' }}><i class="bi bi-box-arrow-in-down"></i> &nbsp;Masuk</a></button>
        <button type="button" class="btn btn-warning col-11 m-3" data-bs-toggle="modal" data-bs-target="#ModalKeluarKaryawan" {{ $keluar === false ? 'hidden':' ' }}><i class="bi bi-box-arrow-in-up" ></i> &nbsp;Keluar</a></button>
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="mb-3">@if(isset($data)){{$data}} @endif</h4>
                
            </div>
    </div>
</div>
{{-- Table Masuk --}}
<div class="container-fluid pt-4 px-4 mb-5">
    <div class="row vh-50 bg-light rounded align-items-center justify-content-center mx-0">
        <div class="d-flex align-items-center justify-content-between">
            <h4></h4>
            <h4 class="m-3">Masuk</h4>
            <h4></h4>
                
            </div>       
                <div class="bg-light rounded h-100 p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="">
                                <tr class="text-center text-dark">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Karyawan</th>
                                    <th scope="col">Bagian</th>
                            </thead>
                            <tbody class="text-center text-dark">
                                @foreach ($data_m as $item1)
                                <tr>
                                    <td>
                                        {{$no++}}
                                    </td>
                                    <td>
                                        {{$item1->name_karyawan}}
                                    </td>
                                    <td>
                                        {{$item1->bagian}}
                                    </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (isset($item1->name_kapal))
                        
                    <div class="d-flex align-items-center justify-content-between">
                        <h4></h4>
                        <h4 class="m-3">{{$item1->name_kapal}}</h4>    
                        <h4></h4>
                    </div> 
                    <h5 class="m-2">{{$item1->tgl}}</h5>
                    @endif
                </div>
    </div>
</div>

{{-- Table Keluar --}}
<div class="container-fluid pt-4 px-4 mb-5" {{ $keluar === false ? 'hidden':' ' }}>
    <div class="row vh-50 bg-light rounded align-items-center justify-content-center mx-0">
        <div class="d-flex align-items-center justify-content-between">
            <h4></h4>
            <h4 class="m-3">Keluar</h4>
            <h4></h4>
                
            </div>       
                <div class="bg-light rounded h-100 p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="">
                                <tr class="text-center text-dark">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Karyawan</th>
                                    <th scope="col">Bagian</th>
                            </thead>
                            <tbody class="text-center text-dark">
                                @foreach ($data_k as $item2)
                                <tr>
                                    <td>
                                        {{$no_1++}}
                                    </td>
                                    <td>
                                        {{$item2->name_karyawan}}
                                    </td>
                                    <td>
                                        {{$item2->bagian}}
                                    </td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if (isset($item2->name_kapal))
                        
                    <div class="d-flex align-items-center justify-content-between">
                        <h4></h4>
                        <h4 class="m-3">{{$item2->name_kapal}}</h4>    
                        <h4></h4>
                    </div> 
                    <h5 class="m-2">{{$item2->tgl}}</h5>
                    @endif
                </div>
    </div>
</div>

    <!-- Modal Absen Masuk-->
    <div class="modal fade" id="ModalMasukKaryawan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Absen Karyawan
                    </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form method="POST" action="/mulai-absen">
                    @csrf
                    <input type="text" class="form-control mb-1" name="id_absensi" value="{{$id_absen}}" hidden>
                    
                                <div class="testimonial-item text-center">
                                    <button type="button" class="btn btn-success" onclick="startQRScanner(1)">Aktifkan Kamera</button>
                                    <div id="reader1"></div>
                                        
                                            <div class="form-floating mb-2 mt-2">
                                                <input type="text" class="form-control" id="result1"  name="id_karyawan" >
                                                <label for="floatingInput">Kode Karyawan</label>
                                            </div>
                                        
                                </div>
                    
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="bagian">
                        <option selected>-- Bagian --</option>
                        <option value="Foreman">Foreman</option>
                        <option value="Driver">Driver</option>
                        <option value="Personil">Personil</option>
                    </select>

                    <input type="text" class="form-control" name="keterangan" value="Masuk" required hidden>
                       
                    <button type="button submit" class="btn btn-outline-dark form-control bg-primary" ><i class="bi bi-clipboard-check"></i> Absen</button>
                    
            </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Absen Keluar-->
    <div class="modal fade" id="ModalKeluarKaryawan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        Absen Karyawan
                    </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form method="POST" action="/mulai-absen">
                    @csrf
                    <input type="text" class="form-control mb-1" name="id_absensi" value="{{$id_absen}}" hidden>
                    
                                <div class="testimonial-item text-center">
                                    <button type="button" class="btn btn-success" onclick="startQRScanner(2)">Aktifkan Kamera</button>
                                    <div id="reader2" width="600px"></div>
                                        
                                            <div class="form-floating mb-2 mt-2">
                                                <input type="text" class="form-control" id="result2"  name="id_karyawan" required >
                                                <label for="floatingInput">Kode Karyawan</label>
                                            </div>
                                        
                                </div>
                    
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="bagian">
                        <option selected>-- Bagian --</option>
                        <option value="Foreman">Foreman</option>
                        <option value="Driver">Driver</option>
                        <option value="Personil">Personil</option>
                    </select>

                    <input type="text" class="form-control" name="keterangan" value="Keluar" required hidden>
                       
                    <button type="button submit" class="btn btn-outline-dark form-control bg-primary" ><i class="bi bi-clipboard-check"></i> Absen</button>
                    
            </form>
            </div>
        </div>
        </div>
    </div>










<script>
    let html5QrcodeScanner
    let ketVal

    function startQRScanner(ket) {
        ketVal = ket 
        html5QrcodeScanner = new Html5QrcodeScanner(
        "reader"+ketVal,
        { fps: 10, qrbox: {width: 250, height: 250} },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess);
    }
   
    function onScanSuccess(decodedText, decodedResult) {
                html5QrcodeScanner.clear()
                // $('#result').val(decodedText)
                document.getElementById('result'+ketVal).value = decodedText;
            }
</script>


@endsection