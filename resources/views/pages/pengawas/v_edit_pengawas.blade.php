@extends('layout/template')

@section('isi-konten')
{{-- @dd($data) --}}
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="row vh-50 bg-light rounded align-items-center justify-content-center mx-0">
                            <form action="{{'/pengawas/'.$data->id_pengawas}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="bg-light rounded h-100 p-4">
                                    <h3 class="mb-4">Data Pengawas</h3>
                                    <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{$data->id_pengawas}}" readonly placeholder="Kode Pengawas" disabled
                                                placeholder="Kode Pengawas">
                                            <label for="floatingInput">Kode Pengawas</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{$data->name_pengawas}}" name="name_pengawas"
                                            placeholder="Nama">
                                        <label for="floatingInput">Nama</label>
                                    </div>
                                    <button type="button submit" class="btn btn-primary m-1" ><i class="bi bi-save"></i> Simpan</button>
                                    <button type="button" class="btn btn-light m-1" ><a href="/pengawas"><i class="bi bi-arrow-left"></i> Batal</a></button>
                                </div>
                            </form>
                        </div>
                    </div>

@endsection