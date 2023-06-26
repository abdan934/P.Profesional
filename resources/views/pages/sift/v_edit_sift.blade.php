@extends('layout/template')

@section('isi-konten')
{{-- @dd($data) --}}
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="row vh-50 bg-light rounded align-items-center justify-content-center mx-0">
                            <form action="{{'/sift/'.$data->id_sift}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="bg-light rounded h-100 p-4">
                                    <h3 class="mb-4">Data Shift</h3>
                                    <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{$data->id_sift}}" readonly placeholder="Kode Shift" disabled
                                                placeholder="Kode Shift">
                                            <label for="floatingInput">Kode Shift</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{$data->name_sift}}" name="name_sift"
                                            placeholder="Nama">
                                        <label for="floatingInput">Nama</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="time" class="form-control" name="waktu_awal" required value="{{$data->waktu_awal}}" required
                                            placeholder="Waktu Awal" >
                                        <label for="floatingInput">Waktu Awal</label>
                                    </div>
                                    
                                    <div class="form-floating mb-3">
                                        <input type="time" class="form-control" name="waktu_akhir" required value="{{$data->waktu_akhir}}" required
                                            placeholder="Waktu Akhir" >
                                        <label for="floatingInput">Waktu Akhir</label>
                                    </div>
                                    <button type="button submit" class="btn btn-primary m-1" ><i class="bi bi-save"></i> Simpan</button>
                                    <button type="button" class="btn btn-light m-1" ><a href="/sift"><i class="bi bi-arrow-left"></i> Batal</a></button>
                                </div>
                            </form>
                        </div>
                    </div>

@endsection