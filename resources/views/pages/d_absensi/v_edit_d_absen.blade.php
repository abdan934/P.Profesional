@extends('layout/template')

@section('isi-konten')

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="row vh-50 bg-light rounded align-items-center justify-content-center mx-0">
                            <form action="{{'/detail-absensi/'.$data->id_detail_absensi}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="bg-light rounded h-100 p-4">
                                    <h3 class="mb-4">Data Detail Absensi</h3>
                                    <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{$data->id_absensi}}" disabled
                                                placeholder="Kode Absen">
                                            <label for="floatingInput">Kode Absen</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{$data->id_karyawan}}" disabled
                                                placeholder="Kode Karyawan">
                                            <label for="floatingInput">Kode Karyawan</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="{{$data->id_sift}}" disabled
                                                placeholder="Kode Shift">
                                            <label for="floatingInput">Kode Shift</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{$data->name_kapal}}" name="name_kapal" required
                                            placeholder="Nama Kapal">
                                        <label for="floatingInput">Nama Kapal</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{$data->bagian}}" name="bagian" required
                                            placeholder="Bagian">
                                        <label for="floatingInput">Bagian</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{$data->dermaga}}" name="dermaga" required
                                            placeholder="Dermaga">
                                        <label for="floatingInput">Dermaga</label>
                                    </div>
                                    <fieldset class="row mb-3 col-5">
                                        <legend class="col-form-label col-sm-3 pt-0">Status : </legend>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="keterangan"
                                                    value="Hadir" {{ $data->keterangan === 'Hadir' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gridRadios1">
                                                    Hadir
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="keterangan"
                                                    value="Absen" {{ $data->keterangan === 'Absen' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gridRadios2">
                                                    Absen
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <button type="submit" class="btn btn-primary m-1" ><i class="bi bi-save"></i> Simpan</button>
                                    <button type="button" class="btn btn-light m-1" ><a href="/hrd"><i class="bi bi-arrow-left"></i> Batal</a></button>
                                </div>
                            </form>
                        </div>
                    </div>

@endsection