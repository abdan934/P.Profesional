@extends('layout/template')

@section('isi-konten')


<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
        
        <button type="button" class="btn btn-outline-primary col-3 m-2" data-bs-toggle="modal" data-bs-target="#ModalAdd"><i class="bi bi-person-plus me-2"></i>Tambah</a></button>
        <button type="button" class="btn btn-outline-success col-3 m-2" data-bs-toggle="modal" data-bs-target="#ModalImport"><i class="bi bi-file-earmark-excel me-2"></i>Import</button>
        <button type="button" class="btn btn-outline-secondary col-3 m-2" data-bs-toggle="modal" ><i class="bi bi-file-earmark-spreadsheet me-2"></i><a href="{{asset('template-2.xlsx')}}">Template</a></button>
        <div class="bg-light rounded h-100 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-3">Data User</h4>
                    
                </div>
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
                                <th scope="col">Username</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Jabatan</th>
                                <th >Aksi</th>
                                <th>Reset</th>
                        </thead>
                        <tbody >
                            
                            @foreach ($data as $item)
                            <tr>
                                <th scope="row" class="text-center">{{$no++}}</th>
                                <td class="m-1">{{$item->username}}</td>
                                <td class="m-1">{{$item->name}}</td>
                                <td class="m-1">{{$item->email}}</td>
                                <td class="m-1">{{$item->level}}</td>
                                <td class="text-center">
                                        <button type="button" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#ModalHapus_{{$item->id}}"><i class="bi bi-trash"></i> Hapus</button>  
                                    <a href="{{url('/user/'.$item->id.'/edit')}}">             
                                        <button type="button" class="btn btn-outline-info m-1"><i class="bi bi-list"></i> Detail</button>               
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
                                    <td class="text-center">
                                        <form action="{{ ('/reset-password/'.$item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin mereset password pengguna ini?')">
                                            @csrf
                                        <button type="button submit"  class="btn btn-outline-warning" >
                                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                                
                        </tbody>
                    </table>
                <div class="custom-pagination m-2">
                    <div class="pagination-summary m-2">
                        Result: {{$data->total()}}    
                    </div>
                    {{$data->links('pagination::simple-bootstrap-4')}}
                    <ul class="pagination pagination-ls m-1 mb-3">
                        <li class="page-item active" aria-current="page">
                            <span class="page-link colour-success">{{$data->currentPage()}}</span>
                        </li>
                        <li class="page-item disabled">
                            <span class="page-link">Total Halaman: {{$data->lastPage()}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
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
                            <input type="text" class="form-control"  name="username" required 
                                placeholder="Username"  >
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" required 
                                placeholder="Nama" >
                            <label for="floatingInput">Nama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" required 
                                placeholder="Email" >
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="password" required 
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

            <!-- Modal Import Excel-->
            <div class="modal fade" id="ModalImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Import User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/importuser" id="frmFileUpload" class="dropzone" method="post" enctype="multipart/form-data">
                        @csrf
                                    <div>
                                        <label for="formFileLg" class="form-label"><h4>Gunakan nama file selain template-user.xlsx</h4></label>
                                        <label for="formFileLg" class="form-label">Masukkan File Excel</label>
                                        <input class="form-control form-control-lg" id="formFileLg" type="file" name="file_excel" multiple>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" onclick="submitForm()" class="btn btn-primary"><i class="bi bi-person-plus-fill"></i> Import</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>

            <script>
                function submitForm() {
                    var fileInput = document.getElementById('formFileLg');
                    if (fileInput.files.length === 0) {
                        alert('Masukkan File terlebih dahulu.');
                        return;
                    }
                    document.getElementById('frmFileUpload').submit();
                }
            </script>
@endsection