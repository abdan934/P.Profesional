@extends('layout/template')

@section('isi-konten')


<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
        
        <button type="button" class="btn btn-outline-primary col-3 m-2" data-bs-toggle="modal" data-bs-target="#ModalAdd"><i class="bi bi-person-plus me-2"></i>Tambah</a></button>
        <button type="button" class="btn btn-outline-success col-3 m-2" data-bs-toggle="modal" data-bs-target="#"><i class="bi bi-file-earmark-excel me-2"></i>Import</button>
        <button type="button" class="btn btn-outline-secondary col-3 m-2" data-bs-toggle="modal" ><i class="bi bi-file-earmark-spreadsheet me-2"></i>Template</button>
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-3">Data User</h4>
                <div>
                    <button type="button" class="btn btn-light"><a href="/user"><i class="bi bi-arrow-counterclockwise me-2"></i>Refresh</a></button>
                </div>
            </div>
                <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th scope="col">No</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th ></th>
                    </thead>
                    <tbody >
                        
                        @foreach ($data as $item)
                        <tr>
                            <th scope="row">{{$no++}}</th>
                            <td class="m-1">{{$item->username}}</td>
                            <td class="m-1">{{$item->name}}</td>
                            <td class="m-1">{{$item->level}}</td>
                            <td class="">
                                    <button type="button" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#ModalHapus_{{$item->id}}"><i class="bi bi-trash"></i></button>  
                                <a href="{{url('/user/'.$item->id.'/edit')}}">             
                                    <button type="button" class="btn btn-outline-info m-1"><i class="bi bi-list"></i></button>               
                                </a>
                                <!-- Modal -->
                                    <div class="modal fade" id="ModalHapus_{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        PERINGATAN !!
                                                    </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Yakin akan menghapus data ?</h5>
                                                <table>
                                                    <tr>
                                                        
                                                        <td><h6>Username</h6></td>
                                                    
                                                        <td><h6>=</h6></td>
                                                        <td><h6>{{$item->username}}</h6></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h6>Nama</h6></td>
                                                        <td><h6>=</h6></td>
                                                        <td><h6>{{$item->name}}</h6></td>
                                                    </tr>
                                                </table>
                                              
                                            <div class="modal-footer">
                                                <form action="{{'/user/'.$item->username}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button submit" class="btn btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            {{$data->links()}}
    </div>
</div>

            <!-- Modal Create-->
            <div class="modal fade" id="ModalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                Tambah User
                            </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <form method="POST" action="/user">
                            @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control"  name="username" required value="{{old('username')}}"
                                placeholder="Username"  >
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" required value="{{old('name')}}"
                                placeholder="Nama" >
                            <label for="floatingInput">Nama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" required value="{{old('email')}}"
                                placeholder="Email" >
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" name="level" required value="{{old('level')}}"
                                aria-label="Floating label select example">
                                <option selected>--- Pilih ---</option>
                                <option value="admin">admin</option>
                                <option value="pengawas">pengawas</option>
                                <option value="karyawan">karyawan</option>
                            </select>
                            <label for="floatingSelect">Pilih jabatan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" required value="{{old('password')}}"
                                placeholder="Password" >
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password_confirmation" required 
                                placeholder="Confirm Password" >
                            <label for="floatingPassword">Confirm Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary" ><i class="bi bi-plus"></i> Tambah</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>

@endsection