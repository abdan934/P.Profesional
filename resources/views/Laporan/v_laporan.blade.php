{{$no=1}}
@extends('layout/template')

@section('isi-konten')


<div class="container-fluid pt-4 px-4">
    <div class="row vh-10 bg-light rounded align-items-center justify-content-center mx-0">
       <form action="">
        <div class="d-flex">
            <div class="form-floating m-3 col-5">
                <input type="text" class="form-control" name="name_kapal" placeholder="Nama Kapal">
                <label for="floatingInput">Nama Kapal</label>
            </div>
            <div class="form-floating m-3 col-5">
                <input type="text" class="form-control" name="tgl" value="{{$today}}">
                <label for="floatingInput">Bulan dan Tahun</label>
            </div>
            <button type="button submit" class="btn btn-lx btn-light mt-3 mb-3 ms-2 col-1"><i class="fa fa-search"></i> Cari</button>
        </div>
       </form>
    </div>
</div>

@if (isset($data))
    
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
        
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-3">Data User</h4>
            </div>
            <h4 class="mb-3">{{$data->tgl}}</h4>
                <div class="d-flex align-items-center justify-content-between col-12">
                    <form class="d-flex align-items-center mb-3" action="/user" method="GET">
                        @csrf
                        <input class="form-control flex-grow-1" type="search" placeholder="Search" name="search">
                        <button type="submit" class="btn btn-lm btn-light m-1"><i class="fa fa-search"></i></button>
                    </form>
                    <div class="ml-auto m-1">
                        <button type="button" class="btn btn-light"><a href="/user"><i class="bi bi-arrow-counterclockwise me-2"></i>Refresh</a></button>
                    </div>
                </div>

                <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Pengawas</th>
                                <th scope="col">Bagian</th>
                                <th scope="col">Dermaga</th>
                                <th scope="col">Tanggal</th>
                        </thead>
                        <tbody >
                            
                            @foreach ($data as $item)
                            <tr>
                                <th scope="row" class="text-center">{{$no++}}</th>
                                <td class="m-1">{{$item->name_pengawas}}</td>
                                <td class="m-1">{{$item->name_karyawan}}</td>
                                <td class="m-1">{{$item->bagian}}</td>
                                <td class="m-1">{{$item->dermaga}}</td>
                                <td class="m-1">{{$item->tgl}}</td>
                                @endforeach
                                
                        </tbody>
                    </table>
               
            </div>
        </div>

    </div>
</div>

@endif


@endsection