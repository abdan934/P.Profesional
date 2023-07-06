@extends('layout/template')

@section('isi-konten')

            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                    
                    <button type="button" class="btn btn-outline-primary col-3 m-3 me-auto" data-bs-toggle="modal" data-bs-target="#ModalAddDetailAbsen"><i class="bi bi-plus-circle-fill"></i> &nbsp;Tambah</a></button>

                    <div class="bg-light rounded h-100 p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <h4 class="mb-3">Data Detail Absen</h4>
                                
                            </div>
                            <div class="d-flex align-items-center justify-content-between col-12">
                                <form class="d-flex align-items-center mb-3" action="/detail-absensi" method="GET">
                                    @csrf
                                    <input class="form-control flex-grow-1" type="search" placeholder="Search" name="search">
                                    <button type="button submit" class="btn btn-lm btn-light m-1"><i class="fa fa-search"></i></button>
                                </form>
                                <div class="ml-auto m-1">
                                    <button type="button" class="btn btn-light"><a href="/detail-absensi"><i class="bi bi-arrow-counterclockwise me-2"></i>Refresh</a></button>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="rounded h-100 p-4">
                                    <div class="table-responsive">
                                            <table class="table table-hover table-bordered align-middle">
                                                <thead class="table-light">
                                                    <tr class="text-center">
                                                        <th >No</th>
                                                        <th >Kode</th>
                                                        <th >Nama Karyawan</th>
                                                        <th >Bagian</th>
                                                        <th >Nama Kapal</th>
                                                        <th >Keterangan</th>
                                                        <th >Waktu Absen</th>
                                                        <th >Aksi</th>
                                                </thead>
                                                <tbody >
                                                    
                                                    @foreach ($data as $item)
                                                    <tr class="text-center">
                                                        <th scope="row" class="text-center">{{$no++}}</th>
                                                        <td class="m-1">{{$item->id_absensi}}</td>
                                                        <td class="m-1">{{$item->name_karyawan}}</td>
                                                        <td class="m-1">{{$item->bagian}}</td>
                                                        <td class="m-1">{{$item->name_kapal}}</td>
                                                        <td class="m-1" style="position: relative;">
                                                            {{$item->keterangan}}
                                                        </td>
                                                        <td class="m-1">{{$item->waktu_absen}}</td>
                                                        <td class="text-center">
                                                                <button type="button" class="btn btn-outline-danger m-1" data-bs-toggle="modal" data-bs-target="#ModalHapus_{{$item->id_detail_absensi}}"><i class="bi bi-trash"></i> Hapus</button>  
                                                            <a href="{{url('/detail-absensi/'.$item->id_detail_absensi.'/edit')}}">             
                                                                <button type="button" class="btn btn-outline-info m-1"><i class="bi bi-list"></i> Detail</button>               
                                                            </a>
                                                            
                                                            <!-- Modal hapus-->
                                                                <div class="modal fade" id="ModalHapus_{{$item->id_detail_absensi}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                                            <table class="text-left">
                                                                                <tr>
                                                                                    
                                                                                    <td><h6>Kode Detail Absen</h6></td>
                                                                                    <td><h6>=</h6></td>
                                                                                    <td><h6>{{$item->id_detail_absensi}}</h6></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    
                                                                                    <td><h6>Kode Absen</h6></td>
                                                                                    <td><h6>=</h6></td>
                                                                                    <td><h6>{{$item->id_absensi}}</h6></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><h6>Nama Karyawan</h6></td>
                                                                                    <td><h6>=</h6></td>
                                                                                    <td><h6>{{$item->name_karyawan}}</h6></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><h6>Nama Kapal</h6></td>
                                                                                    <td><h6>=</h6></td>
                                                                                    <td><h6>{{$item->name_kapal}}</h6></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><h6>Bagian</h6></td>
                                                                                    <td><h6>=</h6></td>
                                                                                    <td><h6>{{$item->bagian}}</h6></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><h6>Dermaga</h6></td>
                                                                                    <td><h6>=</h6></td>
                                                                                    <td><h6>{{$item->dermaga}}</h6></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><h6>Keterangan</h6></td>
                                                                                    <td><h6>=</h6></td>
                                                                                    <td><h6>{{$item->keterangan}}</h6></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td><h6>Waktu Absen</h6></td>
                                                                                    <td><h6>=</h6></td>
                                                                                    <td><h6>{{$item->waktu_absen}}</h6></td>
                                                                                </tr>
                                                                            </table>
                                                                        
                                                                        <div class="modal-footer">
                                                                            <form action="{{'/detail-absensi/'.$item->id_detail_absensi}}" method="POST">
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
                                    
                                        <div class="custom-pagination m-2">
                                        <div class="pagination-summary m-2">
                                            Result: {{$data->total()}}    
                                        </div>
                                        {{$data->links('pagination::simple-bootstrap-4')}}
                                        <ul class="pagination pagination-ls m-1 mb-3">
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link">{{$data->currentPage()}}</span>
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
                <div class="modal fade" id="ModalAddDetailAbsen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    Tambah Data Detail Absen
                                </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                            <form method="POST" action="/detail-absensi">
                                @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control"  name="id_absensi" required value="{{old('id_absensi')}}"
                                    placeholder="Kode Absen"  >
                                <label for="floatingInput">Kode Absen</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="id_karyawan" required value="{{old('id_karyawan')}}"
                                    placeholder="Kode Karyawan" >
                                <label for="floatingInput">Kode Karyawan</label>
                            </div>
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="bagian" required>
                                <option selected>-- Bagian --</option>
                                <option value="Foreman" >Foreman</option>
                                <option value="Driver" >Driver</option>
                                <option value="Personil" >Personil</option>
                            </select>
                            <div class="form-floating mb-3">
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-3 pt-0">Keterangan : </legend>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="keterangan"
                                                value="Hadir" >
                                            <label class="form-check-label" for="gridRadios1">
                                                Hadir
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="keterangan"
                                                value="Absen">
                                            <label class="form-check-label" for="gridRadios2">
                                                Absen
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <button type="button submit" class="btn btn-primary" ><i class="bi bi-plus"></i> Tambah</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>

                <script>
                    // Mengambil element select
                    const keteranganSelect = document.getElementById('keterangan');
                
                    keteranganSelect.addEventListener('change', function() {
                        const newValue = this.value; 
                
                        axios.post('/update-keterangan', {
                            keterangan: newValue
                        })
                        .then(function(response) {
                            // Tanggapan sukses, lakukan tindakan lain jika diperlukan
                            console.log('Update keterangan berhasil');
                        })
                        .catch(function(error) {
                            // Tanggapan gagal, tangani kesalahan jika diperlukan
                            console.error('Gagal mengupdate keterangan');
                        });
                    });
                </script>
                
@endsection