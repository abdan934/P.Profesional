@extends('layout/template')

@section('isi-konten')


            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="row vh-50 bg-light rounded align-items-center justify-content-center mx-0">
                            <form action="{{'/user/'.$data->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="bg-light rounded h-100 p-4">
                                    <h3 class="mb-4">Data User</h3>
                                    <div class="form-floating mb-3">
                                        {{-- <input type="hidden" name="id" value="{{ $data->id }}"> --}}
                                            <input type="text" class="form-control" value="{{$data->username}}" disabled
                                                placeholder="username">
                                            <label for="floatingInput">Username</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{$data->name}}" name="name"
                                            placeholder="Nama">
                                        <label for="floatingInput">Nama</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" value="{{$data->email}}" name="email"
                                            placeholder="name@example.com">
                                        <label for="floatingInput">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select"  name="level" 
                                            aria-label="Floating label select example">
                                            <option selected >-- Pilih --</option>
                                            {{-- <option value="admin" {{ $data->level === 'admin' ? 'selected' : '' }}>Admin</option> --}}
                                            <option value="Pengawas" {{ $data->level === 'Pengawas' ? 'selected' : '' }}>Pengawas</option>
                                            <option value="Karyawan"  {{ $data->level === 'Karyawan' ? 'selected' : '' }}>Karyawan</option>
                                            <option value="HRD"  {{ $data->level === 'HRD' ? 'selected' : '' }}>HRD</option>
                                        </select>
                                        <label for="floatingSelect">Jabatan</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary m-1" ><i class="bi bi-save"></i> Simpan</button>
                                    <button type="button" class="btn btn-light m-1" ><a href="/user"><i class="bi bi-arrow-left"></i> Batal</a></button>
                                </div>
                            </form>
                        </div>
                    </div>

@endsection