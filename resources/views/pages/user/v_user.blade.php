@extends('layout/template')

@section('isi-konten')


<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">

            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Data User</h6>
                <table class="table table-hover">
                    <thead>
                        <tr >
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
                            <td style="align-items: center;">{{$item->username}}</td>
                            <td style="align-items: center;">{{$item->name}}</td>
                            <td style="align-items: center;">{{$item->level}}</td>
                            <td class="d-flex">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#ModalHapus"><i class="bi bi-list-ul me-2"></i>Details</button>               
                                
                                <!-- Modal -->
                                    <div class="modal fade" id="ModalHapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        Detail Data User
                                                    </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <form method="POST" action="{{'/user/'.$item->id}}">
                                                    @csrf
                                                    @method('PUT')
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" 
                                                        placeholder="Username" value="{{$item->username}}" disabled>
                                                    <label for="floatingInput">Username</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="name"
                                                        placeholder="Nama" value="{{$item->name}}">
                                                    <label for="floatingInput">Nama</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" id="floatingSelect" name="level"
                                                        aria-label="Floating label select example">
                                                        <option selected>{{$item->level}}</option>
                                                        <option value="admin">admin</option>
                                                        <option value="pengawas">pengawas</option>
                                                        <option value="karyawan">karyawan</option>
                                                    </select>
                                                    <label for="floatingSelect">Pilih jabatan</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" id="floatingPassword" name="password"
                                                        placeholder="Password" {{$item->password}}>
                                                    <label for="floatingPassword">Password</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-pencil"></i> Ubah</button>
                                            </form>
                                              
                                            <div class="modal-footer">
                                                <form action="{{'/user/'.$item->id}}">
                                                    <button type="button" class="btn btn-danger"><i class="bi bi-trash"></i> Hapus</button>
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
</div>


@endsection