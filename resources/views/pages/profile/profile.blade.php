@extends('layout/template')

@section('isi-konten')


            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="row vh-50 bg-light rounded align-items-center justify-content-center mx-0">
                            <form action="{{'/myprofile/'.$user->username}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="bg-light rounded h-100 p-4">
                                    <h3 class="mb-4">MyProfile</h3>
                                    <div class="form-floating mb-3">
                                        {{-- <input type="hidden" name="id" value="{{ $user->id }}"> --}}
                                            <input type="text" class="form-control" value="{{$user->username}}" disabled
                                                placeholder="username">
                                            <label for="floatingInput">Username</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" value="{{$user->name}}" name="name"
                                            placeholder="Nama">
                                        <label for="floatingInput">Nama</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" value="{{$user->email}}" name="email"
                                            placeholder="name@example.com">
                                        <label for="floatingInput">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select"  disabled
                                            aria-label="Floating label select example">
                                            <option value="admin" {{ $user->level === 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="pengawas" {{ $user->level === 'pengawas' ? 'selected' : '' }}>Pengawas</option>
                                            <option value="karyawan"  {{ $user->level === 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                                            <option value="hrd"  {{ $user->level === 'hrd' ? 'selected' : '' }}>HRD</option>
                                        </select>
                                        <label for="floatingSelect">Jabatan</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary m-1" ><i class="bi bi-save"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-6 mb-5">
                        <div class="bg-light rounded h-100 p-4">
                            <h4 class="mb-4 text-center">Foto Profile</h4>
                            <form action="{{'/ubah-profile/'.$user->username}}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="text-center">
                                    <img class="img-fluid rounded-circle mx-auto mb-4" src="{{asset('fotoprofile/'.$user->foto_profile)}}" style="width: 100px; height: 100px;">
                                </div>
                                <div class="mb-3">
                                    <label for="formFileMultiple" class="form-label">Masukan foto</label>
                                    <input class="form-control" type="file" name="foto_profile" id="formFileMultiple" multiple required>
                                </div>
                                <!-- Button trigger modal -->
                                    <button type="button submit" class="btn btn-primary" >
                                        Ubah
                                    </button>
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-6 mb-5">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Ganti Password</h6>
                            <form action="{{'/ubah-pass/'.$user->username}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" value="******" name="password">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" value="******" name="password_confirmation">
                                </div>
                                <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Ubah
                                    </button>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Informasi !!!</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                        <div class="modal-body">
                                                            <h5>Yakin ingin mengubah password anda?</h5>
                                                        </div>
                                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                            <button type="button submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>

                    @if (isset($karyawan))
                    <div class="col-sm-6 col-xl-6 mb-5">
                        <div class="bg-light rounded h-100 p-4">
                            <h4 class="mb-4 text-center">QR CODE</h4>
                                <div class="text-center">
                                    <img class="img-fluid rounded-square mx-auto mb-4" src="{{asset('QRcode/'.$karyawan->qr_karyawan)}}" style="width: 200px; height: 200px;">
                                </div>
                        </div>
                    </div>
                    @endif
                </div>

                    
@endsection