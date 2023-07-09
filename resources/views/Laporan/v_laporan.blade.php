@extends('layout/template')

@section('isi-konten')



<div class="container-fluid pt-4 px-4">
    <div class="row vh-10 bg-light rounded align-items-center justify-content-center mx-0">
       <form method="POST" action="{{url('/laporan-cari-kapal')}}">
        @csrf
        <div class="d-flex">
            <div class="form-floating m-3 col-5">
                <input type="text" class="form-control" name="name_kapal" placeholder="Nama Kapal">
                <label for="floatingInput">Nama Kapal</label>
            </div>
            <div class="form-floating m-3 col-5">
                <input type="text" class="form-control" name="tgl" value="{{$today}}">
                <label for="floatingInput">Tahun-Bulan-Tanggal </label>
            </div>
            <button type="submit" class="btn btn-lx btn-light mt-3 mb-3 ms-2 col-1"><i class="fa fa-search"></i> Cari</button>
        </div>
       </form>
    </div>
</div>

{{-- @dd($dataS2) --}}
@if (isset($namakapal))
<div class="container-fluid pt-4 px-4">
    <div class="row vh-10 bg-light rounded align-items-left justify-content-left mx-0 ">
        <div class="row">
            <div class="col-2 mt-3">
                <h5>{{$tanggal}}</h5>
            </div>
            <div class=" col-4 mt-3 text-center">
                <h4>{{$namakapal}}</h4>
            </div>
            <div class="col-3 mt-3">
                <h4>
                    <form class="" action="/cetak-laporan" method="POST" target="_blank">
                        @csrf
                        <input type="text" name="id_1" value="{{$idS1}}" hidden >
                        <input type="text" name="id_2" value="{{$idS2}}" hidden >
                        <input type="text" name="id_3" value="{{$idS3}}" hidden >
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-file-earmark"></i> Laporan PDF
                        </button>
                    </form>       
                </h4>
            </div>
                <div class="col-3 mt-3">
                    <h4>
                        <form class="" action="/cetak-laporan-excel" method="POST" target="_blank">
                            @csrf
                            <input type="text" name="id_1" value="{{$idS1}}" hidden >
                            <input type="text" name="id_2" value="{{$idS2}}" hidden >
                            <input type="text" name="id_3" value="{{$idS3}}" hidden >
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-file-earmark-spreadsheet-fill"></i> Laporan Excel
                            </button>
                        </form>       
                    </h4>
                </div>
                
               
        </div>
    </div>
</div>
@endif

@if (isset($dataS1))
<div class="container-fluid pt-4 px-4 mb-5">
    <div class="row vh-50 bg-light rounded align-items-center justify-content-center mx-0">
        
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-3"> Shift I</h4>
                <h4 class="mb-3">
                    {{$P1}}
                </h4>
            </div> 

                <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Bagian</th>
                                <th scope="col">Dermaga</th>
                        </thead>
                        <tbody >
                            
                            @foreach ($dataS1 as $item1)
                            <tr>
                                <th scope="row" class="text-center">{{$no++}}</th>
                                <td class="m-1">{{$item1->name_karyawan}}</td>
                                <td class="m-1">{{$item1->bagian}}</td>
                                <td class="m-1">{{$item1->dermaga}}</td>
                                @endforeach
                                {{-- @dd($dataS3) --}}
                                
                        </tbody>
                    </table>
               
            </div>
        </div>

    </div>
</div>
@endif

@if (isset($dataS2))
<div class="container-fluid pt-4 px-4 mb-5">
    <div class="row vh-50 bg-light rounded align-items-center justify-content-center mx-0">
        
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-3"> Shift II</h4>
                <h4 class="mb-3">
                    {{$P2}}
                </h4>
            </div> 

                <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Bagian</th>
                                <th scope="col">Dermaga</th>
                        </thead>
                        <tbody >
                            
                            @foreach ($dataS2 as $item2)
                            <tr>
                                <th scope="row" class="text-center">{{$no++}}</th>
                                <td class="m-1">{{$item2->name_karyawan}}</td>
                                <td class="m-1">{{$item2->bagian}}</td>
                                <td class="m-1">{{$item2->dermaga}}</td>
                                @endforeach
                                {{-- @dd($dataS3) --}}
                                
                        </tbody>
                    </table>
               
            </div>
        </div>

    </div>
</div>
@endif

@if (isset($dataS3))
<div class="container-fluid pt-4 px-4 mb-5">
    <div class="row vh-50 bg-light rounded align-items-center justify-content-center mx-0">
        
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-3"> Shift III</h4>
                <h4 class="mb-3">
                    {{$P3}}
                </h4>
            </div> 

                <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Bagian</th>
                                <th scope="col">Dermaga</th>
                        </thead>
                        <tbody >
                            
                            @foreach ($dataS3 as $item3)
                            <tr>
                                <th scope="row" class="text-center">{{$no++}}</th>
                                <td class="m-1">{{$item3->name_karyawan}}</td>
                                <td class="m-1">{{$item3->bagian}}</td>
                                <td class="m-1">{{$item3->dermaga}}</td>
                                @endforeach
                                {{-- @dd($dataS3) --}}
                                
                        </tbody>
                    </table>
               
            </div>
        </div>

    </div>
</div>
@endif


@endsection