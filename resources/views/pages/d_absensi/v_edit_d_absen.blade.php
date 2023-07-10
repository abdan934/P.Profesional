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
    
                                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="bagian" required>
                                        <option selected>-- Bagian --</option>
                                        <option value="Foreman"  {{ $data->bagian === 'Foreman' ? 'selected' : '' }}>Foreman</option>
                                        <option value="Driver"  {{ $data->bagian === 'Driver' ? 'selected' : '' }}>Driver</option>
                                        <option value="Personil"  {{ $data->bagian === 'Personil' ? 'selected' : '' }}>Personil</option>
                                    </select>   

                                    <fieldset class="row mb-3 col-5">
                                        <legend class="col-form-label col-sm-3 pt-0">Status : </legend>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="HADIR" {{ $data->status === 'HADIR' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gridRadios1">
                                                    Hadir
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="-" {{ $data->status === '-' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="gridRadios2">
                                                    Absen
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <button type="submit" class="btn btn-primary m-1" ><i class="bi bi-save"></i> Simpan</button>
                                    <button type="button" class="btn btn-light m-1" ><a href="/detail-absensi"><i class="bi bi-arrow-left"></i> Batal</a></button>
                                </div>
                            </form>
                        </div>
                    </div>

@endsection