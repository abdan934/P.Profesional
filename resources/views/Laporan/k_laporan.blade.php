@extends('layout/template')

@section('isi-konten')



<div class="container-fluid pt-4 px-4">
    <div class="row vh-10 bg-light rounded align-items-center justify-content-center mx-0">
        <form class="d-flex align-items-center mb-3 mt-3" action="/cek-absen-karyawan" method="GET">
            @csrf
            <input class="form-control flex-grow-1" type="search" placeholder="Search" name="search" value="{{$today}}">
            <button type="button submit" class="btn btn-lm btn-light m-1"><i class="fa fa-search"></i></button>
        </form>
    </div>
</div>

@if (isset($data_absen_s))
<div class="container-fluid pt-4 px-4 mb-5">
    <div class="row vh-50 bg-light rounded align-items-center justify-content-center mx-0">
        
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-3">{{$data_absen_s[0]->tgl}}</h4>
                <h4 class="mb-3">
                    
                </h4>
            </div> 

                <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kapal</th>
                                <th scope="col">Dermaga</th>
                                <th scope="col">Bagian</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Kode</th>
                        </thead>
                        <tbody >
                            
                            @foreach ($data_absen_s as $item)
                            <tr>
                                <th scope="row" class="text-center">{{$no++}}</th>
                                <td class="m-1">{{$item->name_karyawan}}</td>
                                <td class="m-1">{{$item->name_kapal}}</td>
                                <td class="m-1">{{$item->dermaga}}</td>
                                <td class="m-1">{{$item->bagian}}</td>
                                <td class="m-1">{{$item->tgl}}</td>
                                <td class="m-1">{{$item->id_absensi}}</td>
                                @endforeach
                                
                        </tbody>
                    </table>
               
            </div>
        </div>

    </div>
</div>
@else
<div class="container-fluid pt-4 px-4 mb-5">
    <div class="row vh-50 bg-light rounded align-items-center justify-content-center mx-0">
        
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-3"> {{$bulansekarang}}</h4>
                <h4 class="mb-3">
                    
                </h4>
            </div> 

                <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kapal</th>
                                <th scope="col">Dermaga</th>
                                <th scope="col">Bagian</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Kode</th>
                        </thead>
                        <tbody >
                            
                            @foreach ($data_absen as $item1)
                            <tr>
                                <th scope="row" class="text-center">{{$no++}}</th>
                                <td class="m-1">{{$item1->name_karyawan}}</td>
                                <td class="m-1">{{$item1->name_kapal}}</td>
                                <td class="m-1">{{$item1->dermaga}}</td>
                                <td class="m-1">{{$item1->bagian}}</td>
                                <td class="m-1">{{$item1->tgl}}</td>
                                <td class="m-1">{{$item1->id_absensi}}</td>
                                @endforeach
                                
                        </tbody>
                    </table>
               
            </div>
        </div>

    </div>
</div>
    

@endif

@endsection